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
        <h3 class="col-sm-6 d-flex justify-content-end m-0 font-weight-bold text-primary">
            <a class="nav-link fas fa-user-edit" href="" data-bs-toggle="modal" data-bs-target="#miModal"></a></h3>
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
    <!-- Modal -->
    <div class="modal fade" id="miModal" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>