<?php
include("conexion.php");
$con=conectar();

$fecha=$_POST['fecha'];
$textras=$_POST['textras'];
$dia=$_POST['dia'];
$llegada=$_POST['llegada'];
$salida=$_POST['salida'];
$cliente=$_POST['cliente'];
$email=$_POST['email'];
$telefono=$_POST['telefono'];
$habitacion=$_POST['habitacion'];
$huespedes=$_POST['huespedes'];
$edades=$_POST['edades'];
$tarifa=$_POST['tarifa'];
$anticipo=$_POST['anticipo'];
$via=$_POST['via'];
$sextras=$_POST['sextras'];
$noches=$_POST['noches'];
$garantia=$_POST['garantia'];
$cextras=$_POST['cextras'];
$comentarios=$_POST['comentarios'];
$pago=$_POST['pago'];
$total=$_POST['total'];
$status=$_POST['status'];
$gtotal=$_POST['gtotal'];

$total = ((-$tarifa * $noches) + $anticipo);

$gtotal = ($total + $textras);

$sql="INSERT INTO reservaciones VALUES(NULL,'$fecha','$dia','$llegada','$salida','$cliente','$email','$telefono','$habitacion','$huespedes','$edades','$tarifa','$anticipo','$via','$sextras','$noches','$cextras','$textras','$garantia','$comentarios','$pago','$total','$status','$gtotal')";
$query= mysqli_query($con,$sql);

if($query){
    Header("Location: reservagroup2.php");
    
}else {
}
?>