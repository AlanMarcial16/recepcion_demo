<?php
include("conexion.php");
$con = conectar();

$fecha = $_POST['fecha'];
$salida = $_POST['salida'];
$cliente = $_POST['cliente'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$habitacion = $_POST['habitacion'];
$huespedes = $_POST['huespedes'];
$edades = $_POST['edades'];
$tarifa = $_POST['tarifa'];
$sextras = $_POST['sextras'];
$noches = $_POST['noches'];
$total = $_POST['total'];
$medio_contacto = isset($_POST['medio_contacto']) ? $_POST['medio_contacto'] : 'No especificado'; // Captura el medio de contacto

$total = (($tarifa * $noches));

// Inserción en la tabla cotizaciones
$sql = "INSERT INTO cotizaciones (fecha, salida, cliente, email, telefono, habitacion, huespedes, edades, tarifa, sextras, noches, total, medio_contacto) VALUES ('$fecha', '$salida', '$cliente', '$email', '$telefono', '$habitacion', '$huespedes', '$edades', '$tarifa', '$sextras', '$noches', '$total', '$medio_contacto')";
$query = mysqli_query($con, $sql);

// Inserción en la tabla crm (opcional, si también necesitas guardar esta información allí)
$sql_crm = "INSERT INTO crm (fecha, salida, cliente, email, telefono, habitacion, huespedes, edades, tarifa, sextras, noches, total, medio_contacto) VALUES ('$fecha', '$salida', '$cliente', '$email', '$telefono', '$habitacion', '$huespedes', '$edades', '$tarifa', '$sextras', '$noches', '$total', '$medio_contacto')";
$query_crm = mysqli_query($con, $sql_crm);

if ($query) {
    Header("Location: cotizacion.php");
} else {
    echo "Error al guardar la cotización.";
}
?>
