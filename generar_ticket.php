<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pruebar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['ticket_id'])) {
    $ticketId = $_GET['ticket_id'];

    $sql = "SELECT * FROM tickets WHERE id = $ticketId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $datos_ticket = json_decode($row['datos_json'], true);
        $fyh = $row['fyh'];
        $habitacion = $row['habitacion'];
        $comensal = $row['comensal'];
        $id_ticket = $row['id'];

        // Agrega este bloque para verificar si existe el mensaje en el JSON
        $mensaje = isset($datos_ticket[0]['mensaje']) ? $datos_ticket[0]['mensaje'] : '';

        // Generar el HTML del ticket
        echo "<!DOCTYPE html>";
        echo "<html lang='es'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Tickets de Compra</title>";
        echo "</head>";
        echo "<body>";
        echo "<style>
            .ticket {
                width: 200px;
                margin: 0 10px;
                font-family: Arial, sans-serif;
                background: #fff;
                padding: 10px;
                border: 1px solid #000;
                box-shadow: 2px 2px 3px #888;
                text-align: center;
                display: inline-block;
            }
            .ticket img {
                width: 50px;
                height: 50px;
            }
            .ticket h1 {
                font-size: 16px;
                margin: 5px 0;
            }
            .ticket p {
                font-size: 10px;
                margin: 5px 0;
            }
            .ticket hr {
                border: none;
                border-top: 1px dashed #888;
                height: 1px;
                margin: 8px 0;
            }
            .item {
                display: flex;
                justify-content: space-between;
                font-size: 12px;
                margin: 5px 0;
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
                font-weight: bold;
            }
            </style>";

        echo "<div class='ticket'>";
        echo "<img src='https://static.wixstatic.com/media/9ed84f_e9388ac15d374e77aa9c89cdb80e014a~mv2.png' alt='Logo'>";
        echo "<h1>CASA FLORA HANDMADE HOTEL</h1>";
        echo "<p>Terraza Alimentos saludables y Eco-amigables</p>";
        echo "<p>Pedido: MESA 1</p>";
        echo "<p>Habitación: $habitacion</p>";
        echo "<p>Cliente: $comensal</p>";
        echo "<p>Mensaje: $mensaje</p>"; // Mostrar el mensaje
        echo "<p>Empleado: Propietario</p>";
        echo "<p>TPV: Terraza</p>";
        echo "<p>Fecha y Hora: $fyh</p>";
        echo "<p>Folio de venta: 00-$id_ticket</p>";
        echo "<hr>";

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
        echo "No se encontraron resultados para el ID del ticket proporcionado.";
    }
} else {
    echo 'ID del ticket no proporcionado.';
}

$conn->close();
?>
