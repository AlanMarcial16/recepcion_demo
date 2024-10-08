<?php
include("conexion.php");
$con = conectar();

$cod_reserva = $_POST['cod_reserva'];
$fecha = $_POST['fecha'];
$textras = $_POST['textras'];
$dia = $_POST['dia'];
$llegada = $_POST['llegada'];
$cliente = $_POST['cliente'];
$salida = $_POST['salida'];
$huespedes = $_POST['huespedes'];
$via = $_POST['via'];
$noches = $_POST['noches'];
$comentarios = $_POST['comentarios'];
$total = $_POST['total'];
$status = $_POST['status'];
$gtotal = $_POST['gtotal'];

// Escapar los caracteres especiales en los comentarios
$comentarios = mysqli_real_escape_string($con, $comentarios);

////////////////////////////////////////////////////////////////////////////
$sql_select = "SELECT anticipo, tarifa, noches, gtotal, total, textras FROM reservaciones WHERE cod_reserva='$cod_reserva'";
$query_select = mysqli_query($con, $sql_select);
$row_select = mysqli_fetch_assoc($query_select);
$anticipo = $row_select['anticipo'];
$tarifa = $row_select['tarifa'];
$noches_actual = $row_select['noches'];
$textras = $row_select['textras'];
$total = $row_select['total'];

$gtotal = $row_select['gtotal'];

$noches_nuevo = $_POST['noches']; // Usamos directamente las noches nuevas

$total = ((-$tarifa * $noches_nuevo) + $anticipo);

$gtotal = ($total + $textras);

$sql = "UPDATE reservaciones SET noches='$noches_nuevo' WHERE cod_reserva='$cod_reserva'";
$query = mysqli_query($con, $sql);

$sql = "UPDATE reservaciones SET total='$total', gtotal='$gtotal' WHERE cod_reserva='$cod_reserva'";
$query = mysqli_query($con, $sql);

$sql = "UPDATE reservaciones SET fecha='$fecha', dia='$dia', llegada='$llegada', cliente='$cliente', salida='$salida', huespedes='$huespedes', via='$via', comentarios='$comentarios' WHERE cod_reserva='$cod_reserva'";
$query = mysqli_query($con, $sql);

if ($query) {
    header("Location: inicio.php");
    exit();
} else {
    echo "Error al actualizar los datos: " . mysqli_error($con);
}

mysqli_close($con);
?>
