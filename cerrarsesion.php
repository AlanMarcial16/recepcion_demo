<?php 
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
    include("conexion.php");
    $con=conectar();

    $sql = "SELECT COUNT(*) as total_filas FROM cotizaciones";
    $query=mysqli_query($con,$sql);
    

    $sql2="SELECT *  FROM cajach";
    $query2=mysqli_query($con,$sql2);

    $sql3="SELECT *  FROM users";
    $query3=mysqli_query($con,$sql3);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <link rel="stylesheet" href="css/hyf.css">
    <title>Entrega recepción - Casa Flora Handmade Hotel</title>
    <link rel="shortcut icon" href="https://static.wixstatic.com/media/9ed84f_b72e16d4242e4e97a54c4945ac674912~mv2.png/v1/fill/w_50,h_50,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/9ed84f_b72e16d4242e4e97a54c4945ac674912~mv2.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/estilo5.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        h2 {
			text-align: center; /* centrar el texto dentro del elemento */
			margin-left: auto; /* establecer el margen izquierdo a auto */
			margin-right: auto; /* establecer el margen derecho a auto */
		}
        .h1{
                text-align: center;
            }

            .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            width: 70%;
            }

            .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            }

            .container {
            padding: 2px 16px;
            }

            #contenedor {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            }

            .checklist label {
                display: inline-block;
                margin-right: 10px; /* espacio entre la etiqueta y el checkbox */
            }
            .checklist input[type="checkbox"] {
                display: inline-block;
            }
            .custom-container {
                max-width: 1600px; /* Ajusta el valor según tus necesidades */
                margin: 0 auto; /* Centra el contenido horizontalmente */
            }
            
    </style>
</head>
<body>
<div class="login custom-container">
    <div class="login-triangle"></div>
    
    <h1 class="login-header">Entrega recepción</h1>
    <form action="entrec.php" method="post" class="login-container">
    <h2><b>Por favor <?php echo htmlspecialchars($_SESSION["username"]); ?>, realice el siguiente proceso para cerrar sesión.</b></h2>
    <hr/>
        <div class="form-group ">
        <h2>Corte de caja</h2>
        <br>
        <?php
            while($row=mysqli_fetch_array($query2)){
        ?>
            <div class="card">
                <div class="container">
                <h3><b>Resumen de operaciones</b></h3> 
                <br>
                <p> Total entradas: $<?php  echo $row['totale']?></p>
                <p> Total salidas: $<?php  echo $row['totals']?></p>
                <br>
                <h3><b> Saldo total en caja: $<?php  echo $row['gtotal']?></b></h3> 
            </div>
            </div>
        <?php 
            }
        ?>
        <p><b>*Compruebe que la cantidad total coincida con la que tiene en caja</b></p>    
        </div> 
        <br>   
        <div class="form-group">
            <h2>Cotizaciones</h2>
            <br>
            <?php
            $sql = "SELECT * FROM crm";
            if ($result=mysqli_query($con,$sql)) {
                $rowcount=mysqli_num_rows($result);
                echo "El número total de cotizaciones pendientes por enviar es: ".$rowcount; 
            }
            ?>
        </div>
        <br>
        <div class="form-group">
            <h2>Check In</h2>
            <br>
            <?php
            $sql = "SELECT * FROM reservaciones";
            if ($result=mysqli_query($con,$sql)) {
                $rowcount=mysqli_num_rows($result);
                echo "El número total de check in realizados durante el turno: ".$rowcount; 
            }
            ?>
        </div> 
        <br>
        <div class="form-group">
        <h2>Devolución de objetos</h2>
        <br>
        <div class="checklist">
		<label><input type="checkbox"> Celular</label>
		<label><input type="checkbox"> Radio</label>
	    </div>
	    </ul>
        </div>
        <br>
        <div class="form-group">
            <h2>Pendientes e indicaciones</h2>
            <p>Pendiente 1</p>
            <input type="int" name="pendiente1" class="form-control">
            <p>Pendiente 2</p>
            <input type="int" name="pendiente2" class="form-control">
            <p>Pendiente 3</p>
            <input type="int" name="pendiente3" class="form-control">
           
        </div> 
        <br>
        
        <div class="form-group">
            <h2>Validó</h2>
            <?php
            $conexion = mysqli_connect("localhost", "root", "", "prueba");

            if (mysqli_connect_errno()) {
                echo "Error al conectar con la base de datos: " . mysqli_connect_error();
                exit();
            }

            $query = "SELECT id, username FROM users";
            $resultado = mysqli_query($conexion, $query);

            echo '<select class="form-control mb-3" name="opciones" required>';

            while ($fila = mysqli_fetch_array($resultado)) {
                echo '<option value="' . $fila['id'] . '">' . $fila['username'] . '</option>';
            }

            echo '</select>';
            mysqli_close($conexion);
            ?>
        </div>
        
        <br><br>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Ingresar">
        </div>
    </form>
</div>  
</body>
</html>