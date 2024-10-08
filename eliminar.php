<?php
// Conexión a la base de datos
$conn = mysqli_connect("localhost", "root", "", "prueba");

// Verifica si se recibió el ID de la fila a eliminar
if (isset($_POST['cod_operacion'])) {
    // Escapa el ID para evitar inyección de SQL
    $cod_operacion = mysqli_real_escape_string($conn, $_POST['cod_operacion']);

    // Query para eliminar la fila
    $sql = "DELETE FROM cajaop WHERE cod_operacion = $cod_operacion";

    if (mysqli_query($conn, $sql)) {
        // Éxito al eliminar la fila
        http_response_code(200);
    } else {
        // Error al eliminar la fila
        http_response_code(500);
    }
} else {
    // No se recibió el ID de la fila a eliminar
    http_response_code(400);
}

// Cierra la conexión a la base de datos
mysqli_close($conn);
?>
