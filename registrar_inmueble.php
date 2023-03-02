<?php
date_default_timezone_set('America/Bogota');
include('php/conexion.php');
include('php/funciones.php');
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
                    <input type="hidden" id="id_pro" name="id_pro">
                    <div class="row">
                        <label for="cedula" class="col-sm-6">Propietario:</label>
                        <h3 class="col-sm-6 d-flex justify-content-end m-0 font-weight-bold text-primary">
                            <a type="button" class="nav-link fa fa-user-plus" data-toggle="modal" data-target="#exampleModal"></a>
                        </h3>
                    </div>
                    <input type="text" class="form-control" id="propietario" name="propietario" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el propietario" readonly disabled>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_expedicion">Matricula del inmueble:</label>
                    <input type="text" class="form-control" id="matricula" name="matricula" minlength="5" maxlength="250" required title="Dijite la matricula del inmueble">
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
                    <label for="barrio">Barrio:</label>
                    <input type="text" class="form-control" id="barrio" name="barrio" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el barrio donde esta ubicado el inmueble">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="codigo-postal">Codigo postal:</label>
                    <input type="text" class="form-control" id="codigo-postal" name="codigo-postal" minlength="3" maxlength="250" required pattern="^[0-9()+-]*$" title="Dijite el codigo postal">
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
                <div class="form-group col-sm-12 col-md-6">
                    <label for="Estrato">Estrato del inmueble</label>
                    <select name="Estrato" id="Estrato" class="form-control" title="Estrato del inmueble" required>
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
                        <div class="form-group col-sm-12 col-md-6 form-check form-check">
                            <input type="checkbox" class="form-check-input" id="television" name="servicios[]" value="Television">
                            <label for="television">Televisión</label>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 form-check">
                            <input type="checkbox" class="form-check-input" id="wifi" name="servicios[]" value="Servicio de wifi">
                            <label for="wifi">Servicio de wifi</label>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 form-check">
                            <input type="checkbox" class="form-check-input" id="electricidad" name="servicios[]" value="Sevicio de electricidad">
                            <label for="electricidad">Sevicio de electricidad</label>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 form-check">
                            <input type="checkbox" class="form-check-input" id="agua" name="servicios[]" value="Agua">
                            <label for="agua">Agua</label>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 form-check">
                            <input type="checkbox" class="form-check-input" id="gas" name="servicios[]" value="Gas">
                            <label for="gas">Gas</label>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 form-check">
                            <input type="checkbox" class="form-check-input" id="seguridad" name="servicios[]" value="Seguridad">
                            <label for="seguridad">Seguridad</label>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 form-check">
                            <input type="checkbox" class="form-check-input" id="piscina" name="servicios[]" value="Piscina">
                            <label for="piscina">Piscina</label>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 form-check">
                            <input type="checkbox" class="form-check-input" id="sauna" name="servicios[]" value="Sauna">
                            <label for="sauna">Sauna</label>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 form-check">
                            <input type="checkbox" class="form-check-input" id="aire_acon" name="servicios[]" value="Aire acondicionado">
                            <label for="aire_acon">Aire acondicionado</label>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 form-check">
                            <input type="checkbox" class="form-check-input" id="cancha_fut" name="servicios[]" value="Cancha de futbol">
                            <label for="cancha_fut">Cancha de futbol</label>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 form-check">
                            <input type="checkbox" class="form-check-input" id="gimnacio" name="servicios[]" value="Gimnacio">
                            <label for="gimnacio">Gimnacio</label>
                        </div>
                        <div class="form-group col-sm-12 col-md-6 form-check">
                            <input type="checkbox" class="form-check-input" id="gimnacio" name="servicios[]" value="Telefono fijo">
                            <label for="gimnacio">Telefono fijo</label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="habitaciones">Habitaciones</label>
                    <select name="habitaciones" id="habitaciones" class="form-control" title="Número de habitaciones" required>
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
                    <label for="baños">Baños</label>
                    <select name="baños" id="baños" class="form-control" title="Estrato del inmueble" required>
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
                    <label for="garaje">Garaje</label>
                    <select name="garaje" id="garaje" class="form-control" title="Estrato del inmueble" required>
                        <option value="">Selecciona una opción</option>
                        <option value="si">SI</option>
                        <option value="no">NO</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="mascotas">Aceptan mascotas</label>
                    <select name="mascotas" id="mascotas" class="form-control" title="Estrato del inmueble" required>
                        <option value="">Selecciona una opción</option>
                        <option value="si">SI</option>
                        <option value="no">NO</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
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
                    <button type="submit" id="enviar" name="enviar" class="btn btn-info">Registrar</button>
                </div>
            </div>
        </form>

    </div>
</div>
<?php
$resultado = $conex->query("SELECT * FROM cliente");
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Seleccionar el propietario</h1>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" class="user needs-validation" novalidate>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-primary">Clientes</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="Table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Cédula</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Teléfono</th>
                                            <th>Dirección</th>
                                            <th>Email</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Mostrar los resultados en la tabla
                                        while ($fila = mysqli_fetch_assoc($resultado)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $fila['CEDULA']; ?></td>
                                                <td><?php echo $fila['NOMBRES']; ?></td>
                                                <td><?php echo $fila['APELLIDOS']; ?></td>
                                                <td><?php echo $fila['TELEFONO']; ?></td>
                                                <td><?php echo $fila['DIRECCION']; ?></td>
                                                <td><?php echo $fila['EMAIL']; ?></td>
                                                <td><button type="button" id="boton" name="Guardar" data-nombre="<?php echo $fila['NOMBRES'] ?>" data-apellido="<?php echo $fila['APELLIDOS'] ?>" data-id="<?php echo $fila['ID_CLIENTE'] ?>" class="btn btn-primary">Seleccionar</button></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Cédula</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Teléfono</th>
                                            <th>Dirección</th>
                                            <th>Email</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).on("click", ".btn-primary", function() {
        var nombre = $(this).data("nombre");
        var apellido = $(this).data("apellido");
        var id = $(this).data("id");
        var nombre_completo = nombre + " " + apellido;
        $("#propietario").val(nombre_completo);
        $("#id_pro").val(id);
        $("#exampleModal").modal("hide");
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
<?php
$errores = array();
if (isset($_POST['enviar'])) {
    $id_pro = trim($_POST['id_pro']);
    $matricula = trim($_POST['matricula']);
    $departamento = trim($_POST['departamento']);
    $municipio = trim($_POST['municipio']);
    $barrio = trim($_POST['barrio']);
    $codigo_postal = trim($_POST['codigo-postal']);
    $direccion = trim($_POST['direccion']);
    $tipo_negocios = trim($_POST['negocio']);
    $codigo_wasi = trim($_POST['wasi_inm']);
    $estrato = trim($_POST['Estrato']);
    if(isset($_POST['servicios'])){
        $servicios = $_POST['servicios'];
    }else{
        $servicios="";
    }
    $habitaciones = trim($_POST['habitaciones']);
    $baños = trim($_POST['baños']);
    $garaje = trim($_POST['garaje']);
    $mascotas = trim($_POST['mascotas']);
    $fecha_registro = date('Y-m-d H:i:s');
    $usuario_registro = $_SESSION['ID_USUARIO'];
    $fecha_modificacion = date('Y-m-d H:i:s');
    $usuario_modificacion = $_SESSION['ID_USUARIO'];
    if (
        strlen($id_pro) >= 1 &&
        strlen($matricula) >= 1 &&
        strlen($departamento) >= 1 &&
        strlen($municipio) >= 1 &&
        strlen($barrio) >= 1 &&
        strlen($codigo_postal) >= 1 &&
        strlen($direccion) >= 1 &&
        strlen($tipo_negocios) >= 1 &&
        strlen($codigo_wasi) >= 1 &&
        strlen($estrato) >= 1 &&
        strlen($habitaciones) >= 1 &&
        strlen($baños) >= 1 &&
        strlen($garaje) >= 1 &&
        strlen($mascotas) >= 1
    ) {
        if (!empty($servicios)) {
            $servicios_total = implode(',', $servicios);
        } else {
            $servicios_total = "";
        }
        if (!validar_numero($matricula) || !validar_numero($codigo_postal) || !validar_numero($codigo_wasi)) {
            $errores[] = "Datos no validos, vefique los tipos de datos";
        }
        if (wasi_existe($codigo_wasi,$matricula)) {
            $errores[] = "Ya existe un registro con el codigo de wasi o con esa matricula";
        }
        if (empty($errores)) {
            $SQL = $conex->query("INSERT INTO `inmueble`( `PROPIETARIO`, `MATRICULA_INMUEBLE`, `DEPARTAMENTO`, `MUNICIPIO`, `BARRIO`, `CODIGO_POSTAL`, `DIRECCION`, `TIPO_NEGOCIO`, `CODIGO_WASI_INMUEBLE`, `ESTRATO`, `SERVICIOS`, `HABITACIONES`, `BAÑOS`, `GARAJE`, `ACEPTAN_MASCOTAS`, `FECHA_CREACION_INMUEBLE`, `USUARIO_CREACION_INMUEBLE`, `FECHA_MODIFICACION_INMUEBLE`, `USUARIO_MODIFICACION_INMUEBLE`) 
            VALUES ('$id_pro','$matricula','$departamento','$municipio','$barrio','$codigo_postal','$direccion','$tipo_negocios','$codigo_wasi','$estrato','$servicios_total','$habitaciones','$baños','$garaje','$mascotas','$fecha_registro','$usuario_registro','$fecha_modificacion','$usuario_modificacion');");
            if ($SQL) {
                echo "<script>
                Swal.fire({
                  title: '¡Éxito!',
                  text: 'La operación se realizó correctamente.',
                  icon: 'success',
                  confirmButtonText: 'Continuar'
                });
                </script>";
            } else {
                $errores[] = "El inmueble no se ha registrado correctamente" . mysqli_error($conex);
            }
        }
    } else {
        $errores[] = "Todos los campos son obligatorios";
    }
    if (!empty($errores)) {
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