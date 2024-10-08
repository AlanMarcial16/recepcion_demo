<?php

include("conexion.php");
$con = conectar();

$cod_reserva = $_POST['cod_reserva'];
$fecha = $_POST['fecha'];
$dia = $_POST['dia'];
$llegada = $_POST['llegada'];
$salida = $_POST['salida'];
$cliente = $_POST['cliente'];
$habitacion = $_POST['habitacion'];
$huespedes = $_POST['huespedes'];
$tarifa = $_POST['tarifa'];
$anticipo = $_POST['anticipo'];
$via = $_POST['via'];
$sextras = $_POST['sextras'];
$noches = $_POST['noches'];
$cextras = $_POST['cextras'];
$comentarios = $_POST['comentarios'];
$total = $_POST['total'];

$total = (((-$tarifa * $noches) - $cextras) + $anticipo);

$sql = "INSERT INTO cancelaciones VALUES(NULL,'$fecha','$dia','$llegada','$salida','$cliente','$habitacion','$huespedes','$tarifa','$anticipo','$via','$sextras','$noches','$cextras','$comentarios','$total')";
$query = mysqli_query($con, $sql);

$sql = "DELETE FROM reservaciones WHERE cod_reserva='$cod_reserva'";
$query = mysqli_query($con, $sql);

if ($query) {
    // Obtener el ID de la habitación seleccionada
    $queryHabitacion = "SELECT habitacion_id FROM habitaciones WHERE nombre = '$habitacion'";
    $resultHabitacion = mysqli_query($con, $queryHabitacion);
    $rowHabitacion = mysqli_fetch_assoc($resultHabitacion);
    $habitacion_id = $rowHabitacion['habitacion_id'];

    // Actualizar el estado de la habitación a "disponible"
    $queryHabitacion = "UPDATE habitaciones SET estado = 'disponible' WHERE habitacion_id = $habitacion_id";
    mysqli_query($con, $queryHabitacion);

    Header("Location: inicio.php");
}

?>
