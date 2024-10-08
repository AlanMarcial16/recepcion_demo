<?php
include("conexion.php");
$con = conectar();

$cod_reserva = $_POST['cod_reserva'];
$comentarios = $_POST['comentarios'];

$sql_update = "UPDATE reservaciones SET comentarios='$comentarios' WHERE cod_reserva='$cod_reserva'";
$query_update = mysqli_query($con, $sql_update);

if ($query_update) {
    header("Location: insertarpos.php?id=$cod_reserva");
}
?>
