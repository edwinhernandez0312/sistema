<?php
include('php/conexion.php');
include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
// verificcar que si se envio una id
if(isset($_GET['id'])){
    $id_usuario = $_GET['id'];
}else{
    die("Error: no se ha espesificado el id del usuario");
}
// hacer la consulta con la id que llego
$SQL = $conex->query("SELECT * FROM `usuario` WHERE ID_USUARIO='$id_usuario';");
// comprobar que con esa id haya algun registro
if(mysqli_num_rows($SQL)==0){
    die("Error: no se ecnontro un usuario con la id" .$id_usuario);
}
$row = mysqli_fetch_assoc($SQL);
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
                <input type="email" value="<?php echo $row['EMAIL_USU']; ?>" class="form-control" id="email" name="email" readonly>
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
if (isset($_POST['Guardar'])) {
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $email = trim($_POST['email']);
    if (
        strlen(trim($nombre)) >= 1 &&
        strlen(trim($apellidos)) >= 1 &&
        strlen(trim($email)) >= 1
    ) {
        if(!validar_texto($nombre) || !validar_texto($apellidos)){
            $errores[] ="Formato de caracteres incorrecto";
        }
        if(!validar_correo($email)){
            $errores[] ="Correo no valido";
        }
        if($email != $row['EMAIL_USU']){
            if(email_existe($email)){
                $errores[] ="El correo electronico ya se encuentra registrado";
            }
        }
        if(empty($errores)){
            $SQL=$conex->query("UPDATE `usuario` SET `NOMBRE_USU`='$nombre',`APELLIDOS_USU`='$apellidos',`EMAIL_USU`='$email' WHERE ID_USUARIO='$id_usuario';");
            if($SQL){
                echo "<script>
                Swal.fire({
                  title: '¡Éxito!',
                  text: 'La operación se realizó correctamente.',
                  icon: 'success',
                  confirmButtonText: 'Continuar'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = 'editar_perfil.php?id=" . $id_usuario . "';
                  }
                })
                </script>";
            }else{
                $errores[]="Usuario no se pudo actualizar" . mysqli_error($conex);
                $lista_errores = "<ul>";
                foreach ($errores as $error) {
                    $lista_errores .= "<li>" . $error . "</li>";
                }
                $lista_errores .= "</ul>";
                echo "<script>
Swal.fire({
icon: 'error',
title: 'Error',
html: '$lista_errores',
confirmButtonText: 'Continuar'
});
</script>";
            }
        }else{
            $lista_errores = "<ul>";
            foreach ($errores as $error) {
                $lista_errores .= "<li>" . $error . "</li>";
            }
            $lista_errores .= "</ul>";
            echo "<script>
Swal.fire({
icon: 'error',
title: 'Error',
html: '$lista_errores',
confirmButtonText: 'Continuar'
});
</script>";
        }
    }else{
        $errores[] = "Todos los campos son obligatorios";
                $lista_errores = "<ul>";
                foreach ($errores as $error) {
                    $lista_errores .= "<li>" . $error . "</li>";
                }
                $lista_errores .= "</ul>";
                echo "<script>
    Swal.fire({
    icon: 'error',
    title: 'Error',
    html: '$lista_errores',
    confirmButtonText: 'Continuar'
    });
    </script>";
    }
}
require_once "vistas/footer.php";
?>