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

$sql="SELECT * FROM cotizaciones WHERE cod_reserva='$id'";
$query=mysqli_query($con,$sql);

$row=mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Información para contacto - Casa Flora Handmade Hotel</title>
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
        <link rel="stylesheet" href="css/button2.css">
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
        <script>
            function copiarAlPortapapeles(p1) {
            var aux = document.createElement("input");
            aux.setAttribute("value", document.getElementById("p1").innerHTML);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");
            document.body.removeChild(aux);
            }
        </script>
        <style>
            .custom-container {
                max-width: 1600px; /* Ajusta el valor según tus necesidades */
                margin: 0 auto; /* Centra el contenido horizontalmente */
            }
            .logo-img {
            max-width: 50px; /* Ajusta el valor según tus necesidades */
            }
            .h3{
                text-align: center;
            }
            .h2{
                text-align: center;
            }

            .h1{
                text-align: center;
                color: green;
            }
            .p{
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
                        <a class="active" href="contacto.php">CRM</a>
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
                                <h1 style="text-align: center;"><b>Contacto</b></h1>
                                <div style="text-align: left;">
                                <!--<a href="https://wa.me/<?php  echo $row['telefono']?>?" target="_blank">
                                    <button class="btn btn-success">Enviar por Whatsapp</button>
                                </a>-->
                                <a href="https://mail.google.com/mail/?to=<?php echo $row['email'] ?>&subject=Asunto%20por%20defecto&body=Este%20es%20un%20correo%20electr%C3%B3nico%20precargado." class="btn-wsp-top" target="_blank">
                                    <i class="fa fa-envelope-o"></i>
                                </a>

                                <a href="https://api.whatsapp.com/send?phone=<?php  echo $row['telefono']?>" class="btn-wsp" target="_blank">
                                    <i class="fa fa-whatsapp icono"></i>
                                </a>
                                <a href="contacto.php">
                                    <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                </a>
                                </div>
                                <hr>
                                <!--<div style="text-align: right;">
                                <button onclick="copiarAlPortapapeles('p1')">Copiar</button>
                                </div>-->
                                <br>

                                <!-- Agrega un div con el atributo contenteditable para hacer el texto editable -->
                                <div class="p" id="p1" contenteditable="true">
                                    Buen día Sr(a) <?php echo $row['cliente']; ?>, nos comunicamos de Hotel Casa Flora en Atlixco para su COTIZACIÓN<br>
                                    <br>Check in: <?php echo date_format(date_create($row['fecha']), 'd-m-Y'); ?> (Se realiza desde las 3 pm)<br>
                                    Check out: <?php echo date_format(date_create($row['salida']), 'd-m-Y'); ?> (Se realiza a las 12 Hrs)<br>
                                    <br>Habitación: <?php echo $row['habitacion']; ?>, Servicios Especiales: <?php echo $row['sextras']; ?>, Número de huéspedes: <?php echo $row['huespedes']; ?>, Número de noches: <?php echo $row['noches']; ?>, Por un total de:<br> 
                                    <br>$<?php echo $row['total']; ?>.00 M.N.<br>
                                    <br>La tarifa incluye IVA e impuestos locales, WiFi, estacionamiento, amenidades, sesión de Netflix o Roku y desayuno saludable para todas las personas.<br><br>
                                    • *Se prohíben alimentos y bebidas ajenas al hotel*<br><br>
                                    • *A su llegada le solicitaremos un depósito de seguridad de $400.00 o bien, una identificación oficial que se le devolverá a la salida*
                                </div>


                                
                                <!--<h2 id="p1" class="h2">Buen día Sr(a) <?php  echo $row['cliente']?> nos comunicamos de Hotel Casa Flora en Atlixco por su reservación para el día <?php  echo $row['fecha']?></h2>
                                <br><br>
                                <h1 id="p2" class="h2">Check in: <?php  echo $row['fecha']?></h1>
                                <h1 id="p3" class="h2">Check out: <?php  echo $row['salida']?></h1>
                                <br><br>
                                <h1 id="p4" class="h2">Habitación: <?php  echo $row['habitacion']?>, Servicios Especiales: <?php  echo $row['sextras']?>, Número de huéspedes: <?php  echo $row['huespedes']?>, Número de noches: <?php  echo $row['noches']?>, Por un total de: </h1>
                                <br>
                                <h1 id="p5" class="h1">$<?php  echo $row['total']?>.00 M.N.</h1>
                                <br>
                                <h3 id="p6" class="h3">La tarifa incluye IVA e impuestos locales, WiFi, estacionamiento, amenidades, sesión de Netflix o Roku y desayuno saludable para todas las personas.</h3>
                                <br><br>
                                <h3 id="p7" class="h3">*Se prohíben alimentos y bebidas ajenas al hotel*</h3>
                                <br>
                                <h3 id="p8" class="h3">*A su llegada le solicitaremos un depósito de seguridad de $400.00 o bien, una identificación oficial que se le de<i class="fa1 fa fa-arrow-left"></i>á a la salida*</h3>-->
            
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