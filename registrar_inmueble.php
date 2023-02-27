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
        <h6 class="m-0 font-weight-bold text-primary">Registrar inmueble</h6>
    </div>
    <div class="card-body">
        <form method="POST" class="user needs-validation" novalidate>
            <div class="row">
                <div class="form-group col-sm-12 col-md-6">
                    <label for="cedula">Propietario:</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" minlength="3" maxlength="250" required pattern="^[0-9]*$" title="Dijite la cedula solo numeros sin espacios">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_expedicion">Matricula del inmueble:</label>
                    <input type="text" class="form-control" id="fecha_expedicion" name="fecha_expedicion" minlength="5" maxlength="250" required title="Dijite la matricula del inmueble">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="departamento">Departamento</label>
                    <select id="departamento" name="departamento" class="form-control"></select>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="municipio">Municipio:</label>
                    <select id="municipio" name="municipio" class="form-control"></select>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="barrio">Barrio:</label>
                    <input type="text" class="form-control" id="barrio" name="barrio" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el barrio donde esta ubicado el inmueble">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="telefono">Codigo postal:</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" minlength="3" maxlength="250" required pattern="^[0-9()+-]*$" title="Dijite el codigo postal">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" minlength="3" maxlength="250" required title="Dijite la direccion">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="negocio">Tipo de negocio:</label>
                    <select class="form-control" id="negocio" name="negocio" required title="Dijite el estado civil">
                        <option value="">Selecciona una opción</option>
                        <?php
                        $consulta = $conex->query("SELECT * FROM `tipo_negocio`;");
                        while ($row = $consulta->fetch_array()) {
                        ?>
                            <option value="<?php echo $row['ID_NEGOCIO'] ?>"><?php echo $row['TIPO_NEGOCIO'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="wasi_inm">Codigo wasi del inmueble:</label>
                    <input type="tel" class="form-control" id="wasi_inm" name="wasi_inm" minlength="3" maxlength="250" required pattern="^[0-9()+-]*$" title="Codigo del inmueble">
                </div>
                <div class="for-group col-sm-12 col-md-6">
                    <label for="Estrato">Estrato del inmueble</label>
                    <select name="Estrato" id="Estrato" class="form-control" title="Estrato del inmueble">
                        <option value="">Selecciona una opción</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <div class="row">
                    <div class="fom-group col-sm-12 col-md-6">
                        <input type="checkbox" id="television" name="servicios[]" value="Television">
                        <label for="television">Televisión</label>
                    </div>
                    <div class="fom-group col-sm-12 col-md-6">
                        <input type="checkbox" id="wifi" name="servicios[]" value="Servicio de wifi">
                        <label for="wifi">Servicio de wifi</label>
                    </div>
                    <div class="fom-group col-sm-12 col-md-6">
                        <input type="checkbox" id="electricidad" name="servicios[]" value="electricidad de wifi">
                        <label for="electricidad">Sevicio de electricidad</label>
                    </div>
                    <div class="fom-group col-sm-12 col-md-6">
                        <input type="checkbox" id="agua" name="servicios[]" value="Agua">
                        <label for="agua">Agua</label>
                    </div>
                    <div class="fom-group col-sm-12 col-md-6">
                        <input type="checkbox" id="gas" name="servicios[]" value="Gas">
                        <label for="gas">Gas</label>
                    </div>
                    <div class="fom-group col-sm-12 col-md-6">
                        <input type="checkbox" id="seguridad" name="servicios[]" value="Seguridad">
                        <label for="seguridad">Seguridad</label>
                    </div>
                    <div class="fom-group col-sm-12 col-md-6">
                        <input type="checkbox" id="piscina" name="servicios[]" value="Piscina">
                        <label for="piscina">Piscina</label>
                    </div>
                    <div class="fom-group col-sm-12 col-md-6">
                        <input type="checkbox" id="sauna" name="servicios[]" value="sauna">
                        <label for="sauna">Sauna</label>
                    </div>
                    <div class="fom-group col-sm-12 col-md-6">
                        <input type="checkbox" id="aire_acon" name="servicios[]" value="aire_acon">
                        <label for="aire_acon">Aire acondicionado</label>
                    </div>
                    <div class="fom-group col-sm-12 col-md-6">
                        <input type="checkbox" id="cancha_fut" name="servicios[]" value="cancha_fut">
                        <label for="cancha_fut">Cancha de futbol</label>
                    </div>
                    <div class="fom-group col-sm-12 col-md-6">
                        <input type="checkbox" id="gimnacio" name="servicios[]" value="gimnacio">
                        <label for="gimnacio">Gimnacio</label>
                    </div>
                    <div class="fom-group col-sm-12 col-md-6">
                        <input type="checkbox" id="gimnacio" name="servicios[]" value="gimnacio">
                        <label for="gimnacio">Telefono fijo</label>
                    </div>
                </div>
                </div>
                <div class="for-group col-sm-12 col-md-6">
                    <label for="habitaciones">Habitaciones</label>
                    <select name="habitaciones" id="habitaciones" class="form-control" title="Número de habitaciones">
                        <option value="">Selecciona una opción</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
                <div class="for-group col-sm-12 col-md-6">
                    <label for="baños">Baños</label>
                    <select name="baños" id="baños" class="form-control" title="Estrato del inmueble">
                        <option value="">Selecciona una opción</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
                <div class="for-group col-sm-12 col-md-6">
                    <label for="garaje">Garaje</label>
                    <select name="garaje" id="garaje" class="form-control" title="Estrato del inmueble">
                        <option value="">Selecciona una opción</option>
                        <option value="si">SI</option>
                        <option value="no">NO</option>
                    </select>
                </div>
                <div class="for-group col-sm-12 col-md-6">
                    <label for="mascotas">Ceptan mascotas</label>
                    <select name="mascotas" id="mascotas" class="form-control" title="Estrato del inmueble">
                        <option value="">Selecciona una opción</option>
                        <option value="si">SI</option>
                        <option value="no">NO</option>
                    </select>
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
            url: "https://www.datos.gov.co/resource/xdk5-pm3f.json",
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
<?php
if(isset($_POST['enviar'])){
    $servicios = $_POST['servicios'];
        $cadena=implode(",", $servicios);
    
    echo $cadena;
}
require_once "vistas/footer.php";
?>