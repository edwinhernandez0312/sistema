<?php
include('php/conexion.php');
include('php/funciones.php');
$errores = array();
$completados = array();
if (isset($_POST['enviar'])) {
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
    $mascotas=trim($_POST['mascotas']);
    $ingresos=trim($_POST['ingresos']);
    $vive_per=trim($_POST['vive_per']);
    if (
        strlen(trim($cedula)) >= 1 &&
        strlen(trim($fecha_expedicion)) >= 1 &&
        strlen(trim($nombres)) >= 1 &&
        strlen(trim($apellidos)) >= 1 &&
        strlen(trim($fecha_modificacion)) >= 1 &&
        strlen(trim($telefono)) >= 1 &&
        strlen(trim($direccion)) >= 1 &&
        strlen(trim($email)) >= 1 &&
        strlen(trim($estado_civil)) >= 1 &&
        strlen(trim($nombres_ref1)) >= 1 &&
        strlen(trim($telefono_ref1)) >= 1 &&
        strlen(trim($nombres_ref2)) >= 1 &&
        strlen(trim($telefono_ref2)) >= 1 &&
        strlen(trim($usuario_registro)) >= 1 &&
        strlen(trim($fecha_registro)) >= 1 &&
        strlen(trim($fecha_modificacion)) >= 1 &&
        strlen(trim($usuario_modificacion)) >= 1
    ) {
        if (!validar_numero($cedula) || !validar_numero($telefono) || !validar_numero($telefono_ref1) || !validar_numero($telefono_ref2)) {
            $errores[] = "Formato numerico incorrecto";
        }
        if (fechasDiferentes($fecha_nacimiento, $fecha_expedicion)) {
            $errores[] = "la fecha de naciminiento no puede ser igual a la fecha de expedicion de la cedula";
        }
        if (!validar_texto($nombres) || !validar_texto($apellidos) || !validar_texto($estado_civil) || !validar_texto($nombres_ref1) || !validar_texto($nombres_ref2)) {
            $errores[] = "Formato de caracteres incorrecto";
        }
        if (!validar_correo($email)) {
            $errores[] = "Correo no valido";
        }
        if (cedula_existe($cedula)) {
            $errores[] = "El usuario con esta cedula ya existe";
        }
        if (empty($errores)) {
            $sql = $conex->query("INSERT INTO `cliente`(`CEDULA`, `FECHA_EXPEDICION`, `NOMBRES`, `APELLIDOS`, `FECHA_NACIMIENTO_CLIENTE`, `TELEFONO`, `DIRECCION`, `EMAIL`, `ESTADO_CIVIL`,`MASCOTA`,`INGRESOS`,`VIVE_PERSONAS`, `NOMBRES_REF1`, `TELEFONO_REF1`, `NOMBRES_REF2`, `TELEFONO_REF2`,  `USUARIO_REGISTRO_CLIENTE`,`USUARIO_MODIFICACION_CLIENTE`) 
            VALUES ('$cedula', '$fecha_expedicion', '$nombres','$apellidos','$fecha_nacimiento','$telefono', '$direccion', '$email', '$estado_civil','$mascotas','$ingresos','$vive_per','$nombres_ref1', '$telefono_ref1', '$nombres_ref2', '$telefono_ref2','$id','$id')");
            // Ejecutar la sentencia SQL
            if ($sql) {
                // Si la inserción fue exitosa, mostrar un mensaje al usuario
                echo "<script>
                Swal.fire({
                  title: '¡Éxito!',
                  text: 'La operación se realizó correctamente.',
                  icon: 'success',
                  confirmButtonText: 'Continuar'
                });
                </script>";
            } else {
                // Si hubo un error en la inserción, mostrar un mensaje de error
                $errores[] = "Cliente no se ha registrado correctamente" . mysqli_error($conex);
            }
        }
    } else {
        $errores[] = "Todos los campos son obligatorios";
    }
    if (!empty($errores)) {
        $lista_errores = "<ul>";
        foreach ($errores as $error) {
            $lista_errores .= "<li>" . $error . "</li>";
        }
        $lista_errores .= "</ul>";
        echo "<script>
    Swal.fire({
    icon: 'error',
    title: 'Error',
    html: '$lista_errores',
    confirmButtonText: 'Continuar'
    });
    </script>";
    }
}
