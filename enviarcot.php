<?php
// Incluye el archivo de conexión a la base de datos
include("conexion.php");
$con = conectar();

// Verifica si se ha pasado el cod_reserva por la URL
if(isset($_GET['cod_reserva'])) {
    $cod_reserva = $_GET['cod_reserva'];

    // Realiza una consulta para obtener los datos de la reserva correspondiente al cod_reserva
    $sql = "SELECT fecha, salida, cliente, email, telefono, noches FROM crm WHERE cod_reserva = $cod_reserva";
    $query = mysqli_query($con, $sql);

    // Verifica si se encontraron resultados
    if(mysqli_num_rows($query) > 0) {
        // Obtiene los datos de la reserva
        $row = mysqli_fetch_assoc($query);
        $fecha = $row['fecha'];
        $salida = $row['salida'];
        $cliente = $row['cliente'];
        $email = $row['email'];
        $telefono = $row['telefono'];
        $noches = $row['noches'];
    } else {
        echo "No se encontraron datos para el cod_reserva proporcionado.";
        exit; // Sale del script si no se encuentran datos
    }
} else {
    echo "No se proporcionó un cod_reserva válido.";
    exit; // Sale del script si no se proporciona el cod_reserva
}
?>

<!-- Luego, puedes utilizar los datos recuperados para rellenar los campos del formulario -->
<!-- Agrega el código HTML del formulario aquí y utiliza los valores de las variables PHP -->

<form action="insertar.php" method="POST" id="Reservas">
    <!-- Aquí van los campos del formulario -->
    <input type="date" class="form-control mb-3" name="fecha" placeholder="Fecha" value="<?php echo $fecha; ?>" required>
    <input type="date" class="form-control mb-3" name="salida" placeholder="Salida" value="<?php echo $salida; ?>" required>
    <input type="text" class="form-control mb-3" name="cliente" placeholder="Nombre del cliente" value="<?php echo $cliente; ?>" required>
    <!-- Y así sucesivamente para los demás campos -->
</form>
