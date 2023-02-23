<?php
date_default_timezone_set('America/Bogota');
include('php/conexion.php');
// include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
$id = $_SESSION['ID_USUARIO'];
$nombre = $_SESSION['NOMBRE_USU'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">


    <title>Docs CILR - Registro</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/registro.css">
</head>

<body>
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" id="page-top" href="index.php">
        <div><img src="img/icono.png" class="img-fluid" alt="Icono de mi sitio web"></div>
        <div class="sidebar-brand-text mx-3">CILR</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-house-user"></i>
            <span>Inicio</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Explorar
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users"></i>
            <span>Clientes</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Clientes:</h6>
                <a class="collapse-item" href="registrar_clientes.php">Agregar Clientes</a>
                <a class="collapse-item" href="ver_clientes.php">Ver Clientes</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-city"></i>
            <span>Inmuebles</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Inmuebles:</h6>
                <a class="collapse-item" href="utilities-color.html">Agregar Inmuebles</a>
                <a class="collapse-item" href="utilities-border.html">Ver Inmuebles</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Archivo
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Legajos</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Legajos</h6>
                <?php
                if ($_SESSION['TIPO_USUARIO'] == 1 || $_SESSION['TIPO_USUARIO'] == 2) {
                ?>
                    <a class="collapse-item" href="">Nuevo Legajo</a>
                <?php
                }
                ?>
                <a class="collapse-item" href="">Ver Legajos</a>
            </div>
        </div>
    </li>

    <?php
    if ($_SESSION['TIPO_USUARIO'] == 1) {
    ?>
        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>Usuarios</span></a>
        </li>
    <?php
    }
    ?>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- LO QUE HAY DENTRO DE LA PAGINA -->
    <div id="content height-auto">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <form class="form-inline">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
            </form>


            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nombre; ?></span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="perfil.php">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Perfil
                        </a>
                        <!-- <div class="dropdown-divider"></div> -->
                        <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Cerrar sesion
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->


    </div>
    <!-- End of Main Content -->
    <main id="main">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Registrar Cliente</h6>
        </div>
        <div class="card-body">
            <form method="POST" class="user needs-validation" novalidate id="miFormulario">
                <div class="form-group">
                    <label for="cedula">Cédula:</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" required pattern="^[0-9]*$" title="Dijite la cedula sin espacios solo numeros">
                </div>
                <div class="form-group">
                    <label for="fecha_expedicion">Fecha de Expedición:</label>
                    <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion" required >
                </div>
                <div class="form-group">
                    <label for="nombres">Nombres:</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+">
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+">
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required pattern="^[0-9()+-]*$">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" minlength="3" maxlength="250" required pattern="[a-zA-Z0-9!#$%&'*_+-]([\.]?[a-zA-Z0-9!#$%&'*_+-])+@[a-zA-Z0-9]([^@&%$\/()=?¿!.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?">
                </div>
                <div class="form-group">
                    <label for="estado_civil">Estado Civil:</label>
                    <select class="form-control" id="estado_civil" name="estado_civil" required>
                        <option value="">Selecciona una opción</option>
                        <option value="Soltero/a">Soltero/a</option>
                        <option value="Casado/a">Casado/a</option>
                        <option value="Divorciado/a">Divorciado/a</option>
                        <option value="Viudo/a">Viudo/a</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nombres_ref1">Nombres Referencia 1:</label>
                    <input type="text" class="form-control" id="nombres_ref1" name="nombres_ref1" required>
                </div>
                <div class="form-group">
                    <label for="telefono_ref1">Teléfono Referencia 1:</label>
                    <input type="tel" class="form-control" id="telefono_ref1" name="telefono_ref1" required>
                </div>
                <div class="form-group">
                    <label for="nombres_ref2">Nombres Referencia 2:</label>
                    <input type="text" class="form-control" id="nombres_ref2" name="nombres_ref2" required>
                </div>
                <div class="form-group">
                    <label for="telefono_ref2">Teléfono Referencia 2:</label>
                    <input type="tel" class="form-control" id="telefono_ref2" name="telefono_ref2" required>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha_registro">Fecha Registro:</label>
                            <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="usuario_registro">Usuario Registro:</label>
                            <input type="text" class="form-control" id="usuario_registro" name="usuario_registro" value="<?php echo $_SESSION['NOMBRE_USU']; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fecha_modificacion">Fecha Modificación:</label>
                            <input type="text" class="form-control" id="fecha_modificacion" name="fecha_modificacion" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="usuario_modificacion">Usuario Modificación:</label>
                            <input type="text" class="form-control" id="usuario_modificacion" name="usuario_modificacion" value="<?php echo $_SESSION['NOMBRE_USU']; ?>" readonly>
                        </div>
                    </div>
                    <button type="submit" name="registro" class="btn btn-primary">Registrar</button>
            </form>
            <div id="resultado">

            </div>
        </div>
    </div>
    </main>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy;
                    <a href="https://laurarivera.co">Constructora Inmobiliaria Laura Rivera S.A.S</a> </span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">¿Deseas cerrar sesion?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">¿Estas seguro que deseas cerrar sesion?</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="salir.php">Cerrar sesion</a>
        </div>
    </div>
</div>
</div>
</body>
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
<script>
    $(document).ready(function() {
        $('#miFormulario').submit(function(event) {
            event.preventDefault(); // evita que se recargue la página
            $.ajax({
                type: 'POST', // o 'GET' si estás usando GET
                url: 'guardar_cliente.php', // URL del archivo PHP que procesará el formulario
                data: $(this).serialize(), // serializa los datos del formulario y los envía como datos del AJAX
                success: function(response) {
                    $('#resultado').html(response); // actualiza el contenido de un elemento con el resultado del procesamiento del formulario
                }
            });
        });
    });
</script>

</html>
<?php
// Si se ha enviado el formulario
// if (isset($_POST['enviar'])) {
// Recoger los datos del formulario
// $cedula = $_POST['cedula'];
// $fecha_expedicion = $_POST['fecha_expedicion'];
// $nombres = $_POST['nombres'];
// $apellidos = $_POST['apellidos'];
// $fecha_nacimiento = $_POST['fecha_nacimiento'];
// $telefono = $_POST['telefono'];
// $direccion = $_POST['direccion'];
// $email = $_POST['email'];
// $estado_civil = $_POST['estado_civil'];
// $nombres_ref1 = $_POST['nombres_ref1'];
// $telefono_ref1 = $_POST['telefono_ref1'];
// $nombres_ref2 = $_POST['nombres_ref2'];
// $telefono_ref2 = $_POST['telefono_ref2'];
// $fecha_registro = date('Y-m-d H:i:s');
// $usuario_registro = $_SESSION['NOMBRE_USU'];
// $fecha_modificacion = date('Y-m-d H:i:s');
// $usuario_modificacion = $_SESSION['NOMBRE_USU'];

// Validar los datos
// $errores = array();

// if (empty($cedula)) {
//     $errores[] = 'La cédula es obligatoria.';
// } elseif (!is_numeric($cedula)) {
//     $errores[] = 'La cédula debe ser un número.';
// }

// Validar y procesar la fecha de expedición
// $fecha_expedicion_obj = DateTime::createFromFormat('Y-m-d', $fecha_expedicion);
// if (!$fecha_expedicion_obj) {
//     $errores[] = 'La fecha de expedición no es válida.';
// }

// if (empty($nombres)) {
//     $errores[] = 'Los nombres son obligatorios.';
// }

// if (empty($apellidos)) {
//     $errores[] = 'Los apellidos son obligatorios.';
// }

// Validar y procesar la fecha de nacimiento
// $fecha_nacimiento_obj = DateTime::createFromFormat('Y-m-d', $fecha_nacimiento);
// if (!$fecha_nacimiento_obj) {
//     $errores[] = 'La fecha de nacimiento no es válida.';
// }

// if (empty($telefono)) {
//     $errores[] = 'El teléfono es obligatorio.';
// } elseif (!is_numeric($telefono)) {
//     $errores[] = 'El teléfono debe ser un número.';
// }

// if (empty($direccion)) {
//     $errores[] = 'La dirección es obligatoria.';
// }

// if (empty($email)) {
//     $errores[] = 'El correo electrónico es obligatorio.';
// } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     $errores[] = 'El correo electrónico no es válido.';
// }

// if (empty($estado_civil)) {
//     $errores[] = 'El estado civil es obligatorio.';
// }

// if (empty($nombres_ref1)) {
//     $errores[] = 'Los nombres de la primera referencia son obligatorios.';
// }

// if (empty($telefono_ref1)) {
//     $errores[] = 'El teléfono de la primera referencia es obligatorio.';
// } elseif (!is_numeric($telefono_ref1)) {
//     $errores[] = 'El teléfono de la primera referencia debe ser un número.';
// }

// if (empty($nombres_ref2)) {
//     $errores[] = 'Los nombres de la segunda referencia son obligatorios.';
// }
// if (empty($telefono_ref2)) {
//     $errores[] = 'El teléfono de la segunda referencia es obligatorio.';
// } elseif (!is_numeric($telefono_ref2)) {
//     $errores[] = 'El teléfono de la segunda referencia debe ser un número.';
// if(!validar_numero($cedula)){
//     $errores[]="Cedula incorrecta";
// }
// if (empty($errores)) {
//     // Verificar conexión
//     if (!$conex) {
//         die('Error de conexión: ' . mysqli_connect_error());
//     }

// Crear la sentencia SQL para insertar los datos del cliente
// $sql =$conex->query("INSERT INTO `cliente`(`CEDULA`, `FECHA_EXPEDICION`, `NOMBRES`, `APELLIDOS`, `FECHA_NACIMIENTO_CLIENTE`, `TELEFONO`, `DIRECCION`, `EMAIL`, `ESTADO_CIVIL`, `NOMBRES_REF1`, `TELEFONO_REF1`, `NOMBRES_REF2`, `TELEFONO_REF2`,  `USUARIO_REGISTRO_CLIENTE`,`USUARIO_MODIFICACION_CLIENTE`) VALUES ('$cedula', '$fecha_expedicion', '$nombres','$apellidos','$fecha_nacimiento','$telefono', '$direccion', '$email', '$estado_civil',  '$nombres_ref1', '$telefono_ref1', '$nombres_ref2', '$telefono_ref2','$id','$id')");

// Ejecutar la sentencia SQL
// if ($sql) {
//     // Si la inserción fue exitosa, mostrar un mensaje al usuario
//     echo 'El cliente se registró correctamente.';
// } else {
//     // Si hubo un error en la inserción, mostrar un mensaje de error
//     echo 'Error al registrar el cliente: ' . mysqli_error($conex);
// }

// Redireccionar al cliente a una página de confirmación de registro exitoso
// header('Location: index.php');
// exit;
// }

// Si no hay errores, se procede a registrar el cliente


?>