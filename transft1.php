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

$sql="SELECT * FROM reservaciones WHERE cod_reserva='$id'";
$query=mysqli_query($con,$sql);

$row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="js/alerta2.js"></script>
        <title>Realizar Check In - Casa Flora Handmade Hotel</title>
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
        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <!--SCRIPT PARA LLENADO AUTOMÁTICO DE SELECTS 2 -->
        <style>
            .custom-container {
                max-width: 1600px; /* Ajusta el valor según tus necesidades */
                margin: 0 auto; /* Centra el contenido horizontalmente */
            }
            
            .logo-img {
            max-width: 50px; /* Ajusta el valor según tus necesidades */
            }
            table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            table-layout:fixed;
            }

            td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 0.5% 0;
            overflow:hidden;
            width: 50;
            white-space:nowrap;
            }

            tr:nth-child(even) {
            background-color: #dddddd;
            }
        </style>
    </head>
    <body>
            <div class="header">
                <a href="inicio.php" class="logo">
                    <img src="https://static.wixstatic.com/media/9ed84f_e9388ac15d374e77aa9c89cdb80e014a~mv2.png" alt="Logo" class="logo-img">
                    <?php echo htmlspecialchars($_SESSION["username"]); ?>
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
                                <h1 style="text-align: center;"><b>Transferir Tickets</b></h1>
                                <div style="text-align: left;">
                                <a href="insertarpos.php?id=<?php echo $row['cod_reserva']?>">
                                    <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                </a>
                                </div>
                                <div class="row"> 
                                    <!-- Cambios 25 de noviembre-->
                                    <div>
                                    <br><br>
                                    <?php
$servername1 = "localhost";
$username1 = "root";
$password1 = "";
$database1 = "prueba_demor";

$servername2 = "localhost";
$username2 = "root";
$password2 = "";
$database2 = "prueba_demo";

$conn1 = mysqli_connect($servername1, $username1, $password1, $database1);
$conn2 = mysqli_connect($servername2, $username2, $password2, $database2);

if (!$conn1 || !$conn2) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$id = $_GET['id'];

$sql_reservaciones = "SELECT * FROM reservaciones WHERE cod_reserva = '$id'";
$result_reservaciones = mysqli_query($conn2, $sql_reservaciones);

echo "<table>";
echo "<thead class='table-success table-striped'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Ticket</th>";
echo "<th>Habitación</th>";
echo "<th>Comensal</th>";
echo "<th colspan='2'>Status</th>";
echo "<th>Fecha y Hora</th>";
echo "<th colspan='2'>Acciones</th>"; // Colspan para fusionar las celdas de Acciones
echo "</tr>";
echo "</thead>";
echo "<tbody>";

while ($row_reservacion = mysqli_fetch_assoc($result_reservaciones)) {
    $habitacion = $row_reservacion['habitacion'];
    $comensal = $row_reservacion['cliente'];

    $sql_tickets = "SELECT * FROM tickets WHERE habitacion = '$habitacion' AND comensal = '$comensal'";
    $result_tickets = mysqli_query($conn1, $sql_tickets);

    while ($row_ticket = mysqli_fetch_assoc($result_tickets)) {
        $fyh = $row_ticket['fyh']; // Obtenemos la fecha y hora del ticket
        $status = ''; // Inicializamos el status

        // Decodificamos los datos JSON del ticket
        $datos_ticket = json_decode($row_ticket['datos_json'], true);

        // Verificamos el mensaje del ticket para determinar el status
        if (isset($datos_ticket[0]['mensaje'])) {
            $mensaje = $datos_ticket[0]['mensaje'];
            if ($mensaje === "Mandado a la habitación" || $mensaje === "PAGADO AL MOMENTO" || $mensaje === "Servicios especiales") {
                $status = $mensaje;
            }
        }

        // Verificar el ID del ticket
        echo "<tr>";
        echo "<td>ID del ticket: " . $row_ticket['id'] . "</td>"; // Agregamos esta línea para verificar el ID del ticket
        echo "<td>{$row_ticket['datos_json']}</td>";
        echo "<td>{$row_ticket['habitacion']}</td>";
        echo "<td>{$row_ticket['comensal']}</td>";
        echo "<td colspan='2'>$status</td>";
        echo "<td>{$row_ticket['fyh']}</td>";
        echo "<td><a href='transferirt1.php?id={$row_ticket['id']}'>Transferir</a></td>";
        echo "<td><a href='#' class='delete-btn' data-id='{$row_ticket['id']}'>Eliminar</a></td>"; // Acción de eliminar
        echo "</tr>";
    }
}

echo "</tbody>";
echo "</table>";

mysqli_close($conn1);
mysqli_close($conn2);
?>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.delete-btn').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const ticketId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Estás seguro?',
                text: "¿Deseas eliminar este ticket?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Introduce la contraseña',
                        input: 'password',
                        inputLabel: 'Contraseña',
                        inputPlaceholder: 'Introduce la contraseña',
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Enviar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if (result.value === '020799') {
                                window.location.href = 'eliminar_ticket.php?id=' + ticketId;
                            } else {
                                Swal.fire('Contraseña incorrecta', '', 'error');
                            }
                        }
                    });
                }
            });
        });
    });
});
</script>


                                    </div>
                                </div>
                        </div>
                    </div>
                    </div>  
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