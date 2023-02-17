<?php
include ('php/conexion.php');
$conex;
// validar campos que no esten vacios
function validar_datos($nombre, $apellidos,$correo,$pass1,$pass2){
if(strlen(trim($nombre))<1 || strlen(trim($apellidos))<1 || strlen(trim($correo))<1 || strlen(trim($pass1))<1 || strlen(trim($pass2))<1
|| !validar_texto($nombre) || !validar_texto($apellidos)){
    //devolver true si estan vacios
    return true;
} else {
    //devolver false si no estan vacios
    return false;
}
}
function validar_texto($text)
{
    $pattern = "/^[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+$/";
    if(preg_match($pattern, trim($text))){
        return true;
    }else{
        return false;
    }
}
// funcion para validar que la variable solo tenga numero y (-)
function validar_numero($text)
{
    $pattern = "/^[0-9\-]+$/";
    if (preg_match($pattern, trim($text))){
        return true;
    }else{
        return false;
    }
}

function validar_correo($correo){
    if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}
// validar que las 2 contraseñas sean iguales
function validar_contraseña($pass1,$pass2){
    // si no son iguales enviar else
    if(strcmp($pass1,$pass2)!==0){
        return false;
    }else{
        // si son iguales enviar true
        return true;
    }
}
function minMax($min,$max,$valor){
if(strlen(trim($valor))<$min){
    return true;
}elseif(strlen(trim($valor))>$max){
    return true;
}else{
    return false;
}
}

function usuario_existe($usuario){
    global $conex;
    $consulta = $conex->query("SELECT ID_USUARIO FROM `usuario` WHERE NOMBRE_USU='$usuario';");
    $num=mysqli_num_rows($consulta);
    $consulta->close();

    if($num>0){
        return true;
}else{
    return false;
}
}

function email_existe($correo){
    global $conex;
    $consulta = $conex->query("SELECT ID_USUARIO FROM `usuario` WHERE EMAIL_USU='$correo';");
    $num=mysqli_num_rows($consulta);
    $consulta->close();

    if($num>0){
        return true;
}else{
    return false;
}
}

function cifrar_contraseña($contraseña){
$hast=password_hash($contraseña, PASSWORD_DEFAULT);
return $hast;
}

function crear_token(){
    $token=md5(uniqid(mt_rand(), false));
    return $token;
}
?>