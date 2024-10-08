<?php
// Obtener los valores del formulario
$fecha = $_POST['fecha'];
$salida = $_POST['salida'];

// Realizar la conexión a la base de datos
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'prueba';

$conexion = mysqli_connect($host, $user, $pass, $db);

// Verificar la disponibilidad de las habitaciones
$query = "SELECT COUNT(*) as ocupadas FROM reservaciones WHERE (fecha <= '$salida' AND salida >= '$fecha')";
$resultado = mysqli_query($conexion, $query);

if ($resultado) {
  $fila = mysqli_fetch_assoc($resultado);
  $habitacionesOcupadas = $fila['ocupadas'];

  if ($habitacionesOcupadas < 10) {
    echo "Habitaciones disponibles: " . (10 - $habitacionesOcupadas);
  } else {
    echo "Lo sentimos, no hay habitaciones disponibles en esas fechas. Por favor, elija otras fechas.";
  }
} else {
  echo "Error al verificar la disponibilidad de las habitaciones.";
}

// Cerrar la conexión a la base de
