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
        <title>Habitaciones - Casa Flora Handmade Hotel</title>
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
        <link rel="stylesheet" href="css/estilo4.css?v=2">
        <link rel="stylesheet" href="css/estilo8.css?v=2">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

            .button-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 50vh;
            }

            /* Estilos para los botones */
            .btn2 {
                font-size: 24px;
                padding: 20px 40px;
                border-radius: 10px;
                background-color: #007bff;
                color: #fff;
                border: none;
                cursor: pointer;
                margin: 10px;
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
                                <a href="inicio.php">
                                    <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                </a>
                                </div>

                                <br>

                                <h1 style="text-align: center;"><b>Habitaciones</b></h1>
                                <hr>
                                <br>

                                <style>
                                    .card {
                                        padding: 1rem;
                                        border-radius: 10px;
                                        margin-bottom: 20px;
                                    }
                                    
                                    .disponible {
                                        background-color: #4CAF50;
                                        color: white;
                                    }
                                    
                                    .no-disponible {
                                        background-color: #FF5733;
                                        color: white;
                                    }

                                    .btn-large {
                                        width: 200px;
                                        height: 100px;
                                        font-size: 20px;
                                        margin: 10px;
                                    }
                                </style>

                            <div class="max-w-100">
                                <div class="row">
                                    <?php
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "prueba_demo";

                                    $conn = new mysqli($servername, $username, $password, $dbname);

                                    if ($conn->connect_error) {
                                        die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
                                    }

                                    $sql = "SELECT * FROM habitaciones";
                                    $result = $conn->query($sql);

                                    if ($result) {
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $nombre = $row['nombre'];
                                                $estado = $row['estado'];
                                                $buttonColor = ($estado === 'disponible') ? 'disponible' : 'no-disponible';
                
                                                // Agrega un botón dinámico dependiendo del estado de la habitación
                                                echo '<div class="col-md-3">
                                                        <div class="card p-3 shadow-sm ' . $buttonColor . '">
                                                            <div class="card-body text-center">
                                                                <h3 class="card-title mb-3"><b>' . $nombre . '</b></h3>
                                                                <p class="card-text">Estado: <b>' . $estado . '</b></p>';
                
                                                if ($estado === 'ocupada') {
                                                    // Si la habitación está ocupada, muestra el botón de Liberar
                                                    echo '<button class="btn btn-large" onclick="al(\'' . $nombre . '\')">Liberar</button>';
                                                } else {
                                                    // Si la habitación no está ocupada, muestra el botón de Reservar deshabilitado
                                                    echo '<button class="btn btn-large" disabled>Reservar</button>';
                                                }
                
                                                echo '</div>
                                                    </div>
                                                </div>';
                                            }
                                        } else {
                                            echo "No se encontraron habitaciones.";
                                        }
                                    } else {
                                        echo "Error en la consulta: " . $conn->error;
                                    }
                
                                    $conn->close();
                                    ?>
                                </div>
                            </div>

                            <script>
                                function al(habitacion) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Advertencia',
                                        text: 'Solo el administrador puede realizar esta acción',
                                        showDenyButton: true,
                                        showCancelButton: true,
                                        confirmButtonText: 'Aceptar',
                                        cancelButtonText: "Cancelar",
                                        denyButtonText: `Soy el administrador`,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: 'grey',
                                    }).then((result) => {
                                        if (result.isDenied) {
                                            Swal.fire({
                                                title: 'Ingrese su contraseña',
                                                input: 'password',
                                                inputAttributes: {
                                                    autocapitalize: 'off',
                                                    style: 'width: 50%; margin: auto;' // Centra el campo y ajusta su ancho
                                                },
                                                showCancelButton: true,
                                                confirmButtonText: 'Confirmar',
                                                showLoaderOnConfirm: true,
                                                preConfirm: (password) => {
                                                    // Validar la contraseña ingresada
                                                    if (password !== '020799') {
                                                        Swal.showValidationMessage('La contraseña ingresada es incorrecta');
                                                    }
                                                },
                                                allowOutsideClick: () => !Swal.isLoading()
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    // Muestra un mensaje visual antes de redirigir
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: '¡Habitación liberada!',
                                                        text: 'La habitación ' + habitacion + ' ha sido liberada exitosamente.',
                                                        showConfirmButton: false, // No muestra el botón de confirmación
                                                        timer: 2000 // Ajusta el tiempo en milisegundos (en este caso, 2 segundos)
                                                    }).then(() => {
                                                        // Redirige a cambia_estado.php con el nombre de la habitación después de la animación
                                                        window.location.href = '/recepcion/cambia_estado.php?habitacion=' + habitacion;
                                                    });
                                                }
                                            });
                                        }
                                    });
                                }
                            </script>

                                

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