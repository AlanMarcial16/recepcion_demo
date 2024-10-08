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

    $sql="SELECT *  FROM crm";
    $query=mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CRM - Casa Flora Handmade Hotel</title>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX=" crossorigin="anonymous" />
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
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
            .thc{
                background-color: Red;
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
            font-size: 20px;
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

            .button3 {
                background-color: red; 
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
                        <a class="active" href="contacto.php">CRM</a>
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
                            <h1 style="text-align: center;"><b>CRM</b></h1>
                            <br>
                            <div style="text-align: right;">
                                <a href="vaciartabla.php">
                                    <button class="button3" disabled>Vaciar tabla</button>
                                </a>
                            </div>
                            <br>
                            <?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "prueba_demo";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtener el valor seleccionado del filtro
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Consulta SQL base
$sql = "SELECT * FROM crm";

// Agregar condiciones según el filtro seleccionado
if ($filter === 'hoy') {
    $sql .= " WHERE DATE(fecha) = CURDATE()";
} elseif ($filter === 'mes') {
    $sql .= " WHERE MONTH(fecha) = MONTH(CURDATE())";
} elseif ($filter === 'semana') {
    $sql .= " WHERE YEARWEEK(fecha, 1) = YEARWEEK(CURDATE(), 1)";
}

// Ordenar los datos de contacto por fecha descendente
$sql .= " ORDER BY fecha DESC";

// Ejecutar la consulta
$query = mysqli_query($conn, $sql);
?>

<div class="filter-section">
    <label for="filter">Filtrar datos de contacto:</label>
    <select id="filter" onchange="applyFilter()">
        <option value="">Seleccione una opción</option>
        <option value="">Todos los datos de contacto</option>
        <option value="hoy">Datos de contacto de hoy</option>
        <option value="mes">Datos de contacto del mes</option>
        <option value="semana">Datos de contacto de la semana</option>
    </select>
</div>

<script>
    function applyFilter() {
        var filter = document.getElementById("filter").value;
        var url = new URL(window.location.href);
        url.searchParams.set('filter', filter);
        window.location.href = url.toString();
    }
</script>

<?php
// Consulta SQL para obtener los datos ordenados por fecha en orden descendente
$query = mysqli_query($conn, "SELECT * FROM cotizaciones ORDER BY cod_reserva DESC");

if (!$query) {
    die('Error en la consulta: ' . mysqli_error($conn));
}
?>

<table>
    <thead class="table-success table-striped">
        <tr>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Correo Electrónico</th>
            <th>Teléfono</th>
            <th>Habitación</th>
            <th>Medio de Contacto</th>
            <th colspan="2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_array($query)): ?>
        <tr>
            <td><?php echo date("d/m/Y", strtotime($row['fecha'])); ?></td> <!-- Formato de fecha ajustado -->
            <td><?php echo htmlspecialchars($row['cliente']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['telefono']); ?></td>
            <td><?php echo htmlspecialchars($row['habitacion']); ?></td>
            <td>
                <?php
                $medio_contacto = htmlspecialchars($row['medio_contacto']);
                switch($medio_contacto) {
                    case 'Teléfono':
                        echo '<img src="https://img.icons8.com/ios-filled/30/000000/phone.png" alt="Teléfono" title="Teléfono">';
                        break;
                    case 'Correo Electrónico':
                        echo '<img src="https://img.icons8.com/ios-filled/30/000000/email.png" alt="Correo Electrónico" title="Correo Electrónico">';
                        break;
                    case 'Red Social':
                        echo '<img src="https://img.icons8.com/ios-filled/30/000000/facebook-new.png" alt="Red Social" title="Red Social">';
                        break;
                    default:
                        echo 'No definido';
                }
                ?>
            </td>
            <td><a href="infocont.php?id=<?php echo urlencode($row['cod_reserva']); ?>" class="btni fa fa-whatsapp"> Enviar</a></td>
            <td><a href="exp4.php?cod_reserva=<?php echo urlencode($row['cod_reserva']); ?>" class="btni fa fa-calendar-check-o"> Reservar</a></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
mysqli_close($conn);
?>

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