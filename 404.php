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
  <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- 404 Error Text -->
                    <div class="text-center">
                        <div class="error mx-auto" data-text="404">404</div>
                        <p class="lead text-gray-800 mb-5">Pagina no encontrada</p>
                        <p class="text-gray-500 mb-0">Parece que encontraste una falla en la matrix...</p>
                        <a href="index.php">&larr; Vuelve al inicio</a>
                    </div>

                </div>
                <!-- /.container-fluid -->
                <?php require_once "vistas/footer.php" ?>