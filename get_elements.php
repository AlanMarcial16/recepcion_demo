<?php
if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "prueba_demor");

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener elementos según la categoría
    $sql = "SELECT ID, Nombre, Unidad, Cantidad FROM inventario_cf WHERE Categoria = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparando statement: " . $conn->error);
    }
    $stmt->bind_param("s", $categoria);
    if ($stmt->execute() === false) {
        die("Error ejecutando statement: " . $stmt->error);
    }
    $result = $stmt->get_result();

    $elements = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $elements[] = $row;
        }
    }

    echo json_encode($elements);

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(array("error" => "No se recibió la categoría"));
}
?>
