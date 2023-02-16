<?php
$conex=new mysqli("localhost","root","","inmobiliaria");
if(mysqli_connect_errno()){
    echo "Conexion Fallida:" ,mysqli_connect_error();
    exit();
}
?>