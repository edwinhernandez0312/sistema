<?php
include('php/conexion.php');
include('php/funciones.php');
if(isset($_POST['enviar'])){
    $cedula = $_POST['cedula'];
    $fecha_expedicion = $_POST['fecha_expedicion'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $estado_civil = $_POST['estado_civil'];
    $nombres_ref1 = $_POST['nombres_ref1'];
    $telefono_ref1 = $_POST['telefono_ref1'];
    $nombres_ref2 = $_POST['nombres_ref2'];
    $telefono_ref2 = $_POST['telefono_ref2'];
    $fecha_registro = date('Y-m-d H:i:s');
    $usuario_registro = $_SESSION['NOMBRE_USU'];
    $fecha_modificacion = date('Y-m-d H:i:s');
    $usuario_modificacion = $_SESSION['NOMBRE_USU'];
    if(
        strlen(trim($cedula)) >=1 &&
        strlen(trim($fecha_expedicion)) >=1 &&
        strlen(trim($nombres)) >=1 &&
        strlen(trim($apellidos)) >=1 &&
        strlen(trim($fecha_modificacion)) >=1 &&
        strlen(trim($telefono)) >=1 &&
        strlen(trim($direccion)) >=1 &&
        strlen(trim($email)) >=1 &&
        strlen(trim($estado_civil)) >=1 &&
        strlen(trim($nombres_ref1)) >=1 &&
        strlen(trim($telefono_ref1)) >=1 

    )
}
?>
