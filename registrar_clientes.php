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
        <h6 class="m-0 font-weight-bold text-primary">Registro de Cliente</h6>
    </div>
    <div class="card-body">
        <form method="post" action="registrar_cliente.php">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="cedula">Cédula</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="fecha_expedicion">Fecha de Expedición</label>
                    <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="nombres">Nombres</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" required>
                </div>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="estado_civil">Estado Civil</label>
                    <select class="form-control" id="estado_civil" name="estado_civil" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Soltero/a">Soltero/a</option>
                        <option value="Casado/a">Casado/a</option>
                        <option value="Viudo/a">Viudo/a</option>
                        <option value="Divorciado/a">Divorciado/a</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="nombres_ref1">Nombres Referencia 1</label>
                    <input type="text" class="form-control" id="nombres_ref1" name="nombres_ref1" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="telefono_ref1">Teléfono
                    </label>
                </div>
            </div>
        </form>
    </div>
</div>
