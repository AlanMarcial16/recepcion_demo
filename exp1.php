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
            .custom-container {
                max-width: 1600px; /* Ajusta el valor según tus necesidades */
                margin: 0 auto; /* Centra el contenido horizontalmente */
            }
            .logo-img {
            max-width: 50px; /* Ajusta el valor según tus necesidades */
            }
            form input {
            text-align: center;
            width: 50px;
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
                    else if (seleccionado === '3') {
                        descripcion.options[1] = new Option('1 Adulto (18 años +) y 2 Bebés (0 a 2 años)');
                        descripcion.options[2] = new Option('1 Adulto (18 años +) y 2 Niños (3 a 12 años)');
                        descripcion.options[3] = new Option('1 Adulto (18 años +) y 2 Adolescentes (13 a 17 años) ');
                        descripcion.options[4] = new Option('1 Adulto (18 años +) y 1 Adolescente (13 a 17 años) y 1 Niño (3 a 12 años)');
                        descripcion.options[5] = new Option('1 Adulto (18 años +) y 1 Adolescente (13 a 17 años) y 1 Bebé (0 a 2 años)');
                        descripcion.options[6] = new Option('1 Adulto (18 años +) y 1 Niño (3 a 12 años) y 1 Bebé (0 a 2 años)');
                        descripcion.options[7] = new Option('2 Adultos (18 años +) y 1 Bebé (0 a 2 años)');
                        descripcion.options[8] = new Option('2 Adultos (18 años +) y 1 Niño (3 a 12 años)');
                        descripcion.options[9] = new Option('2 Adultos (18 años +) y 1 Adolescente (13 a 17 años)');
                        descripcion.options[10] = new Option('3 Adultos (18 años +)');
                    }

                    else if (seleccionado === '4') {
                        descripcion.options[1] = new Option('1 Adulto (18 años +) y 3 Niños (3 a 12 años)');
                        descripcion.options[2] = new Option('1 Adulto (18 años +) y 3 Adolescentes (13 a 17 años)');
                        descripcion.options[3] = new Option('2 Adultos (18 años +) y 2 Bebés (0 a 2 años)');
                        descripcion.options[4] = new Option('2 Adultos (18 años +) y 1 Niño (3 a 12 años) y 1 Bebé (0 a 2 años)');
                        descripcion.options[5] = new Option('2 Adultos (18 años +) y 1 Adolescente (13 a 17 años) y 1 Bebé (0 a 2 años)');
                        descripcion.options[6] = new Option('2 Adultos (18 años +) y 1 Niño (3 a 12 años) y 1 Adolescente (13 a 17 años)');
                        descripcion.options[7] = new Option('3 Adultos (18 años +) y 1 Bebé (0 a 2 años)');
                        descripcion.options[8] = new Option('3 Adultos (18 años +) y 1 Niño (3 a 12 años)');
                        descripcion.options[9] = new Option('3 Adultos (18 años +) y 1 Adolescente (13 a 17 años)');
                        descripcion.options[10] = new Option('4 Adultos (18 años +)');
                        // Puedes agregar más combinaciones según tus necesidades
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

                                <div style="text-align: left;">
                                <a href="inicio.php">
                                    <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                </a>
                                <a href="reservagroup.php">
                                    <button class="btn info">Reserva grupal</button>
                                </a>
                                </div>

                                <h1 style="text-align: center;"><b>Ingrese los datos de la Reserva</b></h1>
                                <BR></BR>
                                <HR></HR>

                                <form action="insertar.php" method="POST"  id="Reservas">
                                <div class="container mt-5 custom-container"  style="margin:auto; text-align: center; width: 850px;">
                                    <div class="row">
                                    <div class="col-md-6">
                                    <p><b>Fecha</b></p>
                                    <input type="date" class="form-control mb-3" onblur="dif(), filterOptionsByMonth()" id="fecha" name="fecha" placeholder="Fecha" onChange="alertDiaDeSemana(), dif(), updateSelect3Options()" required>
                                    
                                    <p><b>Día</b></p>
                                    <p>El día seleccionado es: <span id="dia" name="dia"></span></p>
                                    <br>
                                    <input type="hidden" class="form-control mb-3" id="dia-input" name="dia" placeholder="Día" readonly>                                  
                                    <p><b>Llegada</b></p>
                                    <input type="time" class="form-control mb-3" name="llegada" placeholder="Llegada" value="15:00:00" required>
                                    <p><b>Salida</b></p>
                                    <input type="date" class="form-control mb-3" onchange="dif()" onblur="dif()" id="salida" name="salida" placeholder="Salida" required>
                                    <p><b>Número de noches</b></p>
                                    <input class="form-control mb-3" id="noches" name="noches" placeholder="Noches" onkeypress="return event.charCode>=48 && event.charCode<=57" value="" readonly required>
                                    <p><b>Nombre del Cliente</b></p>
                                    <input type="int" class="form-control mb-3" id="cliente" name="cliente" placeholder="Ingrese el nombre del cliente" onblur="upperCase()" onkeypress="return SoloLetras(event)" required>
                                    <p><b>Correo electrónico</b></p>
                                    <input type="int" class="form-control mb-3" name="email" placeholder="Ingrese el correo electrónico" required>
                                    <p><b>Número de teléfono</b></p>
                                    <input type="int" class="form-control mb-3" name="telefono" placeholder="Ingrese el número de teléfono" onkeypress="return event.charCode>=48 && event.charCode<=57" required>
                                    </div>
                                    <div class="col-md-6">
                                    <hr>
                                    <p><b>Habitaciones disponibles para la fecha seleccionada:</b></p>
                                    <span id="habitacionesDisponibles"></span>
                                    <hr>
                
                                    <p><b>Reserva Vía</b></p>
                                    <!-- Agrega un evento onchange para el selector para que se actualice cuando cambie el mes -->
                                    <select class="form-control mb-3" id="select1" name="via" placeholder="Vía" required onchange="filterOptionsByMonth(), updateSelect3Options()">
                                        <option selected>Elija una opción</option>
                                        <hr>
                                        <optgroup label="DIRECTA" class="grupo1">
                                            <option value="Directa">Directa</option>
                                            <option value="DSemanaSanta">DIRECTA Semana Santa (1-16 de Abril)</option>
                                            <option value="DRecesoEscolar">DIRECTA Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="DAtlixcayotlDiadeMuertos">DIRECTA Atlixcayotl/Dia de Muertos (22 de Septiembre-2 de Noviembre)</option>
                                            <option value="DVillaIluminada">DIRECTA Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="DFinDeAno">DIRECTA Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>
                                        <hr>
                                        <optgroup label="Wix" class="grupo2">
                                            <option value="Wix">Wix</option>
                                            <option value="WixSemanaSanta">Wix Semana Santa (1-16 de Abril)</option>
                                            <option value="WixRecesoEscolar">Wix Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="WixAtlixcayotlDiadeMuertos">Wix Atlixcayotl/Dia de Muertos (22 de Septiembre-2 de Noviembre)</option>
                                            <option value="WixVillaIluminada">Wix Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="WixFinDeAno">Wix Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>
                                        <hr>
                                        <optgroup label="Airbnb" class="grupo1">
                                            <option value="Airbnb">Airbnb</option>
                                            <option value="AirbnbSemanaSanta">Airbnb Semana Santa (1-16 de Abril)</option>
                                            <option value="AirbnbRecesoEscolar">Airbnb Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="AirbnbAtlixcayotlDiadeMuertos">Airbnb Atlixcayotl/Dia de Muertos (22 de Septiembre-2 de Noviembre)</option>
                                            <option value="AirbnbVillaIluminada">Airbnb Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="AirbnbFinDeAno">Airbnb Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>
                                        <hr>
                                        <optgroup label="Walkin" class="grupo2">
                                            <option value="Walkin">Walkin</option>
                                            <option value="WalkinSemanaSanta">Walkin Semana Santa (1-16 de Abril)</option>
                                            <option value="WalkinRecesoEscolar">Walkin Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="WalkinAtlixcayotlDiadeMuertos">Walkin Atlixcayotl/Dia de Muertos (22 de Septiembre-2 de Noviembre)</option>
                                            <option value="WalkinVillaIluminada">Walkin Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="WalkinFinDeAno">Walkin Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>
                                        <hr>
                                        <optgroup label="Booking" class="grupo1"> 
                                            <option value="Booking">Booking</option>
                                            <option value="BookingSemanaSanta">Booking Semana Santa (1-16 de Abril)</option>
                                            <option value="BookingRecesoEscolar">Booking Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="BookingAtlixcayotlDiadeMuertos">Booking Atlixcayotl/Dia de Muertos (22 de Septiembre-2 de Noviembre)</option>
                                            <option value="BookingVillaIluminada">Booking Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="BookingFinDeAno">Booking Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>
                                        <hr>
                                        <optgroup label="EXPEDIA" class="grupo2"> 
                                            <option value="EXPEDIA">EXPEDIA</option>
                                            <option value="ESemanaSanta">EXPEDIA Semana Santa (1-16 de Abril)</option>
                                            <option value="ERecesoEscolar">EXPEDIA Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="EAtlixcayotlDiadeMuertos">EXPEDIA Atlixcayotl/Dia de Muertos (22 de Septiembre-2 de Noviembre)</option>
                                            <option value="EVillaIluminada">EXPEDIA Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="EFinDeAno">EXPEDIA Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>
                                        <hr>
                                    </select>

                                    <script>
                                        function filterOptionsByMonth() {
                                            const select = document.getElementById('select1');
                                            const options = select.getElementsByTagName('option');
                                            const dateInput = document.getElementById('fecha').value;
                                            const selectedDate = new Date(dateInput);
                                            const selectedMonth = selectedDate.getMonth() + 1;

                                            // Mostrar todas las opciones al principio
                                            for (let i = 0; i < options.length; i++) {
                                                options[i].style.display = 'block';
                                            }

                                            if (selectedMonth === 12) {
                                                // Si el mes seleccionado es diciembre, ocultar las opciones que no contienen "Diciembre" en su texto
                                                for (let i = 0; i < options.length; i++) {
                                                    const option = options[i];
                                                    if (option.style.display === 'block' && option.innerText.indexOf('Diciembre') === -1) {
                                                        option.style.display = 'none';

                                                        // Además, verificar si la opción pertenece a un grupo (optgroup) y ocultar el grupo si es necesario
                                                        const optgroup = option.parentElement;
                                                        if (optgroup && Array.from(optgroup.children).every(opt => opt.style.display === 'none')) {
                                                            optgroup.style.display = 'none';
                                                        }
                                                    }
                                                }
                                            } else {
                                                // Si el mes seleccionado no es diciembre, ocultar las opciones que no coinciden con el mes seleccionado
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
                                        }


                                        function getMonthNumber(monthName) {
                                            const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                                            return months.indexOf(monthName) + 1;
                                        }

                                        // Filtramos las opciones por el mes seleccionado al cargar la página (opcional)
                                        // filterOptionsByMonth();
                                    </script>

                                    <p><b>Habitación</b></p>
                                    <select class="form-control mb-3" id="select2" name="habitacion" placeholder="Habitación" onchange="updateSelect3Options()" required>

                                    </select>

                                    <p><b>Tarifa</b></p>
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
                                        /////////////////////////////////////////////////////////////////////////////////7
                                        //PRECIOS PARA RESERVAS EN WIX
                                        Wix: {
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
                                        WixSemanaSanta: {
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
                                        WixRecesoEscolar: {
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
                                        WixAtlixcayotlDiadeMuertos: {
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
                                        WixVillaIluminada: {
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
                                        WixFinDeAno: {
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
                                        /////////////////////////////////////////////////////////////////////////////////    

                                        /////////////////////////////////////////////////////////////////////////////////7
                                        //PRECIOS PARA RESERVAS EN Airbnb
                                        Airbnb: {
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
                                        AirbnbSemanaSanta: {
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
                                        AirbnbRecesoEscolar: {
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
                                        AirbnbAtlixcayotlDiadeMuertos: {
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
                                        AirbnbVillaIluminada: {
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
                                        AirbnbFinDeAno: {
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
                                        ///////////////////////////////////////////////////////////////////////////////// 

                                        /////////////////////////////////////////////////////////////////////////////////7
                                        //PRECIOS PARA RESERVAS EN Walkin
                                        Walkin: {
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
                                        WalkinSemanaSanta: {
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
                                        WalkinRecesoEscolar: {
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
                                        WalkinAtlixcayotlDiadeMuertos: {
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
                                        WalkinVillaIluminada: {
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
                                        WalkinFinDeAno: {
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
                                        ///////////////////////////////////////////////////////////////////////////////// 

                                        //PRECIOS PARA RESERVAS EN Booking
                                        Booking: {
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
                                        //PRECIOS PARA SEMANA SANTA Booking
                                        BookingSemanaSanta: {
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
                                        //PRECIOS PARA RECESO ESCOLAR Booking
                                        BookingRecesoEscolar: {
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
                                        //PRECIOS PARA ATLIXCAYOTL/DIA DE MUERTOS Booking
                                        BookingAtlixcayotlDiadeMuertos: {
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
                                        //PRECIOS PARA VILLA ILUMINADA Booking
                                        BookingVillaIluminada: {
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
                                        //PRECIOS PARA FIN DE AÑO Booking
                                        BookingFinDeAno: {
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


                                    
                                    <p><b>Número de huéspedes</b></p>
                                    <select class="form-control mb-3" id="huespedes" name="huespedes" placeholder="Número de huéspedes" onclick="LlenarHuesped()" required>
                                        <option selected>Elija una opción</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <!--3 o más huespedes se reservan como servicio extra-->
                                        <!--<option value="3">3</option>
                                        <option value="4">4</option>-->
                                    </select>
                                    <p><b>Descripción</b></p>
                                    <select class="form-control mb-3" id="edades" name="edades" placeholder="Seleccione las edades de los huéspedes" required>
                                        
                                    </select>
                                    <!--
                                    <p><b>Anticipo</b></p>-->
                                    <input type="hidden" class="form-control mb-3" id="anticipo" name="anticipo" placeholder="Anticipo (ANOTE SOLAMENTE NÚMEROS SIN SIGNOS NI LETRAS)" required>
                                    <!--Servicios Especiales-->
                                    <input type="hidden" class="form-control mb-3" name="sextras" required >
                                    <!--STATUS DE LA HABITACIÓN--->
                                    <input type="hidden" class="form-control mb-3" name="status" value="Reservado" required>
                                    <!--CONSUMOS EXTRAS--->
                                    <input type="hidden" class="form-control mb-3" name="cextras" required>
                                    <!--TOTAL EXTRAS--->
                                    <input type="hidden" class="form-control mb-3" name="textras" required>
                                    <!--GARANTÍA--->
                                    <input type="hidden" class="form-control mb-3" name="garantia" placeholder="Indique que se dejará como garantía" required>
                                    <!--MÉTODO DE PAGO--->
                                    <input type="hidden" class="form-control mb-3" name="pago" placeholder="Indique el método de pago" required>
                                    <p><b>Comentarios</b></p>
                                    <input type="int" class="form-control mb-3" name="comentarios" placeholder="Comentarios" required>
                                    </div>
                                    </div>
                                    <br>
                                    <!-- Botón de Submit -->
                                    <div class="text-center">
                                        <input type="submit" class="registerbtn" value="Finalizado">
                                    </div>
                                </div>
                            </form>
                            <!-- Asegúrate de que este script esté directamente en tu archivo exp1.php -->
                            <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fechaInput = document.getElementById('fecha');

            fechaInput.addEventListener('blur', function() {
                fetch('obtenerHabitaciones.php', {
                    method: 'POST',
                    body: new URLSearchParams({
                        fecha: fechaInput.value
                    }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                })
                .then(response => response.json())
                .then(habitacionesPorCategoria => {
                    console.log('Habitaciones Disponibles por Categoría:', habitacionesPorCategoria);

                    // Construye la cadena para mostrar en SweetAlert
                    let resultado = '';
                    for (const [categoria, cantidad] of Object.entries(habitacionesPorCategoria)) {
                        resultado += `${categoria}: ${cantidad}<br>`;
                    }

                    // Muestra la información en una ventana de SweetAlert
                    Swal.fire({
                        title: 'Habitaciones Disponibles',
                        html: resultado,
                        icon: 'info',
                        confirmButtonText: 'OK'
                    });
                })
                .catch(error => console.error('Error al obtener las habitaciones disponibles por categoría:', error));
            });
        });
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