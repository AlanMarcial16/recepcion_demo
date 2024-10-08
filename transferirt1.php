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

    $id=$_GET['id'];

    // Verificar si se ha enviado el ID del ticket en la URL
if(isset($_GET['id'])) {
    $ticket_id = $_GET['id'];
    echo "ID del ticket recibido: " . $ticket_id;
} else {
    echo "No se proporcionó un ID de ticket.";
}

    $sql="SELECT * FROM reservaciones WHERE cod_reserva='$id'";
    $query=mysqli_query($con,$sql);
    
    $row=mysqli_fetch_array($query);
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Agregar anticipo - Casa Flora Handmade Hotel</title>
    <link rel="shortcut icon" href="https://static.wixstatic.com/media/9ed84f_b72e16d4242e4e97a54c4945ac674912~mv2.png/v1/fill/w_50,h_50,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/9ed84f_b72e16d4242e4e97a54c4945ac674912~mv2.png">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/hyf.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <!-- Bootstrap Stylesheets -->
	    <link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/responsive.css?v=2">
	    <!-- Font Awesome Stylesheets -->
	    <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/design.css?v=2">
        <link rel="stylesheet" href="css/estilo4.css">
        <link rel="stylesheet" href="css/estilo8.css">
	    <!-- Template Main Stylesheets -->
	    <link rel="stylesheet" href="css/contact-form.css" type="text/css">	
        <!--SWEET ALERT-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>	
        <!--SWEET ALERT-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <style>
            .custom-container {
                max-width: 1600px; /* Ajusta el valor según tus necesidades */
                margin: 0 auto; /* Centra el contenido horizontalmente */
            }
            .logo-img {
            max-width: 50px; /* Ajusta el valor según tus necesidades */
            }
            .button1 {
                background-color: #4CAF50; 
                border: none;
                color: white;
                padding: 10px 30px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 18px;
                margin: 4px 2px;
                cursor: pointer;
            }
            
            .button2 {
                background-color: #f44336; 
                border: none;
                color: white;
                padding: 10px 30px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 18px;
                margin: 4px 2px;
                cursor: pointer;
            } 

            .button3 {
                background-color: #1e90ff; 
                border: none;
                color: white;
                padding: 10px 30px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 18px;
                margin: 4px 2px;
                cursor: pointer;
            }    

            .h1{
                text-align: center;
            }
            .h2{
                text-align: center;
            }
            table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            table-layout:fixed;
            }

            td, th {
            border: 1px solid black;
            text-align: center;
            padding: 0.5% 0;
            overflow:hidden;
            width: 50;
            white-space:nowrap;
            }

            .thd{
                text-align: justify;
            }

            .thx{
                text-align: left;
            }

            tr:nth-child(even) {
            background-color: #dddddd;
            }
            .thc{
                font-size: 50px;
            }

            .btn {
            background-color: DodgerBlue;
            border: none;
            color: white;
            padding: 12px 16px;
            font-size: 16px;
            cursor: pointer;
            }
            .btnp {
            background-color: Green;
            border: none;
            color: white;
            padding: 12px 16px;
            font-size: 16px;
            cursor: pointer;
            }

            .btnc {
            background-color: Red;
            border: none;
            color: white;
            padding: 12px 16px;
            font-size: 16px;
            cursor: pointer;
            }

            .btni {
            background-color: #669999;
            border: none;
            color: white;
            padding: 12px 16px;
            font-size: 16px;
            cursor: pointer;
            }
            /* Darker background on mouse-over */
            .btn:hover {
            background-color: Black;
            }
            /* Darker background on mouse-over */
            .btnp:hover {
            background-color: Black;
            }
            /* Darker background on mouse-over */
            .btnc:hover {
            background-color: Black;
            }

            .h4{
                text-align: center;
            }
        </style>
    </head>
    <body>
            <div class="header">
                <a href="inicio.php" class="logo">
                    <img src="https://static.wixstatic.com/media/9ed84f_e9388ac15d374e77aa9c89cdb80e014a~mv2.png" alt="Logo" class="logo-img">
                    <?php echo htmlspecialchars($_SESSION["username"]); ?> - Demo
                    <span style="font-size: 3vw; font-weight: bold; color: red; display: block; text-align: center; margin-top: 10px;">
            CAPACITACIÓN
        </span>
                </a>
                    <div class="header-right">
                        <a href="ocupacion.php">Calendario</a>
                        <a href="checkout.php">CheckOut</a>
                        <a href="cajaint.php">Caja Chica</a>
                        <a href="tarifas.php">Tarifas</a>
                        <a href="cotizacion.php">Cotización</a>
                        <a href="contacto.php">CRM</a>
                        <a href="facturacion.php">Facturación</a>
                        <a href="incidencias.php">Incidencias</a>
                        <a href="gastos.php">Gastos</a>
                        <a onclick="validarCerrarSesion()">Cerrar sesión</a>
                        <script>
                        function validarCerrarSesion() {
    // Realizar una solicitud AJAX al servidor para obtener el estado de las mesas
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var mesas = JSON.parse(xhr.responseText);
            verificarEstadoMesas(mesas);
        }
    };
    xhr.open("GET", "obtener_estado_mesas.php", true);
    xhr.send();
}

function verificarEstadoMesas(mesas) {
    var algunaOcupada = false;

    for (var i = 0; i < mesas.length; i++) {
        if (mesas[i].estado === 'Ocupada') {
            algunaOcupada = true;
            break;
        }
    }

    if (algunaOcupada) {
        Swal.fire({
            title: 'No se puede cerrar sesión',
            text: 'Hay mesas ocupadas, comuníquese con el operador de terraza para poder liberarlas y cerrar sesión.',
            icon: 'error',
        });
    } else {
        salir();
    }
}

function salir() {
    Swal.fire({
        title: '¿Está seguro?',
        text: "¿Desea salir?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, salir',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Aquí puedes colocar el código para cerrar la ventana o redireccionar a otra página
            window.location.href = 'cerrarsesion.php';
        }
    })
}
                        </script>
                    </div>
            </div>
            <div class="container mt-5 custom-container">
                    <div class="row"> 
                        <div>
                                <div style="text-align: right;">
                                <script>
                                    var options2 = {
                                        weekday: 'long',
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric'
                                    };

                                    var date = new Date().toLocaleDateString('es-ES', options2);
                                    var formattedDate = date.replace(/^\w/, (c) => c.toUpperCase());
                                    var styledDate = "<strong>" + formattedDate + "</strong>";
                                    
                                    document.write(styledDate);
                                </script>
                                </div>
                                <h1 style="text-align: center;"><b>Seleccione la habitación destino</b></h1>
                                <div style="text-align: left;">
                                <a href="transft1.php?id=<?php  echo $row['cod_reserva']?>">
                                    <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                </a>
                                </div>
                                <hr>

                                <style>
                                    /* Estilos para centrar el contenido del formulario */
                                    form {
                                        text-align: center;
                                    }

                                    /* Estilos para el selector */
                                    select {
                                        width: 300px; /* Ancho del selector */
                                        padding: 10px; /* Espaciado interno */
                                        font-size: 16px; /* Tamaño de fuente */
                                        margin-bottom: 20px; /* Margen inferior */
                                    }

                                    /* Estilos para el botón */
                                    button {
                                        padding: 15px 30px; /* Espaciado interno */
                                        font-size: 18px; /* Tamaño de fuente */
                                    }
                                </style>

                                <br>

                                <?php
// Conexión a la base de datos 'prueba_demor' (tickets)
$servername_tickets = "localhost";
$username_tickets = "root";
$password_tickets = "";
$database_tickets = "prueba_demor";
$conn_tickets = mysqli_connect($servername_tickets, $username_tickets, $password_tickets, $database_tickets);

if (!$conn_tickets) {
    die("Conexión fallida a la base de datos 'prueba_demor': " . mysqli_connect_error());
}

// Conexión a la base de datos 'prueba_demo' (reservaciones)
$servername_reservaciones = "localhost";
$username_reservaciones = "root";
$password_reservaciones = "";
$database_reservaciones = "prueba_demo";
$conn_reservaciones = mysqli_connect($servername_reservaciones, $username_reservaciones, $password_reservaciones, $database_reservaciones);

if (!$conn_reservaciones) {
    die("Conexión fallida a la base de datos 'prueba_demo': " . mysqli_connect_error());
}

// Obtener los datos de la tabla reservaciones
$sql_reservaciones = "SELECT cliente, habitacion FROM reservaciones";
$result_reservaciones = mysqli_query($conn_reservaciones, $sql_reservaciones);

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores seleccionados del formulario
    $cliente_habitacion = explode("||", $_POST["cliente"]);
    $cliente = $cliente_habitacion[0];
    $habitacion = $cliente_habitacion[1];
    
    // Verificar si el ID del ticket está presente en la URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $ticket_id = $_GET['id'];
    
        echo "ID del ticket: " . $ticket_id; // Mostrar el id para verificar
    
        // Actualizar la tabla tickets con los nuevos valores utilizando el ID del ticket
        $sql_update = "UPDATE prueba_demor.tickets SET habitacion='$habitacion', comensal='$cliente' WHERE id=$ticket_id";
        if (mysqli_query($conn_tickets, $sql_update)) {
            echo "Ticket actualizado correctamente.";
        } else {
            echo "Error al actualizar el ticket: " . mysqli_error($conn_tickets);
        }
    } else {
        echo "No se proporcionó un ID de ticket válido.";
    }
    
}

?>

<form method="post" action="actualizar_ticket2.php?id=<?php echo $_GET['id']; ?>">
    <label for="cliente">Cliente:</label>
    <select name="cliente" id="cliente">
        <?php
            // Generar opciones de cliente
            while ($row_reservacion = mysqli_fetch_assoc($result_reservaciones)) {
                echo "<option value='" . $row_reservacion['cliente'] . "||" . $row_reservacion['habitacion'] . "'>" . $row_reservacion['cliente'] . " - " . $row_reservacion['habitacion'] . "</option>";
            }
        ?>
    </select>
    <br><br>
    <label for="habitacion">Habitación:</label>
    <input type="text" name="habitacion" id="habitacion" readonly>
    <br><br>
    <input type="submit" value="Actualizar Ticket">
</form>

<script>
// JavaScript para actualizar el valor de la habitación según la selección del cliente
document.getElementById("cliente").addEventListener("change", function() {
    var selectedOption = this.value.split("||");
    var selectedClient = selectedOption[0];
    var selectedRoom = selectedOption.length > 1 ? selectedOption[1] : "";
    document.getElementById("habitacion").value = selectedRoom;
});
</script>

<?php
    // Cerrar la conexión a las bases de datos
    mysqli_close($conn_tickets);
    mysqli_close($conn_reservaciones);
?>


                           
                                
                        </div>
                    </div>
                    </div>  
            </div>
            
    </body>
    <!--Fin de la página-->
    <br><br>
    <footer class="footer">
          <p><b>Hotel Casa Flora Atlixco, Todos los derechos reservados &copy; 2022</b></p>
    </footer>
</html>