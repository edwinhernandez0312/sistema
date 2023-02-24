<?php
date_default_timezone_set('America/Bogota');
include('php/conexion.php');
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
$id = $_SESSION['ID_USUARIO'];
require_once "vistas/nav.php";
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registrar Cliente</h6>
    </div>
    <div class="card-body">
        <form method="POST" class="user needs-validation" novalidate>
            <div class="row">
                <div class="form-group col-sm-12 col-md-6">
                    <label for="cedula">Cédula:</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" minlength="3" maxlength="250" required pattern="^[0-9]*$" title="Dijite la cedula solo numeros sin espacios">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_expedicion">Fecha de Expedición:</label>
                    <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion" required title="Dijite la fecha de expedición">
                </div>

                <div class="form-group col-sm-12 col-md-6">
                    <label for="nombres">Nombres:</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el nombre minimo 3 caracteres">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite los Apellidos minimo 3 caracteres">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required title="Dijite la fecha de nacimiento">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" minlength="3" maxlength="250" required pattern="^[0-9()+-]*$" title="Dijite el telefono">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" minlength="3" maxlength="250" required title="Dijite la direccion">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" minlength="3" maxlength="250" required pattern="[a-zA-Z0-9!#$%&'*_+-]([\.]?[a-zA-Z0-9!#$%&'*_+-])+@[a-zA-Z0-9]([^@&%$\/()=?¿!.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="estado_civil">Estado Civil:</label>
                    <select class="form-control" id="estado_civil" name="estado_civil" required title="Dijite el estado civil">
                        <option value="">Selecciona una opción</option>
                        <option value="Soltero/a">Soltero/a</option>
                        <option value="Casado/a">Casado/a</option>
                        <option value="Divorciado/a">Divorciado/a</option>
                        <option value="Viudo/a">Viudo/a</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="nombres_ref1">Nombres Referencia 1:</label>
                    <input type="text" class="form-control" id="nombres_ref1" name="nombres_ref1" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el nombre minimo 3 caracteres">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="telefono_ref1">Teléfono Referencia 1:</label>
                    <input type="tel" class="form-control" id="telefono_ref1" name="telefono_ref1" minlength="3" maxlength="250" required pattern="^[0-9()+-]*$" title="Dijite el telefono">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="nombres_ref2">Nombres Referencia 2:</label>
                    <input type="text" class="form-control" id="nombres_ref2" name="nombres_ref2" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el nombre minimo 3 caracteres">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="telefono_ref2">Teléfono Referencia 2:</label>
                    <input type="tel" class="form-control" id="telefono_ref2" name="telefono_ref2" minlength="3" maxlength="250" required pattern="^[0-9()+-]*$" title="Dijite el telefono">
                </div>
                <div class="form-group col-md-6">
                    <label for="fecha_registro">Fecha Registro:</label>
                    <input type="text" class="form-control" id="fecha_registro" name="fecha_registro" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="usuario_registro">Usuario Registro:</label>
                    <input type="text" class="form-control" id="usuario_registro" name="usuario_registro" value="<?php echo $_SESSION['NOMBRE_USU']; ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_modificacion">Fecha Modificación:</label>
                    <input type="text" class="form-control" id="fecha_modificacion" name="fecha_modificacion" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="usuario_modificacion">Usuario Modificación:</label>
                    <input type="text" class="form-control" id="usuario_modificacion" name="usuario_modificacion" value="<?php echo $_SESSION['NOMBRE_USU']; ?>" readonly>
                </div>
                <div>
                    <button type="submit" id="enviar" name="enviar" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </form>

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
include 'guardar_cliente.php';
require_once "vistas/footer.php";
?>