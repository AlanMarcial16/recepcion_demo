<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "prueba";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    if (is_numeric($id)) {
        // Consulta para obtener el precio antes de eliminar
        $precio_eliminar_query = mysqli_query($conn, "SELECT preciou FROM ventadirecta WHERE id = $id");
        $precio_eliminar_row = mysqli_fetch_assoc($precio_eliminar_query);
        $precio_eliminar = $precio_eliminar_row['preciou'];

        $sql = "DELETE FROM ventadirecta WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            // Recalcula el nuevo total después de eliminar
            $total_query = mysqli_query($conn, "SELECT SUM(preciou) AS total FROM ventadirecta");
            $total_row = mysqli_fetch_assoc($total_query);
            $total = $total_row['total'];

            setcookie("total", $total, time() + (86400 * 30), "/"); // 30 days

            session_start();
            $_SESSION['total'] = $total;

            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        } else {
            echo "Error al eliminar la opción: " . mysqli_error($conn);
        }
    } else {
        echo "ID de opción inválido.";
    }
}

mysqli_close($conn);
?>
