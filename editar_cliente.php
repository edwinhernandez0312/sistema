<?php
date_default_timezone_set('America/Bogota');
include('php/conexion.php');
include('php/funciones.php');
session_start();

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
$Usuario_registro=$fila['USUARIO_REGISTRO_CLIENTE'];
$sql="SELECT * FROM usuario WHERE ID_USUARIO=$Usuario_registro";
$resultado=mysqli_query($conex, $sql);
$usuario=mysqli_fetch_assoc($resultado);
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
            <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
            <div class="form-group">
                <label for="cedula">Cédula:</label>
                <input type="text" class="form-control" name="cedula" value="<?php echo $fila['CEDULA']; ?>">
            </div>
            <div class="form-group">
                <label for="fecha_expedicion">Fecha de expedición de la cédula:</label>
                <input type="date" class="form-control" name="fecha_expedicion" value="<?php echo $fila['FECHA_EXPEDICION']; ?>">
            </div>
            <div class="form-group"><label for="nombres">Nombres:</label>
                <input type="text" class="form-control" name="nombres" value="<?php echo $fila['NOMBRES']; ?>">
                <label for="apellidos">Apellidos:</label>
            </div>
            <div class="form-group"><input type="text" class="form-control" name="apellidos" value="<?php echo $fila['APELLIDOS']; ?>">
                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                <input type="date" class="form-control" name="fecha_nacimiento" value="<?php echo $fila['FECHA_NACIMIENTO_CLIENTE']; ?>">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" name="telefono" value="<?php echo $fila['TELEFONO']; ?>">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" name="direccion" value="<?php echo $fila['DIRECCION']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value="<?php echo $fila['EMAIL']; ?>">
            </div>
            <div class="form-group">
                <label for="estado_civil">Estado civil:</label>
                <select name="estado_civil" class="form-control">
                    <option value="soltero/a" <?php if ($fila['ESTADO_CIVIL'] == 'soltero/a') echo 'selected'; ?>>Soltero/a</option>
                    <option value="casado/a" <?php if ($fila['ESTADO_CIVIL'] == 'casado/a') echo 'selected'; ?>>Casado/a</option>
                    <option value="divorciado/a" <?php if ($fila['ESTADO_CIVIL'] == 'divorciado/a') echo 'selected'; ?>>Divorciado/a</option>
                    <option value="viudo/a" <?php if ($fila['ESTADO_CIVIL'] == 'viudo/a') echo 'selected'; ?>>Viudo/a</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nombres_ref1">Nombres de la referencia 1:</label>
                <input type="text" class="form-control" name="nombres_ref1" value="<?php echo $fila['NOMBRES_REF1']; ?>">
            </div>
            <div class="form-group">
                <label for="telefono_ref1">Teléfono de la referencia 1:</label>
                <input type="text" class="form-control" name="telefono_ref1" value="<?php echo $fila['TELEFONO_REF1']; ?>">
            </div>
            <div class="form-group">
                <label for="nombres_ref2">Nombres de la referencia 2:</label>
                <input type="text" class="form-control" name="nombres_ref2" value="<?php echo $fila['NOMBRES_REF2']; ?>">
            </div>
            <div class="form-group">
                <label for="telefono_ref2">Teléfono de la referencia 2:</label>
                <input type="text" class="form-control" name="telefono_ref2" value="<?php echo $fila['TELEFONO_REF2']; ?>">
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fecha_registro">Fecha Registro:</label>
                        <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" value="<?php echo $fila['FECHA_REGISTRO'] ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="usuario_registro">Usuario Registro:</label>
                        <input type="text" class="form-control" id="usuario_registro" name="usuario_registro" value="<?php echo $usuario['NOMBRE_USU'] ; ?>" readonly>
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
            </div>
            <input type="submit" name="enviar" class="btn btn-primary">
        </form>
    </div>
</div>