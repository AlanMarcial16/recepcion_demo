<?php

include("conexion.php");
$con=conectar();

$cod_reserva=$_POST['cod_reserva'];
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
$pago=$_POST['pago'];
$total=$_POST['total'];

$total = ((($tarifa * $noches) + ($cextras + $sextras)) - $anticipo);

$sql="UPDATE reservaciones SET fecha='$fecha', dia='$dia',llegada='$llegada',salida='$salida',cliente='$cliente',habitacion='$habitacion',huespedes='$huespedes',tarifa='$tarifa',anticipo='$anticipo',via='$via',sextras='$sextras',noches='$noches',garantia='$garantia',cextras='$cextras',pago='$pago',total='$total' WHERE cod_reserva='$cod_reserva'";
$query=mysqli_query($con,$sql);


    if($query){
        Header('Location: inicio.php');
        
    }
?>