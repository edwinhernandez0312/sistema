<?php
// Conexión a la base de datos
include('php/conexion.php');
include('php/funciones.php');
session_start();

// Consulta SQL para obtener todos los clientes
$resultado = $conex->query("SELECT * FROM cliente");
require_once "vistas/nav.php";
?>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // Mostrar los resultados en la tabla
                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                    ?>
                                        <tr>
                                        <td><a href="editar_cliente.php?id=<?php echo $fila['ID_CLIENTE']; ?>"><?php echo $fila['CEDULA']; ?></a></td>
                                            <td><?php echo $fila['NOMBRES']; ?></td>
                                            <td><?php echo $fila['APELLIDOS']; ?></td>
                                            <td><?php echo $fila['TELEFONO']; ?></td>
                                            <td><?php echo $fila['DIRECCION']; ?></td>
                                            <td><?php echo $fila['EMAIL']; ?></td>
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
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
<?php require_once "vistas/footer.php" ?>