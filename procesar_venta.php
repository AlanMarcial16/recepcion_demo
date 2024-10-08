<?php
include("conexion.php");
$con = conectar();

date_default_timezone_set('America/Mexico_City');
$fyh_actual = date('Y-m-d H:i:s');

$opcion = $_POST["opcion"];
$cantidad = $_POST["cantidad"];
$precio = $_POST["precio"];

$sql = "INSERT INTO ventadirecta (nombre, cantidad, preciou, fyh) VALUES ('$opcion', '$cantidad', '$precio', '$fyh_actual')";
$query = mysqli_query($con, $sql);

if ($query) {
    $total_query = mysqli_query($con, "SELECT SUM(preciou) AS total FROM ventadirecta");
    $total_row = mysqli_fetch_assoc($total_query);
    $total = $total_row['total'];

    setcookie("total", $total, time() + (86400 * 30), "/"); // 30 days

    session_start();
    $_SESSION['total'] = $total;

    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}
?>
