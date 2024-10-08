<?php
include("conexion.php");
$con=conectar();

$pendiente1=$_POST['pendiente1'];
$pendiente2=$_POST['pendiente2'];
$pendiente3=$_POST['pendiente3'];

$sql = "TRUNCATE TABLE `entrec`";
$query= mysqli_query($con,$sql);

$sql="INSERT INTO entrec VALUES(NULL,'$pendiente1','$pendiente2','$pendiente3')";
$query= mysqli_query($con,$sql);

if($query){
    Header("Location: logout.php");
    
}else {
}
?>