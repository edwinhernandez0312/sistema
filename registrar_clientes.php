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

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registrar Cliente</h6>
    </div>
    <div class="card-body">
        <form action="procesar_registro_cliente.php" method="POST">
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
                <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</div>