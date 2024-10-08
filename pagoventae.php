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

    $sql="SELECT *  FROM ventadirecta";
    $query=mysqli_query($con,$sql);

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Pago con efectivo - Casa Flora Handmade Hotel</title>
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
            #restante {
                margin-top: 20px;
                font-weight: bold;
                font-size: 24px; /* Tamaño de fuente más grande */
                color: green; /* Color verde */
            }
        </style>
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
                text-align: justify;
            }

            .h1{
                text-align: center;
                color: green;
            }
            .h4{
                text-align: justify;
                color: red;
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
                                        <a href="pagarventa.php">
                                            <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                        </a>
                                </div>
                                <h1 style="text-align: center;"><b>Pagar</b></h1>
                                <div class="container mt-5 custom-container">
                                <div class="row"> 
                                    <div>
                                    <div class="card">
                                        <br>
                                    <!--Inicia selección de método de pago-->
                                    <fieldset>
                                        <div>
                                        <?php
                                                    $total = 0; // Inicializar el total en 0
                                                    
                                                    while($row = mysqli_fetch_array($query)){
                                                        // Obtener el precio y convertirlo a número
                                                        $precio = floatval($row['preciou']);
                                                        
                                                        // Sumar el precio al total
                                                        $total += $precio;
                                                ?>
                                                <script>
                                                    function restar() {
                                                        var total = <?php echo $total; ?>; // Nuevo valor total calculado
                                                        var monto = document.getElementById("monto").value; // Obtener el monto introducido

                                                        // Validar que se haya ingresado un monto válido
                                                        if (monto !== '') {
                                                            total = parseInt(monto) - total; // Restar el monto al nuevo valor total
                                                        }

                                                        // Mostrar el monto restante en el elemento con el id 'restante'
                                                        document.getElementById("restante").textContent = "Cambio: " + total;
                                                    }
                                                </script>

                                            <h3 class="h1">
                                            <?php
                                                    }
                                                ?>
                                                <b>Total: $<?php echo $total?></b>
                                            </h3>
                                            <br><br>
                                            
                                            <h3 class="h3">Despliegue la caja e introduzca el monto, devuelva cambio si es necesario.</h3>
                                            <br><br>
                                        </div>
                                        <div style="text-align: center;">
                                            <span class="h3">Total</span>
                                            <input type="text" id="campo1" value="<?php echo $total?>" readonly/>
                                            <span class="h3">Efectivo</span>
                                            <input type="text" id="monto" name="monto" oninput="restar()">
                                            
                                            <br><br>
                                            <div id="restante"></div>
                                        </div>
                                        <br>
                                        <form action="procesar_venta_directa.php" method="post" name="eform" onsubmit="return redirect()" style="max-width:500px;margin:auto">
                                                <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
                                                <input type="hidden" name="cantidad" value="<?php echo $cantidad; ?>">
                                                <input type="hidden" name="preciou" value="<?php echo $preciou; ?>">
                                                <input type="hidden" name="total_venta" value="<?php echo $total; ?>">
                                            <hr>
                                            <br>
                                            <input type="submit" name="btnfin" class="registerbtn" value="Continuar">
                                            
                                        </form>
                                        <br>
                                        <div style="text-align: center;">
                                        <a href="generar_pdf.php" target="_blank">
                                                <button class="btn btn-sm btn-primary" style="font-family: 'Nombre de tu tipografía', sans-serif;">Imprimir Ticket</button>
                                            </a>
                                        </div>
                                        <br><br>
                                        <h3 class="h3">Al concluir la operación haga click en "Continuar"</h3>
                                        <br><br>
                                        
                                        <!--<a href="verificahab.php?id=<?php echo $row['cod_reserva'] ?>">
                                        <button class="btn success">Comenzar Checkout</button>
                                        </a>
                                        <a href="verificahab.php?id=<?php echo $row['cod_reserva'] ?>">
                                        <button class="btn success">Continuar</button>
                                        </a>
                                        </div>-->
                    </fieldset>
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