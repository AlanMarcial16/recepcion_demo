<?php
// obtenerHabitaciones.php

// Conexión a la base de datos (asegúrate de configurar tus credenciales correctamente)
$conn = new mysqli("localhost", "root", "", "prueba");

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtiene la fecha seleccionada del formulario
$fechaSeleccionada = $_POST['fecha'];

// Consulta SQL para obtener las habitaciones reservadas para la fecha seleccionada
$sql = "SELECT habitacion FROM reservaciones WHERE fecha = '$fechaSeleccionada'";
$result = $conn->query($sql);

// Almacena las habitaciones ocupadas en un array
$habitacionesOcupadas = array();

// Verifica si hay resultados en la consulta
if ($result->num_rows > 0) {
    // Recorre los resultados y agrega las habitaciones ocupadas al array
    while ($row = $result->fetch_assoc()) {
        $habitacionesOcupadas[] = $row['habitacion'];
    }
}

// Define todas las habitaciones posibles con sus categorías
$habitacionesTotales = array(
    "Estándar" => array("Cuna de moisés", "Dalia"),
    "Superior" => array("Bugambilia", "Tulipan", "Jazmín", "Violeta"),
    "Superior Deluxe" => array("Lily", "Girasol"),
    "Deluxe con vista a los volcanes" => array("Margarita", "Nochebuena")
);

// Obtiene las habitaciones disponibles restando las ocupadas de las totales
$habitacionesDisponibles = array();

foreach ($habitacionesTotales as $categoria => $habitacionesCategoria) {
    $habitacionesDisponibles[$categoria] = count(array_diff($habitacionesCategoria, $habitacionesOcupadas));
}

// Convierte el array de habitaciones disponibles a formato JSON
$habitacionesJSON = json_encode($habitacionesDisponibles);

// Devuelve la lista de habitaciones disponibles como respuesta
echo $habitacionesJSON;

// Cierra la conexión a la base de datos
$conn->close();
?>
