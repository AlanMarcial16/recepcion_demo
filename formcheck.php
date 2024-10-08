<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
} 
include("conexion.php");
$con = conectar();

include("conexion2.php");
$con2 = conectar2();

    $id=$_GET['id'];

    $sql="SELECT * FROM reservaciones WHERE cod_reserva='$id'";
    $query=mysqli_query($con,$sql);

    $row=mysqli_fetch_array($query);

    $sql2 = "SELECT *  FROM mesas";
    $query2 = mysqli_query($con2, $sql2);

    $consumo_abierto = false;

    while ($mesa = mysqli_fetch_array($query2)) {
        if (
            $row['cliente'] == $mesa['comensal'] &&
            $row['habitacion'] == $mesa['habitacion']
        ) {
            $consumo_abierto = true;
            break;
        }
    }

    $color = $consumo_abierto ? 'red' : 'green';
    $simbolo = $consumo_abierto ? '⚠️' : '✅';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Realizar Check Out - Casa Flora Handmade Hotel</title>
        <link rel="shortcut icon" href="https://static.wixstatic.com/media/9ed84f_b72e16d4242e4e97a54c4945ac674912~mv2.png/v1/fill/w_50,h_50,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/9ed84f_b72e16d4242e4e97a54c4945ac674912~mv2.png">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/hyf.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>
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
                                <h1 style="text-align: center;"><b>Check Out</b></h1>
                                <div style="text-align: left;">
                                <a href="checkout.php">
                                    <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                </a>
                                </div>
                                <div class="container mt-5 custom-container">
                                <div class="row"> 
                                    <div>
                                    <h1>Información de la reserva de: <?php  echo $row['cliente']?></h1>
                                    <h2></h2>
                                    <div class="cont">
                                    <a href="factura.php?id=<?php echo $row['cod_reserva'] ?>" target="_blank">
                                        <input class="btn btn-primary btn-lg btn-dark" type="button" value="Facturar">
                                    </a>
                                    </div>
                                    <div class="card">
                                    <h4 style="text-align: right;">Reserva: #<?php  echo $row['cod_reserva']?> </h4>
                                    <br>
                                    <div class="container">
                                        <div class="row">
                                        <div class="col-3">
                                        <h4><b>Nombre</b></h4> 
                                        <input type="text" class="form-control mb-3" name="cliente" placeholder="Cliente" value="<?php  echo $row['cliente']?>" readonly>
                                        </div>
                                        <div class="col-3">
                                        <h4><b>Habitación</b></h4>  
                                        <input type="text" class="form-control mb-3" name="habitacion" placeholder="Habitación" value="<?php  echo $row['habitacion']?>" readonly>
                                        </div>
                                        <div class="col-3">
                                        <h4><b>Salida</b></h4>
                                        <input type="text" class="form-control mb-3" name="salida" placeholder="Salida" value="<?php  echo $row['salida']?>" readonly>
                                        </div>
                                        <div class="col-3">
                                        <h4><b>Servicios Especiales</b></h4>
                                        <input type="text" class="form-control mb-3" name="sextras" placeholder="Servicios Especiales" value="<?php  echo $row['sextras']?>" readonly>
                                        </div>
                                        </div>
                                        <br><br>
                                        <h1 style="<?php echo ($row['textras'] < 0) ? 'color: red;' : '' ?>">
                                        <b>Consumos extra: $<?php echo $row['textras']?>.00 M.N.</b>
                                        <h1 style="<?php echo ($row['total'] < 0) ? 'color: red;' : '' ?>">
                                        <b>Habitación: $<?php echo $row['total']?>.00 M.N.</b>
                                    </h1>
                                    <div style="text-align: right;">
                                        <a href="cobrarc.php?id=<?php echo $row['cod_reserva'] ?>">
                                            <button class="btn danger">Cobrar</button>
                                        </a>
                                        
                                        <a href="verificahab.php?id=<?php echo $row['cod_reserva'] ?>" id="checkoutLink" data-consumo="<?php echo $consumo_abierto ? '1' : '0'; ?>" data-cextras="<?php echo $row['cextras']; ?>">
                                            <button class="btn success" id="checkoutButton">Comenzar Checkout</button>
                                        </a>
                                    </div>

                                    

                                    <script>
                                        document.getElementById('checkoutButton').addEventListener('click', function (event) {
                                            event.preventDefault(); // Evita la acción por defecto (navegar al enlace)

                                            // Verifica si hay consumo abierto
                                            var consumoAbierto = document.getElementById('checkoutLink').getAttribute('data-consumo') === '1';

                                            // Verifica si cextras es diferente de 0
                                            var cextrasDiferenteDeCero = parseInt(document.getElementById('checkoutLink').getAttribute('data-cextras')) !== 0;

                                            if (consumoAbierto) {
                                                // Muestra el mensaje al pulsar el botón si hay un consumo abierto
                                                Swal.fire({
                                                    icon: 'warning',
                                                    title: 'Ticket Abierto',
                                                    text: 'Esta reserva tiene un ticket abierto, comuníquese con el operador de terraza.',
                                                });
                                            } else if (cextrasDiferenteDeCero) {
                                                // Muestra el mensaje si cextras es diferente de 0
                                                Swal.fire({
                                                    icon: 'warning',
                                                    title: 'Se requiere liquidar la cuenta',
                                                    text: 'Por favor, liquide la cuenta para continuar.',
                                                });
                                            } else {
                                                // Si no hay consumo abierto y cextras es 0, redirige al enlace de checkout
                                                window.location.href = document.getElementById('checkoutLink').getAttribute('href');
                                            }
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
            </div>
            <style>
                .btn-wsp {
                    position: fixed;
                    width: 60px;
                    height: 60px;
                    line-height: 63px;
                    bottom: 70px; /* Ajusta este valor para cambiar la posición vertical */
                    right: 25px;
                    background: <?php echo $color; ?>;
                    color: #FFF;
                    border-radius: 50px;
                    text-align: center;
                    font-size: 35px;
                    box-shadow: 0px 1px 10px rgba(0, 0, 0, 0.3);
                    z-index: 100;
                    transition: all 300ms ease;
                }

                .btn-wsp:hover {
                    background: white;
                }

                @media only screen and (min-width: 320px) and (max-width: 768px) {
                    .btn-wsp {
                        width: 63px;
                        height: 63px;
                        line-height: 66px;
                    }
                }

            </style>
            <!-- Código JavaScript y SweetAlert2 para mostrar el mensaje automáticamente y al pulsar el botón -->
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    <?php if ($consumo_abierto) { ?>
                        // Muestra el mensaje automáticamente si hay un consumo abierto
                        Swal.fire({
                            icon: 'warning', // Puedes cambiar a 'error' o 'success' según prefieras
                            title: 'Ticket Abierto',
                            text: 'Esta reserva tiene un ticket abierto, comuníquese con el operador de terraza.',
                        });
                    <?php } ?>
                });

                function pen() {
                    <?php if ($consumo_abierto) { ?>
                        // Muestra el mensaje al pulsar el botón si hay un consumo abierto
                        Swal.fire({
                            icon: 'warning',
                            title: 'Ticket Abierto',
                            text: 'Esta reserva tiene un ticket abierto, comuníquese con el operador de terraza.',
                        });
                    <?php } else { ?>
                        // Comentario: Aquí puedes agregar código adicional que se ejecutará si no hay consumo abierto
                    <?php } ?>
                }
            </script>

            <!-- Botón -->
            <a onclick="pen()" class="btn-wsp">
                <?php echo $simbolo; ?>
            </a>
   
    </body>
    <!--Fin de la página-->
    <br><br>
    <footer class="footer">
          <p><b>Hotel Casa Flora Atlixco, Todos los derechos reservados &copy; 2022</b></p>
    </footer>
</html>