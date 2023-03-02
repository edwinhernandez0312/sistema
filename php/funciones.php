<?php
include('php/conexion.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function enviar_email($correo, $titulo, $titulo2, $cuerpo,)
{
    $email = new PHPMailer(true);
    try {
        // $email->SMTPDebug=SMTP::DEBUG_SERVER;
        $email->isSMTP();
        $email->Host = 'smtp.office365.com';
        $email->SMTPAuth = true;
        $email->Username = 'sistemas.laurarivera@outlook.com';
        $email->Password = '900985803_CILR';
        $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $email->Port = 587;

        $email->setFrom('sistemas.laurarivera@outlook.com', $titulo);
        $email->addAddress($correo, $titulo);


        $email->isHTML(true);
        $email->Subject = $titulo2;
        $email->Body = $cuerpo;
        $email->send();
        return true;
    } catch (Exception $e) {
        echo "Mensaje" . $email->ErrorInfo;
        return false;
    }
}
$conex;
// validar campos que no esten vacios
function validar_datos($nombre, $apellidos, $correo, $pass1, $pass2)
{
    if (
        strlen(trim($nombre)) < 1 || strlen(trim($apellidos)) < 1 || strlen(trim($correo)) < 1 || strlen(trim($pass1)) < 1 || strlen(trim($pass2)) < 1
        || !validar_texto($nombre) || !validar_texto($apellidos)
    ) {
        //devolver true si estan vacios
        return true;
    } else {
        //devolver false si no estan vacios
        return false;
    }
}
function validar_texto($text)
{
    $pattern = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\/]*$/";
    if (preg_match($pattern, trim($text))) {
        return true;
    } else {
        return false;
    }
}
// funcion para validar que la variable solo tenga numero y (-)
function validar_numero($text)
{
    $pattern = "/^[\d() +\-]*$/";
    if (preg_match($pattern, trim($text))) {
        return true;
    } else {
        return false;
    }
}

function validar_correo($correo)
{
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
// validar que las 2 contraseñas sean iguales
function validar_contraseña($pass1, $pass2)
{
    // si no son iguales enviar else
    if (strcmp($pass1, $pass2) !== 0) {
        return false;
    } else {
        // si son iguales enviar true
        return true;
    }
}
function minMax($min, $max, $valor)
{
    if (strlen(trim($valor)) < $min) {
        return true;
    } elseif (strlen(trim($valor)) > $max) {
        return true;
    } else {
        return false;
    }
}
// para validar si el usuario existe en la base de datos
function usuario_existe($usuario)
{
    global $conex;
    $consulta = $conex->query("SELECT ID_USUARIO FROM `usuario` WHERE NOMBRE_USU='$usuario';");
    $num = mysqli_num_rows($consulta);
    $consulta->close();

    if ($num > 0) {
        return true;
    } else {
        return false;
    }
}
// para validar si el correo existe en la base de datos
function email_existe($correo)
{
    global $conex;
    $consulta = $conex->query("SELECT ID_USUARIO FROM `usuario` WHERE EMAIL_USU='$correo';");
    $num = mysqli_num_rows($consulta);
    $consulta->close();

    if ($num > 0) {
        return true;
    } else {
        return false;
    }
}
// funcion para cifrar la contraseña
function cifrar_contraseña($contraseña)
{
    $hast = password_hash($contraseña, PASSWORD_DEFAULT);
    return $hast;
}
// funcion para crear un token
function crear_token()
{
    $token = md5(uniqid(mt_rand(), false));
    return $token;
}
// funcion para validar que las contraseñas se han iguales
function validar_login($correo, $pass)
{
    if (!validar_correo($correo) || strlen(trim($correo)) < 1 || strlen(trim($pass)) < 1) {
        return true;
    } else {
        return false;
    }
}
// funcion para hacer una busqueda en la tabla usuairos 
function traer_valor($campo, $campo_condicion, $valor)
{
    global $conex;
    $consulta = $conex->query("SELECT $campo FROM `usuario` WHERE $campo_condicion ='$valor';");
    $num = mysqli_num_rows($consulta);

    if ($num > 0) {
        while ($row = $consulta->fetch_array()) {
            return $row[$campo];
        }
    } else {
        return false;
    }
}
// funciion para crear token de restabelcer contraseña
function crear_token_pass($user_id)
{
    global $conex;
    $token = crear_token();
    $consulta = $conex->query("UPDATE `usuario` SET `TOKEN_PASS`='$token',`PASSWORD_REQ`=1 WHERE ID_USUARIO= '$user_id';");

    return $token;
}
// verificar datos en la base de datos para el cambio de contraseña
function verificar_token_pass($user_id, $user_token)
{
    global $conex;
    $consulta = $conex->query("SELECT PASSWORD_REQ FROM `usuario` WHERE ID_USUARIO='$user_id' AND TOKEN_PASS='$user_token' AND PASSWORD_REQ=1;");
    $num = mysqli_num_rows($consulta);

    if ($num > 0) {
        while ($row = $consulta->fetch_array()) {
            $passReq = $row['PASSWORD_REQ'];
        }
        if ($passReq == 1) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
// verificar que las contraseñas no esten vacias 
function pass_vacias($pass1, $pass2)
{
    if (strlen(trim($pass1)) < 1 || strlen(trim($pass2)) < 1) {
        return true;
    } else {
        return false;
    }
}
// actualizar contraseña
function actualizar_pass($pass1, $user_id, $user_token)
{
    global $conex;
    $consulta = $conex->query("UPDATE `usuario` SET `PASSWORD_USUARIO`='$pass1',`TOKEN_PASS`='',`PASSWORD_REQ`=0  WHERE ID_USUARIO='$user_id' AND TOKEN_PASS='$user_token';");
    if ($consulta) {
        return true;
    } else {
        return false;
    }
}
// mostrar errores 
// function mostrar_errores($errores)
// {
//     if (count($errores) > 0) {
//         echo "<div id='alert' class='alert alert-danger' role='alert'>
//         <a href='#' onclick=\" showHide ('error');\">X</a>
//         <ul>";
//         foreach ($errores as $error) {
//             echo "<li>" . $error . "</li>";
//         }
//         echo "</ul>";
//         echo "</div>";
//         echo "<script>
//         setTimeout(function() {
//           document.getElementById('alert').style.display = 'none';
//         }, 4000);
//       </script>";
//     }
// }
// mostrar texto de completado correctamente
// function mostrar_bienes($bienes)
// {
//     if (count($bienes) > 0) {
//         echo "<div id='alert' class='alert alert-success' role='alert'>
//         <a href='#' onclick=\" showHide ('error');\">X</a>
//         <ul>";
//         foreach ($bienes as $bien) {
//             echo "<li>" . $bien . "</li>";
//         }
//         echo "</ul>";
//         echo "</div>";
//         echo "<script>
//         setTimeout(function() {
//           document.getElementById('alert').style.display = 'none';
//         }, 4000);
//       </script>";
//     }
// }
// validar que las fechas no se han iguales
function fechasDiferentes($fecha1, $fecha2)
{
    $fecha1_ts = strtotime($fecha1);
    $fecha2_ts = strtotime($fecha2);

    if (date('Y-m-d', $fecha1_ts) === date('Y-m-d', $fecha2_ts)) {
        return true;
    }

    return false;
}
// para validar si el usuario existe en la base de datos
function cedula_existe($cedula)
{
    global $conex;
    $consulta = $conex->query("SELECT CEDULA FROM `cliente` WHERE CEDULA='$cedula';");
    $num = mysqli_num_rows($consulta);
    $consulta->close();

    if ($num > 0) {
        return true;
    } else {
        return false;
    }
}

//validar que el codigo wasi del inmueble no exista
function wasi_existe($codigo,$matricula){
    global $conex;
    $consulta = $conex->query("SELECT * FROM `inmueble` WHERE CODIGO_WASI_INMUEBLE ='$codigo' OR MATRICULA_INMUEBLE='$matricula';");
    $num = mysqli_num_rows($consulta);
    $consulta->close();
    
    if ($num > 0) {
        return true;
    } else {
        return false;
    }
}
function wasi_existe_update($codigo){
    global $conex;
    $consulta = $conex->query("SELECT * FROM `inmueble` WHERE CODIGO_WASI_INMUEBLE ='$codigo';");
    $num = mysqli_num_rows($consulta);
    $consulta->close();
    
    if ($num > 0) {
        return true;
    } else {
        return false;
    }
}
function matricula_existe_update($matricula){
    global $conex;
    $consulta = $conex->query("SELECT * FROM `inmueble` WHERE MATRICULA_INMUEBLE ='$matricula';");
    $num = mysqli_num_rows($consulta);
    $consulta->close();
    
    if ($num > 0) {
        return true;
    } else {
        return false;
    }
}
?>
