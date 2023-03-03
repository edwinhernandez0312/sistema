<?php
date_default_timezone_set('America/Bogota');
include('php/conexion.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
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
                    <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cédula" minlength="3" maxlength="250" required pattern="^[0-9]*$" title="Dijite la cedula solo numeros sin espacios">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_expedicion">Fecha de Expedición:</label>
                    <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion" required title="Dijite la fecha de expedición">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="lugar_exp">Lugar de expedición:</label>
                    <input type="text" class="form-control" id="lugar_exp" name="lugar_exp" placeholder="Lugar de expedición" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+(?:\(([^)]+)\))?" title="Dijite el luagr de expedición minimo 3 caracteres">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="nombres">Nombres:</label>
                    <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Nombres" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el nombre minimo 3 caracteres">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite los Apellidos minimo 3 caracteres">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required title="Dijite la fecha de nacimiento">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" minlength="3" placeholder="Teléfono" maxlength="250" required pattern="^[0-9()+- ]*$" title="Dijite el telefono">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="departamento">Departamento</label>
                    <select id="departamento" name="departamento" class="form-control" required>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="municipio">Municipio:</label>
                    <select id="municipio" name="municipio" class="form-control" required>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" minlength="3" maxlength="250" required title="Dijite la direccion">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="direccion_lab">Dirección laboral:</label>
                    <input type="text" class="form-control" id="direccion_lab" name="direccion_lab" placeholder="Dirección laboral" minlength="3" maxlength="250" required title="Dijite la direccion laboral">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" minlength="3" maxlength="250" required pattern="[a-zA-Z0-9!#$%&'*_+-]([\.]?[a-zA-Z0-9!#$%&'*_+-])+@[a-zA-Z0-9]([^@&%$\/()=?¿!.,:;]|\d)+[a-zA-Z0-9][\.][a-zA-Z]{2,4}([\.][a-zA-Z]{2})?">
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
                <div class="for-group col-sm-12 col-md-6">
                    <label for="mascotas">Mascotas</label>
                    <select name="mascotas" id="mascotas" class="form-control" title="Tiene mascotas?">
                        <option value="">Selecciona una opción</option>
                        <option value="si">SI</option>
                        <option value="no">NO</option>
                    </select>
                </div>
                <div class="for-group col-sm-12 col-md-6">
                    <label for="ingresos">Ingresos (SMMLV)</label>
                    <select name="ingresos" id="ingresos" class="form-control" title="Ingresos mensuales">
                        <option value="">Selecciona una opción</option>
                        <option value="1-2">1-2</option>
                        <option value="2-3">2-3</option>
                        <option value="3-4">3-4</option>
                        <option value="4-5">4-5</option>
                        <option value="+5">+5</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="vive_per">Personas con quien vive:</label>
                    <input type="text" class="form-control" id="vive_per" name="vive_per" placeholder="Personas con quin vive" minlength="1" maxlength="250" pattern="^[0-9()+-]*$" title="Con cuantas personas vive">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="nombres_ref1">Nombres Referencia 1:</label>
                    <input type="text" class="form-control" id="nombres_ref1" name="nombres_ref1" placeholder="Nombres Referencia 1" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el nombre minimo 3 caracteres">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="telefono_ref1">Teléfono Referencia 1:</label>
                    <input type="tel" class="form-control" id="telefono_ref1" name="telefono_ref1" placeholder="Teléfono Referencia 1" minlength="3" maxlength="250" required pattern="^[0-9()+- ]*$" title="Dijite el telefono">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="nombres_ref2">Nombres Referencia 2:</label>
                    <input type="text" class="form-control" id="nombres_ref2" name="nombres_ref2" placeholder="Nombres de referencia 2" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el nombre minimo 3 caracteres">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="telefono_ref2">Teléfono Referencia 2:</label>
                    <input type="tel" class="form-control" id="telefono_ref2" name="telefono_ref2" placeholder="Telefono Referencia 2" minlength="3" maxlength="250" required pattern="^[0-9()+- ]*$" title="Dijite el telefono">
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
                <div class="form-group col-sm-12 col-md-6">
                    <button type="submit" id="enviar" name="enviar" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </form>

    </div>
</div>
<script>
    $(document).ready(function() {
        // Obtener los datos de la API usando Ajax
        $.ajax({
            url: "https://www.datos.gov.co/resource/xdk5-pm3f.json?$query=SELECT%0A%20%20%60region%60%2C%0A%20%20%60c_digo_dane_del_departamento%60%2C%0A%20%20%60departamento%60%2C%0A%20%20%60c_digo_dane_del_municipio%60%2C%0A%20%20%60municipio%60%0AWHERE%0A%20%20%60region%60%20IN%20(%0A%20%20%20%20%22Regi%C3%B3n%20Caribe%22%2C%0A%20%20%20%20%22Regi%C3%B3n%20Centro%20Oriente%22%2C%0A%20%20%20%20%22Regi%C3%B3n%20Centro%20Sur%22%2C%0A%20%20%20%20%22Regi%C3%B3n%20Eje%20Cafetero%20-%20Antioquia%22%2C%0A%20%20%20%20%22Regi%C3%B3n%20Llano%22%2C%0A%20%20%20%20%22Regi%C3%B3n%20Pac%C3%ADfico%22%0A%20%20)",
            type: "GET",
            dataType: "json",
            success: function(data) {
                // Crear un arreglo con los nombres de los departamentos sin repetir
                var departamentos = [];
                $.each(data, function(index, value) {
                    if ($.inArray(value.departamento, departamentos) === -1) {
                        departamentos.push(value.departamento);
                    }
                });

                // Ordenar el arreglo alfabéticamente
                departamentos.sort();

                // Añadir una opción vacía al select de departamentos
                $("#departamento").append("<option value=''>Seleccione un departamento</option>");

                // Añadir las opciones con los nombres de los departamentos al select de departamentos
                $.each(departamentos, function(index, value) {
                    $("#departamento").append("<option value='" + value + "'>" + value + "</option>");
                });

                // Añadir una opción vacía al select de municipios
                $("#municipio").append("<option value=''>Seleccione un municipio</option>");

                // Cuando se cambia el valor del select de departamentos
                $("#departamento").change(function() {
                    // Obtener el valor seleccionado
                    var departamento = $(this).val();

                    // Vaciar el select de municipios
                    $("#municipio").empty();

                    // Añadir una opción vacía al select de municipios
                    $("#municipio").append("<option value=''>Seleccione un municipio</option>");

                    // Si se seleccionó un departamento válido
                    if (departamento != "") {
                        // Crear un arreglo con los nombres de los municipios del departamento seleccionado sin repetir
                        var municipios = [];
                        $.each(data, function(index, value) {
                            if (value.departamento == departamento && $.inArray(value.municipio, municipios) === -1) {
                                municipios.push(value.municipio);
                            }
                        });

                        // Ordenar el arreglo alfabéticamente
                        municipios.sort();

                        // Añadir las opciones con los nombres de los municipios al select de municipios
                        $.each(municipios, function(index, value) {
                            $("#municipio").append("<option value='" + value + "'>" + value + "</option>");
                        });
                    }

                });
            }
        });
    });
</script>
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