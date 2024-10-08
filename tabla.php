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
        <title>Añadir nueva reservación - Casa Flora Handmade Hotel</title>
        <script src="js/alerta1.js"></script>
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
        <link rel="stylesheet" href="css/estilox.css">
        <link rel="stylesheet" href="css/estilo8.css">
	    <!-- Template Main Stylesheets -->
	    <link rel="stylesheet" href="css/contact-form.css" type="text/css">	
        <!--SWEET ALERT-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
        <!--SWEET   -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <style>
            .logo-img {
            max-width: 50px; /* Ajusta el valor según tus necesidades */
            }
        </style>
        <script type="text/javascript">

            $(document).ready(function(){
                $('inputo').each(function(){/*En caso de fallo quitar la "o"*/
                    valor=$(this).next('span').text();
                    $(this).val(valor);
                })
            });

            function alertDiaDeSemana(){ 
                var d=new Date(document.getElementById("fecha").value);
                d.setDate(d.getDate() + 1);

                var diadesemana=new Array(7);
                diadesemana[0]="Domingo";
                diadesemana[1]="Lunes";
                diadesemana[2]="Martes";
                diadesemana[3]="Miércoles";
                diadesemana[4]="Jueves";
                diadesemana[5]="Viernes";
                diadesemana[6]="Sábado";
                var n= diadesemana[d.getDay()];
                document.getElementById("dia").innerHTML=n;

                $("#dia-input").val(n);
    
            }
            
            function dif() {
            var fechaI = new Date(document.getElementById("fecha").value);
            var fechaF = new Date(document.getElementById("salida").value);
            var tiempo = fechaF.getTime() - fechaI.getTime();
            console.log(fechaI);
            var dias = Math.floor(tiempo / (1000 * 60 * 60 * 24));
            document.getElementById("noches").innerHTML = dias;
            document.getElementById("noches").value = dias;

            };

            
            function upperCase() {
            var x=document.getElementById("cliente").value
            document.getElementById("cliente").value=x.toUpperCase()
            }

            function SoloLetras(letra) {

            tecla = (document.all) ? letra.keyCode : letra.which;

            //Tecla de retroceso para borrar, y espacio siempre la permite
            if (tecla == 8 || tecla == 32) {
                return true;
            }

            // Patrón de entrada
            patron = /[A-Za-z]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);

            }
            

            function LlenarHuesped()
            {
                const selectElement = document.querySelector('#huespedes');
                var descripcion = document.getElementById("edades");
                selectElement.addEventListener('change', (event) => {
                    const seleccionado = event.target.value;

                    if(seleccionado === '1'){
                        descripcion.options[1] = new Option('1 Adulto (18 años +)');
                    }
                    else if(seleccionado === '2'){
                        descripcion.options[1] = new Option('2 Adultos (18 años +)');
                        descripcion.options[2] = new Option('1 Adultos (18 años +) y 1 Adolescente (13 a 17 años)');
                        descripcion.options[3] = new Option('1 Adultos (18 años +) y 1 Niño (3 a 12 años)'); 
                        descripcion.options[4] = new Option('1 Adultos (18 años +) y 1 Bebé (0 a 2 años)'); 
                    }
                    else if(seleccionado === '3'){
                        descripcion.options[1] = new Option('3+ Pack se cobrará como servicio extra');
                    }
                    //3 o 4 pack se reservan para habitaciones especiales además de que se cobrarán como servicio extra
                });
            }
        </script>
    </head>
    <body onLoad="LlenarHuesped()">
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
                                <a href="reservagroup.php">
                                    <button class="btn info">Reserva grupal</button>
                                </a>
                                </div>

                                <br>

                                <form action="insertar.php" method="POST" style="max-width:500px;margin:auto" id="Reservas">
                                    <h1>Ingrese los datos de la Reserva</h1>
                                    <br>
                                    <hr>
                                    <p>Fecha</p>
                                    <input type="date" class="form-control mb-3" onblur="dif()" id="fecha" name="fecha" placeholder="Fecha"  onChange="alertDiaDeSemana(), dif()"required>
                                    <p>Día</p>
                                    <p>El día seleccionado es: <span id="dia" name="dia"></span></p>
                                    <input type="hidden" class="form-control mb-3" id="dia-input" name="dia" placeholder="Día" readonly>                                  
                                    <p>Llegada</p>
                                    <input type="time" class="form-control mb-3" name="llegada" placeholder="Llegada" value="15:00:00" required>
                                    <p>Salida</p>
                                    <input type="date" class="form-control mb-3" onchange="dif()" onblur="dif()" id="salida" name="salida" placeholder="Salida" required>
                                    <p>Número de noches</p>
                                    <input class="form-control mb-3" id="noches" name="noches" placeholder="Noches" onkeypress="return event.charCode>=48 && event.charCode<=57" value="" readonly required>
                                    <p>Nombre del Cliente</p>
                                    <input type="int" class="form-control mb-3" id="cliente" name="cliente" placeholder="Ingrese el nombre del cliente" onblur="upperCase()" onkeypress="return SoloLetras(event)" required>
                                    <p>Correo electrónico</p>
                                    <input type="int" class="form-control mb-3" name="email" placeholder="Ingrese el correo electrónico" required>
                                    <p>Número de teléfono</p>
                                    <input type="int" class="form-control mb-3" name="telefono" placeholder="Ingrese el número de teléfono" onkeypress="return event.charCode>=48 && event.charCode<=57" required>


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

                                    <p>Habitación</p>
                                    <select class="form-control mb-3" id="select2" name="habitacion" placeholder="Habitación" required>

                                    </select>
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
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    951: ['$951 (Lunes - Jueves)'],
                                                    1046: ['$1046 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    951: ['$951 (Lunes - Jueves)'],
                                                    1046: ['$1046 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    1070: ['$1070 (Lunes - Jueves)'],
                                                    1177: ['$1177 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    1070: ['$1070 (Lunes - Jueves)'],
                                                    1177: ['$1177 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    1070: ['$1070 (Lunes - Jueves)'],
                                                    1177: ['$1177 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    1070: ['$1070 (Lunes - Jueves)'],
                                                    1177: ['$1177 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1220: ['$1220 (Lunes - Jueves)'],
                                                    1338: ['$1338 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1220: ['$1220 (Lunes - Jueves)'],
                                                    1338: ['$1338 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1379: ['$1379 (Lunes - Jueves)'],
                                                    1522: ['$1522 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1379: ['$1379 (Lunes - Jueves)'],
                                                    1522: ['$1522 (Viernes-Domingo)'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA SEMANA SANTA
                                        DSemanaSanta: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1150.61: ['$1150.61'],
                                                },
                                                Dalia:{
                                                    1150.61: ['$1150.61'],
                                                },
                                                Bugambilia: {
                                                    1294.60: ['$1294.60'],
                                                },
                                                Tulipan: {
                                                    1294.60: ['$1294.60'],
                                                },
                                                Jazmín: {
                                                    1294.60: ['$1294.60'],
                                                },
                                                Violeta: {
                                                    1294.60: ['$1294.60'],
                                                },
                                                Lily: {
                                                    1471.32: ['$1471.32'],
                                                },
                                                Girasol: {
                                                    1471.32: ['$1471.32'],
                                                },
                                                Margarita: {
                                                    1674.21: ['$1674.21'],
                                                },
                                                NocheBuena: {
                                                    1674.21: ['$1674.21'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA RECESO ESCOLAR
                                        DRecesoEscolar: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    969.83: ['$969.83 (Lunes - Jueves)'],
                                                    1098.31: ['$1098.31 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    969.83: ['$969.83 (Lunes - Jueves)'],
                                                    1098.31: ['$1098.31 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    1069.81: ['$1069.81 (Lunes - Jueves)'],
                                                    1235.76: ['$1235.76 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    1069.81: ['$1069.81 (Lunes - Jueves)'],
                                                    1235.76: ['$1235.76 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    1069.81: ['$1069.81 (Lunes - Jueves)'],
                                                    1235.76: ['$1235.76 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    1069.81: ['$1069.81 (Lunes - Jueves)'],
                                                    1235.76: ['$1235.76 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1280.74: ['$1280.74 (Lunes - Jueves)'],
                                                    1404.44: ['$1404.44 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1280.74: ['$1280.74 (Lunes - Jueves)'],
                                                    1404.44: ['$1404.44 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1420.59: ['$1420.59 (Lunes - Jueves)'],
                                                    1598.11: ['$1598.11 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1420.59: ['$1420.59 (Lunes - Jueves)'],
                                                    1598.11: ['$1598.11 (Viernes-Domingo)'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA ATLIXCAYOTL/DIA DE MUERTOS
                                        DAtlixcayotlDiadeMuertos: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1171.53: ['$1171.53 (Lunes - Jueves)'],
                                                },
                                                Dalia:{
                                                    1171.53: ['$1171.53 (Lunes - Jueves)'],
                                                },
                                                Bugambilia: {
                                                    1318.14: ['$1318.14 (Lunes - Jueves)'],
                                                },
                                                Tulipan: {
                                                    1318.14: ['$1318.14 (Lunes - Jueves)'],
                                                },
                                                Jazmín: {
                                                    1318.14: ['$1318.14 (Lunes - Jueves)'],
                                                },
                                                Violeta: {
                                                    1318.14: ['$1318.14 (Lunes - Jueves)'],
                                                },
                                                Lily: {
                                                    1498.07: ['$1498.07 (Lunes - Jueves)'],
                                                },
                                                Girasol: {
                                                    1498.07: ['$1498.07 (Lunes - Jueves)'],
                                                },
                                                Margarita: {
                                                    1704.65: ['$1704.65 (Lunes - Jueves)'],
                                                },
                                                NocheBuena: {
                                                    1704.65: ['$1704.65 (Lunes - Jueves)'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA VILLA ILUMINADA
                                        DVillaIluminada: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1055.40: ['$1055.40 (Lunes - Jueves)'],
                                                    1181.99: ['$1181.99 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    1055.40: ['$1055.40 (Lunes - Jueves)'],
                                                    1181.99: ['$1181.99 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    1187.49: ['$1187.49 (Lunes - Jueves)'],
                                                    1329.91: ['$1329.91 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    1187.49: ['$1187.49 (Lunes - Jueves)'],
                                                    1329.91: ['$1329.91 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    1187.49: ['$1187.49 (Lunes - Jueves)'],
                                                    1329.91: ['$1329.91 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    1187.49: ['$1187.49 (Lunes - Jueves)'],
                                                    1329.91: ['$1329.91 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1353.92: ['$1353.92 (Lunes - Jueves)'],
                                                    1511.44: ['$1511.44 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1353.92: ['$1353.92 (Lunes - Jueves)'],
                                                    1511.44: ['$1511.44 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1530.92: ['$1530.92 (Lunes - Jueves)'],
                                                    1719.87: ['$1719.87 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1530.92: ['$1530.92 (Lunes - Jueves)'],
                                                    1719.87: ['$1719.87 (Viernes-Domingo)'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA FIN DE AÑO
                                        DFinDeAno: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1370.27: ['$1370.27'],
                                                },
                                                Dalia:{
                                                    1370.27: ['$1370.27'],
                                                },
                                                Bugambilia: {
                                                    1541.75: ['$1541.75'],
                                                },
                                                Tulipan: {
                                                    1541.75: ['$1541.75'],
                                                },
                                                Jazmín: {
                                                    1541.75: ['$1541.75'],
                                                },
                                                Violeta: {
                                                    1541.75: ['$1541.75'],
                                                },
                                                Lily: {
                                                    1752.20: ['$1752.20'],
                                                },
                                                Girasol: {
                                                    1752.20: ['$1752.20'],
                                                },
                                                Margarita: {
                                                    1993.83: ['$1993.83'],
                                                },
                                                NocheBuena: {
                                                    1993.83: ['$1993.83'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                            }
                                        },
                                        option2: {
                                            select2: {
                                                option1: "Cuna de Moises",
                                                option2: "Dalia",
                                                option3: "Bugambilia",
                                                option4: "Tulipan",
                                                option5: "Jazmín",
                                                option6: "Violeta",
                                                option7: "Lily",
                                                option8: "Girasol",
                                                option9: "Margarita",
                                                option10: "Noche Buena",
                                                option11: "Ocaso Terraza",
                                                option12: "Sala de Negocios",
                                            },
                                            select3: {
                                                option1: "Cuna de Moises",
                                                option2: "Dalia",
                                                option3: "Bugambilia",
                                                option4: "Tulipan",
                                                option5: "Jazmín",
                                                option6: "Violeta",
                                                option7: "Lily",
                                                option8: "Girasol",
                                                option9: "Margarita",
                                                option10: "Noche Buena",
                                                option11: "Ocaso Terraza",
                                                option12: "Sala de Negocios",
                                            }
                                        },
                                        //PRECIOS PARA RESERVAS EN OTA
                                        OTA: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1112.45: ['$1112.45 (Lunes - Jueves)'],
                                                    1244.75: ['$1244.75 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    1112.45: ['$1112.45 (Lunes - Jueves)'],
                                                    1244.75: ['$1244.75 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    1251.68: ['$1251.68 (Lunes - Jueves)'],
                                                    1400.52: ['$1400.52 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    1251.68: ['$1251.68 (Lunes - Jueves)'],
                                                    1400.52: ['$1400.52 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    1251.68: ['$1251.68 (Lunes - Jueves)'],
                                                    1400.52: ['$1400.52 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    1251.68: ['$1251.68 (Lunes - Jueves)'],
                                                    1400.52: ['$1400.52 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1427.11: ['$1427.11 (Lunes - Jueves)'],
                                                    1591.70: ['$1591.70 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1427.11: ['$1427.11 (Lunes - Jueves)'],
                                                    1591.70: ['$1591.70 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1613.68: ['$1613.68 (Lunes - Jueves)'],
                                                    1811.19: ['$1811.19 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1613.68: ['$1613.68 (Lunes - Jueves)'],
                                                    1811.19: ['$1811.19 (Viernes-Domingo)'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA SEMANA SANTA OTA
                                        OSemanaSanta: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1323.20: ['$1323.20'],
                                                },
                                                Dalia:{
                                                    1323.20: ['$1323.20'],
                                                },
                                                Bugambilia: {
                                                    1488.79: ['$1488.79'],
                                                },
                                                Tulipan: {
                                                    1488.79: ['$1488.79'],
                                                },
                                                Jazmín: {
                                                    1488.79: ['$1488.79'],
                                                },
                                                Violeta: {
                                                    1488.79: ['$1488.79'],
                                                },
                                                Lily: {
                                                    1692.01: ['$1692.01'],
                                                },
                                                Girasol: {
                                                    1692.01: ['$1692.01'],
                                                },
                                                Margarita: {
                                                    1925.34: ['$1925.34'],
                                                },
                                                NocheBuena: {
                                                    1925.34: ['$1925.34'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA RECESO ESCOLAR OTA
                                        ORecesoEscolar: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1115.30: ['$1115.30 (Lunes - Jueves)'],
                                                    1263.06: ['$1263.06 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    1115.30: ['$1115.30 (Lunes - Jueves)'],
                                                    1263.06: ['$1263.06 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    1230.28: ['$1230.28 (Lunes - Jueves)'],
                                                    1421.12: ['$1421.12 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    1230.28: ['$1230.28 (Lunes - Jueves)'],
                                                    1421.12: ['$1421.12 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    1230.28: ['$1230.28 (Lunes - Jueves)'],
                                                    1421.12: ['$1421.12 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    1230.28: ['$1230.28 (Lunes - Jueves)'],
                                                    1421.12: ['$1421.12 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1472.85: ['$1472.85 (Lunes - Jueves)'],
                                                    1615.10: ['$1615.10 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1472.85: ['$1472.85 (Lunes - Jueves)'],
                                                    1615.10: ['$1615.10 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1633.67: ['$1633.67 (Lunes - Jueves)'],
                                                    1837.83: ['$1837.83 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1633.67: ['$1633.67 (Lunes - Jueves)'],
                                                    1837.83: ['$1837.83 (Viernes-Domingo)'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA ATLIXCAYOTL/DIA DE MUERTOS OTA
                                        OAtlixcayotlDiadeMuertos: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1347.26: ['$1347.26 (Lunes - Jueves)'],
                                                },
                                                Dalia:{
                                                    1347.26: ['$1347.26 (Lunes - Jueves)'],
                                                },
                                                Bugambilia: {
                                                    1515.86: ['$1515.86 (Lunes - Jueves)'],
                                                },
                                                Tulipan: {
                                                    1515.86: ['$1515.86 (Lunes - Jueves)'],
                                                },
                                                Jazmín: {
                                                    1515.86: ['$1515.86 (Lunes - Jueves)'],
                                                },
                                                Violeta: {
                                                    1515.86: ['$1515.86 (Lunes - Jueves)'],
                                                },
                                                Lily: {
                                                    1722.78: ['$1722.78 (Lunes - Jueves)'],
                                                },
                                                Girasol: {
                                                    1722.78: ['$1722.78 (Lunes - Jueves)'],
                                                },
                                                Margarita: {
                                                    1960.35: ['$1960.35 (Lunes - Jueves)'],
                                                },
                                                NocheBuena: {
                                                    1960.35: ['$1960.35 (Lunes - Jueves)'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA VILLA ILUMINADA OTA
                                        OVillaIluminada: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1182.05: ['$1182.05 (Lunes - Jueves)'],
                                                    1335.65: ['$1335.65 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    1182.05: ['$1182.05 (Lunes - Jueves)'],
                                                    1335.65: ['$1335.65 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    1329.99: ['$1329.99 (Lunes - Jueves)'],
                                                    1502.80: ['$1502.80 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    1329.99: ['$1329.99 (Lunes - Jueves)'],
                                                    1502.80: ['$1502.80 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    1329.99: ['$1329.99 (Lunes - Jueves)'],
                                                    1502.80: ['$1502.80 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    1329.99: ['$1329.99 (Lunes - Jueves)'],
                                                    1502.80: ['$1502.80 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1516.39: ['$1516.39 (Lunes - Jueves)'],
                                                    1707.93: ['$1707.93 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1516.39: ['$1516.39 (Lunes - Jueves)'],
                                                    1707.93: ['$1707.93 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1714.63: ['$1714.63 (Lunes - Jueves)'],
                                                    1943.45: ['$1943.45 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1714.63: ['$1714.63 (Lunes - Jueves)'],
                                                    1943.45: ['$1943.45 (Viernes-Domingo)'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA FIN DE AÑO OTA
                                        OFinDeAno: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1575.81: ['$1575.81'],
                                                },
                                                Dalia:{
                                                    1575.81: ['$1575.81'],
                                                },
                                                Bugambilia: {
                                                    1773.01: ['$1773.01'],
                                                },
                                                Tulipan: {
                                                    1773.01: ['$1773.01'],
                                                },
                                                Jazmín: {
                                                    1773.01: ['$1773.01'],
                                                },
                                                Violeta: {
                                                    1773.01: ['$1773.01'],
                                                },
                                                Lily: {
                                                    2015.03: ['$2015.03'],
                                                },
                                                Girasol: {
                                                    2015.03: ['$2015.03'],
                                                },
                                                Margarita: {
                                                    2292.91: ['$2292.91'],
                                                },
                                                NocheBuena: {
                                                    2292.91: ['$2292.91'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA RESERVAS EN EXPEDIA
                                        EXPEDIA: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1223.69: ['$1223.69 (Lunes - Jueves)'],
                                                    1369.23: ['$1369.23 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    1223.69: ['$1223.69 (Lunes - Jueves)'],
                                                    1369.23: ['$1369.23 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    1376.85: ['$1376.85 (Lunes - Jueves)'],
                                                    1540.58: ['$1540.58 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    1376.85: ['$1376.85 (Lunes - Jueves)'],
                                                    1540.58: ['$1540.58 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    1376.85: ['$1376.85 (Lunes - Jueves)'],
                                                    1540.58: ['$1540.58 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    1376.85: ['$1376.85 (Lunes - Jueves)'],
                                                    1540.58: ['$1540.58 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1569.82: ['$1569.82 (Lunes - Jueves)'],
                                                    1750.87: ['$1750.87 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1569.82: ['$1569.82 (Lunes - Jueves)'],
                                                    1750.87: ['$1750.87 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1775.04: ['$1775.04 (Lunes - Jueves)'],
                                                    1992.31: ['$1992.31 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1775.04: ['$1775.04 (Lunes - Jueves)'],
                                                    1992.31: ['$1992.31 (Viernes-Domingo)'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA SEMANA SANTA EXPEDIA
                                        ESemanaSanta: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1455.52: ['$1455.52'],
                                                },
                                                Dalia:{
                                                    1455.52: ['$1455.52'],
                                                },
                                                Bugambilia: {
                                                    1637.67: ['$1637.67'],
                                                },
                                                Tulipan: {
                                                    1637.67: ['$1637.67'],
                                                },
                                                Jazmín: {
                                                    1637.67: ['$1637.67'],
                                                },
                                                Violeta: {
                                                    1637.67: ['$1637.67'],
                                                },
                                                Lily: {
                                                    1861.21: ['$1861.21'],
                                                },
                                                Girasol: {
                                                    1861.21: ['$1861.21'],
                                                },
                                                Margarita: {
                                                    2117.88: ['$2117.88'],
                                                },
                                                NocheBuena: {
                                                    2117.88: ['$2117.88'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA RECESO ESCOLAR EXPEDIA
                                        ERecesoEscolar: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1226.83: ['$1226.83 (Lunes - Jueves)'],
                                                    1389.36: ['$1389.36 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    1226.83: ['$1226.83 (Lunes - Jueves)'],
                                                    1389.36: ['$1389.36 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    1353.31: ['$1353.31 (Lunes - Jueves)'],
                                                    1563.23: ['$1563.23 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    1353.31: ['$1353.31 (Lunes - Jueves)'],
                                                    1563.23: ['$1563.23 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    1353.31: ['$1353.31 (Lunes - Jueves)'],
                                                    1563.23: ['$1563.23 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    1353.31: ['$1353.31 (Lunes - Jueves)'],
                                                    1563.23: ['$1563.23 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1620.13: ['$1620.13 (Lunes - Jueves)'],
                                                    1776.61: ['$1776.61 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1620.13: ['$1620.13 (Lunes - Jueves)'],
                                                    1776.61: ['$1776.61 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1797.04: ['$1797.04 (Lunes - Jueves)'],
                                                    2021.61: ['$2021.61 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1797.04: ['$1797.04 (Lunes - Jueves)'],
                                                    2021.61: ['$2021.61 (Viernes-Domingo)'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA ATLIXCAYOTL/DIA DE MUERTOS EXPEDIA
                                        EAtlixcayotlDiadeMuertos: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1481.99: ['$1481.99 (Lunes - Jueves)'],
                                                },
                                                Dalia:{
                                                    1481.99: ['$1481.99 (Lunes - Jueves)'],
                                                },
                                                Bugambilia: {
                                                    1667.45: ['$1667.45 (Lunes - Jueves)'],
                                                },
                                                Tulipan: {
                                                    1667.45: ['$1667.45 (Lunes - Jueves)'],
                                                },
                                                Jazmín: {
                                                    1667.45: ['$1667.45 (Lunes - Jueves)'],
                                                },
                                                Violeta: {
                                                    1667.45: ['$1667.45 (Lunes - Jueves)'],
                                                },
                                                Lily: {
                                                    1895.06: ['$1895.06 (Lunes - Jueves)'],
                                                },
                                                Girasol: {
                                                    1895.06: ['$1895.06 (Lunes - Jueves)'],
                                                },
                                                Margarita: {
                                                    2156.38: ['$2156.38 (Lunes - Jueves)'],
                                                },
                                                NocheBuena: {
                                                    2156.38: ['$2156.38 (Lunes - Jueves)'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA VILLA ILUMINADA EXPEDIA
                                        EVillaIluminada: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1300.25: ['$1300.25 (Lunes - Jueves)'],
                                                    1469.22: ['$1469.22 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    1300.25: ['$1300.25 (Lunes - Jueves)'],
                                                    1469.22: ['$1469.22 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    1462.99: ['$1462.99 (Lunes - Jueves)'],
                                                    1653.08: ['$1653.08 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    1462.99: ['$1462.99 (Lunes - Jueves)'],
                                                    1653.08: ['$1653.08 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    1462.99: ['$1462.99 (Lunes - Jueves)'],
                                                    1653.08: ['$1653.08 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    1462.99: ['$1462.99 (Lunes - Jueves)'],
                                                    1653.08: ['$1653.08 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1668.03: ['$1668.03 (Lunes - Jueves)'],
                                                    1878.72: ['$1878.72 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1668.03: ['$1668.03 (Lunes - Jueves)'],
                                                    1878.72: ['$1,878.72 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1886.10: ['$1886.10 (Lunes - Jueves)'],
                                                    2137.80: ['$2137.80 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1886.10: ['$1886.10 (Lunes - Jueves)'],
                                                    2137.80: ['$2137.80 (Viernes-Domingo)'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                            }
                                        },
                                        //PRECIOS PARA FIN DE AÑO EXPEDIA
                                        EFinDeAno: {
                                            select2: {
                                                NULL: "Elija una opción",
                                                CunadeMoises: "Cuna de Moises",
                                                Dalia: "Dalia",
                                                Bugambilia: "Bugambilia",
                                                Tulipan: "Tulipan",
                                                Jazmín: "Jazmín",
                                                Violeta: "Violeta",
                                                Lily: "Lily",
                                                Girasol: "Girasol",
                                                Margarita: "Margarita",
                                                NocheBuena: "Noche Buena",
                                                OcasoTerraza: "Ocaso Terraza",
                                                SaladeNegocios: "Sala de Negocios",
                                            },
                                            select3: {
                                                CunadeMoises: {
                                                    1733.40: ['$1733.40'],
                                                },
                                                Dalia:{
                                                    1733.40: ['$1733.40'],
                                                },
                                                Bugambilia: {
                                                    1950.32: ['$1950.32'],
                                                },
                                                Tulipan: {
                                                    1950.32: ['$1950.32'],
                                                },
                                                Jazmín: {
                                                    1950.32: ['$1950.32'],
                                                },
                                                Violeta: {
                                                    1950.32: ['$1950.32'],
                                                },
                                                Lily: {
                                                    2216.54: ['$2216.54'],
                                                },
                                                Girasol: {
                                                    2216.54: ['$2216.54'],
                                                },
                                                Margarita: {
                                                    2522.20: ['$2522.20'],
                                                },
                                                NocheBuena: {
                                                    2522.20: ['$2522.20'],
                                                },
                                                OcasoTerraza: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
                                                },
                                                SaladeNegocios: {
                                                    2500: ['$2500 (Lunes - Jueves)'],
                                                    5000: ['$5000 (Viernes-Domingo)'],
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
                                    
                                    </script>


                                    
                                    <p>Número de huéspedes</p>
                                    <select class="form-control mb-3" id="huespedes" name="huespedes" placeholder="Número de huéspedes" onclick="LlenarHuesped()" required>
                                        <option selected>Elija una opción</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3 o más</option>
                                        <!--3 o más huespedes se reservan como servicio extra-->
                                        <!--<option value="3">3</option>
                                        <option value="4">4</option>-->
                                    </select>
                                    <p>Descripción</p>
                                    <select class="form-control mb-3" id="edades" name="edades" placeholder="Seleccione las edades de los huéspedes" required>
                                        
                                    </select>
                                    <p>Anticipo</p>
                                    <input type="int" class="form-control mb-3" id="anticipo" name="anticipo" placeholder="Anticipo (ANOTE SOLAMENTE NÚMEROS SIN SIGNOS NI LETRAS)" onkeypress="return event.charCode>=48 && event.charCode<=57" required>
                                    <!--<p>Servicios Especiales</p>-->
                                    <input type="hidden" class="form-control mb-3" name="sextras" placeholder="Introduzca el monto total de Servicios Especiales" onkeypress="return event.charCode>=48 && event.charCode<=57" >
                                    <!--<select class="form-control mb-3" name="sextras" placeholder="Servicios Especiales" required>
                                        <option selected>NINGUNO</option>
                                        <option value="500">CAMA EXTRA</option>
                                        <option value="PAQUETE ROMÁNTICO">PAQUETE ROMÁNTICO</option>
                                        <option value="PAQUETE DÍA DE MUERTOS">PAQUETE DÍA DE MUERTOS</option>
                                        <option value="PAQUETE VILLA ILUMINADA">PAQUETE VILLA ILUMINADA</option>
                                        <option value="EARLY CHECK IN">EARLY CHECK IN</option>
                                        <option value="EARLY CHECK OUT">EARLY CHECK OUT</option>
                                        <option value="LATE CHECK IN">LATE CHECK IN</option>
                                        <option value="LATE CHECK OUT">LATE CHECK OUT</option>
                                        <option value="3+ Pack">3+ Pack</option>
                                    </select>--->
                                    <!--STATUS DE LA HABITACIÓN--->
                                    <input type="hidden" class="form-control mb-3" name="status" value="Reservado" required>
                                    <!--CONSUMOS EXTRAS--->
                                    <input type="hidden" class="form-control mb-3" name="cextras" placeholder="Consumos Extras (ANOTE SOLAMENTE NÚMEROS SIN SIGNOS NI LETRAS)" required>
                                    <!--GARANTÍA--->
                                    <input type="hidden" class="form-control mb-3" name="garantia" placeholder="Indique que se dejará como garantía" required>
                                    <!--MÉTODO DE PAGO--->
                                    <input type="hidden" class="form-control mb-3" name="pago" placeholder="Indique el método de pago" required>
                                    <p>Comentarios</p>
                                    <input type="int" class="form-control mb-3" name="comentarios" placeholder="Comentarios" required>
                                    <hr>
                                    <p>Al realizar una reserva se están aceptando nuestros <a href="#">Términos y Condiciones</a>.</p>
                                    <br>
                                    <input type="submit" class="registerbtn" value="Aceptar">
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