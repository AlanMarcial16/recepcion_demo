<?php
include("conexion.php");
$con=conectar();

$nombre=$_POST['nombre'];
$apellidos=$_POST['apellidos'];
$fecha_nac=$_POST['fecha_nac'];
$sexo=$_POST['sexo'];
$email=$_POST['email'];
$telefono=$_POST['telefono'];
$rfc=$_POST['rfc'];
$procedencia=$_POST['procedencia'];
$nivel=$_POST['nivel'];

$sql="INSERT INTO clientes_frecuentes VALUES(NULL,'$nombre','$apellidos','$fecha_nac','$sexo','$email','$telefono','$rfc','$procedencia','$nivel')";
$query= mysqli_query($con,$sql);

if($query){
    Header("Location: clientefrec.php");
    
}else {
}
?>