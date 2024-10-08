<?php
// Inicializar la sesión
session_start();

// Incluir archivo de conexión
include("conexion.php");
$con = conectar();

// Verificar si el usuario ya está conectado, si es así, redirigirlo a la página de inicio
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: inicio.php");
    exit;
}

// Incluir archivo de configuración
require_once "config.php";

// Definir variables y inicializarlas con valores vacíos
$username = $password = "";
$username_err = $password_err = "";

// Procesar los datos del formulario cuando se envíe el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Verificar si el nombre de usuario está vacío
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese su usuario.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Verificar si la contraseña está vacía
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingrese su contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar credenciales
    if(empty($username_err) && empty($password_err)){
        // Preparar una declaración de selección
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Establecer parámetros
            $param_username = $username;
            
            // Intentar ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt)){
                // Almacenar el resultado
                mysqli_stmt_store_result($stmt);
                
                // Verificar si el nombre de usuario existe, si es así, verificar la contraseña
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Vincular variables de resultado
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // La contraseña es correcta, así que iniciar una nueva sesión
                            // Guardar datos en variables de sesión
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Obtener el ID de sesión actual
                            $session_key = session_id();

                            // Insertar o actualizar el estado de la sesión en la base de datos
                            $sql = "INSERT INTO session_status (session_key, status) VALUES (?, 'active')
                                    ON DUPLICATE KEY UPDATE status = 'active'";
                            $stmt = mysqli_prepare($link, $sql);
                            mysqli_stmt_bind_param($stmt, "s", $session_key);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_close($stmt);

                            // Redirigir al usuario a la página de inicio
                            header("location: inicio.php");
                            exit;
                        } else{
                            // Mostrar un mensaje de error si la contraseña no es válida
                            $password_err = "La contraseña que has ingresado no es válida.";
                        }
                    }
                } else{
                    // Mostrar un mensaje de error si el nombre de usuario no existe
                    $username_err = "No existe cuenta registrada con ese nombre de usuario.";
                }
            } else{
                echo "Algo salió mal, por favor vuelve a intentarlo.";
            }
        }
        
        // Cerrar declaración
        mysqli_stmt_close($stmt);
    }
    
    // Cerrar conexión
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/hyf.css">
    <title>Login - Casa Flora Handmade Hotel</title>
    <link rel="shortcut icon" href="https://static.wixstatic.com/media/9ed84f_b72e16d4242e4e97a54c4945ac674912~mv2.png/v1/fill/w_50,h_50,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/9ed84f_b72e16d4242e4e97a54c4945ac674912~mv2.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/estilo1.css">
    <style type="text/css">
        body { font: 14px sans-serif; }
        .wrapper { width: 350px; padding: 20px; }
        .login { display: flex; flex-direction: column; align-items: center; }
        .logo { max-width: 300px; filter: grayscale(100%) brightness(500%); margin-bottom: 20px; }
        .login-header { text-align: center; margin-bottom: 20px; }
        .login-container { width: 100%; }
    </style>
</head>
<body>
    <div class="login">
        <img class="logo" src="https://static.wixstatic.com/media/9ed84f_e9388ac15d374e77aa9c89cdb80e014a~mv2.png" alt="Logo">
        <h1 class="login-header">Inicio de sesión - RECEPCIÓN</h1>
        <br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-container">
            <p>Por favor, introduzca sus credenciales para iniciar sesión.</p>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Ingresar">
            </div>
            <p>¿Eres administrador? <a href="index2.php">Haz Click aquí</a>.</p>
            <p>Jefe de operaciones <a href="index3.php">Haz Click aquí</a>.</p>
            <p><a href="register.php">Registrar</a></p>
        </form>
    </div>
    <br>
    <div class="login">
        <h1 class="login-header">Pendientes</h1>
        <form action="#" method="post" class="login-container">
            <p>Los pendientes por realizar son los siguientes:</p>
            <?php
                while($row=mysqli_fetch_array($query)){
            ?>
                <div class="form-group">
                    <li><b><?php  echo $row['pendiente1']?></b></li>
                    <li><b><?php  echo $row['pendiente2']?></b></li>
                    <li><b><?php  echo $row['pendiente3']?></b></li>
                </div>    
                
            <?php 
                }
            ?>
        </form>
    </div>     
</body>
</html>
