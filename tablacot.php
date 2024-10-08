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

    $sql="SELECT *  FROM cotizaciones";
    $query=mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cotizaciones - Casa Flora Handmade Hotel</title>
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
        <style>
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
        .custom-container {
            max-width: 1600px; /* Ajusta el valor según tus necesidades */
            margin: 0 auto; /* Centra el contenido horizontalmente */
        }

        </style>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
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
                        <a class="active" href="cotizacion.php">Cotización</a>
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
                            <h1 style="text-align: center;"><b>Tabla de cotizaciones</b></h1>
                            <div style="text-align: left;">
                                <a href="cotizacion.php">
                                    <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                </a>
                                <a href="vaciartabla.php">
                                    <button class="btn info">Vaciar tabla</button>
                                </a>
                                
                            </div>
                            <br>
                            <!-- Tabla de incidencias -->
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
$sql = "SELECT * FROM cotizaciones";

// Agregar condiciones según el filtro seleccionado
if ($filter === 'hoy') {
    $sql .= " WHERE fecha = CURDATE()";
} elseif ($filter === 'mes') {
    $sql .= " WHERE MONTH(fecha) = MONTH(CURDATE())";
} elseif ($filter === 'semana') {
    $sql .= " WHERE YEARWEEK(fecha, 1) = YEARWEEK(CURDATE(), 1)";
}

// Ordenar las Cotizaciones por fecha descendente
$sql .= " ORDER BY fecha DESC";

// Ejecutar la consulta
$query = mysqli_query($conn, $sql);
?>

<div class="filter-section">
    <label for="filter">Filtrar cotizaciones:</label>
    <select id="filter" onchange="applyFilter()">
        <option value="">Seleccione una opción</option>
        <option value="">Todas las Cotizaciones</option>
        <option value="hoy">Cotizaciones para hoy</option>
        <option value="mes">Cotizaciones por mes</option>
        <option value="semana">Cotizaciones por semana</option>
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

<table>
    <thead class="table-success table-striped">
        <tr>
            <th>Fecha</th>
            <th>Nombre</th>
            <TH>Habitación</TH>
            <th>Medio de contacto</th>
            <th>Info</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_array($query)): ?>
        <tr>
            <td><?php echo date("d/m/Y", strtotime($row['fecha'])); ?></td> <!-- Formato de fecha ajustado -->
            <td><?php echo htmlspecialchars($row['cliente']); ?></td>
            <td><?php echo htmlspecialchars($row['habitacion']); ?></td>
            <td><?php echo htmlspecialchars($row['medio_contacto']); ?></td>
            <td><a href="infocot.php?id=<?php echo urlencode($row['cod_reserva']); ?>" class="btni fa fa-eye"></a></td>
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
            
    </body>
    <!--Fin de la página-->
    <br><br>
    <footer class="footer">
          <p><b>Hotel Casa Flora Atlixco, Todos los derechos reservados &copy; 2022</b></p>
    </footer>
</html>