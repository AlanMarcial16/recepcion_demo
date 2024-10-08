<?php
// Incluir conexión y definir $cod_reserva
include("conexion.php");
$con = conectar();
$cod_reserva = $_POST['cod_reserva'];

// Obtener el ID de la habitación seleccionada
$habitacion_nombre = $_POST['habitacion'];
$queryHabitacion = "SELECT habitacion_id FROM habitaciones WHERE nombre = '$habitacion_nombre'";
$resultHabitacion = mysqli_query($con, $queryHabitacion);
$rowHabitacion = mysqli_fetch_assoc($resultHabitacion);
$habitacion_id = $rowHabitacion['habitacion_id'];

// Actualizar el nombre de la habitación en la reserva
$sql = "UPDATE reservaciones SET via='$via', habitacion='$habitacion_nombre', tarifa='$tarifa' WHERE cod_reserva='$cod_reserva'";
$query = mysqli_query($con, $sql);

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

$sql_update = "UPDATE reservaciones SET tarifa='$tarifa_nuevo', total='$total', gtotal='$gtotal' WHERE cod_reserva='$cod_reserva'";
$query_update = mysqli_query($con, $sql_update);

if ($query && $query_update) {
    // Realizar la redirección a "cobrar.php" después de redirigir a "inicio.php"
    header("Location: insertarpos.php?id=$cod_reserva");
    exit(); // Asegurarse de que el script se detenga después de la redirección
}
?>
