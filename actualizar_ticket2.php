<?php
// Verificar si se ha enviado el ID del ticket en la URL y si se recibieron los datos del formulario
if(isset($_GET['id']) && isset($_POST['cliente']) && isset($_POST['habitacion'])) {
    // Conexión a la base de datos 'prueba_demor' (tickets)
    $servername_tickets = "localhost";
    $username_tickets = "root";
    $password_tickets = "";
    $database_tickets = "prueba_demor";
    $conn_tickets = mysqli_connect($servername_tickets, $username_tickets, $password_tickets, $database_tickets);

    if (!$conn_tickets) {
        die("Conexión fallida a la base de datos 'prueba_demor': " . mysqli_connect_error());
    }

    // Obtener el ID del ticket y los datos del formulario
    $ticket_id = $_GET['id'];
    $cliente_habitacion = explode("||", $_POST['cliente']);
    $cliente = $cliente_habitacion[0]; // Nombre del comensal
    $habitacion = $_POST['habitacion'];

    // Actualizar la tabla tickets con los nuevos valores utilizando el ID del ticket
    $sql_update = "UPDATE prueba_demor.tickets SET habitacion='$habitacion', comensal='$cliente' WHERE id=$ticket_id";
    if (mysqli_query($conn_tickets, $sql_update)) {
        // Redirigir a inicio.php
        header("Location: inicio.php");
        exit(); // Asegurar que el script se detenga después de la redirección
    } else {
        echo "Error al actualizar el ticket: " . mysqli_error($conn_tickets);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn_tickets);
} else {
    echo "No se proporcionaron todos los datos necesarios.";
}
?>
