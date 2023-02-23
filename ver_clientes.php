<?php
// Conexión a la base de datos
include('php/conexion.php');
include('php/funciones.php');
session_start();

// Consulta SQL para obtener todos los clientes
$resultado =$conex->query("SELECT * FROM cliente");
require_once "vistas/nav.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ver clientes</title>
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Clientes</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Lista de clientes</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
</body>
</html>
    <?php require_once "vistas/footer.php"?>