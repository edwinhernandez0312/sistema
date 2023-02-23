<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST["cedula"];
    $nombres = $_POST["nombres"];

    // Aquí puedes procesar los datos recibidos

    echo "Datos recibidos: cedula=" . $cedula . ", nombre=" . $nombres;
} else {
    // Manejar caso en que no se haya hecho una petición POST
    echo "No se recibieron datos";
}
