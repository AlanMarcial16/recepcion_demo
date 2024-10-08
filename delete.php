<?php

include("conexion.php");
$con=conectar();

$cod_reserva=$_GET['id'];

$sql="DELETE FROM reservaciones  WHERE cod_reserva='$cod_reserva'";
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: inicio.php");
    }
?>
