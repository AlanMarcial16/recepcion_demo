<?php
include("conexion.php");
$con = conectar();

$cod_reserva = $_POST['cod_reserva'];
$fecha = $_POST['fecha'];
$dia = $_POST['dia'];
$llegada = $_POST['llegada'];
$salida = $_POST['salida'];
$cliente = $_POST['cliente'];
$huespedes = $_POST['huespedes'];
$tarifa = $_POST['tarifa'];
$anticipo = $_POST['anticipo'];
$via = $_POST['via'];
$sextras = $_POST['sextras'];
$noches = $_POST['noches'];
$garantia = $_POST['garantia'];
$cextras = $_POST['cextras'];
$total = $_POST['total'];

// Obtener el ID de la habitación seleccionada
$habitacion_nombre = $_POST['habitacion'];
$queryHabitacion = "SELECT habitacion_id FROM habitaciones WHERE nombre = '$habitacion_nombre'";
$resultHabitacion = mysqli_query($con, $queryHabitacion);
$rowHabitacion = mysqli_fetch_assoc($resultHabitacion);
$habitacion_id = $rowHabitacion['habitacion_id'];

// Actualizar el estado de la habitación a "ocupada"
$queryHabitacion = "UPDATE habitaciones SET estado = 'ocupada' WHERE habitacion_id = $habitacion_id";
mysqli_query($con, $queryHabitacion);

// Actualizar el nombre de la habitación en la reserva
$sql = "UPDATE reservaciones SET fecha='$fecha', dia='$dia', llegada='$llegada', salida='$salida', cliente='$cliente', habitacion='$habitacion_nombre', huespedes='$huespedes', tarifa='$tarifa', anticipo='$anticipo', via='$via', sextras='$sextras', noches='$noches', garantia='$garantia', cextras='$cextras', total='$total' WHERE cod_reserva='$cod_reserva'";
$query = mysqli_query($con, $sql);

// Guardar el nombre de la habitación en la variable $habitacion
$habitacion = $habitacion_nombre;

/*$sql = "INSERT INTO cajaop (cod_operacion, tipodeoperacion, descripcion, tipocomprobante, importeentrada, importesalida, fecha_hora_registro) 
        VALUES (NULL, 'Entrada', 'Check In habitación $habitacion', 'Ticket', '" . abs($gtotal) . "', '', NOW())";
$query = mysqli_query($con, $sql);*/

// Insertar operación a caja chica 
if (isset($_POST['garantia']) && $_POST['garantia'] == "D.S. $400") {
    // Ejecutar el query utilizando $habitacion en la descripción
    $sql = "INSERT INTO cajaop (cod_operacion, tipodeoperacion, descripcion, tipocomprobante, importeentrada, importesalida, fecha_hora_registro) 
            VALUES (NULL, 'Entrada', 'Depósito de seguridad habitación $habitacion', 'Ticket', '400', '', NOW())";
    $query = mysqli_query($con, $sql);
}

if ($query) {
    // Realizar la redirección a "cobrar.php" después de redirigir a "inicio.php"
    header("Location: inicio.php");
    exit(); // Asegurarse de que el script se detenga después de la redirección
}
?>
