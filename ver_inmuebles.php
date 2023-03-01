<?php
// Conexión a la base de datos
include('php/conexion.php');
include('php/funciones.php');
session_start();
if (!isset($_SESSION['TIPO_USUARIO'])) {
    header('Location: login.php');
    exit();
}

// Consulta SQL para obtener todos los clientes
$resultado = $conex->query("SELECT NOMBRES,APELLIDOS, inmueble.* FROM cliente INNER JOIN inmueble ON cliente.ID_CLIENTE = inmueble.PROPIETARIO;");
require_once "vistas/nav.php";
?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Inmuebles</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="Table" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Propietario</th>
                        <th>Matricula del inmueble</th>
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
                            <td><a href="editar_inmueble.php?id=<?php echo $fila['ID_INMUEBLE']; ?>"><?php echo $fila['NOMBRES']." ". $fila['APELLIDOS']; ?></a></td>
                            <td><?php echo $fila['MATRICULA_INMUEBLE']; ?></td>
                            <td><?php echo $fila['DEPARTAMENTO']; ?></td>
                            <td><?php echo $fila['MUNICIPIO']; ?></td>
                            <td><?php echo $fila['BARRIO']; ?></td>
                            <td><?php echo $fila['CODIGO_POSTAL']; ?></td>
                            <td><a><?php echo "Descargar"; ?></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Propietario</th>
                        <th>Matricula del inmueble</th>
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
<?php require_once "vistas/footer.php" ?>