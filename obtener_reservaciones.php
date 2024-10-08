<?php
// Realizar la conexión a la base de datos
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'prueba';

$conexion = mysqli_connect($host, $user, $pass, $db);

// Obtener el mes y año actual
$currentMonth = date('n');
$currentYear = date('Y');

// Obtener las reservaciones para el mes y año actual
$query = "SELECT fecha, salida FROM reservaciones WHERE MONTH(fecha) = $currentMonth AND YEAR(fecha) = $currentYear";
$resultado = mysqli_query($conexion, $query);

$reservaciones = array();

if ($resultado) {
  while ($row = mysqli_fetch_assoc($resultado)) {
    $reservaciones[] = array(
      'fecha' => $row['fecha'],
      'salida' => $row['salida']
    );
  }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);

// Enviar las reservaciones como respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($reservaciones);
?>
