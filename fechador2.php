<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

// Conexión a la base de datos MySQL
include("conexion.php");
    $con=conectar();


    // Leer las fechas enviadas desde el formulario
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Construir la consulta SQL para seleccionar los registros entre las fechas
    $sql = "SELECT * FROM finalizadas WHERE fecha BETWEEN '$fecha_inicio' AND '$fecha_fin' ORDER BY fecha ASC";
    $query = mysqli_query($con, $sql);

    $sql2="SELECT *  FROM finalizadas ORDER BY fecha DESC";
    $query2=mysqli_query($con,$sql2);


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Resultados de la búsqueda - Casa Flora Handmade Hotel</title>
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
        .thc{
            background-color: Red;
        }

        .btnch {
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
        .h1{
            text-align:center;
        }
        </style>
        
    </head>
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
                                <div style="text-align: left;">
                                <a href="fbuscar2.php">
                                    <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                </a>
                                </div>
                                <br>
                                <h1 class="h1"><b>Finalizadas</b></h1>
                                <br>
                                <hr>
                                <h1 class="h3">Resultados de la búsqueda:</h1>
                                <br>
                                <table>
                                        <thead class="table-success table-striped">
                                            <tr>
                                                <th>Info</th>
                                                <th colspan="2">Cliente</th>
                                                <th colspan="2">Llegada</th>
                                                <th colspan="2">Salida</th>
                                                <TH colspan="2">Habitación</TH>
                                                <th>Huéspedes</th>
                                                <th>Noches</th>
                                                <th>Total</th>
                                                <th>Garantía</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row=mysqli_fetch_array($query)){
                                        ?>
                                        <tr>
                                            <th><a href="infores2.php?id=<?php echo $row['cod_reserva'] ?>" class="btni fa fa-eye"></a></th>
                                            <th colspan="2"><?php  echo $row['cliente']?></th>
                                            <th colspan="2"><?php  echo $row['fecha']?></th>
                                            <th colspan="2"><?php  echo $row['salida']?></th>
                                            <th colspan="2"><?php  echo $row['habitacion']?></th>
                                            <th><?php  echo $row['huespedes']?></th>
                                            <th><?php  echo $row['noches']?></th>
                                            <th>$<?php  echo $row['total']?></th>
                                            <th><?php  echo $row['garantia']?></th>
                                            
                                        </tr>
                                        <?php 
                                        } 
                                        ?>
                                </tbody>
                                </table>
                                <br><br>
                                <br><br>
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

