<?php
include('php/conexion.php');
include('php/funciones.php');
if (isset($_POST['cerrar_sesion'])) {
    session_unset();
    session_destroy();
}
if (isset($_POST['TIPO_USUARIO'])) {
    switch ($_SESSION['TIPO_USUARIO']) {
        case 1:
            header('location: index.php');
            break;

        default;
    }
}
$errores = array();
if (isset($_POST['envio'])) {
    $correo = trim($_POST['correo']);
    $contraseña = trim($_POST['contraseña']);
    $error = 0;
    if (validar_login($correo, $contraseña)) {
        $error++;
        $errores[] = "Complete los todos los campos";
    }
    if ($error == 0) {
        $SQL = $conex->query("SELECT * FROM `usuario` WHERE EMAIL_USU='$correo';");
        if (mysqli_num_rows($SQL) != 0) {
            while ($row = $SQL->fetch_array()) {
                $pass = password_verify($contraseña, $row['PASSWORD_USUARIO']);
                if ($pass) {
                    session_start();
                    $tipo = $row['TIPO_USUARIO'];
                    $_SESSION['ID_USUARIO'] = $row['ID_USUARIO'];
                    $_SESSION['TIPO_USUARIO'] = $tipo;
                    $_SESSION['NOMBRE_USU'] = $row['NOMBRE_USU'];
                    $_SESSION['APELLIDOS_USU'] = $row['APELLIDOS_USU'];
                    $_SESSION['EMAIL_USU'] = $row['EMAIL_USU'];
                    switch ($_SESSION['TIPO_USUARIO']) {
                        case 1:
                            header('location: index.php');
                            break;
                        case 2:
                            header('location: index.php');
                            break;
                        case 3:
                            header('location: index.php');
                            break;
                        case 4:
                            header('location: index.php');
                        default:
                    }
                } else {
                    $errores[] = "Contraseña incorrecta";
                }
            }
        } else {
            $errores[] = "Datos incorrectos";
        }
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
    <title>Docs CILR - Iniciar Sesion</title>

    <title>Docs CILR</title>
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

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Bienvenido</h1>
                                    </div>
                                    <form class="user needs-validation" novalidate method="POST" onsubmit="validar_campos();">
                                        <div class="form-group">
                                            <input type="email" name="correo" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Correo Electronico" minlength="3" maxlength="250" required pattern="[a-zA-Z0-9!#$%&'*_+-]([\.]?[a-zA-Z0-9!#$%&'*_+-])+@[a-zA-Z0-9]([^@&%$\/()=?¿!.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="contraseña" class="form-control form-control-user" id="pass" placeholder="Contraseña" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚ]\[0-9]" title="Tamaño mínimo: 3. Tamaño máximo: 250">
                                        </div>
                                        <div class="form-group">
                                            <div id="inco" class="alert alert-danger ocultar" role="alert">
                                                Campos No Validos, Verifique La Información.
                                            </div>
                                        </div>
                                        <button type="submit" name="envio" id="enviar" class="btn btn-primary btn-user btn-block">
                                            Iniciar Sesion
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="olvido-contraseña.php">Olvide mi contraseña</a>
                                    </div>
                                </div>
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
?>