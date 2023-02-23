<?php
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
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h1 class="m-0 font-weight-bold text-primary">Editar cliente</h1>
    </div>
    <div class="card-body">
        <form method="POST">
            <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
            <div class="form-group">
                <label for="cedula">Cédula:</label>
                <input type="text" class="form-control" name="cedula" value="<?php echo $fila['CEDULA']; ?>"><br><br>
            </div>
            <div class="form-group">
                <label for="fecha_expedicion">Fecha de expedición de la cédula:</label>
                <input type="date" class="form-control" name="fecha_expedicion" value="<?php echo $fila['FECHA_EXPEDICION']; ?>"><br><br>
            </div>
            <div class="form-group"><label for="nombres">Nombres:</label>
                <input type="text" class="form-control" name="nombres" value="<?php echo $fila['NOMBRES']; ?>"><br><br>
                <label for="apellidos">Apellidos:</label>
            </div>
            <div class="form-group"><input type="text" class="form-control" name="apellidos" value="<?php echo $fila['APELLIDOS']; ?>"><br><br>
                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                <input type="date" class="form-control" name="fecha_nacimiento" value="<?php echo $fila['FECHA_NACIMIENTO_CLIENTE']; ?>"><br><br>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" class="form-control" name="telefono" value="<?php echo $fila['TELEFONO']; ?>"><br><br>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección:</label>
                <input type="text" class="form-control" name="direccion" value="<?php echo $fila['DIRECCION']; ?>"><br><br>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value="<?php echo $fila['EMAIL']; ?>"><br><br>
            </div>
            <div class="form-group">
                <label for="estado_civil">Estado civil:</label>
                <select name="estado_civil" class="form-control">
                    <option value="soltero/a" <?php if ($fila['ESTADO_CIVIL'] == 'soltero/a') echo 'selected'; ?>>Soltero/a</option>
                    <option value="casado/a" <?php if ($fila['ESTADO_CIVIL'] == 'casado/a') echo 'selected'; ?>>Casado/a</option>
                    <option value="divorciado/a" <?php if ($fila['ESTADO_CIVIL'] == 'divorciado/a') echo 'selected'; ?>>Divorciado/a</option>
                    <option value="viudo/a" <?php if ($fila['ESTADO_CIVIL'] == 'viudo/a') echo 'selected'; ?>>Viudo/a</option>
                </select><br><br>
            </div>
            <div class="form-group">
                <label for="nombres_ref1">Nombres de la referencia 1:</label>
                <input type="text" class="form-control" name="nombres_ref1" value="<?php echo $fila['NOMBRES_REF1']; ?>"><br><br>
            </div>
            <div class="form-group">
                <label for="telefono_ref1">Teléfono de la referencia 1:</label>
                <input type="text" class="form-control" name="telefono_ref1" value="<?php echo $fila['TELEFONO_REF1']; ?>"><br><br>
            </div>
            <div class="form-group">
                <label for="nombres_ref2">Nombres de la referencia 2:</label>
                <input type="text" class="form-control" name="nombres_ref2" value="<?php echo $fila['NOMBRES_REF2']; ?>"><br><br>
            </div>
            <div class="form-group">
                <label for="telefono_ref2">Teléfono de la referencia 2:</label>
                <input type="text" nclass="form-control" ame="telefono_ref2" value="<?php echo $fila['TELEFONO_REF2']; ?>"><br><br>
            </div>
            <input type="submit" name="enviar" class="btn btn-primary">
        </form>
    </div>
</div>