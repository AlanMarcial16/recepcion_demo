<?php

include("conexion.php");
$con=conectar();

$cod_reserva=$_POST['cod_reserva'];
$textras=$_POST['textras'];
$fecha=$_POST['fecha'];
$dia=$_POST['dia'];
$llegada=$_POST['llegada'];
$salida=$_POST['salida'];
$cliente=$_POST['cliente'];
$habitacion=$_POST['habitacion'];
$huespedes=$_POST['huespedes'];
$tarifa=$_POST['tarifa'];
$anticipo=$_POST['anticipo'];
$via=$_POST['via'];
$sextras=$_POST['sextras'];
$noches=$_POST['noches'];
$garantia=$_POST['garantia'];
$cextras=$_POST['cextras'];
$textras=$_POST['textras'];
$pago=$_POST['pago'];
$total=$_POST['total'];
$gtotal=$_POST['gtotal'];

$sql="UPDATE reservaciones SET fecha='$fecha', dia='$dia',llegada='$llegada',salida='$salida',cliente='$cliente',habitacion='$habitacion',huespedes='$huespedes',tarifa='$tarifa',anticipo='$anticipo',via='$via',sextras='0',noches='$noches',garantia='$garantia',cextras='0',textras='0',pago='$pago',total='0',gtotal='0' WHERE cod_reserva='$cod_reserva'";
$query=mysqli_query($con,$sql);

if($query){
    Header("Location: formcheck.php?id=$cod_reserva");
    
}else {
}

?>