<?php
include("conexion.php");
$con = conectar();

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $preciou = $_POST['preciou'];

    // Verificar si el ID existe en la base de datos antes de actualizar
    $sql_check = "SELECT id FROM ventadirecta WHERE id = $id";
    $result_check = mysqli_query($con, $sql_check);

    if (mysqli_num_rows($result_check) > 0) {
        // El ID existe en la base de datos, realizar la actualización
        $sql = "UPDATE ventadirecta SET nombre='$nombre', cantidad='$cantidad', preciou='$preciou' WHERE id='$id'";
        $query = mysqli_query($con, $sql);

        if ($query) {
            // Actualizar el valor total
            $total_query = mysqli_query($con, "SELECT SUM(preciou) AS total FROM ventadirecta");
            $total_row = mysqli_fetch_assoc($total_query);
            $total = $total_row['total'];

            setcookie("total", $total, time() + (86400 * 30), "/"); // 30 days

            session_start();
            $_SESSION['total'] = $total;

            header("Location: ventad.php");
            exit();
        } else {
            echo "Error al actualizar los datos: " . mysqli_error($con);
        }
    } else {
        echo "ID no válido o no existe en la base de datos.";
    }
}

mysqli_close($con);
?>
