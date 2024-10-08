<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "prueba_demo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el código de operación enviado por el formulario
if(isset($_POST['cod_operacion'])) {
    $cod_operacion = $_POST['cod_operacion'];

    // Consulta SQL para eliminar la fila
    $sql = "DELETE FROM cajaop WHERE cod_operacion = $cod_operacion";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página cajaint.php
        header("Location: cajaint.php");
        exit(); // Asegura que el script se detenga después de redirigir
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }
} else {
    echo "Error: No se proporcionó el código de operación";
}

// Cerrar conexión
$conn->close();
?>
