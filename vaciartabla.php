<?php

include("conexion.php");
$con=conectar();

$sql = "TRUNCATE TABLE `crm`";
$query= mysqli_query($con,$sql);

$sql = "TRUNCATE TABLE `cotizaciones`";
$query= mysqli_query($con,$sql);

    if($query){
        Header("Location: cotizacion.php");
    }

?>