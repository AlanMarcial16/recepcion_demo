<?php
include("conexion.php");
$con = conectar();

$cod_reserva = $_POST['cod_reserva'];
$garantia = $_POST['garantia'];

$sql_update = "UPDATE reservaciones SET garantia='$garantia' WHERE cod_reserva='$cod_reserva'";
$query_update = mysqli_query($con, $sql_update);

if ($query_update) {
    // Verificar si la garantía seleccionada es "Depósito de seguridad ($400.00 M.N.)"
    if ($garantia == "D.S. $400") {
        // Obtener otros valores necesarios del formulario si es necesario
        $habitacion = $_POST['habitacion'];
        // Realizar la inserción en la tabla cajaop para entrada
        $sql = "INSERT INTO cajaop (cod_operacion, tipodeoperacion, descripcion, tipocomprobante, importeentrada, importesalida, fecha_hora_registro) 
                VALUES (NULL, 'Entrada', 'Cambio de garantía habitación $habitacion', 'Ticket', '400', '', NOW())";
        $query = mysqli_query($con, $sql);
    } elseif ($garantia == "ID") {
        // Obtener otros valores necesarios del formulario si es necesario
        $habitacion = $_POST['habitacion'];
        // Realizar la inserción en la tabla cajaop para salida
        $sql = "INSERT INTO cajaop (cod_operacion, tipodeoperacion, descripcion, tipocomprobante, importeentrada, importesalida, fecha_hora_registro) 
                VALUES (NULL, 'Salida', 'Devolución de depósito x cambio habitación $habitacion', 'Ticket', '', '400', NOW())";
        $query = mysqli_query($con, $sql);
    }
    header("Location: insertarpos.php?id=$cod_reserva");
}
?>
