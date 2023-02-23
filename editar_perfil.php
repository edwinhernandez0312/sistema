<?php
include('php/conexion.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
$nombre=trim($_GET['nombre']);
$apellidos=trim($_GET['apellidos']);
$email=trim($_GET['email']);
require_once "vistas/nav.php";
?>

<main>
<div class="card-body">
        <div class="row">
<form class="col-md-12" method="post">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" value="<?php echo $nombre; ?>" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre">
    </div>
    <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos</label>
        <input type="text" value="<?php echo $apellidos; ?>" class="form-control" id="apellidos" name="apellidos" placeholder="Ingresa tus apellidos">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" value="<?php echo $email; ?>"class="form-control" id="email" name="email" placeholder="Ingresa tu correo electrónico">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
        </div>
</div>
</main>
<?php
require_once "vistas/footer.php";
?>
