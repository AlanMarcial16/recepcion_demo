<?php
include("conexion.php");
$con = conectar();

$cod_reserva = $_POST['cod_reserva'];

// Obtener valores de "sextras" y "cextras" de la base de datos
$sql_select = "SELECT anticipo, tarifa, noches, gtotal, total, textras FROM reservaciones WHERE cod_reserva='$cod_reserva'";
$query_select = mysqli_query($con, $sql_select);
$row_select = mysqli_fetch_assoc($query_select);
$total_actual = $row_select['total'];
$anticipo = $row_select['anticipo'];
$noches = $row_select['noches'];
$textras = $row_select['textras'];
$tarifa = $row_select['tarifa'];

$gtotal = $row_select['gtotal'];

$total_nuevo = $_POST['total'];

$total = (-$total_nuevo);

$gtotal = ($total + $textras);

$sql_update = "UPDATE reservaciones SET total='$total_nuevo' WHERE cod_reserva='$cod_reserva'";
$query_update = mysqli_query($con, $sql_update);

$sql = "UPDATE reservaciones SET total='$total', gtotal='$gtotal' WHERE cod_reserva='$cod_reserva'";
$query_update = mysqli_query($con, $sql);


if ($query_update) {
    header("Location: insertarpos.php?id=$cod_reserva");
}
?>

