<?php
$servername1 = "localhost";
$username1 = "root";
$password1 = "";
$database1 = "pruebar";

$servername2 = "localhost";
$username2 = "root";
$password2 = "";
$database2 = "prueba";

$conn1 = mysqli_connect($servername1, $username1, $password1, $database1);
$conn2 = mysqli_connect($servername2, $username2, $password2, $database2);

if (!$conn1 || !$conn2) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$id = $_GET['id'];

$sql_reservaciones = "SELECT * FROM reservaciones WHERE cod_reserva = '$id'";
$result_reservaciones = mysqli_query($conn2, $sql_reservaciones);

while ($row_reservacion = mysqli_fetch_assoc($result_reservaciones)) {
    $habitacion = $row_reservacion['habitacion'];
    $comensal = $row_reservacion['cliente'];

    $sql_tickets = "SELECT * FROM tickets WHERE habitacion = '$habitacion' AND comensal = '$comensal'";
    $result_tickets = mysqli_query($conn1, $sql_tickets);

    while ($row_ticket = mysqli_fetch_assoc($result_tickets)) {
        $datos_ticket = json_decode($row_ticket['datos_json'], true);
        $fyh = $row_ticket['fyh']; // Obtenemos la fecha y hora del ticket
        $id_ticket = $row_ticket['id']; // Obtenemos el id del ticket

        // Agrega este bloque para verificar si existe el mensaje en el JSON
        $mensaje = isset($datos_ticket[0]['mensaje']) ? $datos_ticket[0]['mensaje'] : '';

        // Genera el HTML del ticket actual y muestra los datos de $datos_ticket
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
                margin: 0 10px; /* Agregamos margen horizontal para separar los tickets */
                font-family: Arial, sans-serif;
                background: #fff;
                padding: 10px;
                border: 1px solid #000;
                box-shadow: 2px 2px 3px #888;
                text-align: center;
                display: inline-block; /* Hacemos que los tickets se muestren en línea horizontal */
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
            echo "<p>Habitación: {$row_ticket['habitacion']}</p>";
            echo "<p>Cliente: {$row_ticket['comensal']}</p>";
            echo "<p>Mensaje: $mensaje</p>"; // Mostrar el mensaje
            echo "<p>Empleado: Propietario</p>";
            echo "<p>TPV: Terraza</p>";
            echo "<p>Fecha y Hora: $fyh</p>"; // Mostramos la fecha y hora en el ticket
            echo "<p>Folio de venta: 00-$id_ticket</p>"; // Mostramos la fecha y hora en el ticket
            echo "<hr>";

        // Itera sobre los datos del ticket y muestra los detalles
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
    }
}

mysqli_close($conn1);
mysqli_close($conn2);
?>
