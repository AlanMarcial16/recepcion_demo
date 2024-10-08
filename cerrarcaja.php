<?php

include("conexion.php");
$con = conectar();

// Obtener datos de la tabla cajach
$sql_cajach = "SELECT * FROM cajach";
$result_cajach = mysqli_query($con, $sql_cajach);

while ($row_cajach = mysqli_fetch_assoc($result_cajach)) {
    $fecha = $row_cajach['fecha'];
    $monto_inicial = $row_cajach['montoi'];
    $total_entradas = $row_cajach['totale'];
    $total_salidas = $row_cajach['totals'];
    $gran_total = $row_cajach['gtotal'];
    
    // Obtener las operaciones de cajaop correspondientes a la fecha
    $sql_cajaop = "SELECT * FROM cajaop WHERE DATE(fecha_hora_registro) = '$fecha'";
    $result_cajaop = mysqli_query($con, $sql_cajaop);
    
    $detalle_operacion = "";
    while ($row_cajaop = mysqli_fetch_assoc($result_cajaop)) {
        $detalle_operacion .= "Operacion: " . $row_cajaop['tipodeoperacion'] . ", Descripción: " . $row_cajaop['descripcion'] . ", Entrada: " . $row_cajaop['importeentrada'] . ", Salida: " . $row_cajaop['importesalida'] . "\n";
    }

    // Insertar en la nueva tabla flujoefectivo
    $sql_flujo = "INSERT INTO flujoefectivo (fecha, monto_inicial, total_entradas, total_salidas, gran_total, detalle_operacion) 
                  VALUES ('$fecha', '$monto_inicial', '$total_entradas', '$total_salidas', '$gran_total', '$detalle_operacion')";

    mysqli_query($con, $sql_flujo);
}

// Opcional: Vaciar las tablas cajach y cajaop después de insertar en flujoefectivo
$sql_truncate_cajach = "TRUNCATE TABLE cajach";
$sql_truncate_cajaop = "TRUNCATE TABLE cajaop";

mysqli_query($con, $sql_truncate_cajach);
mysqli_query($con, $sql_truncate_cajaop);

Header("Location: cajaint.php");

?>
