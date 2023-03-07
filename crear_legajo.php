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
require_once "vistas/nav.php";
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Crear legajo</h6>
    </div>
    <div class="card-body">
        <form method="POST" class="user needs-validation" novalidate action="crear_legajo2.php">
            <div class="row">
                <div class="form-group col-sm-12 col-md-6">
                    <label for="num_legajo">Numero de legajo:</label>
                    <input type="text" class="form-control" id="num_legajo" name="num_legajo" minlength="5" maxlength="250" required title="Dijite la matricula del inmueble">
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control" title="Estrato del inmueble" required>
                        <option value="">Selecciona una opción</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <input type="hidden" id="id_pro" name="id_pro">
                    <div class="row">
                        <label for="cedula" class="col-sm-6">Propietario:</label>
                        <h5 class="col-sm-6 d-flex justify-content-end m-0 font-weight-bold text-primary">
                            <a type="button" class="nav-link fa fa-user-plus" data-toggle="modal" data-target="#exampleModal"></a>
                        </h5>
                    </div>
                    <input type="text" class="form-control" id="propietario" name="propietario" minlength="3" maxlength="250" required pattern="[a-zA-Z\sñáéíóúÁÉÍÓÚÑ]+" title="Dijite el propietario" readonly disabled>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <button type="submit" id="enviar" name="enviar" class="btn btn-info">Continuar</button>
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
<?php
require_once "vistas/footer.php";
?>