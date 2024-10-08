<?php
include("config2.php");

// Eliminar todos los eventos existentes en la tabla "eventoscalendar"
$sqlEliminarEventos = "DELETE FROM eventoscalendar";
$resultadoEliminarEventos = mysqli_query($con, $sqlEliminarEventos);

if (!$resultadoEliminarEventos) {
    die("Error al eliminar eventos existentes: " . mysqli_error($con));
}

// Obtener información de la tabla "reservaciones"
$sqlReservaciones = "SELECT * FROM reservaciones";
$resultadoReservaciones = mysqli_query($con, $sqlReservaciones);

if (!$resultadoReservaciones) {
    die("Error al consultar la tabla reservaciones: " . mysqli_error($con));
}

// Definir colores según el tipo de habitación
$colores = [
    'Estándar' => '#13e6ed',
    'Superior' => '#8BC34A',
    'Superior_Deluxe' => '#edde0c',
    'Deluxe_con_vista_a_los_volcanes' => '#860bba',
    // Agrega más tipos de habitación aquí según sea necesario
];

// Iterar a través de las reservaciones y agregar eventos a la tabla "eventoscalendar"
while ($row = mysqli_fetch_assoc($resultadoReservaciones)) {
    $habitacion = $row['habitacion'];
    $color_evento = isset($colores[$habitacion]) ? $colores[$habitacion] : '#ed1330';

    // Insertar evento en la tabla "eventoscalendar"
    $sqlEvento = "INSERT INTO eventoscalendar (evento, color_evento, fecha_inicio, fecha_fin) VALUES (
        '$habitacion',
        '$color_evento',
        '{$row['fecha']}',
        '{$row['salida']}'
    )";

    $resultadoEvento = mysqli_query($con, $sqlEvento);

    if (!$resultadoEvento) {
        die("Error al insertar evento en la tabla eventoscalendar: " . mysqli_error($con));
    }
}

// Redireccionar de regreso a la página principal
Header("Location: ocupacion.php");
?>
