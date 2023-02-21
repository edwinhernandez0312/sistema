<?php
include ('php/conexion.php');
include ('php/funciones.php');

if(empty($_GET['user_id'])){
    header('location: login.php');
}
if(empty($_GET['token'])){
    header('location: login.php');
}

$user_id = $conex->real_escape_string($_GET['user_id']);
$user_token = $conex->real_escape_string($_GET['token']);

if(!verificar_token_pass($user_id,$user_token)){
    ?>
            <div class="alert alert-danger d-flex justify-content-center"  role="alert">
                !No se pudo verificar la informacion¡
            </div>
    <?php
    exit;
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


    <title>Docs CILR - Actualizar contraseña</title>

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
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">¡Actualizar Contraseña!</h1>
                                    </div>
                                    <form class="user needs-validation" novalidate method="POST" onsubmit="validar_pass();">
                                        <div class="form-group">
                                            <input type="password" name="contraseña1" class="form-control form-control-user"
                                                id="pass1" placeholder="Contraseña" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚ]\[0-9]"
                                            title="Tamaño mínimo: 3. Tamaño máximo: 250">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="contraseña2" class="form-control form-control-user"
                                                id="pass2" placeholder="Contraseña" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚ]\[0-9]"
                                            title="Tamaño mínimo: 3. Tamaño máximo: 250">
                                        </div>
                                        <div class="form-group">
                                    <div id="inco" class="alert alert-danger ocultar" role="alert">
                                        ¡Campos No Validos! Verifique La Información¡¡¡
                                    </div>
                                </div>
                                        <button type="submit" name="envio" id="enviar" class="btn btn-primary btn-user btn-block">
                                            Guardar Cambios
                                        </button>
                                    </form>
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