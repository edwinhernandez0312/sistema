<?php
date_default_timezone_set('America/Bogota');
include('php/conexion.php');
include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
$tipo = nombre_tipo($_SESSION['TIPO_USUARIO']);
$id= $_SESSION['ID_USUARIO'];
echo $id;
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registrar Cliente</h6>
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="form-group">
                <label for="cedula">Cédula:</label>
                <input type="text" class="form-control" id="cedula" name="cedula" required>
            </div>
            <div class="form-group">
                <label for="fecha_expedicion">Fecha de Expedición:</label>
                <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion" required>
            </div>
            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <input type="text" class="form-control" id="nombres" name="nombres" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
            </div>
            <div class="form-group">
                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="estado_civil">Estado Civil:</label>
                <select class="form-control" id="estado_civil" name="estado_civil" required>
                    <option value="">Selecciona una opción</option>
                    <option value="Soltero/a">Soltero/a</option>
                    <option value="Casado/a">Casado/a</option>
                    <option value="Divorciado/a">Divorciado/a</option>
                    <option value="Viudo/a">Viudo/a</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nombres_ref1">Nombres Referencia 1:</label>
                <input type="text" class="form-control" id="nombres_ref1" name="nombres_ref1" required>
            </div>
            <div class="form-group">
                <label for="telefono_ref1">Teléfono Referencia 1:</label>
                <input type="tel" class="form-control" id="telefono_ref1" name="telefono_ref1" required>
            </div>
            <div class="form-group">
                <label for="nombres_ref2">Nombres Referencia 2:</label>
                <input type="text" class="form-control" id="nombres_ref2" name="nombres_ref2" required>
            </div>
            <div class="form-group">
                <label for="telefono_ref2">Teléfono Referencia 2:</label>
                <input type="tel" class="form-control" id="telefono_ref2" name="telefono_ref2" required>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fecha_registro">Fecha Registro:</label>
                        <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="usuario_registro">Usuario Registro:</label>
                        <input type="text" class="form-control" id="usuario_registro" name="usuario_registro" value="<?php echo $_SESSION['NOMBRE_USU']; ?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fecha_modificacion">Fecha Modificación:</label>
                        <input type="text" class="form-control" id="fecha_modificacion" name="fecha_modificacion" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="usuario_modificacion">Usuario Modificación:</label>
                        <input type="text" class="form-control" id="usuario_modificacion" name="usuario_modificacion" value="<?php echo $_SESSION['NOMBRE_USU']; ?>" readonly>
                    </div>
                </div>
                <button type="submit" name="enviar" class="btn btn-primary">Registrar</button>
        </form>

    </div>
</div>

<?php
// Si se ha enviado el formulario
if (isset($_POST['enviar'])) {
    // Recoger los datos del formulario
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
    $fecha_registro = date('Y-m-d H:i:s');
    $usuario_registro = $_SESSION['NOMBRE_USU'];
    $fecha_modificacion = date('Y-m-d H:i:s');
    $usuario_modificacion = $_SESSION['NOMBRE_USU'];

    // Validar los datos
    $errores = array();

    // if (empty($cedula)) {
    //     $errores[] = 'La cédula es obligatoria.';
    // } elseif (!is_numeric($cedula)) {
    //     $errores[] = 'La cédula debe ser un número.';
    // }

    // Validar y procesar la fecha de expedición
    // $fecha_expedicion_obj = DateTime::createFromFormat('Y-m-d', $fecha_expedicion);
    // if (!$fecha_expedicion_obj) {
    //     $errores[] = 'La fecha de expedición no es válida.';
    // }

    // if (empty($nombres)) {
    //     $errores[] = 'Los nombres son obligatorios.';
    // }

    // if (empty($apellidos)) {
    //     $errores[] = 'Los apellidos son obligatorios.';
    // }

    // Validar y procesar la fecha de nacimiento
    // $fecha_nacimiento_obj = DateTime::createFromFormat('Y-m-d', $fecha_nacimiento);
    // if (!$fecha_nacimiento_obj) {
    //     $errores[] = 'La fecha de nacimiento no es válida.';
    // }

    // if (empty($telefono)) {
    //     $errores[] = 'El teléfono es obligatorio.';
    // } elseif (!is_numeric($telefono)) {
    //     $errores[] = 'El teléfono debe ser un número.';
    // }

    // if (empty($direccion)) {
    //     $errores[] = 'La dirección es obligatoria.';
    // }

    // if (empty($email)) {
    //     $errores[] = 'El correo electrónico es obligatorio.';
    // } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     $errores[] = 'El correo electrónico no es válido.';
    // }

    // if (empty($estado_civil)) {
    //     $errores[] = 'El estado civil es obligatorio.';
    // }

    // if (empty($nombres_ref1)) {
    //     $errores[] = 'Los nombres de la primera referencia son obligatorios.';
    // }

    // if (empty($telefono_ref1)) {
    //     $errores[] = 'El teléfono de la primera referencia es obligatorio.';
    // } elseif (!is_numeric($telefono_ref1)) {
    //     $errores[] = 'El teléfono de la primera referencia debe ser un número.';
    // }

    // if (empty($nombres_ref2)) {
    //     $errores[] = 'Los nombres de la segunda referencia son obligatorios.';
    // }
    // if (empty($telefono_ref2)) {
    //     $errores[] = 'El teléfono de la segunda referencia es obligatorio.';
    // } elseif (!is_numeric($telefono_ref2)) {
    //     $errores[] = 'El teléfono de la segunda referencia debe ser un número.';
    // if(!validar_numero($cedula)){
    //     $errores[]="Cedula incorrecta";
    // }
    // if (empty($errores)) {
    //     // Verificar conexión
    //     if (!$conex) {
    //         die('Error de conexión: ' . mysqli_connect_error());
    //     }

        // Crear la sentencia SQL para insertar los datos del cliente
        $sql =$conex->query("INSERT INTO `cliente`(`CEDULA`, `FECHA_EXPEDICION`, `NOMBRES`, `APELLIDOS`, `FECHA_NACIMIENTO_CLIENTE`, `TELEFONO`, `DIRECCION`, `EMAIL`, `ESTADO_CIVIL`, `NOMBRES_REF1`, `TELEFONO_REF1`, `NOMBRES_REF2`, `TELEFONO_REF2`,  `USUARIO_REGISTRO_CLIENTE`,`USUARIO_MODIFICACION_CLIENTE`) VALUES ('$cedula', '$fecha_expedicion', '$nombres','$apellidos','$fecha_nacimiento','$telefono', '$direccion', '$email', '$estado_civil',  '$nombres_ref1', '$telefono_ref1', '$nombres_ref2', '$telefono_ref2','$id','$id')");

        // Ejecutar la sentencia SQL
        if ($sql) {
            // Si la inserción fue exitosa, mostrar un mensaje al usuario
            echo 'El cliente se registró correctamente.';
        } else {
            // Si hubo un error en la inserción, mostrar un mensaje de error
            echo 'Error al registrar el cliente: ' . mysqli_error($conex);
        }

        // Redireccionar al cliente a una página de confirmación de registro exitoso
        // header('Location: index.php');
        // exit;
    }

    // Si no hay errores, se procede a registrar el cliente
    

?>