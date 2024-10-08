<?php
include("conexion.php");
$con=conectar();

$fecha=$_POST['fecha'];
$habitacion=$_POST['habitacion'];
$area=$_POST['area'];
$descripcion=$_POST['descripcion'];

$sql="INSERT INTO incidencias VALUES(NULL,'$fecha','$habitacion','$area','$descripcion')";
$query= mysqli_query($con,$sql);

if($query){
    Header("Location: incidencias.php");
    
}else {
}
?>