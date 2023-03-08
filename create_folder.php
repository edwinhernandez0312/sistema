<?php
include('php/conexion.php');
include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
if ($_SESSION['TIPO_USUARIO'] != 1 && $_SESSION['TIPO_USUARIO'] != 2) {
    header("Location: login.php");
    exit;
}
if (isset($_POST['id_pro'])) {
    if (!empty($_POST['id_pro'])) {
    } else {
        die("Datos imcompletos");
    }
} else {
    die("Datos incompletos");
}
$id_pro = trim($_POST['id_pro']);
$USU = $_SESSION['ID_USUARIO'];
// Consulta para contar las filas con NULL en IDENTIFICADOR
$sql = "SELECT COUNT(*) FROM legajo WHERE IDENTIFICADOR IS NULL";

// Ejecutar consulta
$resultado = mysqli_query($conex, $sql);

// Obtener resultado
$legajos_libres = mysqli_fetch_array($resultado);

//consulta par obtener los datos de los legajos
$query = "SELECT * FROM legajo ORDER BY ID_LEGAJO DESC LIMIT 1;";
$result = mysqli_query($conex, $query);
$row = mysqli_fetch_assoc($result);
$anio_legajo = intval($row['ANO_LEGAJO']);
//obtenemos el año actual
$year = date("Y");

if ($anio_legajo == $year) {

    //verificar si no existen legajos con el identificador en NULL
    if ($legajos_libres[0] == 0) {

        $caja_legajo = intval($row['CAJA_LEGAJO']);
        $caja_legajo = $caja_legajo + 1;
        //actualiza el numero de caja
        $caja_legajo = strval($caja_legajo);
        $cajanueva = str_pad($caja_legajo, 3, "0", STR_PAD_LEFT);
        //verifica que el año sea el mismo que el de la ultima caja
        for ($i = 1; $i <= 15; $i++) {
            $num = strval($i);
            $num_str = str_pad($num, 3, "0", STR_PAD_LEFT);
            $query = "INSERT INTO `legajo`(`ANO_LEGAJO`, `CAJA_LEGAJO`, `NUMERO_LEGAJO`, `IDENTIFICADOR`, `USUARIO_CREACION_LEGAJO`) VALUES ('$year','$cajanueva','$num_str',NULL,'$USU')";
            mysqli_query($conex, $query);
        }
    }
} else {
    echo "entra al libre";
    $new_identificator = "año pasado";
    $query = "UPDATE `legajo` SET `IDENTIFICADOR`= '$new_identificator' WHERE `ANO_LEGAJO`= '$anio_legajo' AND IDENTIFICADOR IS NULL";
    $sql = mysqli_query($conex, $query);
    $caja_legajo = strval("1");
    $cajanueva = str_pad($caja_legajo, 3, "0", STR_PAD_LEFT);
    for ($i = 1; $i <= 15; $i++) {
        $num = strval($i);
        $num_str = str_pad($num, 3, "0", STR_PAD_LEFT);
        $query = "INSERT INTO `legajo`(`ANO_LEGAJO`, `CAJA_LEGAJO`, `NUMERO_LEGAJO`, `IDENTIFICADOR`, `USUARIO_CREACION_LEGAJO`) VALUES ('$year','$cajanueva','$num_str',NULL,'$USU')";
        mysqli_query($conex, $query);
    }
}

require_once "vistas/nav.php";

?>
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Crear Legajo</h1>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-body">

                            <form method="POST" action="crear_legajo.php">


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inmueble">Inmueble</label>
                                        <input type="text" class="form-control" id="inmueble" name="inmueble" required readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="numero_legajo">Número de Legajo</label>
                                        <input type="text" class="form-control" id="numero_legajo" name="numero_legajo" required readonly>
                                    </div>
                                </div>
                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="identificador">Identificador</label>
                                        <input type="text" class="form-control" id="identificador" name="identificador" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="semillero">Semillero</label>
                                        <input type="text" class="form-control" id="semillero" name="semillero" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="afianzadora">Afianzadora</label>
                                        <input type="text" class="form-control" id="afianzadora" name="afianzadora" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="codeudor">Codeudor</label>
                                        <input type="text" class="form-control" id="codeudor" name="codeudor" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="fecha_inicio_contrato">Fecha de Inicio del Contrato</label>
                                        <input type="date" class="form-control" id="fecha_inicio_contrato" name="fecha_inicio_contrato" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="fecha_finalizacion_contrato">Fecha de finalización de contrato</label>
                                        <input type="date" class="form-control" id="fecha_finalizacion_contrato" name="fecha_finalizacion_contrato" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="tiempo_contrato">Tiempo de contrato</label>
                                        <input type="number" class="form-control" id="tiempo_contrato" name="tiempo_contrato" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="prorroga">Prórroga</label>
                                        <input type="text" class="form-control" id="prorroga" name="prorroga" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="usuario_creacion_legajo">Usuario creacion legajo</label>
                                        <input type="text" class="form-control" id="usuario_creacion_legajo" name="usuario_creacion_legajo" value="<?php echo $_SESSION['NOMBRE_USU']; ?>" required readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="usuario_modificacion_legajo">Usuario modificacion legajo</label>
                                        <input type="text" class="form-control" id="usuario_modificacion_legajo" name="usuario_modificacion_legajo" value="<?php echo $_SESSION['NOMBRE_USU']; ?>" required readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="fecha_modificacion">Fecha de modificación</label>
                                        <input type="date" class="form-control" id="fecha_modificacion" name="fecha_modificacion" value="<?php echo date('Y-m-d'); ?>" required readonly>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            require_once "vistas/footer.php";
            ?>