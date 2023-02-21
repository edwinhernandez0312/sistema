<?php
include('php/conexion.php');
include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
?>




    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <dl class="row">
                    <dt class="col-sm-3">ID:</dt>
                    <dd class="col-sm-9"><?php echo $_SESSION['ID_USUARIO']; ?></dd>

                    <dt class="col-sm-3">User Type:</dt>
                    <dd class="col-sm-9"><?php echo $_SESSION['TIPO_USUARIO']; ?></dd>

                    <dt class="col-sm-3">Name:</dt>
                    <dd class="col-sm-9"><?php echo $_SESSION['NOMBRE_USU']; ?></dd>

                    <dt class="col-sm-3">Last Name:</dt>
                    <dd class="col-sm-9"><?php echo $_SESSION['APELLIDOS_USU']; ?></dd>

                    <dt class="col-sm-3">Email:</dt>
                    <dd class="col-sm-9"><?php echo $_SESSION['EMAIL_USU']; ?></dd>
                </dl>
            </div>
        </div>
    </div>
</div>


