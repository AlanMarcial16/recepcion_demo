<?php

include("conexion.php");
$con=conectar();

$cod_factura=$_POST['cod_factura'];
$salida=$_POST['salida'];
$cliente=$_POST['cliente'];
$rfc=$_POST['rfc'];
$lugar=$_POST['lugar'];
$descrip=$_POST['descrip'];
$email=$_POST['email'];
$telefono=$_POST['telefono'];
$pago=$_POST['pago'];
$total=$_POST['total'];


$sql="INSERT INTO facturas VALUES(NULL,'$salida','$cliente','$rfc','$lugar','$descrip','$email','$telefono','$pago','$total')";
$query= mysqli_query($con,$sql);

    if($query){
        Header("Location: inicio.php");
    }

?>


