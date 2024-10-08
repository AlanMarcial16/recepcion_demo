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

    $sql="SELECT *  FROM incidencias";
    $query=mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Registrar Incidencia - Casa Flora Handmade Hotel</title>
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
        <style>
            .custom-container {
                max-width: 1600px; /* Ajusta el valor según tus necesidades */
                margin: 0 auto; /* Centra el contenido horizontalmente */
            }
            .logo-img {
            max-width: 50px; /* Ajusta el valor según tus necesidades */
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
                        <a class="active" href="incidencias.php">Incidencias</a>
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
                                <br>
                                <h1 style="text-align: center;"><b>Registrar incidencia</b></h1>
                                <br>
                                <hr>
                                <div style="text-align: left;">
                                <a href="incidencias.php">
                                    <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                </a>
                                </div>
                                <form action="insertarin.php" method="POST" style="max-width:500px;margin:auto">
                                    <h1>Ingrese los siguientes campos</h1>
                                    <br>
                                    <hr>
                                    <p>Fecha</p>
                                    <input type="date" class="form-control mb-3" name="fecha" placeholder="Fecha" value="<?php echo date("Y-m-d");?>" required>
                                    <p>Habitación</p>
                                    <select class="form-control mb-3" id="habitacion" name="habitacion" placeholder="Habitación" onChange="LlenarTarifa2();" required>
                                        <option value="Cuna de Moisés">Cuna de Moisés</option>
                                        <option value="Dalia">Dalia</option>
                                        <option value="Tulipan">Tulipan</option>
                                        <option value="Jazmín">Jazmín</option>
                                        <option value="Bugambilia">Bugambilia</option>
                                        <option value="Lily">Lily</option>
                                        <option value="Violeta">Violeta</option>
                                        <option value="Margarita">Margarita</option>
                                        <option value="Noche Buena">Noche Buena</option>
                                        <option value="Girasol">Girasol</option>
                                        <option value="Ocaso Terraza">Ocaso Terraza</option>
                                        <option value="Sala de Negocios">Sala de Negocios</option>
                                    </select>
                                    <p>Área</p>
                                    <select class="form-control mb-3" id="area" name="area" placeholder="Área" required>
                                        <option value="Amenidades">Amenidades</option>
                                        <option value="Artículos de Limpieza">Artículos de Limpieza</option>
                                        <option value="Blancos">Blancos</option>
                                        <option value="Cocina">Cocina</option>
                                        <option value="Construcción">Construcción</option>
                                        <option value="Eléctrico">Eléctrico</option>
                                        <option value="Gas">Gas</option>
                                        <option value="Grifería">Grifería</option>
                                        <option value="Habitación">Habitación</option>
                                        <option value="Herramienta">Herramienta</option>
                                        <option value="Mobiliario">Mobiliario</option>
                                        <option value="Plomeria">Plomeria</option>
                                    </select>
                                    <p>Descripción</p>
                                    <input type="int" class="form-control mb-3" name="descripcion" class="form-control mb-3" placeholder="Describe la incidencia" required>
                                    <hr>
                                    <br>
                                    <input type="submit" class="registerbtn">
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