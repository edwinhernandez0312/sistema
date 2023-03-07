<?php
include('php/conexion.php');
include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}
if ($_SESSION['TIPO_USUARIO'] != 1 && $_SESSION['TIPO_USUARIO'] != 2) {
    header("Location: login.php");
    exit;
}
if (isset($_POST['num_legajo']) && isset($_POST['estado']) && isset($_POST['id_pro'])) {
    if(!empty($_POST['num_legajo'])
    && !empty($_POST['estado'])
    && !empty($_POST['id_pro'])
    ){
    }else{
        die("Datos imcompletos");
    }
}else{
    die("Datos incompletos");
}
$num_legajo = trim($_POST['num_legajo']);
$estado=trim($_POST['estado']);
$id_pro = trim($_POST['id_pro']);
require_once "vistas/nav.php";
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Crear legajo</h6>
    </div>
    <div class="card-body">
        <form method="POST" class="user needs-validation" novalidate>
            <div class="row">
            <div class="form-group col-sm-12 col-md-6">
                    <input type="hidden" id="id_inm" name="id_inm">
                    <div class="row">
                        <label for="matricula" class="col-sm-6">Inmueble:</label>
                        <h5 class="col-sm-6 d-flex justify-content-end m-0 font-weight-bold text-primary">
                            <a type="button" class="nav-link fa fa-user-plus" data-toggle="modal" data-target="#exampleModal"></a>
                        </h5>
                    </div>
                    <input type="text" class="form-control" id="matricula" name="matricula" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" readonly disabled>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="afianzadora">Afianzadora</label>
                    <select name="afianzadora" id="afianzadora" class="form-control" title="Afianzadora del inmueble" required>
                        <option value="">Selecciona una opción</option>
                        <option value="Fianza Ferrer">Fianza Ferrer</option>
                        <option value="Fianly">Fianly</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <input type="hidden" id="id_cod" name="id_cod">
                    <div class="row">
                        <label for="codeudor" class="col-sm-6">Codeudor:</label>
                        <h5 class="col-sm-6 d-flex justify-content-end m-0 font-weight-bold text-primary">
                            <a type="button" class="nav-link fa fa-user-plus" data-toggle="modal" data-target="#Modal"></a>
                        </h5>
                    </div>
                    <input type="text" class="form-control" id="codeudor" name="codeudor" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" readonly disabled>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="semillero">Semillero:</label>
                    <input type="text" class="form-control" id="semillero" name="semillero" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el barrio donde esta ubicado el inmueble">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_registro">Fecha Incio de contrato:</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
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
$resultado = $conex->query("SELECT NOMBRES,APELLIDOS, tipo_negocio.TIPO_NEGOCIO, inmueble.*
FROM inmueble
INNER JOIN cliente ON inmueble.PROPIETARIO = cliente.ID_CLIENTE
INNER JOIN tipo_negocio ON inmueble.TIPO_NEGOCIO = tipo_negocio.ID_NEGOCIO
WHERE inmueble.PROPIETARIO = '$id_pro';");
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
                                            <th>Propietario</th>
                                            <th>Matricula</th>
                                            <th>Departamento</th>
                                            <th>Municipio</th>
                                            <th>Barrio</th>
                                            <th>Codigo postal</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Mostrar los resultados en la tabla
                                        while ($fila = mysqli_fetch_assoc($resultado)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $fila['NOMBRES'] . " " . $fila['APELLIDOS']; ?></td>
                                                <td><?php echo $fila['MATRICULA_INMUEBLE']; ?></td>
                                                <td><?php echo $fila['DEPARTAMENTO']; ?></td>
                                                <td><?php echo $fila['MUNICIPIO']; ?></td>
                                                <td><?php echo $fila['BARRIO']; ?></td>
                                                <td><?php echo $fila['CODIGO_POSTAL']; ?></td>
                                                <td><button type="button" id="boton" name="Guardar" data-matricula="<?php echo $fila['MATRICULA_INMUEBLE'] ?>" data-id="<?php echo $fila['ID_INMUEBLE'] ?>"class="btn btn-primary">Seleccionar</button></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>Propietario</th>
                                            <th>Matricula</th>
                                            <th>Departamento</th>
                                            <th>Municipio</th>
                                            <th>Barrio</th>
                                            <th>Codigo postal</th>
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
<?php
$consulta=$conex->query("SELECT * FROM `cliente` WHERE ID_CLIENTE != '$id_pro';");
?>

<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        while ($fila = mysqli_fetch_assoc($consulta)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $fila['CEDULA'] ?></td>
                                                <td><?php echo $fila['NOMBRES'] ?></td>
                                                <td><?php echo $fila['APELLIDOS']; ?></td>
                                                <td><?php echo $fila['TELEFONO']; ?></td>
                                                <td><?php echo $fila['DIRECCION']; ?></td>
                                                <td><?php echo $fila['EMAIL']; ?></td>
                                                <td><button type="button" id="boton" name="Guardar" data-nombre="<?php echo $fila['NOMBRES'] ?>" data-apellido="<?php echo $fila['APELLIDOS'] ?>" data-id="<?php echo $fila['ID_CLIENTE'] ?>"class="btn btn-success">Seleccionar</button></td>
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
        var matricula = $(this).data("matricula");
        var id = $(this).data("id");
        $("#matricula").val(matricula);
        $("#id_inm").val(id);
        $("#exampleModal").modal("hide");
    });
</script>
<script>
    $(document).on("click", ".btn-success", function() {
        var nombre = $(this).data("nombre");
        var apellido = $(this).data("apellido");
        var id = $(this).data("id");
        var nombre_completo = nombre + " " + apellido;
        $("#codeudor").val(nombre_completo);
        $("#id_cod").val(id);
        $("#Modal").modal("hide");
    });
</script>
<?php
require_once "vistas/footer.php";
?>