<?php
include("conexion.php");
$con = conectar();

$cod_reserva = $_POST['cod_reserva'];
$fecha = $_POST['fecha'];
$dia = $_POST['dia'];
$llegada = $_POST['llegada'];
$salida = $_POST['salida'];
$cliente = $_POST['cliente'];
$habitacion = $_POST['habitacion'];
$huespedes = $_POST['huespedes'];
$tarifa = $_POST['tarifa'];
$anticipo = $_POST['anticipo'];
$via = $_POST['via'];
$sextras = $_POST['sextras'];
$noches = $_POST['noches'];
$garantia = $_POST['garantia'];
$cextras = $_POST['cextras'];
$pago = $_POST['pago'];
$total = $_POST['total'];

$textras = (($cextras + $sextras));

// Insertar datos en la tabla cajaop con la fecha y hora actual
$sql = "INSERT INTO cajaop (cod_operacion, tipodeoperacion, descripcion, tipocomprobante, importeentrada, importesalida, fecha_hora_registro) 
        VALUES (NULL, 'Entrada', 'Consumos y Servicios Especiales habitacion $habitacion', 'Ticket', '$textras', '', NOW())";
$query = mysqli_query($con, $sql);

$sql = "UPDATE reservaciones SET fecha='$fecha', dia='$dia', llegada='$llegada', salida='$salida', cliente='$cliente', 
        habitacion='$habitacion', huespedes='$huespedes', tarifa='$tarifa', anticipo='$anticipo', via='$via', sextras='0', 
        noches='$noches', garantia='$garantia', cextras='0', textras='0', pago='$pago', gtotal='0', total='$total' WHERE cod_reserva='$cod_reserva'";
$query = mysqli_query($con, $sql);

if ($query) {
    header("Location: insertarpos.php?id=$cod_reserva");
} else {
    echo "Error al insertar en la tabla cajaop: " . mysqli_error($con);
}

// Cierra la conexión
mysqli_close($con);
