<?php
include("conexion.php");
$con = conectar();

$cod_reserva = $_POST['cod_reserva'];

// Obtener valores de "sextras" y "cextras" de la base de datos
$sql_select = "SELECT anticipo, tarifa, noches, gtotal, total, textras FROM reservaciones WHERE cod_reserva='$cod_reserva'";
$query_select = mysqli_query($con, $sql_select);
$row_select = mysqli_fetch_assoc($query_select);
$tarifa_actual = $row_select['tarifa'];
$anticipo = $row_select['anticipo'];
$noches = $row_select['noches'];
$textras = $row_select['textras'];
$total = $row_select['total'];

$gtotal = $row_select['gtotal'];

$tarifa_nuevo = $_POST['tarifa'];

$total = ((-$tarifa_nuevo * $noches) + $anticipo);

$gtotal = ($total + $textras);

$sql_update = "UPDATE reservaciones SET tarifa='$tarifa_nuevo' WHERE cod_reserva='$cod_reserva'";
$query_update = mysqli_query($con, $sql_update);

$sql = "UPDATE reservaciones SET total='$total', gtotal='$gtotal' WHERE cod_reserva='$cod_reserva'";
$query_update = mysqli_query($con, $sql);


if ($query_update) {
    header("Location: insertarpos.php?id=$cod_reserva");
}
?>

