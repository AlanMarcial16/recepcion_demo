<?php

// Verificamos que se haya proporcionado el parámetro 'habitacion'
if (isset($_GET['habitacion'])) {
    // Obtenemos el nombre de la habitación desde el parámetro
    $habitacion = $_GET['habitacion'];

    // Realizamos la conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "prueba_demo";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
    }

    // Actualizamos el estado de la habitación a 'disponible'
    $sql = "UPDATE habitaciones SET estado = 'disponible' WHERE nombre = '$habitacion'";
    if ($conn->query($sql) === TRUE) {
        echo "El estado de la habitación $habitacion se ha cambiado a 'disponible' correctamente.";

        // Redirige a habitaciones.php después de cambiar el estado
        header("Location: habitaciones.php");
        exit();
    } else {
        echo "Error al cambiar el estado de la habitación: " . $conn->error;
    }

    $conn->close();
} else {
    // Si no se proporciona el parámetro 'habitacion', mostramos un mensaje de error
    echo "Error: No se proporcionó el nombre de la habitación.";
}

?>
