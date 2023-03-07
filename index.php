<?php
include('php/conexion.php');
include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
// saber que usuario es 
function nombre_tipo($tipo_usuario)
{
    switch ($tipo_usuario) {
        case 1:
            return "Administrador";
            break;
        case 2:
            return "Archivo";
            break;
        case 3:
            return "Cordinador comercial";
            break;
        case 4:
            return "Agente de servicios";
    }
}
$tipo = nombre_tipo($_SESSION['TIPO_USUARIO']);

require_once "vistas/nav.php" ?>
<!-- <style>.card-body {
  font-size: 20px;
}
</style> -->

<div class="row">
  <div class="col-xl-12 col-lg-12">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Enlaces Rápidos</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="row"  style="font-size: 20px;">
          <div class="col-md-4">
            <a href="https://mail.google.com/" target="_blank">
              <div class="card bg-danger text-white shadow">
                <div class="card-body">
                <i class="fas fa-envelope mr-3"></i>Gmail
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="https://www.wasi.co/" target="_blank">
              <div class="card bg-primary text-white shadow">
                <div class="card-body">
                <i class='fas fa-info-circle mr-3'></i><span>Wasi</span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-md-4">
            <a href="https://web.whatsapp.com/" target="_blank">
              <div class="card bg-success text-white shadow">
                <div class="card-body">
                <i class="fab fa-whatsapp fa-x text-white mr-3"></i>Whatsapp
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once "vistas/footer.php" ?>