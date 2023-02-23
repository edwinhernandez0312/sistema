<?php
include('php/conexion.php');
include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
$tipo = nombre_tipo($_SESSION['TIPO_USUARIO']);

require_once "vistas/nav.php"?>

<h1>PENSAR QUE COLOCAR</h1>
<?php require_once "vistas/footer.php"?>