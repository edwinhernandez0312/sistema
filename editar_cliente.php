<?php
date_default_timezone_set('America/Bogota');
include('php/conexion.php');
include('php/funciones.php');
session_start();
$usuario_actual=$_SESSION['ID_USUARIO'];
// Verificar si se envió el id del cliente a editar
if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];
} else {
    die('Error: no se ha especificado el id del cliente');
}

// Consulta SQL para obtener los datos del cliente a editar
$sql = "SELECT * FROM cliente WHERE ID_CLIENTE = $id_cliente";
$resultado = mysqli_query($conex, $sql);

// Comprobar si se encontró el cliente
if (mysqli_num_rows($resultado) == 0) {
    die('Error: no se encontró el cliente con id ' . $id_cliente);
}

// Obtener los datos del cliente
$fila = mysqli_fetch_assoc($resultado);
$Usuario_registro = $fila['USUARIO_REGISTRO_CLIENTE'];
$sql = "SELECT * FROM usuario WHERE ID_USUARIO=$Usuario_registro";
$resultado = mysqli_query($conex, $sql);
$usuario = mysqli_fetch_assoc($resultado);
require_once "vistas/nav.php";
?>
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<script src="vendor/jquery/jquery.min.js"></script>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h1 class="m-0 font-weight-bold text-primary">Editar cliente</h1>
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="row">
                <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>" readonly>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="cedula">Cédula:</label>
                    <input type="text" class="form-control" name="cedula" value="<?php echo $fila['CEDULA']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_expedicion">Fecha de expedición de la cédula:</label>
                    <input type="date" class="form-control" name="fecha_expedicion" value="<?php echo $fila['FECHA_EXPEDICION']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="nombres">Nombres:</label>
                    <input type="text" class="form-control" name="nombres" value="<?php echo $fila['NOMBRES']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" name="apellidos" value="<?php echo $fila['APELLIDOS']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                    <input type="date" class="form-control" name="fecha_nacimiento" value="<?php echo $fila['FECHA_NACIMIENTO_CLIENTE']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" value="<?php echo $fila['TELEFONO']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" name="direccion" value="<?php echo $fila['DIRECCION']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="email" value="<?php echo $fila['EMAIL']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="estado_civil">Estado civil:</label>
                    <select name="estado_civil" class="form-control" readonly>
                        <?php
                        if ($fila['ESTADO_CIVIL'] == "Soltero/a") {
                        ?>
                            <option value="Soltero/a" selected>Soltero/a</option>
                            <option value="Casado/a">Casado/a</option>
                            <option value="Divorciado/a">Divorciado/a</option>
                            <option value="Viudo/a">Viudo/a</option>
                        <?php
                        } else if ($fila['ESTADO_CIVIL'] == "Casado/a") {
                        ?>
                            <option value="Soltero/a">Soltero/a</option>
                            <option value="Casado/a" selected>Casado/a</option>
                            <option value="Divorciado/a">Divorciado/a</option>
                            <option value="Viudo/a">Viudo/a</option>
                        <?php
                        } else if ($fila['ESTADO_CIVIL'] == "Divorciado/a") {
                        ?>
                            <option value="Soltero/a">Soltero/a</option>
                            <option value="Casado/a">Casado/a</option>
                            <option value="Divorciado/a" selected>Divorciado/a</option>
                            <option value="Viudo/a">Viudo/a</option>
                        <?php
                        } else if ($fila['ESTADO_CIVIL'] == "Viudo/a") {
                        ?>
                            <option value="Soltero/a">Soltero/a</option>
                            <option value="Casado/a">Casado/a</option>
                            <option value="Divorciado/a">Divorciado/a</option>
                            <option value="Viudo/a" selected>Viudo/a</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="nombres_ref1">Nombres de la referencia 1:</label>
                    <input type="text" class="form-control" name="nombres_ref1" value="<?php echo $fila['NOMBRES_REF1']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="telefono_ref1">Teléfono de la referencia 1:</label>
                    <input type="text" class="form-control" name="telefono_ref1" value="<?php echo $fila['TELEFONO_REF1']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="nombres_ref2">Nombres de la referencia 2:</label>
                    <input type="text" class="form-control" name="nombres_ref2" value="<?php echo $fila['NOMBRES_REF2']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="telefono_ref2">Teléfono de la referencia 2:</label>
                    <input type="text" class="form-control" name="telefono_ref2" value="<?php echo $fila['TELEFONO_REF2']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_registro">Fecha Registro:</label>
                    <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" value="<?php echo $fila['FECHA_REGISTRO'] ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="usuario_registro">Usuario Registro:</label>
                    <input type="text" class="form-control" id="usuario_registro" name="usuario_registro" value="<?php echo $usuario['NOMBRE_USU']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_modificacion">Fecha Modificación:</label>
                    <input type="text" class="form-control" id="fecha_modificacion" name="fecha_modificacion" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="usuario_modificacion">Usuario Modificación:</label>
                    <input type="text" class="form-control" id="usuario_modificacion" name="usuario_modificacion" value="<?php echo $_SESSION['NOMBRE_USU']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Editar</button>
                </div>
            </div>
        </form>

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
                                <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="cedula">Cédula:</label>
                                    <input type="text" class="form-control" name="cedula" value="<?php echo $fila['CEDULA']; ?>" minlength="3" maxlength="250" required pattern="^[0-9]*$" title="Dijite la cedula solo numeros sin espacios">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="fecha_expedicion">Fecha de expedición de la cédula:</label>
                                    <input type="date" class="form-control" name="fecha_expedicion" value="<?php echo $fila['FECHA_EXPEDICION']; ?>" required title="Dijite la fecha de expedición">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="nombres">Nombres:</label>
                                    <input type="text" class="form-control" name="nombres" value="<?php echo $fila['NOMBRES']; ?>" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el nombre minimo 3 caracteres">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="apellidos">Apellidos:</label>
                                    <input type="text" class="form-control" name="apellidos" value="<?php echo $fila['APELLIDOS']; ?>" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite los Apellidos minimo 3 caracteres">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                                    <input type="date" class="form-control" name="fecha_nacimiento" value="<?php echo $fila['FECHA_NACIMIENTO_CLIENTE']; ?>" required title="Dijite la fecha de nacimiento">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="text" class="form-control" name="telefono" value="<?php echo $fila['TELEFONO']; ?>" minlength="3" maxlength="250" required pattern="^[0-9()+- ]*$" title="Dijite el telefono">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="direccion">Dirección:</label>
                                    <input type="text" class="form-control" name="direccion" value="<?php echo $fila['DIRECCION']; ?>" minlength="3" maxlength="250" required title="Dijite la direccion">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" name="email" value="<?php echo $fila['EMAIL']; ?>" maxlength="250" required pattern="[a-zA-Z0-9!#$%&'*_+-]([\.]?[a-zA-Z0-9!#$%&'*_+-])+@[a-zA-Z0-9]([^@&%$\/()=?¿!.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="estado_civil">Estado civil:</label>
                                    <select name="estado_civil" class="form-control" required title="Dijite el estado civil">
                                        <?php
                                        if ($fila['ESTADO_CIVIL'] == "Soltero/a") {
                                        ?>
                                            <option value="Soltero/a" selected>Soltero/a</option>
                                            <option value="Casado/a">Casado/a</option>
                                            <option value="Divorciado/a">Divorciado/a</option>
                                            <option value="Viudo/a">Viudo/a</option>
                                        <?php
                                        } else if ($fila['ESTADO_CIVIL'] == "Casado/a") {
                                        ?>
                                            <option value="Soltero/a">Soltero/a</option>
                                            <option value="Casado/a" selected>Casado/a</option>
                                            <option value="Divorciado/a">Divorciado/a</option>
                                            <option value="Viudo/a">Viudo/a</option>
                                        <?php
                                        } else if ($fila['ESTADO_CIVIL'] == "Divorciado/a") {
                                        ?>
                                            <option value="Soltero/a">Soltero/a</option>
                                            <option value="Casado/a">Casado/a</option>
                                            <option value="Divorciado/a" selected>Divorciado/a</option>
                                            <option value="Viudo/a">Viudo/a</option>
                                        <?php
                                        } else if ($fila['ESTADO_CIVIL'] == "Viudo/a") {
                                        ?>
                                            <option value="Soltero/a">Soltero/a</option>
                                            <option value="Casado/a">Casado/a</option>
                                            <option value="Divorciado/a">Divorciado/a</option>
                                            <option value="Viudo/a" selected>Viudo/a</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="nombres_ref1">Nombres de la referencia 1:</label>
                                    <input type="text" class="form-control" name="nombres_ref1" value="<?php echo $fila['NOMBRES_REF1']; ?>" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el nombre minimo 3 caracteres">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="telefono_ref1">Teléfono de la referencia 1:</label>
                                    <input type="text" class="form-control" name="telefono_ref1" value="<?php echo $fila['TELEFONO_REF1']; ?>" minlength="3" maxlength="250" required pattern="^[0-9()+-]*$" title="Dijite el telefono">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="nombres_ref2">Nombres de la referencia 2:</label>
                                    <input type="text" class="form-control" name="nombres_ref2" value="<?php echo $fila['NOMBRES_REF2']; ?>" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el nombre minimo 3 caracteres">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="telefono_ref2">Teléfono de la referencia 2:</label>
                                    <input type="text" class="form-control" name="telefono_ref2" value="<?php echo $fila['TELEFONO_REF2']; ?>" minlength="3" maxlength="250" required pattern="^[0-9()+-]*$" title="Dijite el telefono">
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="fecha_registro">Fecha Registro:</label>
                                    <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" value="<?php echo $fila['FECHA_REGISTRO'] ?>" readonly>
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="usuario_registro">Usuario Registro:</label>
                                    <input type="text" class="form-control" id="usuario_registro" name="usuario_registro" value="<?php echo $usuario['NOMBRE_USU']; ?>" readonly>
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="fecha_modificacion">Fecha Modificación:</label>
                                    <input type="text" class="form-control" id="fecha_modificacion" name="fecha_modificacion" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <label for="usuario_modificacion">Usuario Modificación:</label>
                                    <input type="text" class="form-control" id="usuario_modificacion" name="usuario_modificacion" value="<?php echo $_SESSION['NOMBRE_USU']; ?>" readonly>
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
        <?php
        $errores = array();
        $completados = array();
        if (isset($_POST['Guardar'])) {
            $id = $_POST['id_cliente'];
            $cedula = $_POST['cedula'];
            $fecha_expedicion = $_POST['fecha_expedicion'];
            $nombres = $_POST['nombres'];
            $apellidos = $_POST['apellidos'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $email = $_POST['email'];
            $estado_civil = $_POST['estado_civil'];
            $nombres_ref1 = $_POST['nombres_ref1'];
            $telefono_ref1 = $_POST['telefono_ref1'];
            $nombres_ref2 = $_POST['nombres_ref2'];
            $telefono_ref2 = $_POST['telefono_ref2'];
            $fecha_modificacion = date('Y-m-d H:i:s');
            $usuario_modificacion = $_SESSION['NOMBRE_USU'];
            if (
                strlen(trim($cedula)) >= 1 &&
                strlen(trim($fecha_expedicion)) >= 1 &&
                strlen(trim($nombres)) >= 1 &&
                strlen(trim($apellidos)) >= 1 &&
                strlen(trim($fecha_modificacion)) >= 1 &&
                strlen(trim($telefono)) >= 1 &&
                strlen(trim($direccion)) >= 1 &&
                strlen(trim($email)) >= 1 &&
                strlen(trim($estado_civil)) >= 1 &&
                strlen(trim($nombres_ref1)) >= 1 &&
                strlen(trim($telefono_ref1)) >= 1 &&
                strlen(trim($nombres_ref2)) >= 1 &&
                strlen(trim($telefono_ref2)) >= 1 &&
                strlen(trim($fecha_modificacion)) >= 1 &&
                strlen(trim($usuario_modificacion)) >= 1
            ) {
                if (!validar_numero($cedula) || !validar_numero($telefono) || !validar_numero($telefono_ref1) || !validar_numero($telefono_ref2)) {
                    $errores[] = "Formato numerico incorrecto";
                }
                if (fechasDiferentes($fecha_nacimiento, $fecha_expedicion)) {
                    $errores[] = "la fecha de naciminiento no puede ser igual a la fecha de expedicion de la cedula";
                }
                if (!validar_texto($nombres) || !validar_texto($apellidos) || !validar_texto($estado_civil) || !validar_texto($nombres_ref1) || !validar_texto($nombres_ref2)) {
                    $errores[] = "Formato de caracteres incorrecto";
                }
                if (!validar_correo($email)) {
                    $errores[] = "Correo no valido";
                }
                if($cedula!=$fila['CEDULA']){
                    if (cedula_existe($cedula)) {
                        $errores[] = "El usuario con esta cedula ya existe";
                    }
                }
                if (empty($errores)) {
                    $SQL = $conex->query("UPDATE `cliente` SET `CEDULA`='$cedula',`FECHA_EXPEDICION`='$fecha_expedicion',
                    `NOMBRES`='$nombres',`APELLIDOS`='$apellidos',`FECHA_NACIMIENTO_CLIENTE`='$fecha_nacimiento',`TELEFONO`='$telefono',
                    `DIRECCION`='$direccion',`EMAIL`='$email',`ESTADO_CIVIL`='$estado_civil',`NOMBRES_REF1`='$nombres_ref1',`TELEFONO_REF1`='$telefono_ref1',
                    `NOMBRES_REF2`='$nombres_ref2',`TELEFONO_REF2`='$telefono_ref2',`USUARIO_REGISTRO_CLIENTE`='$Usuario_registro',`FECHA_MODIFICACION`='$fecha_modificacion',`USUARIO_MODIFICACION_CLIENTE`='$usuario_actual' WHERE ID_CLIENTE='$id';");
                    if ($SQL) {
                        $completados[] = "Cliente actualizado correctamente";
                    } else {
                        $errores[] = "Cliente no se pudo actualizar" . mysqli_error($conex);
                    }
                }
                mostrar_errores($errores);
                mostrar_bienes($completados);
            }
        }
        require_once "vistas/footer.php" ?>