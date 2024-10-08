<?php
include("conexion.php");
$con = conectar();

$cod_reserva = $_POST['cod_reserva'];

// Obtener datos del formulario
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
$cextras = $_POST['cextras'];
$garantia = $_POST['garantia'];
$pago = $_POST['pago'];
$comentarios = $_POST['comentarios'];
$total = (((-$tarifa * $noches) - $cextras) + $anticipo);

// Validar si la garantía es un depósito de seguridad
$garantia_query = "SELECT garantia FROM reservaciones WHERE cod_reserva='$cod_reserva'";
$garantia_result = mysqli_query($con, $garantia_query);
$garantia_value = mysqli_fetch_assoc($garantia_result)['garantia'];

if ($garantia_value === 'D.S. $400') {
    $sql = "INSERT INTO cajaop (cod_operacion, tipodeoperacion, descripcion, tipocomprobante, importeentrada, importesalida, fecha_hora_registro) 
            VALUES (NULL, 'Salida', 'Devolución Depósito de seguridad habitación $habitacion', 'Ticket', '', '400', NOW())";
    mysqli_query($con, $sql);
}

// Obtener el ID de la habitación seleccionada y actualizar el estado de la habitación
$habitacion_id = mysqli_fetch_assoc(mysqli_query($con, "SELECT habitacion_id FROM habitaciones WHERE nombre = '$habitacion'"))['habitacion_id'];
mysqli_query($con, "UPDATE habitaciones SET estado = 'disponible' WHERE habitacion_id = $habitacion_id");

// Insertar datos en la tabla 'finalizadas' y eliminar la reserva
$sql = "INSERT INTO finalizadas (fecha, dia, llegada, salida, cliente, habitacion, huespedes, tarifa, anticipo, via, sextras, noches, cextras, comentarios, total, garantia, pago) 
        VALUES ('$fecha','$dia','$llegada','$salida','$cliente','$habitacion','$huespedes','$tarifa','$anticipo','$via','$sextras','$noches','$cextras','$comentarios','$total', '$garantia', '$pago')";
mysqli_query($con, $sql);// Muestra el mensaje de error en caso de falla
mysqli_query($con, "DELETE FROM reservaciones WHERE cod_reserva='$cod_reserva'");

// Redireccionar a la página inicio.php
Header("Location: inicio.php");
?>
