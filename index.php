<?php
include('php/conexion.php');
include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
// saber que usuario es 
function nombre_tipo($tipo_usuario)
{
    switch ($tipo_usuario) {
        case 1:
            return "Administrador";
            break;
        case 2:
            return "Archivo";
            break;
        case 3:
            return "Cordinador comercial";
            break;
        case 4:
            return "Agente de servicios";
    }
}
$tipo = nombre_tipo($_SESSION['TIPO_USUARIO']);

require_once "vistas/nav.php" ?>

<h1>COLOCAR NOTICIAS DE LA INMOBILIARIA Y ENLACES DIRECTOS A CORREOS Y REDES SOCIALES</h1>
<?php require_once "vistas/footer.php" ?>