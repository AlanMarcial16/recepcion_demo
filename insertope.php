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

    $sql="SELECT *  FROM reservaciones";
    $query=mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Caja Chica</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
            
        </style>
        <script>
            
        </script>
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
                        <a class="active" href="cajaint.php">Caja Chica</a>
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
                            <h1 style="text-align: center;"><b>Caja Chica</b></h1>
                            <hr>
                            <div style="text-align: right;">
                                <a href="cajaint.php">
                                    <button class="btn info">Ver panel</button>
                                </a>
                            </div>
                            <br>
                            <form action="insertaop.php" method="POST" style="max-width:500px;margin:auto">
                                    <h1 class="h1">Ingrese la siguiente información</h1>
                                    <hr>
                                    <p>Tipo</p>
                                    <select class="form-control mb-3" id="tipodeoperacion" name="tipodeoperacion" placeholder="Introduzca el tipo de operación" onchange="" required>
                                        <option value="" selected>Selecciona una opcion</option>
                                        <option value="Entrada">Entrada</option>
                                        <option value="Salida">Salida</option>
                                    </select>
                                    <p>Descripción</p>
                                    <input type="int" class="form-control mb-3" name="descripcion" placeholder="Introduzca la descripción de la operación" required>
                                    <!--<p>Cantidad</p>
                                    <input type="int" class="form-control mb-3" name="cantidad" id="cantidad" placeholder="Introduzca la cantidad" onkeypress="return event.charCode>=48 && event.charCode<=57" required>
                                    <hr>
                                    <h4>Datos del comprobante</h4>
                                    <br>-->
                                    <p>Tipo de comprobante</p>
                                    <select class="form-control mb-3" name="tipocomprobante" placeholder="Introduzca el tipo de operación" required>
                                        <option value="Ticket">Ticket</option>
                                        <option value="Voucher">Voucher</option>
                                        <option value="Recibo">Recibo</option>
                                    </select>
                                    <!--<p>Código del comprobante</p>
                                    <input type="int" class="form-control mb-3" name="codigo" placeholder="Introduzca el código del comprobante" required>-->                         
                                    <p>Introduzca el importe</p>
                                    
                                    <input type="int" class="form-control mb-3" id="importesalida" name="importesalida" placeholder="Importe Salida" >
                                    <input type="int" class="form-control mb-3" id="importeentrada" name="importeentrada" placeholder="Importe Entrada" >
                                    <hr>
                                    <!--<script>
                                    function test(){
                                        $.ajax({url:"obtotal.php", success:function(result){
                                        $("th").text(result);}
                                    })
                                    } 
                                    </script>-->
                                    <input type="submit" class="registerbtn">
                            </form>
                            <script>
                                let opciones  = document.getElementById("tipodeoperacion")
                                let caja1 = document.getElementById("importeentrada")
                                let caja2 = document.getElementById("importesalida")
                                
                                opciones.addEventListener("change", () => {
                                    let eleccion = opciones.options[opciones.selectedIndex].text
                                    
                                    if(eleccion === "Salida") {
                                    caja1.style.display = "none"
                                    } else {
                                    caja1.style.display = "inline"
                                    }

                                    if(eleccion === "Entrada") {
                                    caja2.style.display = "none"
                                    } else {
                                    caja2.style.display = "inline"
                                    }

                                })
                            </script>
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