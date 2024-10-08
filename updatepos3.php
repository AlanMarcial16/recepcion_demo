<?php
include("conexion.php");
$con = conectar();

$cod_reserva = $_POST['cod_reserva'];

// Obtener valores de "sextras" y "cextras" de la base de datos
$sql_select = "SELECT sextras, cextras, total, desc_servicios, habitacion, cliente FROM reservaciones WHERE cod_reserva='$cod_reserva'";
$query_select = mysqli_query($con, $sql_select);
$row_select = mysqli_fetch_assoc($query_select);
$cextras_actual = $row_select['cextras'];
$sextras = $row_select['sextras'];
$total = $row_select['total'];
$desc_servicios_anterior = $row_select['desc_servicios'];
$habitacion = $row_select['habitacion'];
$cliente = $row_select['cliente'];

$servicios_json = $_POST['desc_servicios'];
$servicios = json_decode($servicios_json, true);

// Ahora puedes usar $servicios para obtener las descripciones y valores.

$cextras_nuevo = $cextras_actual + $_POST['cextras'];

$textras = (-$cextras_nuevo - $sextras);

$gtotal = ($total + $textras);

// Agregar la nueva descripción a la cadena existente
$desc_servicios_nuevo = $desc_servicios_anterior . ', ' . $servicios_json;

$sql_update = "UPDATE reservaciones SET cextras='$cextras_nuevo', desc_servicios='$desc_servicios_nuevo' WHERE cod_reserva='$cod_reserva'";
$query_update = mysqli_query($con, $sql_update);

$sql = "UPDATE reservaciones SET textras='$textras', gtotal='$gtotal' WHERE cod_reserva='$cod_reserva'";
$query_update = mysqli_query($con, $sql);

if ($query_update) {
    // Insertar datos en la tabla tickets
    $datos_ticket = array(
        "nombre" => $servicios[0], // Obtener el nombre del servicio del JSON desc_servicios
        "cantidad" => 1,
        "preciou" => $_POST['cextras'],
        "mensaje" => "Consumos extras desde recepción"
    );

    // Convertir el array de datos del ticket a JSON
    $datos_json = json_encode(array($datos_ticket));

    // Cambiamos a la base de datos "pruebar"
    mysqli_select_db($con, "pruebar");

    // Insertar datos en la tabla tickets
    $sql_insert_ticket = "INSERT INTO tickets (datos_json, habitacion, comensal, fyh) VALUES ('$datos_json', '$habitacion', '$cliente', NOW())";
    $query_insert_ticket = mysqli_query($con, $sql_insert_ticket);

    if ($query_insert_ticket) {
        header("Location: insertarpos.php?id=$cod_reserva");
    } else {
        echo "Error al insertar datos en la tabla tickets: " . mysqli_error($con);
    }
} else {
    echo "Error al actualizar la reserva: " . mysqli_error($con);
}
?>
