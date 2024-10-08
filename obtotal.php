<?php

include("conexion.php");
$con=conectar();

$sql = "SELECT SUM(importeentrada) FROM cajaop;";
$query= mysqli_query($con,$sql);
$arr = mysqli_fetch_array($query,MYSQLI_NUM);
$espacio = " $";
$totale = implode(" ",$arr);

$sql2 = "SELECT SUM(importesalida) FROM cajaop;";
$query2= mysqli_query($con,$sql2);
$arr2 = mysqli_fetch_array($query2,MYSQLI_NUM);
$espacio2 = " $";
$totals = implode(" ",$arr2);

$gtotal = ($totale - $totals);

$sql="UPDATE cajach SET totale='$totale'";
$query=mysqli_query($con,$sql);

$sql="UPDATE cajach SET totals='$totals'";
$query=mysqli_query($con,$sql);

$sql="UPDATE cajach SET gtotal='$gtotal'";
$query=mysqli_query($con,$sql);

if($query){
    Header("Location: cajaint.php");
    
}else {
}
   

?>

