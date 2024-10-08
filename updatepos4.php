<?php
include("conexion.php");
$con = conectar();

$cod_reserva = $_POST['cod_reserva'];
$anticipo = $_POST['anticipo'];
$habitacion = $_POST['habitacion'];
$metodo_pago = $_POST['metodo_pago'];  // Obtener el método de pago del formulario

// Obtener valores de "sextras" y "cextras" de la base de datos
$sql_select = "SELECT anticipo, tarifa, noches, gtotal, total, textras FROM reservaciones WHERE cod_reserva='$cod_reserva'";
$query_select = mysqli_query($con, $sql_select);
$row_select = mysqli_fetch_assoc($query_select);
$anticipo_actual = $row_select['anticipo'];
$tarifa = $row_select['tarifa'];
$noches = $row_select['noches'];
$textras = $row_select['textras'];
$total = $row_select['total'];

$gtotal = $row_select['gtotal'];

$anticipo_nuevo = $anticipo_actual + $anticipo;

$total = ((-$tarifa * $noches) + $anticipo_nuevo);

$gtotal = ($total + $textras);

$sql_update = "UPDATE reservaciones SET anticipo='$anticipo_nuevo' WHERE cod_reserva='$cod_reserva'";
$query_update = mysqli_query($con, $sql_update);

$sql = "UPDATE reservaciones SET total='$total', gtotal='$gtotal' WHERE cod_reserva='$cod_reserva'";
$query_update = mysqli_query($con, $sql);

if ($query_update) {
    // Si el método de pago es "Efectivo", inserta el registro en la tabla "cajaop"
    if ($metodo_pago == 'Efectivo') {
        $sql_cajaop = "INSERT INTO cajaop (cod_operacion, tipodeoperacion, descripcion, tipocomprobante, importeentrada, importesalida, fecha_hora_registro) 
                       VALUES (NULL, 'Entrada', 'Anticipo habitación $habitacion', 'Ticket', '$anticipo', '', NOW())";
        if (mysqli_query($con, $sql_cajaop)) {
            // Registro en cajaop exitoso
        } else {
            // Manejar error si la inserción en cajaop falla
            echo "Error: " . $sql_cajaop . "<br>" . mysqli_error($con);
        }
    }

    header("Location: insertarpos.php?id=$cod_reserva");
} else {
    // Manejar el error de actualización si la consulta de actualización falla
    echo "Error: " . $sql_update . "<br>" . mysqli_error($con);
}
?>
