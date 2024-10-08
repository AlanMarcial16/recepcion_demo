<?php
require('fpdf.php');

// Crear una instancia de FPDF con formato personalizado (58 mm x 210 mm)
$pdf = new FPDF('P', 'mm', array(58, 210));
$pdf->AddPage();

// Ruta relativa de la imagen del logo
$logoPath = 'img/cflogo.jpg';

// Ajustar el tamaño de la imagen (ajustada a 30 mm de ancho y 30 mm de alto)
$pdf->Image($logoPath, 14, 10, 30, 30, 'JPEG', '', '', true, 100);

// Realizar un salto de línea después de la imagen
$pdf->Ln(); // Saltar una línea después de la línea punteada

// Título (debajo del logo) - centrado horizontalmente
$pdf->SetY(43); // Ajustar la posición vertical del título debajo del logo
$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente el título
$pdf->SetFont('Arial', 'B', 8); // Establecer la fuente en negritas (usando 'B')
$pdf->Cell(58, 8, 'CASA FLORA HANDMADE HOTEL', 0, 1, 'C'); // Centrar el texto y saltar una línea
$pdf->SetFont('Arial', '', 8); // Restablecer la fuente a la normal después de la línea

//-------------------------------------------------------------------------------------------------
/* Línea punteada después del título
$pdf->SetLineWidth(0.2); // Establecer el grosor de la línea punteada
$pdf->SetDrawColor(0, 0, 0); // Establecer el color de la línea (negro)

$x1 = 0; // Coordenada X del inicio de la línea
$x2 = 58; // Coordenada X del final de la línea
$y = $pdf->GetY(); // Coordenada Y de la línea (misma que la última posición Y)

for ($x = $x1; $x <= $x2; $x += 1) {
    if ($x % 2 == 0) { // Dibuja un espacio en blanco cada 2 unidades
        $pdf->Line($x, $y, $x + 1, $y); // Dibuja un tramo de la línea punteada
    }
}*/

$pdf->Ln(4); // Saltar una línea después de la línea punteada
//-------------------------------------------------------------------------------------------------- 

// Datos del hotel (debajo del título) - centrados horizontalmente
$pdf->SetY(52); // Ajustar la posición vertical de los datos del hotel debajo del título
//$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
//$pdf->Cell(58, 5, utf8_decode('Terraza'), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto
$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
$pdf->Cell(58, 5, utf8_decode('Terraza Alimentos saludables y'), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto
$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
$pdf->Cell(58, 5, utf8_decode('Eco-amigables'), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto
$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
$pdf->Cell(58, 5, utf8_decode(''), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto

$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
$pdf->Cell(58, 5, utf8_decode('Pedido: MESA 1'), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prueba";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
$pdf->Cell(58, 5, utf8_decode('Empleado: Propietario'), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto

$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
$pdf->Cell(58, 5, utf8_decode('TPV: Terraza'), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Obtener la fecha y hora actual en formato deseado
$fechaHoraActual = date('d-m-Y h:i A');

// Ajustar la zona horaria a la de México
date_default_timezone_set('America/Mexico_City');

// Formatear la fecha y hora ajustada a la zona horaria de México
$fechaHoraActual = date('d-m-Y h:i A');

// Centrar horizontalmente los datos del hotel
$pdf->SetX(($pdf->GetPageWidth() - 58) / 2);

// Agregar la línea con la fecha y hora
$pdf->Cell(58, 5, utf8_decode('Fecha y Hora: ' . $fechaHoraActual), 0, 1, 'C');

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
$pdf->Cell(58, 5, utf8_decode(''), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto

// Línea punteada después del título
$pdf->SetLineWidth(0.2); // Establecer el grosor de la línea punteada
$pdf->SetDrawColor(0, 0, 0); // Establecer el color de la línea (negro)

$x1 = 0; // Coordenada X del inicio de la línea
$x2 = 58; // Coordenada X del final de la línea
$y = $pdf->GetY(); // Coordenada Y de la línea (misma que la última posición Y)

for ($x = $x1; $x <= $x2; $x += 1) {
    if ($x % 2 == 0) { // Dibuja un espacio en blanco cada 2 unidades
        $pdf->Line($x, $y, $x + 1, $y); // Dibuja un tramo de la línea punteada
    }
}

//-------------------------------------------------------------------------------------------------
$pdf->Ln(4); // Saltar una línea después de la línea punteada

$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
$pdf->Cell(58, 5, utf8_decode('En Terraza'), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto

// Línea punteada después del título
$pdf->SetLineWidth(0.2); // Establecer el grosor de la línea punteada
$pdf->SetDrawColor(0, 0, 0); // Establecer el color de la línea (negro)

$x1 = 0; // Coordenada X del inicio de la línea
$x2 = 58; // Coordenada X del final de la línea
$y = $pdf->GetY(); // Coordenada Y de la línea (misma que la última posición Y)

for ($x = $x1; $x <= $x2; $x += 1) {
    if ($x % 2 == 0) { // Dibuja un espacio en blanco cada 2 unidades
        $pdf->Line($x, $y, $x + 1, $y); // Dibuja un tramo de la línea punteada
    }
}

//-------------------------------------------------------------------------------------------------
$pdf->Ln(4); // Saltar una línea después de la línea punteada


// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prueba";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener datos de la tabla
$sql = "SELECT nombre, cantidad, preciou FROM ventadirecta";
$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Encabezados de la tabla de productos
    $ancho_total = 58; // Ancho total de la página en mm
    $ancho_nombre = 29; // Ancho de la columna "Nombre del Producto" en mm
    $ancho_cantidad = 14; // Ancho de la columna "Cantidad" en mm
    $ancho_precio = $ancho_total - $ancho_nombre - $ancho_cantidad; // Calcular el ancho restante para la columna "Precio Unitario"

    // Encabezados de la tabla de productos (con texto en negritas)
    $pdf->SetFont('Arial', 'B', 8); // Establecer la fuente en negritas (usando 'B') para los encabezados
    $pdf->Cell($ancho_nombre, 5, 'Concepto', 0, 0, 'L');
    $pdf->Cell($ancho_precio, 5, 'Precio', 0);
    $pdf->Ln(); // Saltar una línea después de los encabezados
    $pdf->SetFont('Arial', '', 8); // Restablecer la fuente a la normal después
    $pdf->Ln(); // Saltar una línea después de los encabezados

    // Iterar sobre los resultados y agregarlos al PDF
    // Iterar sobre los resultados y agregarlos al PDF
while ($row = $result->fetch_assoc()) {
    $nombre = strtoupper($row['nombre']); // Convertir el nombre a mayúsculas
    $preciou = '$' . number_format($row['preciou'], 2); // Formatear y agregar el signo de dólar

    // Dividir el nombre en palabras
    $palabras = explode(' ', $nombre);
    $linea = '';
    $primeraLinea = true;

    foreach ($palabras as $palabra) {
        // Verificar si agregar esta palabra excede el ancho máximo de la celda
        if ($pdf->GetStringWidth($linea . ' ' . $palabra) < $ancho_nombre) {
            $linea .= ($linea == '' ? '' : ' ') . $palabra;
        } else {
            // Agregar la línea actual y comenzar una nueva línea
            $pdf->Cell($ancho_nombre, 5, utf8_decode($linea), 0);

            // Mostrar el precio solo en la primera línea
            if ($primeraLinea) {
                $pdf->Cell($ancho_precio, 5, utf8_decode($preciou), 0);
                $primeraLinea = false;
            }

            $pdf->Ln(); // Salto de línea después de cada línea de datos
            $linea = $palabra;
        }
    }

    // Agregar la última línea si es necesario
    if (!empty($linea)) {
        $pdf->Cell($ancho_nombre, 5, utf8_decode($linea), 0);

        // Mostrar el precio solo en la primera línea
        if ($primeraLinea) {
            $pdf->Cell($ancho_precio, 5, utf8_decode($preciou), 0);
            $primeraLinea = false;
        }

        $pdf->Ln(); // Salto de línea después de cada línea de datos
    }

    $pdf->Ln(); // Salto de línea entre entradas
}

} else {
    echo "No se encontraron resultados.";
}

// Consulta SQL para obtener el total de la columna "preciou"
$sql_total = "SELECT SUM(preciou) AS total FROM ventadirecta";
$result_total = $conn->query($sql_total);

// Verificar si se obtuvieron resultados
if ($result_total->num_rows > 0) {
    $row_total = $result_total->fetch_assoc();
    $total = $row_total['total'];
} else {
    $total = 0; // Establecer un total predeterminado si no se encontraron resultados
}

$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
$pdf->Cell(58, 5, utf8_decode(''), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto

// Línea punteada antes del total------------------------------------------------------------------
$pdf->SetLineWidth(0.2); // Establecer el grosor de la línea punteada
$pdf->SetDrawColor(0, 0, 0); // Establecer el color de la línea (negro)

$x1 = 0; // Coordenada X del inicio de la línea
$x2 = 58; // Coordenada X del final de la línea
$y = $pdf->GetY(); // Coordenada Y de la línea (misma que la última posición Y)

for ($x = $x1; $x <= $x2; $x += 1) {
    if ($x % 2 == 0) { // Dibuja un espacio en blanco cada 2 unidades
        $pdf->Line($x, $y, $x + 1, $y); // Dibuja un tramo de la línea punteada
    }
}

$pdf->Ln(4); // Saltar una línea después de la línea punteada

$pdf->SetX(10); // Establecer un margen izquierdo

// Establecer la fuente en negritas (usando 'B') para ambas celdas
$pdf->SetFont('Arial', 'B', 8);

// Celda para la palabra "Total"
$pdf->Cell(38, 8, 'Total', 0, 0, 'L');

// Celda para el monto
$pdf->Cell(10, 8, '$' . number_format($total, 2), 0, 1, 'L');

// Volver a la fuente normal
$pdf->SetFont('Arial', '', 8);

// Línea punteada después del total
$pdf->SetLineWidth(0.2); // Establecer el grosor de la línea punteada
$pdf->SetDrawColor(0, 0, 0); // Establecer el color de la línea (negro)

$x1 = 0; // Coordenada X del inicio de la línea
$x2 = 58; // Coordenada X del final de la línea
$y = $pdf->GetY(); // Coordenada Y de la línea (misma que la última posición Y)

for ($x = $x1; $x <= $x2; $x += 1) {
    if ($x % 2 == 0) { // Dibuja un espacio en blanco cada 2 unidades
        $pdf->Line($x, $y, $x + 1, $y); // Dibuja un tramo de la línea punteada
    }
}

$pdf->Ln(4); // Saltar una línea después de la línea punteada


$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
$pdf->Cell(58, 5, utf8_decode('¡GRACIAS POR TU PREFERENCIA!'), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto

$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
$pdf->Cell(58, 5, utf8_decode('Eventos y comentarios:'), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto

$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
$pdf->Cell(58, 5, utf8_decode('experiencias@casaflora.mx'), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto

$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
$pdf->Cell(58, 5, utf8_decode('Cel/Whats: 2441440514'), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto

$pdf->SetX(($pdf->GetPageWidth() - 58) / 2); // Centrar horizontalmente los datos del hotel
$pdf->Cell(58, 5, utf8_decode('Privada Rio Nazas 312, Atlixco, Pue.'), 0, 1, 'C'); // Centrar el texto y saltar una línea después del texto



// Cerrar la conexión a la base de datos
$conn->close();



// Finalizar y generar el PDF
$pdf->Output();
?>

