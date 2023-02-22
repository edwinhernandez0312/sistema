<?php
include ('php/conexion.php');
include ('php/funciones.php');
$errores = array();
$completados = array();
if(isset($_POST['enviar'])){
    $email = $_POST['correo'];
    if(!validar_correo($email)){
        $errores[]="Correo Electronico no valido";
    }else{
    if(email_existe($email)){
        $user_id=traer_valor('ID_USUARIO','EMAIL_USU',$email);
        $user_nombre=traer_valor('NOMBRE_USU','EMAIL_USU',$email);
        
        $token=crear_token_pass($user_id);
        $url='http://'.$_SERVER['SERVER_NAME'].
        '/sistema/cambia_pass.php?user_id='.$user_id.'&token='.$token;

        $asunto="Recuperar Password - Sistema de inmobiliaria";
        $cuerpo="Hola $user_nombre: <br> <br> Se ha solicitado un cambio de contraseña:
        <br> <br>
        para restaurar la contraseña visita la siguiente direccion
        <a href='$url'> Cambiar contraseña </a>";

        if(enviar_email($email,$asunto,$asunto,$cuerpo)){
            $completados[]="Se ha enviado un correo a $email para restablecer la contraseña";
        }else{
            $errores[]="Error al enviar el Email";
        }
    }else{
        $errores[]="Este correo no esta vinculado a ninguna cuenta";
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


    <title>Docs CILR - Olvide mi contraseña</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

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
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Olvidaste Tu Contraseña?</h1>
                                        <p class="mb-4">¡¡Lo entendemos, pasan cosas. ¡Simplemente ingrese su dirección de
                                            correo electrónico a continuación y le enviaremos un enlace para restablecer
                                            su contraseña!!</p>
                                    </div>
                                    <form class="user needs-validation" novalidate method="POST" onsubmit="validar_campo();">
                                        <div class="form-group">
                                            <input type="email" name="correo" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp"
                                                placeholder="Correo Electronico..." minlength="3" maxlength="250" required pattern="[a-zA-Z0-9!#$%&'*_+-]([\.]?[a-zA-Z0-9!#$%&'*_+-])+@[a-zA-Z0-9]([^@&%$\/()=?¿!.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?">
                                        </div>
                                        <div class="form-group">
                                    <div id="inco" class="alert alert-danger ocultar" role="alert">
                                        ¡Campos No Validos! Verifique La Información¡¡¡
                                    </div>
                                </div>
                                        <button type="submit" id="enviar" name="enviar" class="btn btn-primary btn-user btn-block">
                                            Recuperar Contraseña
                                        </button>
                                    </form>
                                    <hr>
                                    <?php echo mostrar_errores($errores) ;?>
                                    <?php echo mostrar_bienes($completados) ;?>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Tengo Una Cuenta? Iniciar Sesion!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script type="text/javascript" src="js/registro.js"></script>
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