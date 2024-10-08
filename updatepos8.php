<?php
// Incluimos el archivo de conexión
include("conexion.php");
// Realizamos la conexión a la base de datos
$con = conectar();

// Obtenemos los valores provenientes del formulario
$cod_reserva = $_POST['cod_reserva'];
$fecha = $_POST['fecha'];
$salida = $_POST['salida'];
$noches_nuevo = $_POST['noches'];
$tarifa_nuevo = $_POST['tarifa'];
$anticipo_nuevo = $_POST['anticipo'];
$textras = $_POST['textras']; // No estoy seguro de dónde obtienes este valor

// Consulta para obtener los valores anteriores de la reserva
$sql_antiguos = "SELECT tarifa, noches, anticipo, textras FROM reservaciones WHERE cod_reserva='$cod_reserva'";
$resultado_antiguos = mysqli_query($con, $sql_antiguos);
$row_antiguos = mysqli_fetch_assoc($resultado_antiguos);

// Calculamos los totales anteriores
$total_anterior = ((-$row_antiguos['tarifa'] * $row_antiguos['noches']) + $row_antiguos['anticipo']);
$gtotal_anterior = ($total_anterior + $row_antiguos['textras']);

// Calculamos los nuevos totales
$total_nuevo = ((-$tarifa_nuevo * $noches_nuevo) + $anticipo_nuevo);
$gtotal_nuevo = ($total_nuevo + $textras);

// Calculamos la diferencia entre los totales anteriores y los nuevos
$total_d = $total_anterior - $total_nuevo;
$gtotal_d = $gtotal_anterior - $gtotal_nuevo;

// Ajustamos los totales para que sean negativos
$total_d = -$total_d;
$gtotal_d = -$gtotal_d;

// Actualizamos los valores en la base de datos
$sql_update = "UPDATE reservaciones SET noches='$noches_nuevo', fecha='$fecha', salida='$salida' WHERE cod_reserva='$cod_reserva'";
$query_update = mysqli_query($con, $sql_update);

$sql_update_totals = "UPDATE reservaciones SET total=total + '$total_d', gtotal=gtotal + '$gtotal_d' WHERE cod_reserva='$cod_reserva'";
$query_update_totals = mysqli_query($con, $sql_update_totals);

if ($query_update && $query_update_totals) {
    // Redireccionamos a alguna página de éxito
    header("Location: insertarpos.php?id=$cod_reserva");
} else {
    // Manejo de errores, redireccionamos a alguna página de error
    header("Location: error.php");
}

?>
