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

    $sql="SELECT *  FROM cotizaciones";
    $query=mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Realizar Cotización - Casa Flora Handmade Hotel</title>
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
        <link rel="stylesheet" href="css/estilo4.css">
        <link rel="stylesheet" href="css/estilo8.css">
	    <!-- Template Main Stylesheets -->
	    <link rel="stylesheet" href="css/contact-form.css" type="text/css">	
        <!--SWEET ALERT-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>	
        <!--SWEET ALERT-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
        <!-- Add icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <!--SCRIPT PARA LLENADO AUTOMÁTICO DE SELECTS 2 -->
        <script type="text/javascript">

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

            function alertDiaDeSemana2(){ 
                var d=new Date(document.getElementById("salida").value);
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
                document.getElementById("dia2").innerHTML=n;

                $("#dia2-input").val(n);
    
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
        </script>
        <script type="text/javascript">
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
                        descripcion.options[1] = new Option('3 Adultos (18 años +)');
                        descripcion.options[2] = new Option('2 Adultos (18 años +) y 1 Adolescentes (13 a 17 años)');
                        descripcion.options[3] = new Option('2 Adultos (18 años +) y 1 Niño (3 a 12 años)'); 
                        descripcion.options[4] = new Option('2 Adultos (18 años +) y 1 Bebé (0 a 2 años)');
                        descripcion.options[5] = new Option('1 Adulto (18 años +) y 2 Adolescentes (13 a 17 años)');
                        descripcion.options[6] = new Option('1 Adulto (18 años +) y 2 Niños (3 a 12 años)');
                        descripcion.options[7] = new Option('1 Adulto (18 años +), 1 Adolescente (13 a 17 años) y 1 Bebé (0 a 2 años)');
                        descripcion.options[8] = new Option('1 Adulto (18 años +), 1 Adolescente (13 a 17 años) y 1 Niño (3 a 12 años)'); 
                        descripcion.options[9] = new Option('1 Adulto (18 años +), 1 Niño (3 a 12 años) y 1 Bebé (0 a 2 años)'); 
                        
                    }
                    else if(seleccionado === '4'){
                        descripcion.options[1] = new Option('2 Adultos (18 años +) y 2 Adolescentes (13 a 17 años)');
                        descripcion.options[2] = new Option('2 Adultos (18 años +) y 2 Niños (3 a 12 años)');
                        descripcion.options[3] = new Option('2 Adultos (18 años +) y 2 Bebés (0 a 2 años)'); 
                        descripcion.options[4] = new Option('2 Adultos (18 años +), 1 Adolescente (13 a 17 años) y 1 Niño (0 a 2 años)');
                        descripcion.options[5] = new Option('2 Adultos (18 años +), 1 Adolescente (13 a 17 años) y 1 Bebé (0 a 2 años)'); 
                    }
                    //3 o 4 pack se reservan para habitaciones especiales además de que se cobrarán como servicio extra
  
                });
            }
        </script>
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
                        <a class="active" href="cotizacion.php">Cotización</a>
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
                                <h1 style="text-align: center;"><b>Cotización</b></h1>
                                <br>
                                <hr>
                                <div style="text-align: right;">
                                <a href="tablacot.php">
                                    <button class="btn info">Ver cotizaciones</button>
                                </a>
                                </div>
                                <br><br>
                                <h1 style="text-align: center;" >Ingrese los datos de la Reserva que desea cotizar</h1>
                                <br><br>
                                <style>
                                    #Reservas {
                                        max-width: 800px;
                                        margin: auto;
                                        display: grid;
                                        grid-template-columns: repeat(2, 1fr);
                                        grid-gap: 20px;
                                    }

                                    #Reservas div {
                                        margin-bottom: 20px;
                                    }

                                    #Reservas h1 {
                                        text-align: center;
                                    }

                                    #Reservas p {
                                        margin: 10px 0;
                                    }

                                    #Reservas input,
                                    #Reservas select {
                                        width: 100%;
                                        padding: 8px;
                                        box-sizing: border-box;
                                    }

                                    #Reservas hr {
                                        border: 0.5px solid #ddd;
                                    }

                                    #Reservas a {
                                        color: #007bff;
                                    }

                                    #Reservas input[type="submit"] {
                                        background-color: #007bff;
                                        color: white;
                                        cursor: pointer;
                                    }

                                    #Reservas input[type="submit"]:hover {
                                        background-color: #0056b3;
                                    }
                                </style>

                            <form action="insertarcot.php" method="POST" id="Reservas">
                                <div>
                                    <p>Llegada</p>
                                    <input type="date" class="form-control" onblur="dif(), filterOptionsByMonth()" id="fecha" name="fecha" required>
                                    <hr>
                                    <p><b>Habitaciones disponibles para la fecha seleccionada:</b></p>
                                    <span id="habitacionesDisponibles"></span>
                                    <hr>
                                    <!--<p>El día seleccionado es: <span id="dia" name="dia"></span></p>-->
                                    <p>Salida</p>
                                    <input type="date" class="form-control" onChange="alertDiaDeSemana2(), dif()" onblur="dif()" id="salida" name="salida" required>
                                    <!--<p>El día seleccionado es: <span id="dia2" name="dia2"></span></p>-->
                                    <p>Número de noches</p>
                                    <input type="int" class="form-control" id="noches" name="noches" placeholder="Número de noches" onkeypress="return event.charCode>=48 && event.charCode<=57" readonly>
                                    <p>Nombre del Cliente</p>
                                    <input type="int" class="form-control" id="cliente" name="cliente" placeholder="Ingrese el nombre del cliente" required>
                                    <p>Correo electrónico</p>
                                    <input type="email" class="form-control" name="email" placeholder="Ingrese el correo electrónico" required>
                                </div>
                                <div>
                                    <p>Número de teléfono</p>
                                    <input type="tel" class="form-control" name="telefono" placeholder="Ingrese el número de teléfono" onkeypress="return event.charCode>=48 && event.charCode<=57" required>
                                    <p>Reserva Vía</p>
                                    <!-- Tu selector -->

                                    <!-- Agrega un evento onchange para el selector para que se actualice cuando cambie el mes -->
                                    <select class="form-control mb-3" id="select1" name="via" placeholder="Vía" required onchange="filterOptionsByMonth()">
                                        <option selected>Elija una opción</option>
                                        <hr>
                                        <optgroup label="DIRECTA" class="grupo1">
                                            <option value="Directa">Directa</option>
                                            <option value="DSemanaSanta">DIRECTA Semana Santa (1-16 de Abril)</option>
                                            <option value="DRecesoEscolar">DIRECTA Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="DAtlixcayotlDiadeMuertos">DIRECTA Atlixcayotl/Dia de Muertos (22 de septiembre-2 de Noviembre)</option>
                                            <option value="DVillaIluminada">DIRECTA Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="DFinDeAno">DIRECTA Fin De Año (23 de Diciembre-3 de Enero)</option>
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

                                    // Filtramos las opciones por el mes actual al cargar la página
                                    //filterOptionsByMonth();
                                    </script>
                                    <p>Habitación</p>
                                    <select class="form-control" id="select2" name="habitacion" placeholder="Habitación" required></select>
                                    <p>Tarifa</p>
                                    <select class="form-control" id="select3" name="tarifa" placeholder="Tarifa" required></select>
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
                                    <select class="form-control" id="huespedes" name="huespedes" placeholder="Número de huéspedes" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                    <p>Descripción</p>
                                    <select class="form-control" id="edades" name="edades" placeholder="Seleccione las edades de los huéspedes" required></select>
                                </div>
                                <p>Medio de Contacto</p>
<div>
    <label>
        <input type="checkbox" name="medio_contacto[]" value="Teléfono">
        <img src="https://img.icons8.com/ios-filled/50/000000/phone.png" alt="Teléfono" title="Teléfono">
    </label>
    <label>
        <input type="checkbox" name="medio_contacto[]" value="Correo Electrónico">
        <img src="https://img.icons8.com/ios-filled/50/000000/email.png" alt="Correo Electrónico" title="Correo Electrónico">
    </label>
    <label>
        <input type="checkbox" name="medio_contacto[]" value="Red Social">
        <img src="https://img.icons8.com/ios-filled/50/000000/facebook-new.png" alt="Red Social" title="Red Social">
    </label>
    <label>
        <input type="checkbox" name="medio_contacto[]" value="Walk In">
        <img src="https://img.icons8.com/ios-filled/50/25D366/whatsapp.png" alt="Walk In" title="Red Social">
    </label>
</div>

                                <hr>
                                <p>Al realizar una reserva se están aceptando nuestros <a href="#">Términos y Condiciones</a>.</p>
                                <input type="submit" class="registerbtn" value="Enviar">
                            </form>
                            <script>
document.addEventListener('DOMContentLoaded', function() {
    const fechaInput = document.getElementById('fecha');
    const habitacionesDisponiblesElement = document.getElementById('habitacionesDisponibles');

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

            // Construye la cadena para mostrar en el span
            let resultado = '';
            for (const [categoria, cantidad] of Object.entries(habitacionesPorCategoria)) {
                resultado += `${categoria}: ${cantidad}<br>`;
            }

            // Actualiza la interfaz de usuario
            habitacionesDisponiblesElement.innerHTML = resultado;
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