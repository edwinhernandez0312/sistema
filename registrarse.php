<?php
include('php/conexion.php');
include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('location: login.php');
} else {
    if ($_SESSION['TIPO_USUARIO'] != 1) {
        header('location: login.php');
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">


    <title>Docs CILR - Registro</title>
    <link rel="stylesheet" href="css/sweetalert2.min.css" type="text/css">
    <!-- SweetAlert2 JS -->
    <script type="text/javascript" src="js/sweetalert2.all.min.js"></script>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/registro.css">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">¡Crear Cuenta!</h1>
                            </div>
                            <form class="user needs-validation" novalidate method="POST" onsubmit="validar_datos();">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="nombre" class="form-control form-control-user" id="nombre" placeholder="Nombres" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Letras. Tamaño mínimo: 3. Tamaño máximo: 250">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="apellidos" class="form-control form-control-user" id="apellidos" placeholder="Apellidos" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Letras. Tamaño mínimo: 3. Tamaño máximo: 250">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" name="correo" class="form-control form-control-user" id="correo" placeholder="Correo Electronico" minlength="3" maxlength="250" required pattern="[a-zA-Z0-9!#$%&'*_+-]([\.]?[a-zA-Z0-9!#$%&'*_+-])+@[a-zA-Z0-9]([^@&%$\/()=?¿!.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?">
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select class="form-control" name="tipo_usuario" required title="Dijite el estado civil">
                                            <option value="">Tipo de usuario</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Archivo</option>
                                            <option value="3">Cordinador comercial</option>
                                            <option value="4">Agente de servicios</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="contraseña1" class="form-control form-control-user" id="pass1" placeholder="Contraseña" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]\[0-9]" title="Tamaño mínimo: 3. Tamaño máximo: 250">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="contraseña2" class="form-control form-control-user" id="pass2" placeholder="Repetir Contraseña" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]\[0-9]" title="Tamaño mínimo: 3. Tamaño máximo: 250">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="inco" class="alert alert-danger ocultar" role="alert">
                                        ¡Campos No Validos! Verifique La Información¡¡¡
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="error" class="alert alert-danger ocultar" role="alert">
                                        Las Contraseñas no coinciden, vuelve a intentar !
                                    </div>
                                </div>
                                <button type="submit" name="registro" id="enviar" class="btn btn-primary btn-user btn-block">
                                    Registrar Cuenta
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                        <a class="small" href="index.php">pantalla principal</a>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="js/registro.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>

</html>
<?php
$errores = array();
if (isset($_POST['registro'])) {
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $correo = trim($_POST['correo']);
    $contraseña1 = trim($_POST['contraseña1']);
    $contraseña2 = trim($_POST['contraseña2']);
    $tipo_usuario = trim($_POST['tipo_usuario']);
    if (
        strlen(trim($nombre)) >= 1 &&
        strlen(trim($apellidos)) >= 1 &&
        strlen(trim($correo)) >= 1 &&
        strlen(trim($contraseña1)) >= 1 &&
        strlen(trim($contraseña2)) >= 1 &&
        strlen(trim($tipo_usuario)) >= 1
    ) {
        // variable para saber si hay errores
        if (validar_datos($nombre, $apellidos, $correo, $contraseña1, $contraseña2)) {
            $errores[] = "Datos incorrectos";
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
        } else {
            if (!validar_correo($correo)) {
                $errores[] = "Correo incorrecto";
            }
            if (!validar_contraseña($contraseña1, $contraseña2)) {
                $errores[] = "Las contraseñas no son iguales";
            }
            if (email_existe($correo)) {
                $errores[] = "Correo ya existe registrado en una cuenta";
            }
            // se valida si hay errores no se envia
            if (empty($errores)) {
                $cifrado = cifrar_contraseña($contraseña1);
                $token = crear_token();
                $registro_SQL = $conex->query("INSERT INTO `usuario`(`TIPO_USUARIO`, `NOMBRE_USU`, `APELLIDOS_USU`, `EMAIL_USU`, `PASSWORD_USUARIO`, `TOKEN_USU`) 
            VALUES ('$tipo_usuario','$nombre','$apellidos','$correo','$cifrado','$token')");
                if ($registro_SQL) {
                    echo "<script>
                Swal.fire({
                  title: '¡Éxito!',
                  text: 'El usuario se registro correctamente.',
                  icon: 'success',
                  confirmButtonText: 'Continuar'
                });
                </script>";
                } else {
                    $errores[] = "Cliente no se pudo actualizar" . mysqli_error($conex);
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
            } else {
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
    } else {
        $errores[] = "Todos los campos son obligatorios";
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
?>