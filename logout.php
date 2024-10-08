<?php
session_start();

// Incluir archivo de conexión
include("conexion.php");
$con = conectar();

// Obtener el ID de sesión actual
$session_key = session_id();

// Actualizar el estado de la sesión a 'inactive' en la base de datos
$sql = "UPDATE session_status SET status = 'inactive' WHERE session_key = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $session_key);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// Destruir todas las variables de sesión
$_SESSION = array();

// Si se utiliza una cookie de sesión, eliminarla
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio
header("location: index.php");
exit;
