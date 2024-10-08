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

$sql="SELECT * FROM finalizadas WHERE cod_reserva='$id'";
$query=mysqli_query($con,$sql);

$row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reserva Finalizada - Casa Flora Handmade Hotel</title>
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
            .h1{
                text-align: center;
            }

            .huno{
                color: green;
            }
            #div2 {
                height:50px;
                width:400px;
                margin:0px auto;
            }
            .cont{
                display: flex;
                justify-content: right;
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
                        <a class="active" href="checkout.php">CheckOut</a>
                        <a href="cajaint.php">Caja Chica</a>
                        <a href="tarifas.php">Tarifas</a>
                        <a href="cotizacion.php">Cotización</a>
                        <a href="contacto.php">CRM</a>
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
                                <a href="facturacion.php">
                                    <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                </a>
                                </div>
                                <div class="container mt-5 custom-container">
                                <div class="row"> 
                                <div>
                                    <h1 class="h1">Estancia Finalizada</h1>
                                    <br>
                                    <div class="card">
                                    <h4 style="text-align: right;">Reserva: #<?php  echo $row['cod_reserva']?> </h4>
                                    <div class="cont">
                                    <a href="facturaf.php?id=<?php echo $row['cod_reserva'] ?>" target="_blank">
                                        <input class="btn btn-primary btn-lg btn-dark" type="button" value="Facturar">
                                    </a>
                                    </div>
                                    <h2>Resumen:</h2>
                                    <br><br>
                                    <div class="container">
                                    <form action="valco.php" method="POST">
                                    <div class="row">
                                    <div class="col-4">
                                    <input type="hidden" name="cod_reserva" value="<?php echo $row['cod_reserva']  ?>">
                                    <h4><b>Fecha</b></h4>
                                    <input type="int" class="form-control mb-3" name="fecha" placeholder="Fecha" value="<?php  echo $row['fecha']?>" readonly>
                                    <h4><b>Día</b></h4>
                                    <input type="int" class="form-control mb-3" name="dia" placeholder="Día" value="<?php  echo $row['dia']?>" readonly>
                                    <h4><b>Llegada</b></h4>
                                    <input type="int" class="form-control mb-3" name="llegada" placeholder="Llegada" value="<?php  echo $row['llegada']?>" readonly>
                                    <h4><b>Salida</b></h4>
                                    <input type="int" class="form-control mb-3" name="salida" placeholder="Salida" value="<?php  echo $row['salida']?>" readonly>
                                    </div>
                                    <div class="col-4">
                                    <h4><b>Cliente</b></h4>
                                    <input type="int" class="form-control mb-3" name="cliente" placeholder="Cliente" value="<?php  echo $row['cliente']?>" readonly>
                                    <h4><b>Habitación</b></h4>
                                    <input type="int" class="form-control mb-3" name="habitacion" placeholder="Habitacion" value="<?php  echo $row['habitacion']?>" readonly>    
                                    <h4><b>Tarifa</b></h4>
                                    <input type="int" class="form-control mb-3" name="tarifa" placeholder="Tarifa" value="<?php  echo $row['tarifa']?>" readonly>
                                    <h4><b>Número de huéspedes</b></h4>
                                    <input type="int" class="form-control mb-3" name="huespedes" placeholder="Huespedes" value="<?php  echo $row['huespedes']?>" readonly>
                                    </div>
                                    <div class="col-4">
                                    <h4><b>Anticipo</b></h4>
                                    <input type="int" class="form-control mb-3" name="anticipo" placeholder="Anticipo" onkeypress="return event.charCode>=48 && event.charCode<=57" value="<?php  echo $row['anticipo']?>" readonly>
                                    <h4><b>Reserva Vía</b></h4>
                                    <input type="int" class="form-control mb-3" name="via" placeholder="Vía" value="<?php  echo $row['via']?>" readonly>
                                    <h4><b>Servicios Especiales</b></h4>
                                    <input type="int" class="form-control mb-3" name="sextras" placeholder="Servicios Especiales" required value="<?php  echo $row['sextras']?>" readonly>
                                    <h4><b>Número de noches</b></h4>
                                    <input type="int" class="form-control mb-3" name="noches" placeholder="Noches" onkeypress="return event.charCode>=48 && event.charCode<=57" value="<?php  echo $row['noches']?>" readonly>
                                    </div>
                                    <div class="col-4">
                                    <h4><b>Consumos Extras</b></h4>
                                    <input type="int" class="form-control mb-3" name="cextras" placeholder="Consumos Extras" value="<?php  echo $row['cextras']?>" readonly>
                                    </div>
                                    <div class="col-4">
                                    <h4><b>Garantía</b></h4>
                                    <input type="int" class="form-control mb-3" name="garantia" placeholder="Garantía" value="<?php  echo $row['garantia']?> ($400.00 DEVUELTO)" readonly>
                                    </div>
                                    <div class="col-4">
                                    <h4><b>Total</b></h4>
                                    <input type="int" class="form-control mb-3" name="total" placeholder="Total" value="<?php  echo $row['total']?> (PAGADO)" readonly>
                                    </div>
                                    <br><br>
                                    <br><br>
                                    </form>
                                    </div>
                                </div>
                                <br>
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