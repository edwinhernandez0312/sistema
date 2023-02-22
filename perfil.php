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
        <h6 class="col-sm-6 m-0 font-weight-bold text-primary">Infomracion de usuario</h6>
        <h6 class="col-sm-6 d-flex justify-content-end m-0 font-weight-bold text-primary"><span class="fas fa-user-edit"></span></h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <dl class="row">

                    <dt class="col-sm-3">Tipo de usuario:</dt>
                    <dd class="col-sm-9"><?php echo $tipo; ?></dd>

                    <dt class="col-sm-3">Nombre:</dt>
                    <dd class="col-sm-9"><?php echo $_SESSION['NOMBRE_USU']; ?></dd>

                    <dt class="col-sm-3">Apellidos:</dt>
                    <dd class="col-sm-9"><?php echo $_SESSION['APELLIDOS_USU']; ?></dd>

                    <dt class="col-sm-3">Email:</dt>
                    <dd class="col-sm-9"><?php echo $_SESSION['EMAIL_USU']; ?></dd>
                </dl>
            </div>
        </div>
    </div>
</div>