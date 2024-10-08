<?php
include("conexion.php");
$con = conectar();

$cod_incidencia = $_POST['cod_incidencia'];
$fecha = $_POST['fecha'];
$habitacion = $_POST['habitacion'];
$area = $_POST['area'];
$descripcion = $_POST['descripcion'];
$costo = $_POST['costo'];

// Insertar datos en la tabla cajaop con la fecha y hora actual
$sql = "INSERT INTO cajaop (cod_operacion, tipodeoperacion, descripcion, tipocomprobante, importeentrada, importesalida, fecha_hora_registro) 
        VALUES (NULL, 'Entrada', 'Incidencia habitación $habitacion', 'Ticket', '$costo', '', NOW())";
$query = mysqli_query($con, $sql);

$sql = "INSERT INTO gastos VALUES(NULL,'$fecha','$habitacion','$area','$descripcion','$costo')";
$query = mysqli_query($con, $sql);

$sql = "DELETE FROM incidencias  WHERE cod_incidencia='$cod_incidencia'";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: incidencias.php");
} else {
    echo "Error al eliminar la incidencia: " . mysqli_error($con);
}

// Cierra la conexión
mysqli_close($con);
?>
