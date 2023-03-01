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

require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Logo
        $this->Image('img/watermark.png', 0, 0, 210, 297);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
/*         $this->Cell(30,10,'Contrato de Administracion para Corretaje Inmobiliario de Arriendo',0,0,'C');
 */        // Line break
        $this->Ln(30);
    }

    function Footer()
    {
        // Watermark image

    }
}

// Crear instancia de la clase FPDF
$pdf = new PDF();

// Añadir página
$pdf->AddPage();


// Definir la fuente y el tamaño
$pdf->SetFont('Arial','B',12);

// Definir ancho de columna de texto
$col_width = 190;

// Agregar título del contrato
$pdf->Cell(0, 10, 'Contrato de Administracion para Corretaje Inmobiliario de Arriendo', 0, 1, 'C');

// Ajustar posición del MultiCell para que comience debajo del título
$pdf->Ln(10);

// Dividir el texto en párrafos
$text = file_get_contents('img/contrato.txt');
$pdf->SetFont('Arial','',12);
// Justificar los párrafos
$paragraphs = $pdf->MultiCell($col_width, 5, utf8_decode($text), 0, 'J');

// Guardar el PDF
$pdf->Output();
?>
