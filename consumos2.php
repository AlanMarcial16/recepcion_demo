<?php
$servername1 = "localhost";  // Datos de la base de datos "pruebar" (tabla "tickets")
$username1 = "root";
$password1 = "";
$database1 = "pruebar";

$servername2 = "localhost";  // Datos de la base de datos "prueba" (tabla "reservaciones")
$username2 = "root";
$password2 = "";
$database2 = "prueba";

// Crear la conexión a ambas bases de datos
$conn1 = mysqli_connect($servername1, $username1, $password1, $database1);
$conn2 = mysqli_connect($servername2, $username2, $password2, $database2);

if (!$conn1 || !$conn2) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtén el "id" de la reserva desde la URL
$id = $_GET['id'];

// Obtener los datos de la tabla "tickets"
$sql_tickets = "SELECT * FROM tickets";
$result_tickets = mysqli_query($conn1, $sql_tickets);

// Obtener los datos de la tabla "reservaciones" para una reserva específica
$sql_reservaciones = "SELECT * FROM reservaciones WHERE cod_reserva = '$id'";
$result_reservaciones = mysqli_query($conn2, $sql_reservaciones);

// Bandera para verificar si se cumple la validación
$coincidencia = false;

// Datos del ticket
$datos_ticket = null;

if (mysqli_num_rows($result_tickets) > 0 && mysqli_num_rows($result_reservaciones) > 0) {
    while ($row_ticket = mysqli_fetch_assoc($result_tickets)) {
        while ($row_reservacion = mysqli_fetch_assoc($result_reservaciones)) {
            if ($row_ticket['habitacion'] == $row_reservacion['habitacion'] &&
                $row_ticket['comensal'] == $row_reservacion['cliente']) {
                $coincidencia = true;
                $datos_ticket = json_decode($row_ticket['datos_json'], true);
                break 2; // Salir de ambos bucles
            }
        }
        // Reiniciar el puntero de la tabla "reservaciones" para volver a recorrerla
        mysqli_data_seek($result_reservaciones, 0);
    }
}

// Cierra las conexiones a las bases de datos
mysqli_close($conn1);
mysqli_close($conn2);

if ($coincidencia) {
    echo "<!DOCTYPE html>";
    echo "<html lang='es'>";
    echo "<head>";
    echo "<meta charset='UTF-8'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    echo "<title>Ticket de Compra</title>";
    echo "</head>";
    echo "<body>";
    echo "<style>
        body {
            font-size: 16px; /* Aumenta el tamaño del texto del cuerpo */
        }

        .ticket {
            width: 200px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            background: #fff;
            padding: 10px;
            border: 1px solid #000;
            box-shadow: 2px 2px 3px #888;
            text-align: center;
        }

        .ticket img {
            width: 50px;
            height: 50px;
        }

        .ticket h1 {
            font-size: 24px; /* Aumenta el tamaño del título */
            margin: 10px 0; /* Aumenta el margen del título */
        }

        .ticket p {
            font-size: 16px; /* Aumenta el tamaño del texto */
            margin: 10px 0; /* Aumenta el margen del texto */
        }

        .ticket hr {
            border: none;
            border-top: 2px dashed #888; /* Aumenta el tamaño de la línea */
            height: 2px;
            margin: 16px 0; /* Aumenta el margen de la línea */
        }

        .item {
            display: flex;
            justify-content: space-between;
            font-size: 20px; /* Aumenta el tamaño del texto de los elementos de la lista */
            margin: 10px 0; /* Aumenta el margen de los elementos de la lista */
        }

        .item span:first-child {
            flex: 1;
            text-align: left;
        }

        .item span:last-child {
            flex: 1;
            text-align: right;
        }

        .total {
            font-size: 20px; /* Aumenta el tamaño del texto del total */
            font-weight: bold;
        }
    </style>";
    echo "<div class='ticket'>";
    echo "<img src='https://static.wixstatic.com/media/9ed84f_e9388ac15d374e77aa9c89cdb80e014a~mv2.png' alt='Logo'>";
    echo "<h1>CASA FLORA HANDMADE HOTEL</h1>";
    echo "<p>Terraza Alimentos saludables y Eco-amigables</p>";
    echo "<p>Pedido: MESA 1</p>";
    echo "<p>Empleado: Propietario</p>";
    echo "<p>TPV: Terraza</p>";
    echo "<hr>";
    echo "<p>En Terraza</p>";
    echo "<hr>";

    // Iterar sobre los datos del ticket y mostrarlos en formato de ticket
    foreach ($datos_ticket as $item) {
        echo "<div class='item'>";
        echo "<span>" . $item['nombre'] . "</span>";
        echo "<span>$" . number_format($item['preciou'], 2) . "</span>";
        echo "</div>";
    }

    echo "<hr>";
    echo "<p class='total'>Total: $" . number_format(array_sum(array_column($datos_ticket, 'preciou')), 2) . "</p>";
    echo "<hr>";
    echo "<p>¡GRACIAS POR TU PREFERENCIA!</p>";
    echo "<p>Eventos y comentarios:</p>";
    echo "<p>experiencias@casaflora.mx</p>";
    echo "<p>Cel/Whats: 2441440564</p>";
    echo "<p>Privada Rio Nazas 312, Atlixco, Pue.</p>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
} else {
    // No se cumple la validación, no se puede visualizar el ticket
    echo "No se cumple la validación. No se puede visualizar el ticket.";
}

?>
