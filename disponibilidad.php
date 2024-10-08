<?php
function obtener_habitaciones_disponibles() {
    // Lista de todas las habitaciones
    $habitaciones_todas = array(
        "CunadeMoises",
        "Dalia",
        "Bugambilia",
        "Tulipan",
        "Jazmín",
        "Violeta",
        "Lily",
        "Girasol",
        "Margarita",
        "NocheBuena"
    );

    // Conexión a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'prueba');

    // Verificar la conexión
    if ($conexion->connect_error) {
        die('Error de conexión a la base de datos: ' . $conexion->connect_error);
    }

    // Obtener la fecha actual
    $fecha_actual = date('Y-m-d');

    // Consulta a la base de datos
    $sql = "SELECT DISTINCT habitacion FROM reservaciones WHERE salida >= '$fecha_actual'";
    $result = $conexion->query($sql);

    // Obtener habitaciones ocupadas
    $habitaciones_ocupadas = [];
    while ($row = $result->fetch_assoc()) {
        $habitaciones_ocupadas[] = $row['habitacion'];
    }

    // Cerrar conexión a la base de datos
    $conexion->close();

    // Obtener habitaciones disponibles
    $habitaciones_disponibles = array_diff($habitaciones_todas, $habitaciones_ocupadas);

    return array(
        'disponibles' => $habitaciones_disponibles,
        'ocupadas' => $habitaciones_ocupadas
    );
}

// Uso de la función
$habitaciones = obtener_habitaciones_disponibles();

echo "<h1>Habitaciones Disponibles:</h1>\n";
foreach ($habitaciones['disponibles'] as $habitacion) {
    echo "<p>" . $habitacion . "</p>\n";
}

echo "<h1>Habitaciones Ocupadas:</h1>\n";
foreach ($habitaciones['ocupadas'] as $habitacion) {
    echo "<p>" . $habitacion . "</p>\n";
}
?>
