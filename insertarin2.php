<?php
include("conexion.php");
$con = conectar();

$fecha = $_POST['fecha'];
$habitacion = $_POST['habitacion'];
$area = $_POST['area'];
$descripcion = $_POST['descripcion'];
$costo = $_POST['costo'];
$cod_reserva = $_POST['cod_reserva']; // Asegúrate de tener $cod_reserva disponible

// Insertar datos en la tabla cajaop con la fecha y hora actual
$sql = "INSERT INTO cajaop (cod_operacion, tipodeoperacion, descripcion, tipocomprobante, importeentrada, importesalida, fecha_hora_registro) 
        VALUES (NULL, 'Entrada', 'Incidencia habitación $habitacion', 'Ticket', '$costo', '', NOW())";
$query = mysqli_query($con, $sql);

$sql = "INSERT INTO gastos VALUES(NULL,'$fecha','$habitacion','$area','$descripcion','$costo')";
$query = mysqli_query($con, $sql);

if ($query) {
    // Redirigir a verificahab.php pasando el valor de cod_reserva como parámetro GET
    header("Location: verificagar.php?id=$cod_reserva");
} else {
    echo "Error al insertar en la tabla gastos: " . mysqli_error($con);
}

// Cierra la conexión
mysqli_close($con);
?>
