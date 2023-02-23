<?php
include('php/conexion.php');
include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
$tipo = nombre_tipo($_SESSION['TIPO_USUARIO']);
?>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 row">
        <h6 class="col-sm-6 m-0 font-weight-bold text-primary">Informacion de usuario</h6>
        <h3 class="col-sm-6 d-flex justify-content-end m-0 font-weight-bold text-primary">
            <a class="nav-link fas fa-user-edit" href="editar_perfil.php?nombre=<?php echo $_SESSION['NOMBRE_USU'] ?> 
            & apellidos=<?php echo $_SESSION['APELLIDOS_USU'] ?> & email=<?php echo $_SESSION['EMAIL_USU'] ?>"></a></h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <dl class="row">

                    <dt class="col-sm-2">Tipo de usuario:</dt>
                    <dd class="col-sm-10"><?php echo $tipo; ?></dd>

                    <dt class="col-sm-2">Nombre:</dt>
                    <dd class="col-sm-10"><?php echo $_SESSION['NOMBRE_USU']; ?></dd>

                    <dt class="col-sm-2">Apellidos:</dt>
                    <dd class="col-sm-10"><?php echo $_SESSION['APELLIDOS_USU']; ?></dd>

                    <dt class="col-sm-2">Email:</dt>
                    <dd class="col-sm-10"><?php echo $_SESSION['EMAIL_USU']; ?></dd>
                </dl>
            </div>
        </div>
    </div>
</div>