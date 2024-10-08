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

    $sql2 = "SELECT habitacion_id, nombre FROM habitaciones WHERE estado = 'disponible'";
    $query2 = mysqli_query($con, $sql2);

    $row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Upgrade/Downgrade - Casa Flora Handmade Hotel</title>
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
        <script>
        function cambiarch() {
            var seleccionado = document.getElementById('habitacion').value;
            alert(seleccionado);
            window.location.replace(seleccionado);
        }
        </script>
        <style>
            .custom-container {
                max-width: 1600px; /* Ajusta el valor según tus necesidades */
                margin: 0 auto; /* Centra el contenido horizontalmente */
            }
            .grupo1 {
                background-color: #FFD700; /* Amarillo dorado */
            }

            .grupo2 {
                background-color: #87CEEB; /* Azul cielo */
            }

            .grupo3 {
                background-color: #FFA07A; /* Salmón claro */
            }

            .grupo4 {
                background-color: #98FB98; /* Verde menta */
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
                color: orange;
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
                                <h1 style="text-align: center;"><b>Realizar Upgrade/Downgrade</b></h1>
                                <div style="text-align: left;">
                                <a href="insertarpos.php?id=<?php echo $row['cod_reserva'] ?>">
                                    <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                </a>
                                </div>
                                <div class="container mt-5 custom-container">
                                <div class="row"> 
                                    <div>
                                    <div class="card">
                                    <h4 style="text-align: right;">Reserva: #<?php  echo $row['cod_reserva']?> </h4>
                                    <!--Inicia selección de método de pago-->
                                    <fieldset>
                                        <div>
                                        <h1 class="h1">La habitación currente es: <b><?php  echo $row['habitacion']?></b> </h1>
                                        <br>
                                        <h2 class="h2">Elija una opción:</h2>
                                        <br><br>
                                        <form action="updateh.php" method="POST" style="max-width:500px;margin:auto">
                                            <!--Obtiene los datos desde la entrada en la bd, para no introducir una entrada vacía-->
                                            <input type="hidden" name="cod_reserva" value="<?php echo $row['cod_reserva']  ?>">
                                            <!--Fecha-->
                                            <input type="hidden" class="form-control mb-3" name="fecha" placeholder="Fecha" value="<?php  echo $row['fecha']?>" readonly>
                                            <!--Día-->
                                            <input type="hidden" class="form-control mb-3" name="dia" placeholder="Día" value="<?php  echo $row['dia']?>" readonly>
                                            <!--Llegada-->
                                            <input type="hidden" class="form-control mb-3" name="llegada" placeholder="Llegada" value="<?php  echo $row['llegada']?>">
                                            <!--Salida-->
                                            <input type="hidden" class="form-control mb-3" name="salida" placeholder="Salida" value="<?php  echo $row['salida']?>" readonly>
                                            <!--Cliente-->
                                            <input type="hidden" class="form-control mb-3" name="cliente" placeholder="Cliente" value="<?php  echo $row['cliente']?>" readonly>
                                            <!--Habitación-->
                                            <input type="hidden" class="form-control mb-3" name="habitacion" placeholder="Habitación" value="<?php  echo $row['habitacion']?>" readonly>
                                            <!--Tarifa-->
                                            <input type="hidden" class="form-control mb-3" name="tarifa" placeholder="Tarifa" value="<?php  echo $row['tarifa']?>" readonly>
                                            <!--Número de huéspedes-->
                                            <input type="hidden" class="form-control mb-3" name="huespedes" placeholder="Huéspedes" value="<?php  echo $row['huespedes']?>" readonly>
                                            <!--Anticipo-->
                                            <input type="hidden" class="form-control mb-3" name="anticipo" placeholder="Anticipo" onkeypress="return event.charCode>=48 && event.charCode<=57" value="<?php  echo $row['anticipo']?>">
                                            <!--Reserva Vía-->
                                            <input type="hidden" class="form-control mb-3" name="via" placeholder="Vía" value="<?php  echo $row['via']?>" readonly>
                                            <!--Servicios Especiales-->
                                            <input type="hidden" class="form-control mb-3" name="sextras" placeholder="Servicios Especiales" value="<?php  echo $row['sextras']?>" readonly>
                                            <!--Número de noches-->
                                            <input type="hidden" class="form-control mb-3" name="noches" placeholder="Noches" value="<?php  echo $row['noches']?>" readonly>
                                            <!--Consumos Extras-->
                                            <input type="hidden" class="form-control mb-3" name="cextras" placeholder="Consumos extras" value="<?php  echo $row['cextras']?>" required>
                                            <!--Garantia-->
                                            <input type="hidden" class="form-control mb-3" name="garantia" placeholder="Garantia" value="<?php  echo $row['garantia']?>" required>
                                            <!--Consumos Extras-->
                                            <input type="hidden" class="form-control mb-3" name="total" placeholder="Total" value="<?php  echo $row['total']?>" required>
                                            <!--Se termina la consulta de datos-->
                                            
                                            <select class="form-control mb-3" id="habitacion" name="habitacion" placeholder="Habitación" required>
                                                <option selected>Elija una opción</option>
                                                <!-- ... Código HTML previo ... -->
                                                <?php
                                                // Función para asignar la clase CSS basada en el tipo de habitación
                                                function obtenerClaseGrupo($tipoHabitacion) {
                                                    // Asigna una clase diferente según el tipo de habitación
                                                    switch ($tipoHabitacion) {
                                                        case 'Estándar':
                                                            return 'grupo1';
                                                        case 'Superior':
                                                            return 'grupo2';
                                                        case 'Superior_Deluxe':
                                                            return 'grupo3';
                                                        case 'Deluxe_con_vista_a_los_volcanes':
                                                            return 'grupo4';
                                                        default:
                                                            return ''; // Por si no se encuentra un grupo específico, no asignamos clase
                                                    }
                                                }

                                                $query2 = mysqli_query($con, "SELECT tipo, nombre FROM habitaciones WHERE estado = 'disponible' ORDER BY tipo");
                                                $optionsAdded = false; // Variable para rastrear si se agregaron opciones
                                                $currentGroup = ""; // Variable para rastrear el grupo actual de habitaciones

                                                while ($row = mysqli_fetch_assoc($query2)):
                                                    $optionsAdded = true; // Indicar que se agregaron opciones
                                                    $tipoHabitacion = $row['tipo'];

                                                    // Si el grupo actual es diferente al tipo de habitación, agregamos un nuevo <optgroup>
                                                    if ($currentGroup !== $tipoHabitacion) {
                                                        if ($currentGroup !== "") {
                                                            // Cerramos el <optgroup> actual antes de abrir uno nuevo, excepto en la primera iteración
                                                            echo '</optgroup>';
                                                            echo '<hr>';
                                                        }
                                                        $claseGrupo = obtenerClaseGrupo($tipoHabitacion); // Obtenemos la clase CSS para el grupo
                                                        echo '<optgroup label="' . $tipoHabitacion . '" class="' . $claseGrupo . '">';
                                                        $currentGroup = $tipoHabitacion;
                                                    }
                                                    ?>
                                                    <option><?php echo $row['nombre'] ?></option>
                                                <?php endwhile; ?>

                                                <?php if ($optionsAdded): // Verificar si se agregaron opciones ?>
                                                    </optgroup>
                                                <?php else: ?>
                                                    <option disabled>NO HAY HABITACIONES DISPONIBLES</option>
                                                <?php endif; ?>
                                                <!-- ... Código HTML posterior ... -->

                                                
                                            </select>




                                            <input type="submit" class="registerbtn" value="Continuar">
                                            <!--<input href="verificahab.php?id=<?php echo $row['cod_reserva'] ?>" type="submit" class="registerbtn" value="Continuar">-->
                                    </form>
                                        <br><br>
                                        
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