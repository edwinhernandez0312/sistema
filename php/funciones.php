<?php
// validar campos que no esten vacios
function validar_datos($nombre, $apellidos,$correo,$pass1,$pass2){
if(strlen(trim($nombre))<1 || strlen(trim($apellidos))<1 || strlen(trim($correo))<1 || strlen(trim($pass1))<1 || strlen(trim($pass2))<1){
    //devolver true si estan vacios
    return true;
} else {
    //devolver false si no estan vacios
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
?>