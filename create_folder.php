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
$id_pro = filter_input(INPUT_GET, 'id_pro', FILTER_VALIDATE_INT);
if ($id_pro === false) {
    die('Datos inválidos');
}
$USU = $_SESSION['ID_USUARIO'];
// Consulta para contar las filas con NULL en IDENTIFICADOR
$sql = "SELECT COUNT(*) FROM legajo WHERE IDENTIFICADOR IS NULL";

// Ejecutar consulta
$resultado = mysqli_query($conex, $sql);

// Obtener resultado
$legajos_libres = mysqli_fetch_array($resultado);

//consulta par obtener los datos de los legajos
$query = "SELECT * FROM legajo ORDER BY ID_LEGAJO DESC LIMIT 1;";
$result = mysqli_query($conex, $query);
$row = mysqli_fetch_assoc($result);
$anio_legajo = intval($row['ANO_LEGAJO']);
//obtenemos el año actual
$year = date("Y");

if ($anio_legajo == $year) {

    //verificar si no existen legajos con el identificador en NULL
    if ($legajos_libres[0] == 0) {

        $caja_legajo = intval($row['CAJA_LEGAJO']);
        $caja_legajo = $caja_legajo + 1;
        //actualiza el numero de caja
        $caja_legajo = strval($caja_legajo);
        $cajanueva = str_pad($caja_legajo, 3, "0", STR_PAD_LEFT);
        //verifica que el año sea el mismo que el de la ultima caja
        for ($i = 1; $i <= 15; $i++) {
            $num = strval($i);
            $num_str = str_pad($num, 3, "0", STR_PAD_LEFT);
            $query = "INSERT INTO `legajo`(`ANO_LEGAJO`, `CAJA_LEGAJO`, `NUMERO_LEGAJO`, `IDENTIFICADOR`, `USUARIO_CREACION_LEGAJO`) VALUES ('$year','$cajanueva','$num_str',NULL,'$USU')";
            mysqli_query($conex, $query);
        }
    }
} else {
    // echo "entra al libre";
    $new_identificator = "año pasado";
    $query = "UPDATE `legajo` SET `IDENTIFICADOR`= '$new_identificator' WHERE `ANO_LEGAJO`= '$anio_legajo' AND IDENTIFICADOR IS NULL";
    $sql = mysqli_query($conex, $query);
    $caja_legajo = strval("1");
    $cajanueva = str_pad($caja_legajo, 3, "0", STR_PAD_LEFT);
    for ($i = 1; $i <= 15; $i++) {
        $num = strval($i);
        $num_str = str_pad($num, 3, "0", STR_PAD_LEFT);
        $query = "INSERT INTO `legajo`(`ANO_LEGAJO`, `CAJA_LEGAJO`, `NUMERO_LEGAJO`, `IDENTIFICADOR`, `USUARIO_CREACION_LEGAJO`) VALUES ('$year','$cajanueva','$num_str',NULL,'$USU')";
        mysqli_query($conex, $query);
    }
}

//trarer los inmuebles que no esten registrados de un cliente
$inmuebles_no_re = $conex->query("SELECT * FROM inmueble i
WHERE PROPIETARIO = '$id_pro'
AND NOT EXISTS (SELECT 1 FROM legajo l WHERE l.INMUEBLE = i.ID_INMUEBLE);");

require_once "vistas/nav.php";

?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h1 class="m-0 font-weight-bold text-primary">Crear legajo</h1>
    </div>
    <div class="card-body">
        <form method="POST" class="user needs-validation" novalidate>
            <div class="row">
                <div class="form-group col-sm-12 col-md-6">
                    <input type="hidden" id="id_inm" name="id_inm">
                    <div class="row">
                        <label for="inmueble" class="col-sm-6">Inmueble:</label>
                        <h5 class="col-sm-6 d-flex justify-content-end m-0 font-weight-bold text-primary">
                            <a type="button" class="nav-link fa fa-user-plus" data-toggle="modal" data-target="#Modal"></a>
                        </h5>
                    </div>
                    <input type="text" class="form-control" id="inmueble" name="inmueble" minlength="3" maxlength="250" readonly disabled>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="num_legajo">Número de Legajo</label>
                    <select name="num_legajo" id="num_legajo" class="form-control" required>
                        <option value="">Selecciona una opción</option>
                        <?php
                        // veridicar si el cliente ya tiene legajo y que me lo traiga
                        $cliente_existe = $conex->query("SELECT * FROM legajo WHERE ID_LEGAJO = (SELECT MAX(ID_LEGAJO) FROM legajo WHERE legajo.CLIENTE = '$id_pro');");
                        $num_clientes = mysqli_num_rows($cliente_existe);
                        if ($num_clientes > 0) {
                            $row_clientes = $cliente_existe->fetch_array();
                        ?>
                            <option value="<?php echo $row_clientes['ANO_LEGAJO'] . "-" . $row_clientes['CAJA_LEGAJO'] . "-" . $row_clientes['NUMERO_LEGAJO'] ?>"> <?php echo $row_clientes['ANO_LEGAJO'] . "-" . $row_clientes['CAJA_LEGAJO'] . "-" . $row_clientes['NUMERO_LEGAJO'] ?></option>
                            <?php
                        } else {
                            $num_legajo = $conex->query("SELECT * FROM legajo WHERE IDENTIFICADOR IS NULL;");
                            $filas = mysqli_num_rows($num_legajo);
                            if ($filas > 0) {
                                while ($row = $num_legajo->fetch_array()) {
                            ?>
                                    <option value="<?php echo $row['ID_LEGAJO'] . "-" . $row['ANO_LEGAJO'] . "-" . $row['CAJA_LEGAJO'] . "-" . $row['NUMERO_LEGAJO'] ?>"><?php echo $row['ANO_LEGAJO'] . "-" . $row['CAJA_LEGAJO'] . "-" . $row['NUMERO_LEGAJO'] ?></option>
                        <?php
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="identificador">Identificador</label>
                    <?php
                    if ($num_clientes > 0) {
                        $identificado_bd = $row_clientes['IDENTIFICADOR'];
                        $siguiente_identidicador = letras_orden($identificado_bd);
                    } else {
                        $siguiente_identidicador = "A";
                    }
                    ?>
                    <input type="text" class="form-control" value="<?php echo $siguiente_identidicador; ?>" id="identificador" name="identificador" readonly disabled>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="semillero" value="PERTENCE A SEMILLERO DE PROPIETARIOS" id="semillero" required>
                        <label class="form-check-label" for="radio1">
                            PERTENCE A SEMILLERO DE PROPIETARIOS
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="semillero" value="NO PERTENCE A SEMILLERO DE PROPIETARIOS" id="semillero" required>
                        <label class="form-check-label" for="radio1">
                            NO PERTENCE A SEMILLERO DE PROPIETARIOS
                        </label>
                    </div>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="afianzadora">Afianzadora</label>
                    <select name="afianzadora" id="afianzadora" class="form-control" required>
                        <option value="">Selecciona una opción</option>
                        <option value="Fianza Ferrer">Fianza Ferrer</option>
                        <option value="Fianly">Fianly</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="estado">Estado</label>
                    <select name="estado" id="estado" class="form-control" required>
                        <option value="">Selecciona una opción</option>
                        <option value="activo">Activo</option>
                        <option value="inactivo">inactivo</option>
                    </select>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="prorroga">Prorroga</label>
                    <input type="text" class="form-control" name="prorroga" id="prorroga" required>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <input type="hidden" id="id_cod" name="id_cod">
                    <div class="row">
                        <label for="codeudor" class="col-sm-6">Codeudor</label>
                        <h5 class="col-sm-6 d-flex justify-content-end m-0 font-weight-bold text-primary">
                            <a type="button" class="nav-link fa fa-house-user" data-toggle="modal" data-target="#exampleModal"></a>
                        </h5>
                    </div>
                    <input type="text" class="form-control" id="codeudor" name="codeudor" readonly disabled>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_inicio_contrato">Fecha de Inicio del Contrato</label>
                    <input type="date" class="form-control" id="fecha_inicio_contrato" name="fecha_inicio_contrato" required>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_finalizacion_contrato">Fecha de finalización de contrato</label>
                    <input type="date" class="form-control" id="fecha_finalizacion_contrato" name="fecha_finalizacion_contrato" required>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="usuario_creacion_legajo">Usuario creacion legajo</label>
                    <input type="text" class="form-control" id="usuario_creacion_legajo" name="usuario_creacion_legajo" value="<?php echo $_SESSION['NOMBRE_USU']; ?>" required readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="usuario_modificacion_legajo">Usuario modificacion legajo</label>
                    <input type="text" class="form-control" id="usuario_modificacion_legajo" name="usuario_modificacion_legajo" value="<?php echo $_SESSION['NOMBRE_USU']; ?>" required readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="fecha_modificacion">Fecha de modificación</label>
                    <input type="date" class="form-control" id="fecha_modificacion" name="fecha_modificacion" value="<?php echo date('Y-m-d'); ?>" required readonly>
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <button type="submit" id="enviar" name="enviar" class="btn btn-info">Continuar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Seleccionar el inmueble</h1>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" class="user needs-validation" novalidate>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-primary">Inmuebles</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="Table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>MATRICULA INMUEBLE</th>
                                            <th>DEPARTAMENTO</th>
                                            <th>MUNICIPIO</th>
                                            <th>BARRIO</th>
                                            <th>CODIGO POSTAL</th>
                                            <th>DIRECCION</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Mostrar los resultados en la tabla
                                        while ($fila = mysqli_fetch_assoc($inmuebles_no_re)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $fila['MATRICULA_INMUEBLE']; ?></td>
                                                <td><?php echo $fila['DEPARTAMENTO']; ?></td>
                                                <td><?php echo $fila['MUNICIPIO']; ?></td>
                                                <td><?php echo $fila['BARRIO']; ?></td>
                                                <td><?php echo $fila['CODIGO_POSTAL']; ?></td>
                                                <td><?php echo $fila['DIRECCION']; ?></td>
                                                <td><button type="button" id="btn" name="Guardar" data-matricula="<?php echo $fila['MATRICULA_INMUEBLE'] ?>" data-id="<?php echo $fila['ID_INMUEBLE'] ?>" class="btn btn-primary">Seleccionar</button></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>MATRICULA_INMUEBLE</th>
                                            <th>DEPARTAMENTO</th>
                                            <th>MUNICIPIO</th>
                                            <th>BARRIO</th>
                                            <th>CODIGO_POSTAL</th>
                                            <th>DIRECCION</th>
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
$codeudor = $conex->query("SELECT * FROM cliente WHERE ID_CLIENTE != '$id_pro';");
?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Seleccionar el codeudor</h1>
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
                                        while ($filas = mysqli_fetch_assoc($codeudor)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $filas['CEDULA']; ?></td>
                                                <td><?php echo $filas['NOMBRES']; ?></td>
                                                <td><?php echo $filas['APELLIDOS']; ?></td>
                                                <td><?php echo $filas['TELEFONO']; ?></td>
                                                <td><?php echo $filas['DIRECCION']; ?></td>
                                                <td><?php echo $filas['EMAIL']; ?></td>
                                                <td><button type="button" id="boton" name="Guardar" data-nombre="<?php echo $filas['NOMBRES'] ?>" data-apellidos="<?php echo $filas['APELLIDOS'] ?>" data-id="<?php echo $filas['ID_CLIENTE'] ?>" class="btn btn-primary">Seleccionar</button></td>
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
    $(document).on("click", "#btn", function() {
        var matricula = $(this).data("matricula");
        var id = $(this).data("id");
        $("#inmueble").val(matricula);
        $("#id_inm").val(id);
        $("#Modal").modal("hide");
    });
</script>
<script>
    $(document).on("click", "#boton", function() {
        var nombres = $(this).data("nombre");
        var apellidos = $(this).data("apellidos");
        var id = $(this).data("id");
        var nombre_completo = nombres + " " + apellidos;
        $("#codeudor").val(nombre_completo);
        $("#id_cod").val(id);
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
$errores=array();
if (isset($_POST['enviar'])) {
    $id_inm = trim($_POST['id_inm']);
    $legajo = trim($_POST['num_legajo']);
    $semillero = trim($_POST['semillero']);
    $afianzadora=trim($_POST['afianzadora']);
    $estado = trim($_POST['estado']);
    $prorroga=trim($_POST['prorroga']);
    $codeudor = trim($_POST['id_cod']);
    $inicio_contrato = trim($_POST['fecha_inicio_contrato']);
    $final_contrato = trim($_POST['fecha_finalizacion_contrato']);
    $usuario_registro = $_SESSION['ID_USUARIO'];
    $usuario_modificacion = $_SESSION['ID_USUARIO'];
    $fecha_modificacion = date('Y-m-d H:i:s');
    $legajo_separado = explode("-", $legajo);

    $fecha1 = new DateTime("$inicio_contrato");
    $fecha2 = new DateTime("$final_contrato");

    // Calcular la diferencia con el método diff
    $diferencia = $fecha1->diff($fecha2);

    // Mostrar la diferencia en años, meses y días
$fecha_total=array();
    // Si los años son cero, no los mostramos
    if ($diferencia->y > 0) {
        $fecha_total[]= $diferencia->y . " años";
        // Si hay meses o días, añadimos una coma
        if ($diferencia->m > 0 || $diferencia->d > 0) {
            // $fecha_total[]=" ,";
        }
    }

    // Si los meses son cero, no los mostramos
    if ($diferencia->m > 0) {
        $fecha_total[]=$diferencia->m . " meses";
        // Si hay días, añadimos una coma
        if ($diferencia->d > 0) {
            // $fecha_total[]=" ,";
        }
    }

    // Si los días son cero, no los mostramos
    if ($diferencia->d > 0) {
        $fecha_total[]=$diferencia->d  . " días";
    }
    $fecha_subir=implode(",",$fecha_total);
if(!validar_numero($id_inm) || !validar_texto($semillero) || !validar_texto($afianzadora)  || !validar_texto($estado)  || !validar_numero($codeudor)){
    $errores[]="Error en el formato de datos que envias";
}
if($fecha1==$fecha2){
    $errores[]="Las fechas no pueden ser iguales";
}
if($fecha1>$fecha2){
    $errores[]="Las fecha de finalizacion de contrato no puede ser menor a la de inicio de contrato";
}
if(empty($errores)){
    if ($num_clientes > 0) {
        $año_legajo = $legajo_separado[0];
        $caja_legajo = $legajo_separado[1];
        $numero_legajo = $legajo_separado[2];
        $insertar = $conex->query("INSERT INTO `legajo`(`ANO_LEGAJO`, `CAJA_LEGAJO`, `NUMERO_LEGAJO`, `IDENTIFICADOR`,
    `ESTADO`, `INMUEBLE`, `CLIENTE`, `AFIANZADORA`, `CODEUDOR`, `SEMILLERO`, `FECHA_INICIO_CONTRATO`, `FECHA_FINALIZACION_CONTRATO`,
    `TIEMPO_CONTRATO`, `PRORROGA`, `FECHA_MODIFICACION`, `USUARIO_CREACION_LEGAJO`, `USUARIO_MODIFICACION_LEGAJO`) 
    VALUES ('$año_legajo','$caja_legajo','$numero_legajo','$siguiente_identidicador','$estado','$id_inm','$id_pro','$afianzadora','$codeudor',
    '$semillero','$inicio_contrato','$final_contrato','$fecha_subir','$prorroga','$fecha_modificacion','$usuario_registro','$usuario_modificacion')");
    if($insertar){
        echo "<script>
        Swal.fire({
          title: '¡Éxito!',
          text: 'La operación se realizó correctamente.',
          icon: 'success',
          confirmButtonText: 'Continuar'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = 'crear_legajo.php';
          }
        })
        </script>";
    }else{
        $errores[]="Error al guardar legajo ". mysqli_error($conex);
    }
    } else {
        $id_legajo = $legajo_separado[0];
        $año_legajo = $legajo_separado[1];
        $caja_legajo = $legajo_separado[2];
        $numero_legajo = $legajo_separado[3];
        $insertar = $conex->query("UPDATE `legajo` SET `IDENTIFICADOR`='$siguiente_identidicador',`ESTADO`='$estado',`INMUEBLE`='$id_inm',`CLIENTE`='$id_pro',
        `AFIANZADORA`='$afianzadora',`CODEUDOR`='$codeudor',`SEMILLERO`='$semillero',`FECHA_INICIO_CONTRATO`='$inicio_contrato',
        `FECHA_FINALIZACION_CONTRATO`='$final_contrato',`TIEMPO_CONTRATO`='$fecha_subir',`PRORROGA`='$prorroga',
        `FECHA_MODIFICACION`='$fecha_modificacion',`USUARIO_CREACION_LEGAJO`='$usuario_registro',`USUARIO_MODIFICACION_LEGAJO`='$usuario_modificacion' WHERE ID_LEGAJO='$id_legajo';");
        if($insertar){
            echo "<script>
            Swal.fire({
              title: '¡Éxito!',
              text: 'La operación se realizó correctamente.',
              icon: 'success',
              confirmButtonText: 'Continuar'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = 'crear_legajo.php';
              }
            })
            </script>";
        }else{
            $errores[]="Error al guardar legajo ". mysqli_error($conex);
        }
    }
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