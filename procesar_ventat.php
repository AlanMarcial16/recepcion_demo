<?php
include("conexion.php");
$con = conectar();

$sql_delete = "DELETE FROM ventadirecta";
$query_delete = mysqli_query($con, $sql_delete);

if ($query_delete) {
    header("Location: ventad.php");
} else {
    echo "Error al borrar los datos de ventadirecta: " . mysqli_error($con);
}
?>


