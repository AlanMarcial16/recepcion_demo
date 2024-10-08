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
                                <div class="container mt-5">
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
                                        <form action="updateh2.php" method="POST" style="max-width:500px;margin:auto">
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
                                            
                                            <!--Número de huéspedes-->
                                            <input type="hidden" class="form-control mb-3" name="huespedes" placeholder="Huéspedes" value="<?php  echo $row['huespedes']?>" readonly>
                                            <!--Anticipo-->
                                            <input type="hidden" class="form-control mb-3" name="anticipo" placeholder="Anticipo" onkeypress="return event.charCode>=48 && event.charCode<=57" value="<?php  echo $row['anticipo']?>">
                                            <!--Reserva Vía-->
                                            <p>Reserva Vía</p>
                                    <select class="form-control mb-3" id="select1" name="via" placeholder="Vía" required>
                                        <option selected>Elija una opción</option>
                                        <hr>
                                        <optgroup label="DIRECTA" class="grupo1">
                                            <option value="Directa">Directa</option>
                                            <option value="DSemanaSanta">DIRECTA Semana Santa (1-16 de Abril)</option>
                                            <option value="DRecesoEscolar">DIRECTA Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="DAtlixcayotlDiadeMuertos">DIRECTA Atlixcayotl/Dia de Muertos</option>
                                            <option value="DVillaIluminada">DIRECTA Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="DFinDeAno">DIRECTA Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>  
                                        <hr>
                                        <optgroup label="OTA" class="grupo2"> 
                                            <option value="OTA">OTA</option>
                                            <option value="OSemanaSanta">OTA Semana Santa (1-16 de Abril)</option>
                                            <option value="ORecesoEscolar">OTA Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="OAtlixcayotlDiadeMuertos">OTA Atlixcayotl/Dia de Muertos</option>
                                            <option value="OVillaIluminada">OTA Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="OFinDeAno">OTA Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>
                                        <hr>
                                        <optgroup label="EXPEDIA" class="grupo1"> 
                                            <option value="EXPEDIA">EXPEDIA</option>
                                            <option value="ESemanaSanta">EXPEDIA Semana Santa (1-16 de Abril)</option>
                                            <option value="ERecesoEscolar">EXPEDIA Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="EAtlixcayotlDiadeMuertos">EXPEDIA Atlixcayotl/Dia de Muertos</option>
                                            <option value="EVillaIluminada">EXPEDIA Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="EFinDeAno">EXPEDIA Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>
                                        <hr>
                                        <!--<option value="OTA">OTA</option>-->
                                    </select>
                                    <script>
                                        function filterOptionsByMonth() {
                                            const select = document.getElementById('select1');
                                            const options = select.getElementsByTagName('option');
                                            const dateInput = document.getElementById('fecha').value; // Obtenemos el valor del campo de fecha
                                            const selectedDate = new Date(dateInput); // Creamos un objeto Date a partir del valor del campo de fecha
                                            const selectedMonth = selectedDate.getMonth() + 1; // Sumamos 1 porque getMonth() devuelve un valor de 0 a 11
                                            
                                            for (let i = 0; i < options.length; i++) {
                                                const option = options[i];
                                                const optionText = option.innerText;
                                                
                                                // Utilizamos expresiones regulares para buscar el mes en el texto de la opción
                                                const monthRegex = /(\d+)\s+de\s+(\w+)/;
                                                const match = monthRegex.exec(optionText);
                                                if (match) {
                                                    const optionMonth = getMonthNumber(match[2]); // Obtenemos el número del mes a partir del nombre
                                                    if (optionMonth !== selectedMonth) {
                                                        option.style.display = 'none'; // Ocultamos la opción que no coincide con el mes seleccionado
                                                    } else {
                                                        option.style.display = 'block'; // Mostramos la opción que coincide con el mes seleccionado
                                                    }
                                                }
                                            }
                                        }

                                        function getMonthNumber(monthName) {
                                            const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                                            return months.indexOf(monthName) + 1;
                                        }

                                        // Filtramos las opciones por el mes seleccionado al cargar la página (opcional)
                                        // filterOptionsByMonth();
                                    </script>
                                    <!--Habitación-->
                                    <p>Habitación</p>
                                    <select class="form-control mb-3" id="select2" name="habitacion" placeholder="Habitación" required>

                                    </select>

                                    <!--Tarifa-->
                                    <p>Tarifa</p>
                                    <select class="form-control mb-3" id="select3" name="tarifa" placeholder="Tarifa" required>
                                        
                                    </select>
                                    <!------------------------------------------------------------------------------------------------------------------->
                                    <!--ESPACIO PARA LA FUNCIÓN DE RELLENO DE SEGUNDO SELECT-->
                                    <script type="text/javascript">
                                    
                                    const options = {
                                        //PRECIOS PARA RESERVAS EN FORMA DIRECTA
                                        Directa: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    976: ['$976 (Lunes - Jueves)'],
                                                    1071: ['$1071 (Viernes - Domingo)'],
                                                },
                                                Superior: {
                                                    1095: ['$1095 (Lunes - Jueves)'],
                                                    1202: ['$1202 (Viernes - Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1244: ['$1244 (Lunes - Jueves)'],
                                                    1361: ['$1361 (Viernes - Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1403: ['$1403 (Lunes - Jueves)'],
                                                    1546: ['$1546 (Viernes - Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA SEMANA SANTA
                                        DSemanaSanta: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1178.10: ['$1178.10'],
                                                },
                                                Superior: {
                                                    1322.09: ['$1322.09'],
                                                },
                                                Superior_Deluxe: {
                                                    1497.50: ['$1497.50'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1700.39: ['$1700.39'],
                                                },
                                                
                                            }
                                        },
                                        //PRECIOS PARA RECESO ESCOLAR
                                        DRecesoEscolar: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    995.32: ['$995.32 (Lunes - Jueves)'],
                                                    1124.55: ['$1124.55 (Viernes - Domingo)'],
                                                },
                                                Superior: {
                                                    1116.70: ['$1116.70 (Lunes - Jueves)'],
                                                    1262.00: ['$1262.00 (Viernes - Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1305.73: ['$1305.73 (Lunes - Jueves)'],
                                                    1429.43: ['$1429.43 (Viernes - Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1445.10: ['$1445.10 (Lunes - Jueves)'],
                                                    1623.10: ['$1623.10 (Viernes - Domingo)'],
                                                },
                                                
                                            }
                                        },
                                        //PRECIOS PARA ATLIXCAYOTL/DIA DE MUERTOS
                                        DAtlixcayotlDiadeMuertos: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1199.52: ['$1199.52 (Lunes - Jueves)'],
                                                },
                                                Superior: {
                                                    1346.13: ['$1346.13 (Lunes - Jueves)'],
                                                },
                                                Superior_Deluxe: {
                                                    1524.72: ['$1524.72 (Lunes - Jueves)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1731.31: ['$1731.31 (Lunes - Jueves)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA VILLA ILUMINADA
                                        DVillaIluminada: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1083.14: ['$1083.14 (Lunes - Jueves)'],
                                                    1210.23: ['$1210.23 (Viernes - Domingo)'],
                                                },
                                                Superior: {
                                                    1215.23: ['$1215.23 (Lunes - Jueves)'],
                                                    1358.15: ['$1358.15 (Viernes - Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1380.34: ['$1380.34 (Lunes - Jueves)'],
                                                    1538.34: ['$1538.34 (Viernes - Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1557.34: ['$1557.34 (Lunes - Jueves)'],
                                                    1746.77: ['$1746.77 (Viernes - Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA FIN DE AÑO
                                        DFinDeAno: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1435.14: ['$1435.14'],
                                                },
                                                Superior: {
                                                    1610.55: ['$1610.55'],
                                                },
                                                Superior_Deluxe: {
                                                    1824.22: ['$1824.22'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    2071.39: ['$2071.39'],
                                                },
                                            }
                                        },            
                                        //PRECIOS PARA RESERVAS EN OTA
                                        OTA: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1141.69: ['$1141.69 (Lunes - Jueves)'],
                                                    1274.49: ['$1274.49 (Viernes - Domingo)'],
                                                },
                                                Superior: {
                                                    1280.92: ['$1280.92 (Lunes - Jueves)'],
                                                    1430.26: ['$1430.26 (Viernes - Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1454.95: ['$1454.95 (Lunes - Jueves)'],
                                                    1620.02: ['$1620.02 (Viernes - Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1641.52: ['$1641.52 (Lunes - Jueves)'],
                                                    1839.51: ['$1839.51 (Viernes - Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA SEMANA SANTA OTA
                                        OSemanaSanta: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1354.82: ['$1354.82'],
                                                },
                                                Superior: {
                                                    1520.40: ['$1520.40'],
                                                },
                                                Superior_Deluxe: {
                                                    1722.12: ['$1722.12'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1955.45: ['$1955.45'],
                                                },    
                                            }
                                        },
                                        //PRECIOS PARA RECESO ESCOLAR OTA
                                        ORecesoEscolar: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1144.61: ['$1144.61 (Lunes - Jueves)'],
                                                    1293.23: ['$1293.23 (Viernes - Domingo)'],
                                                },
                                                Superior: {
                                                    1284.20: ['$1284.20 (Lunes - Jueves)'],
                                                    1451.29: ['$1451.29 (Viernes - Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1501.59: ['$1501.59 (Lunes - Jueves)'],
                                                    1643.84: ['$1643.84 (Viernes - Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1661.87: ['$1661.87 (Lunes - Jueves)'],
                                                    1866.57: ['$1866.57 (Viernes - Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA ATLIXCAYOTL/DIA DE MUERTOS OTA
                                        OAtlixcayotlDiadeMuertos: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1379.45: ['$1379.45 (Lunes - Jueves)'],
                                                },
                                                Superior: {
                                                    1548.05: ['$1548.05 (Lunes - Jueves)'],
                                                },
                                                Superior_Deluxe: {
                                                    1753.43: ['$1753.43 (Lunes - Jueves)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1991.00: ['$1991.00 (Lunes - Jueves)'],
                                                },       
                                            }
                                        },
                                        //PRECIOS PARA VILLA ILUMINADA OTA
                                        OVillaIluminada: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",      
                                            },
                                            select3: {
                                                Estándar: {
                                                    1213.11: ['$1213.11 (Lunes - Jueves)'],
                                                    1367.56: ['$1367.56 (Viernes - Domingo)'],
                                                },
                                                Superior: {
                                                    1361.06: ['$1361.06 (Lunes - Jueves)'],
                                                    1534.71: ['$1534.71 (Viernes - Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1545.98: ['$1545.98 (Lunes - Jueves)'],
                                                    1738.32: ['$1738.32 (Viernes - Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1744.22: ['$1744.22 (Lunes - Jueves)'],
                                                    1973.84: ['$1973.84 (Viernes - Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA FIN DE AÑO OTA
                                        OFinDeAno: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1722.17: ['$1722.17'],
                                                },
                                                Superior: {
                                                    1964.87: ['$1964.87'],
                                                },
                                                Superior_Deluxe: {
                                                    2225.55: ['$2225.55'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    2527.09: ['$2527.09'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA RESERVAS EN EXPEDIA
                                        EXPEDIA: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1255.85: ['$1255.85 (Lunes - Jueves)'],
                                                    1401.94: ['$1401.94 (Viernes - Domingo)'],
                                                },
                                                Superior: {
                                                    1409.01: ['$1409.01 (Lunes - Jueves)'],
                                                    1573.29: ['$1573.29 (Viernes - Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1600.45: ['$1600.45 (Lunes - Jueves)'],
                                                    1782.02: ['$1782.02 (Viernes - Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1805.67: ['$1805.67 (Lunes - Jueves)'],
                                                    2023.47: ['$2023.47 (Viernes - Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA SEMANA SANTA EXPEDIA
                                        ESemanaSanta: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1490.30: ['$1490.30'],
                                                },
                                                Superior: {
                                                    1672.44: ['$1672.44'],
                                                },
                                                Superior_Deluxe: {
                                                    1894.33: ['$1894.33'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    2150.99: ['$2150.99'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA RECESO ESCOLAR EXPEDIA
                                        ERecesoEscolar: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1259.07: ['$1259.07 (Lunes - Jueves)'],
                                                    1422.56: ['$1422.56 (Viernes - Domingo)'],
                                                },
                                                Superior: {
                                                    1412.62: ['$1412.62 (Lunes - Jueves)'],
                                                    1596.42: ['$1596.42 (Viernes - Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1651.75: ['$1651.75 (Lunes - Jueves)'],
                                                    1808.23: ['$1808.23 (Viernes - Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1828.05: ['$1828.05 (Lunes - Jueves)'],
                                                    2053.22: ['$2053.22 (Viernes - Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA ATLIXCAYOTL/DIA DE MUERTOS EXPEDIA
                                        EAtlixcayotlDiadeMuertos: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1517.39: ['$1517.39 (Lunes - Jueves)'],
                                                },
                                                Superior: {
                                                    1702.85: ['$1702.85 (Lunes - Jueves)'],
                                                },
                                                Superior_Deluxe: {
                                                    1928.77: ['$1928.77 (Lunes - Jueves)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    2190.10: ['$2190.10 (Lunes - Jueves)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA VILLA ILUMINADA EXPEDIA
                                        EVillaIluminada: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1334.43: ['$1334.43 (Lunes - Jueves)'],
                                                    1504.32: ['$1504.32 (Viernes - Domingo)'],
                                                },
                                                Superior: {
                                                    1497.16: ['$1497.16 (Lunes - Jueves)'],
                                                    1688.18: ['$1688.18 (Viernes - Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1700.58: ['$1700.58 (Lunes - Jueves)'],
                                                    1912.15: ['$1912.15 (Viernes - Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1918.64: ['$1918.64 (Lunes - Jueves)'],
                                                    2171.23: ['$2171.23 (Viernes - Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA FIN DE AÑO EXPEDIA
                                        EFinDeAno: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                Estándar: "Estándar",
                                                Superior: "Superior",
                                                Superior_Deluxe: "Superior Deluxe",
                                                Deluxe_con_vista_a_los_volcanes: "Deluxe con vista a los volcanes",
                                            },
                                            select3: {
                                                Estándar: {
                                                    1894.38: ['$1894.38'],
                                                },
                                                Superior: {
                                                    2161.35: ['$2161.35'],
                                                },
                                                Superior_Deluxe: {
                                                    2448.11: ['$2448.11'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    2779.80: ['$2779.80'],
                                                },
                                            }
                                        },
                                        };

                                        const select1 = document.getElementById("select1");
                                        const select2 = document.getElementById("select2");
                                        const select3 = document.getElementById("select3");

                                        select1.addEventListener("change", function() {
                                        const selectedOption = options[this.value];
                                        //Selector 2
                                        let optionsHTML = "";

                                        for (const key in selectedOption.select2) {
                                            optionsHTML += `<option value="${key}">${selectedOption.select2[key]}</option>`;
                                        }

                                        select2.innerHTML = optionsHTML;

                                        select2.addEventListener("change", function() {
                                        const selectedOption2 = selectedOption.select3[this.value];
                                        ////////////////////////////////////////

                                        //Selector 3
                                        let optionsHTML2 = "";

                                        for (const key in selectedOption2) {
                                            optionsHTML2 += `<option value="${key}">${selectedOption2[key]}</option>`;
                                        }

                                        select3.innerHTML = optionsHTML2;
                                        ////////////////////////////////////////

                                        });
                                        });

                                        function updateSelect3Options() {
                                            const select1 = document.getElementById("select1");
                                            const select2 = document.getElementById("select2");
                                            const select3 = document.getElementById("select3");
                                            const fechaInput = document.getElementById("fecha");

                                            if (select1.value && select2.value && fechaInput.value) {
                                                const selectedOption = options[select1.value];
                                                const selectedOption2 = selectedOption.select3[select2.value];

                                                const selectedDate = new Date(fechaInput.value);
                                                const dayOfWeek = selectedDate.getDay(); // 0 (Domingo) a 6 (Sábado)

                                                let filteredOptions = {};
                                                for (const key in selectedOption2) {
                                                if (dayOfWeek >= 1 && dayOfWeek <= 4) {
                                                    // Lunes a Jueves (días 1 a 4)
                                                    if (selectedOption2[key][0].includes("(Lunes - Jueves)")) {
                                                    filteredOptions[key] = selectedOption2[key];
                                                    }
                                                } else if (dayOfWeek >= 5 && dayOfWeek <= 6) {
                                                    // Viernes a Domingo (días 5 a 6)
                                                    if (selectedOption2[key][0].includes("(Viernes - Domingo)")) {
                                                    filteredOptions[key] = selectedOption2[key];
                                                    }
                                                }
                                                }

                                                let optionsHTML = "";
                                                for (const key in filteredOptions) {
                                                optionsHTML += `<option value="${key}">${filteredOptions[key]}</option>`;
                                                }

                                                select3.innerHTML = optionsHTML;
                                            }
                                            }
                                        
                                    </script>
                                            
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
                                            
                                            <hr>



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