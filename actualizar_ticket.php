<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se han recibido los datos necesarios del formulario
    if (isset($_POST['habitacion']) && isset($_POST['cliente']) && isset($_POST['habitacion_actual']) && isset($_POST['cliente_actual'])) {
        // Obtener los valores del formulario
        $habitacion = $_POST['habitacion'];
        $cliente = $_POST['cliente'];
        $habitacion_actual = $_POST['habitacion_actual'];
        $cliente_actual = $_POST['cliente_actual'];

        // Realizar la conexión a la base de datos
        $link = mysqli_connect('localhost', 'root', '', 'prueba_demor');

        // Verificar la conexión
        if ($link === false) {
            die("ERROR: Could not connect to the database. " . mysqli_connect_error());
        }

        // Actualizar el ticket en la base de datos
        $sql = "UPDATE tickets SET habitacion = ?, comensal = ? WHERE habitacion = ? AND comensal = ?";
        
        // Preparar la declaración
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "ssss", $param_habitacion, $param_cliente, $param_habitacion_actual, $param_cliente_actual);
            
            // Establecer los parámetros
            $param_habitacion = $habitacion;
            $param_cliente = $cliente;
            $param_habitacion_actual = $habitacion_actual;
            $param_cliente_actual = $cliente_actual;
            
            // Intentar ejecutar la declaración preparada
            if (mysqli_stmt_execute($stmt)) {
                echo "El ticket se actualizó correctamente.";
                // Redireccionar a inicio.php
                header("Location: inicio.php");
                exit();
            } else {
                echo "ERROR: Could not execute $sql. " . mysqli_error($link);
            }
        } else {
            echo "ERROR: Could not prepare statement. " . mysqli_error($link);
        }
        
        // Cerrar la declaración
        mysqli_stmt_close($stmt);

        // Cerrar la conexión a la base de datos
        mysqli_close($link);
    } else {
        echo "ERROR: Not all necessary data received from the form.";
    }
} else {
    echo "ERROR: Incorrect request method.";
}
?>
