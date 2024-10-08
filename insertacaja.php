<?php
include("conexion.php");
$con = conectar();

$montoi = $_POST['montoi'];
$fecha = $_POST['fecha'];
$totale = $_POST['totale'];
$totals = $_POST['totals'];
$gtotal = $_POST['gtotal'];

// Insertar datos en la tabla cajach
$sql = "INSERT INTO cajach VALUES (NULL, '$montoi', '$fecha', '$totale', '$totals', '$gtotal')";
$query = mysqli_query($con, $sql);

if ($query) {
    // Insertar datos en la tabla cajaop con la fecha y hora actual
    $sql = "INSERT INTO cajaop (cod_operacion, tipodeoperacion, descripcion, tipocomprobante, importeentrada, importesalida, fecha_hora_registro) 
            VALUES ('1', 'Entrada', 'Apertura de caja', 'Ticket', '$montoi', '', NOW())";
    
    $query = mysqli_query($con, $sql);

    if ($query) {
        Header("Location: cajaint.php");
    } else {
        echo "Error al insertar en la tabla cajaop: " . mysqli_error($con);
    }
} else {
    echo "Error al insertar en la tabla cajach: " . mysqli_error($con);
}

// Cierra la conexión
mysqli_close($con);
?>
