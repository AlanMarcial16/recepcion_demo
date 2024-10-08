<?php
include("conexion.php");
$con = conectar();

$tipodeoperacion = $_POST['tipodeoperacion'];
$descripcion = $_POST['descripcion'];
$tipocomprobante = $_POST['tipocomprobante'];
$importeentrada = $_POST['importeentrada'];
$importesalida = $_POST['importesalida'];

// Insertar datos en la tabla cajaop con la fecha y hora actual
$sql = "INSERT INTO cajaop (cod_operacion, tipodeoperacion, descripcion, tipocomprobante, importeentrada, importesalida, fecha_hora_registro) 
        VALUES (NULL, '$tipodeoperacion', '$descripcion', '$tipocomprobante', '$importeentrada', '$importesalida', NOW())";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: cajaint.php");
} else {
    echo "Error al insertar en la tabla cajaop: " . mysqli_error($con);
}

// Cierra la conexión
mysqli_close($con);
?>
