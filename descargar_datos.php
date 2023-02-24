<?php
date_default_timezone_set('America/Bogota');
include('php/conexion.php');
include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
$usuario_actual = $_SESSION['ID_USUARIO'];
// Verificar si se envió el id del cliente a editar
if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];
} else {
    die('Error: no se ha especificado el id del cliente');
}

// Consulta SQL para obtener los datos del cliente a editar
$sql = "SELECT * FROM cliente WHERE ID_CLIENTE = $id_cliente";
$resultado = mysqli_query($conex, $sql);

// Comprobar si se encontró el cliente
if (mysqli_num_rows($resultado) == 0) {
    die('Error: no se encontró el cliente con id ' . $id_cliente);
}

// Obtener los datos del cliente
$fila = mysqli_fetch_assoc($resultado);
$Usuario_registro = $fila['USUARIO_REGISTRO_CLIENTE'];
$sql = "SELECT * FROM usuario WHERE ID_USUARIO=$Usuario_registro";
$resultado = mysqli_query($conex, $sql);
$usuario = mysqli_fetch_assoc($resultado);
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array(
    'isRemoteEnabled' => true,
    'defaultFont' => 'Arial'
));
$dompdf->setOptions($options);

// Incluir la librería domPDF
ob_start();
?>
<div>Nombres: <?php echo $fila['NOMBRES']; ?></div>
<div>Apellidos: <?php echo $fila['APELLIDOS'];?></div>
<div>Cedula: <?php echo $fila['CEDULA'];?></div>
<div>Telefono: <?php echo $fila['TELEFONO'];?></div>
<div>Dirección: <?php echo $fila['DIRECCION']; ?></div>
<div>Email: <?php echo $fila['EMAIL'];?></div>
<div>Fecha nacimiento: <?php echo $fila['FECHA_NACIMIENTO_CLIENTE'];?></div>
<div>Usuario Registro: <?php echo $fila['USUARIO_REGISTRO_CLIENTE'];?></div>
<?php
$html = ob_get_clean();

$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));
