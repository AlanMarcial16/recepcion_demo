<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pruebar";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Eliminar el ticket con el ID proporcionado
    $sql_delete = "DELETE FROM tickets WHERE id = '$id'";
    $query_delete = mysqli_query($conn, $sql_delete);
    
    if ($query_delete) {
        // Redirigir al usuario a la página anterior
        if (isset($_SERVER['HTTP_REFERER'])) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            echo "No se puede redirigir a la página anterior.";
        }
        exit;
    } else {
        echo "Error al eliminar el ticket: " . mysqli_error($conn);
    }
} else {
    echo "ID de ticket no especificado.";
}

mysqli_close($conn);
?>
