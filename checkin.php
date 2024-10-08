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
        <title>RESERVAS v2.0</title>
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
        <link rel="stylesheet" href="css/estilo8.css">
	    <!-- Template Main Stylesheets -->
	    <link rel="stylesheet" href="css/contact-form.css" type="text/css">	
        <!--SWEET ALERT-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>	
        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    </head>
    <body onLoad="LlenarTarifa2(),LlenarHuesped()">
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
                        <a href="incidencias.php">Incidencias</a>
                        <a href="gastos.php">Gastos</a>
                        <a href="logout.php" onclick="salir()">Cerrar sesión</a>
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
                                <div style="text-align: right;">
                                <a href="inicio.php">
                                    <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                </a>
                                </div>
                                <form action="update.php" method="POST" style="max-width:500px;margin:auto">
                                    <h1>Check In</h1>
                                    <br>
                                    <hr>
                                    <input type="hidden" name="cod_reserva" value="<?php echo $row['cod_reserva']  ?>">
                                <!--Fecha-->
                                <input type="hidden" class="form-control mb-3" name="fecha" placeholder="Fecha" value="<?php  echo $row['fecha']?>" readonly>
                                <!--Día-->
                                <input type="hidden" class="form-control mb-3" name="dia" placeholder="Día" value="<?php  echo $row['dia']?>" readonly>
                                <p>Llegada</p>
                                <input type="time" class="form-control mb-3" name="llegada" placeholder="Llegada" value="<?php  echo $row['llegada']?>">
                                <!--Salida!-->
                                <input type="hidden" class="form-control mb-3" name="salida" placeholder="Salida" value="<?php  echo $row['salida']?>" readonly>
                                <!--Cliente!-->
                                <input type="hidden" class="form-control mb-3" name="cliente" placeholder="Cliente" value="<?php  echo $row['cliente']?>" readonly>
                                <!--Habitación!-->
                                <input type="hidden" class="form-control mb-3" name="habitacion" placeholder="Habitación" value="<?php  echo $row['habitacion']?>" readonly>
                                    <!--<select class="form-control mb-3" id="habitacion" name="habitacion" placeholder="Habitación" required>
                                        <option value="Cuna de Moisés">Estándar 1 - Cuna de Moisés</option>
                                        <option value="Dalia">Estándar 2 - Dalia</option>
                                        <option value="Bugambilia">Superior 1 - Bugambilia</option>
                                        <option value="Tulipan">Superior 2 - Tulipan</option>
                                        <option value="Jazmín">Superior 3 - Jazmín</option>
                                        <option value="Violeta">Superior 4 - Violeta</option>
                                        <option value="Lily">Superior Deluxe 1 - Lily</option>
                                        <option value="Girasol">Superior Deluxe 2 - Girasol</option>
                                        <option value="Margarita">Deluxe con vista a los volcanes 1 - Margarita</option>
                                        <option value="Noche Buena">Deluxe con vista a los volcanes 2 - Noche Buena</option>
                                        <option value="Ocaso Terraza">Ocaso Terraza</option>
                                        <option value="Sala de Negocios">Sala de Negocios</option>
                                    </select>-->
                                <!--Tarifa-->
                                <input type="hidden" class="form-control mb-3" name="tarifa" placeholder="Tarifa" value="<?php  echo $row['tarifa']?>" readonly>
                                <!--Número de huéspedes-->
                                <input type="hidden" class="form-control mb-3" name="huespedes" placeholder="Huespedes" value="<?php  echo $row['huespedes']?>" readonly>
                                <!--Anticipo-->
                                <input type="hidden" class="form-control mb-3" name="anticipo" placeholder="Anticipo" onkeypress="return event.charCode>=48 && event.charCode<=57" value="<?php  echo $row['anticipo']?>">
                                <!--Reserva Vía-->
                                <input type="hidden" class="form-control mb-3" name="via" placeholder="Vía" value="<?php  echo $row['via']?>" readonly>
                                <!--Servicios Especiales-->
                                <input type="hidden" class="form-control mb-3" name="sextras" placeholder="Servicios Especiales" value="<?php  echo $row['sextras']?>" readonly>
                                <!--Número de noches-->
                                <input type="hidden" class="form-control mb-3" name="noches" placeholder="Noches" onkeypress="return event.charCode>=48 && event.charCode<=57" value="<?php  echo $row['noches']?>" readonly>
                                <!--Consumos Extras-->
                                <input type="hidden" class="form-control mb-3" name="cextras" placeholder="Consumos extras" onkeypress="return event.charCode>=48 && event.charCode<=57" readonly>
                                <p>Garantía</p>
                                <select class="form-control mb-3" name="garantia" required>
                                        <option value="">Elija una opción</option>
                                        <option value="Depósito de seguridad">Depósito de seguridad ($400.00 M.N.)</option>
                                        <option value="Identificación oficial">Identificación oficial</option>
                                </select>
                                
                                <hr>
                                <br>
                                <input type="submit" class="btn btn-primary btn-block" value="Aceptar">
                                <br>    
                            </form>
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