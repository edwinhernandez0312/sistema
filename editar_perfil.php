<?php
include('php/conexion.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
$id_usuario=$_SESSION['ID_USUARIO'];
$SQL=$conex->query("SELECT * FROM `usuario` WHERE ID_USUARIO='$id_usuario';");
$row=mysqli_fetch_assoc($SQL);
require_once "vistas/nav.php";
?>

<main>
<div class="card-body">
        <div class="row">
    <div class="form-group col-sm-12 col-md-12">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" value="<?php echo $row['NOMBRE_USU']; ?>" class="form-control" id="nombre" name="nombre" readonly>
    </div>
    <div class="form-group col-sm-12 col-md-12">
        <label for="apellidos" class="form-label">Apellidos</label>
        <input type="text" value="<?php echo $row['APELLIDOS_USU']; ?>" class="form-control" id="apellidos" name="apellidos" readonly>
    </div>
    <div class="form-group col-sm-12 col-md-12">
        <label for="email" class="form-label">Correo electrónico</label>
        <input type="email" value="<?php echo $row['EMAIL_USU']; ?>"class="form-control" id="email" name="email" readonly>
    </div>
    <div class="form-group col-sm-12 col-md-12">
    <button type="submit" data-toggle="modal" data-target="#exampleModal" class="btn btn-info">Editar</button>
        </div>
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar cliente</h1>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="user needs-validation" novalidate>
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="nombtr">Nombre:</label>
                                    <input type="text" class="form-control" name="nombre" value="<?php echo $row['NOMBRE_USU']; ?>" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el nombre minimo 3 caracteres">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="apellidos">Apellidos:</label>
                                    <input type="text" class="form-control" name="apellidos" value="<?php echo $row['APELLIDOS_USU']; ?>" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite los apellidos minimo 3 caracteres">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="email">Correo electrónico:</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo $row['EMAIL_USU']; ?>" maxlength="250" required pattern="[a-zA-Z0-9!#$%&'*_+-]([\.]?[a-zA-Z0-9!#$%&'*_+-])+@[a-zA-Z0-9]([^@&%$\/()=?¿!.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="Guardar" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</main>
<?php
$errores = array();
$completados = array();
if(isset($_POST['Guardar'])){
    $nombre=$_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email=$_POST['email'];
    
}
require_once "vistas/footer.php";
?>
