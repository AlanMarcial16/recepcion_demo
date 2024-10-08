<?php
include("conexion.php");
$con = conectar();

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$preciou = $_POST['preciou'];
$total_venta = $_POST['total_venta'];

// Insertar datos en la tabla cajaop con la fecha y hora actual
$sql_insert_cajaop = "INSERT INTO cajaop (cod_operacion, tipodeoperacion, descripcion, tipocomprobante, importeentrada, importesalida, fecha_hora_registro) 
                      VALUES (NULL, 'Entrada', 'Venta Directa', 'Ticket', '$total_venta', '', NOW())";
$query_insert_cajaop = mysqli_query($con, $sql_insert_cajaop);

if ($query_insert_cajaop) {
    // Obtener los datos de la tabla ventadirecta para la inserción en tickets
    $sql_select = "SELECT nombre, cantidad, preciou FROM ventadirecta";
    $result_select = mysqli_query($con, $sql_select);

    if (mysqli_num_rows($result_select) > 0) {
        $data = array();

        while ($row = mysqli_fetch_assoc($result_select)) {
            $data[] = $row;
        }

        // Convierte los datos a JSON
        $json_data = json_encode($data, JSON_UNESCAPED_UNICODE);

        // Añade el mensaje al JSON
        $json_data_with_message = json_decode($json_data, true);
        foreach ($json_data_with_message as &$item) {
            $item["mensaje"] = "Mandado a la habitación";
        }
        $json_data_with_message = json_encode($json_data_with_message, JSON_UNESCAPED_UNICODE);

        // Conexión a la base de datos prueb
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "pruebar";

        $conn1 = mysqli_connect($servername, $username, $password, $database);

        if (!$conn1) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        // Inserta los datos en la tabla "tickets" junto con la habitación, comensal y la fecha/hora actual
        $habitacion = 'VD';
        $comensal = 'VD';
        $insert_query = "INSERT INTO tickets (datos_json, habitacion, comensal, fyh) 
                         VALUES ('$json_data_with_message', '$habitacion', '$comensal', NOW())";

        if (mysqli_query($conn1, $insert_query)) {
            // Si la inserción en tickets es exitosa, eliminar los datos de ventadirecta
            $sql_delete = "DELETE FROM ventadirecta";
            $query_delete = mysqli_query($con, $sql_delete);

            if ($query_delete) {
                echo "Datos insertados en la tabla 'tickets' y datos eliminados de 'ventadirecta'.";
                // Redirige a la página "ventad.php"
                header("Location: ventad.php");
                exit; // Asegura que el script se detenga aquí
            } else {
                echo "Error al borrar los datos de ventadirecta: " . mysqli_error($con);
            }
        } else {
            echo "Error al insertar datos en la tabla 'tickets': " . mysqli_error($conn1);
        }

        // Cierra la conexión a la base de datos prueb
        mysqli_close($conn1);
    } else {
        echo "No se encontraron datos en la tabla 'ventadirecta'.";
    }
} else {
    echo "Error al registrar la venta directa: " . mysqli_error($con);
}

// Cierra la conexión a la base de datos
mysqli_close($con);
?>
