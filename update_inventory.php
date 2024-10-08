<?php
header('Content-Type: application/json');

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $elementoId = $_POST['elemento'];
    $cantidadADescontar = $_POST['cantidad'];

    if (!empty($elementoId) && !empty($cantidadADescontar) && is_numeric($cantidadADescontar) && $cantidadADescontar > 0) {
        $conn = new mysqli("localhost", "root", "", "prueba_demor");

        if ($conn->connect_error) {
            $response["status"] = "error";
            $response["message"] = "Conexión fallida: " . $conn->connect_error;
            echo json_encode($response);
            exit();
        }

        $sql = "SELECT Cantidad FROM inventario_cf WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            $response["status"] = "error";
            $response["message"] = "Error preparando statement: " . $conn->error;
            echo json_encode($response);
            exit();
        }
        $stmt->bind_param("i", $elementoId);
        if ($stmt->execute() === false) {
            $response["status"] = "error";
            $response["message"] = "Error ejecutando statement: " . $stmt->error;
            echo json_encode($response);
            exit();
        }
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $cantidadDisponible = $row['Cantidad'];

            if ($cantidadADescontar <= $cantidadDisponible) {
                $nuevaCantidad = $cantidadDisponible - $cantidadADescontar;
                $updateSql = "UPDATE inventario_cf SET Cantidad = ? WHERE ID = ?";
                $updateStmt = $conn->prepare($updateSql);
                if ($updateStmt === false) {
                    $response["status"] = "error";
                    $response["message"] = "Error preparando statement de actualización: " . $conn->error;
                    echo json_encode($response);
                    exit();
                }
                $updateStmt->bind_param("di", $nuevaCantidad, $elementoId);
                if ($updateStmt->execute() === false) {
                    $response["status"] = "error";
                    $response["message"] = "Error ejecutando statement de actualización: " . $updateStmt->error;
                    echo json_encode($response);
                    exit();
                }

                $response["status"] = "success";
                $response["message"] = "Inventario actualizado correctamente. Nueva cantidad: " . $nuevaCantidad;
                $updateStmt->close();
            } else {
                $response["status"] = "error";
                $response["message"] = "Error: la cantidad a descontar es mayor que la cantidad disponible.";
            }
        } else {
            $response["status"] = "error";
            $response["message"] = "Error: el elemento no se encontró en el inventario.";
        }

        $stmt->close();
        $conn->close();
    } else {
        $response["status"] = "error";
        $response["message"] = "Error: datos inválidos.";
    }
} else {
    $response["status"] = "error";
    $response["message"] = "Método de solicitud no permitido.";
}

echo json_encode($response);
?>
