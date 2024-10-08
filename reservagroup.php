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
        <title>Añadir nueva reservación en grupo - Casa Flora Handmade Hotel</title>
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
        <script>
            function aplicarFuncionesAdicionales() {
  // Coloca todas las funciones que deseas aplicar a los formularios adicionales aquí
  function aplicarFuncionesAdicionales(formulario) {
  $(formulario).find('inputo').each(function(){/*En caso de fallo quitar la "o"*/
    valor=$(this).next('span').text();
    $(this).val(valor);
  });

  $(formulario).find('#fecha').on('blur', function() {
    alertDiaDeSemana();
    dif();
  });

  $(formulario).find('#cliente').on('blur', function() {
    upperCase();
  });

  $(formulario).find('#cliente').on('keypress', function(event) {
    return SoloLetras(event);
  });

  $(formulario).find('#huespedes').on('change', function(event) {
    LlenarHuesped();
  });

  // Otras funciones que desees aplicar
}

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
                                <a href="exp1.php">
                                    <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                </a>
                                <a href="reservagroup2.php">
                                    <button class="btn info">Utilizar datos de la última reservación</button>
                                </a>
                                </div>
                                <br>
                                <h1 style="text-align: center;"><b>Ingrese los datos de la Reserva</b></h1>
                                <BR></BR>
                                <HR></HR>

                                <form action="insertargroup.php" method="POST" id="Reservas">
                                <div class="container mt-5 custom-container"  style="margin:auto; text-align: center; width: 850px;">
                                <div class="row">
                                    <div class="col-md-6">
                                <!-- ... Código del formulario original ... -->
                                    <p><b>Fecha</b></p>
                                    <input type="date" class="form-control mb-3" onblur="dif()" id="fecha" name="fecha" placeholder="Fecha"  onChange="alertDiaDeSemana(), dif()"required>
                                    <p><b>Día</b></p>
                                    <p>El día seleccionado es: <span id="dia" name="dia"></span></p>
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
                                    </div>
                                    <div class="col-md-6">
                                    <p><b>Número de teléfono</b></p>
                                    <input type="int" class="form-control mb-3" name="telefono" placeholder="Ingrese el número de teléfono" onkeypress="return event.charCode>=48 && event.charCode<=57" required>


                                    <p><b>Reserva Vía</b></p>
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
                                        <optgroup label="OTA" class="grupo2"> 
                                            <option value="OTA">OTA</option>
                                            <option value="OSemanaSanta">OTA Semana Santa (1-16 de Abril)</option>
                                            <option value="ORecesoEscolar">OTA Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="OAtlixcayotlDiadeMuertos">OTA Atlixcayotl/Dia de Muertos (22 de septiembre-2 de Noviembre)</option>
                                            <option value="OVillaIluminada">OTA Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="OFinDeAno">OTA Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>
                                        <hr>
                                        <optgroup label="EXPEDIA" class="grupo1"> 
                                            <option value="EXPEDIA">EXPEDIA</option>
                                            <option value="ESemanaSanta">EXPEDIA Semana Santa (1-16 de Abril)</option>
                                            <option value="ERecesoEscolar">EXPEDIA Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="EAtlixcayotlDiadeMuertos">EXPEDIA Atlixcayotl/Dia de Muertos (22 de septiembre-2 de Noviembre)</option>
                                            <option value="EVillaIluminada">EXPEDIA Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="EFinDeAno">EXPEDIA Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>
                                        <hr>
                                    </select>

                                    <script>
                                    function filterOptionsByMonth() {
                                        const select = document.getElementById('select1');
                                        const options = select.getElementsByTagName('option');
                                        const currentMonth = new Date().getMonth() + 1; // Sumamos 1 porque getMonth() devuelve un valor de 0 a 11
                                        
                                        for (let i = 0; i < options.length; i++) {
                                            const option = options[i];
                                            const optionText = option.innerText;
                                            
                                            // Utilizamos expresiones regulares para buscar el mes en el texto de la opción
                                            const monthRegex = /(\d+)\s+de\s+(\w+)/;
                                            const match = monthRegex.exec(optionText);
                                            if (match) {
                                                const optionMonth = getMonthNumber(match[2]); // Obtenemos el número del mes a partir del nombre
                                                if (optionMonth !== currentMonth) {
                                                    option.style.display = 'none'; // Ocultamos la opción que no coincide con el mes actual
                                                } else {
                                                    option.style.display = 'block'; // Mostramos la opción que coincide con el mes actual
                                                }
                                            }
                                        }
                                    }

                                    function getMonthNumber(monthName) {
                                        const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                                        return months.indexOf(monthName) + 1;
                                    }

                                    // Filtramos las opciones por el mes actual al cargar la página
                                    filterOptionsByMonth();
                                    </script>

                                    <p><b>Habitación</b></p>
                                    <select class="form-control mb-3" id="select2" name="habitacion" placeholder="Habitación" required>

                                    </select>
                                    <p><b>Tarifa</b></p>
                                    <select class="form-control mb-3" id="select3" name="tarifa" placeholder="Tarifa" required>
                                        
                                    </select>
                                    <!------------------------------------------------------------------------------------------------------------------->
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
                                                    951: ['$951 (Lunes - Jueves)'],
                                                    1046: ['$1046 (Viernes-Domingo)'],
                                                },
                                                Superior: {
                                                    1070: ['$1070 (Lunes - Jueves)'],
                                                    1177: ['$1177 (Viernes-Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1220: ['$1220 (Lunes - Jueves)'],
                                                    1338: ['$1338 (Viernes-Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1379: ['$1379 (Lunes - Jueves)'],
                                                    1522: ['$1522 (Viernes-Domingo)'],
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
                                                    1150.61: ['$1150.61'],
                                                },
                                                Superior: {
                                                    1294.60: ['$1294.60'],
                                                },
                                                Superior_Deluxe: {
                                                    1471.32: ['$1471.32'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1674.21: ['$1674.21'],
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
                                                    969.83: ['$969.83 (Lunes - Jueves)'],
                                                    1098.31: ['$1098.31 (Viernes-Domingo)'],
                                                },
                                                Superior: {
                                                    1069.81: ['$1069.81 (Lunes - Jueves)'],
                                                    1235.76: ['$1235.76 (Viernes-Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1280.74: ['$1280.74 (Lunes - Jueves)'],
                                                    1404.44: ['$1404.44 (Viernes-Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1420.59: ['$1420.59 (Lunes - Jueves)'],
                                                    1598.11: ['$1598.11 (Viernes-Domingo)'],
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
                                                    1171.53: ['$1171.53 (Lunes - Jueves)'],
                                                },
                                                Superior: {
                                                    1318.14: ['$1318.14 (Lunes - Jueves)'],
                                                },
                                                Superior_Deluxe: {
                                                    1498.07: ['$1498.07 (Lunes - Jueves)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1704.65: ['$1704.65 (Lunes - Jueves)'],
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
                                                    1055.40: ['$1055.40 (Lunes - Jueves)'],
                                                    1181.99: ['$1181.99 (Viernes-Domingo)'],
                                                },
                                                Superior: {
                                                    1187.49: ['$1187.49 (Lunes - Jueves)'],
                                                    1329.91: ['$1329.91 (Viernes-Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1353.92: ['$1353.92 (Lunes - Jueves)'],
                                                    1511.44: ['$1511.44 (Viernes-Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1530.92: ['$1530.92 (Lunes - Jueves)'],
                                                    1719.87: ['$1719.87 (Viernes-Domingo)'],
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
                                                    1370.27: ['$1370.27'],
                                                },
                                                Superior: {
                                                    1541.75: ['$1541.75'],
                                                },
                                                Superior_Deluxe: {
                                                    1752.20: ['$1752.20'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1993.83: ['$1993.83'],
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
                                                    1112.45: ['$1112.45 (Lunes - Jueves)'],
                                                    1244.75: ['$1244.75 (Viernes-Domingo)'],
                                                },
                                                Superior: {
                                                    1251.68: ['$1251.68 (Lunes - Jueves)'],
                                                    1400.52: ['$1400.52 (Viernes-Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1427.11: ['$1427.11 (Lunes - Jueves)'],
                                                    1591.70: ['$1591.70 (Viernes-Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1613.68: ['$1613.68 (Lunes - Jueves)'],
                                                    1811.19: ['$1811.19 (Viernes-Domingo)'],
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
                                                    1323.20: ['$1323.20'],
                                                },
                                                Superior: {
                                                    1488.79: ['$1488.79'],
                                                },
                                                Superior_Deluxe: {
                                                    1692.01: ['$1692.01'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1925.34: ['$1925.34'],
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
                                                    1115.30: ['$1115.30 (Lunes - Jueves)'],
                                                    1263.06: ['$1263.06 (Viernes-Domingo)'],
                                                },
                                                Superior: {
                                                    1230.28: ['$1230.28 (Lunes - Jueves)'],
                                                    1421.12: ['$1421.12 (Viernes-Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1472.85: ['$1472.85 (Lunes - Jueves)'],
                                                    1615.10: ['$1615.10 (Viernes-Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1633.67: ['$1633.67 (Lunes - Jueves)'],
                                                    1837.83: ['$1837.83 (Viernes-Domingo)'],
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
                                                    1347.26: ['$1347.26 (Lunes - Jueves)'],
                                                },
                                                Superior: {
                                                    1515.86: ['$1515.86 (Lunes - Jueves)'],
                                                },
                                                Superior_Deluxe: {
                                                    1722.78: ['$1722.78 (Lunes - Jueves)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1960.35: ['$1960.35 (Lunes - Jueves)'],
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
                                                    1182.05: ['$1182.05 (Lunes - Jueves)'],
                                                    1335.65: ['$1335.65 (Viernes-Domingo)'],
                                                },
                                                Superior: {
                                                    1329.99: ['$1329.99 (Lunes - Jueves)'],
                                                    1502.80: ['$1502.80 (Viernes-Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1516.39: ['$1516.39 (Lunes - Jueves)'],
                                                    1707.93: ['$1707.93 (Viernes-Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1714.63: ['$1714.63 (Lunes - Jueves)'],
                                                    1943.45: ['$1943.45 (Viernes-Domingo)'],
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
                                                    1575.81: ['$1575.81'],
                                                },
                                                Superior: {
                                                    1773.01: ['$1773.01'],
                                                },
                                                Superior_Deluxe: {
                                                    2015.03: ['$2015.03'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    2292.91: ['$2292.91'],
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
                                                    1223.69: ['$1223.69 (Lunes - Jueves)'],
                                                    1369.23: ['$1369.23 (Viernes-Domingo)'],
                                                },
                                                Superior: {
                                                    1376.85: ['$1376.85 (Lunes - Jueves)'],
                                                    1540.58: ['$1540.58 (Viernes-Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1569.82: ['$1569.82 (Lunes - Jueves)'],
                                                    1750.87: ['$1750.87 (Viernes-Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1775.04: ['$1775.04 (Lunes - Jueves)'],
                                                    1992.31: ['$1992.31 (Viernes-Domingo)'],
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
                                                    1455.52: ['$1455.52'],
                                                },
                                                Superior: {
                                                    1637.67: ['$1637.67'],
                                                },
                                                Superior_Deluxe: {
                                                    1861.21: ['$1861.21'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    2117.88: ['$2117.88'],
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
                                                    1226.83: ['$1226.83 (Lunes - Jueves)'],
                                                    1389.36: ['$1389.36 (Viernes-Domingo)'],
                                                },
                                                Superior: {
                                                    1353.31: ['$1353.31 (Lunes - Jueves)'],
                                                    1563.23: ['$1563.23 (Viernes-Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1620.13: ['$1620.13 (Lunes - Jueves)'],
                                                    1776.61: ['$1776.61 (Viernes-Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1797.04: ['$1797.04 (Lunes - Jueves)'],
                                                    2021.61: ['$2021.61 (Viernes-Domingo)'],
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
                                                    1481.99: ['$1481.99 (Lunes - Jueves)'],
                                                },
                                                Superior: {
                                                    1667.45: ['$1667.45 (Lunes - Jueves)'],
                                                },
                                                Superior_Deluxe: {
                                                    1895.06: ['$1895.06 (Lunes - Jueves)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    2156.38: ['$2156.38 (Lunes - Jueves)'],
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
                                                    1300.25: ['$1300.25 (Lunes - Jueves)'],
                                                    1469.22: ['$1469.22 (Viernes-Domingo)'],
                                                },
                                                Superior: {
                                                    1462.99: ['$1462.99 (Lunes - Jueves)'],
                                                    1653.08: ['$1653.08 (Viernes-Domingo)'],
                                                },
                                                Superior_Deluxe: {
                                                    1668.03: ['$1668.03 (Lunes - Jueves)'],
                                                    1878.72: ['$1878.72 (Viernes-Domingo)'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    1886.10: ['$1886.10 (Lunes - Jueves)'],
                                                    2137.80: ['$2137.80 (Viernes-Domingo)'],
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
                                                    1733.40: ['$1733.40'],
                                                },
                                                Superior: {
                                                    1950.32: ['$1950.32'],
                                                },
                                                Superior_Deluxe: {
                                                    2216.54: ['$2216.54'],
                                                },
                                                Deluxe_con_vista_a_los_volcanes: {
                                                    2522.20: ['$2522.20'],
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
                                    <p><b>Número de huéspedes</b></p>
                                    <select class="form-control mb-3" id="huespedes" name="huespedes" placeholder="Número de huéspedes" onclick="LlenarHuesped()" required>
                                        <option selected>Elija una opción</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3 o más</option>
                                        <!--3 o más huespedes se reservan como servicio extra-->
                                        <!--<option value="3">3</option>
                                        <option value="4">4</option>-->
                                    </select>
                                    <p><b>Descripción</b></p>
                                    <select class="form-control mb-3" id="edades" name="edades" placeholder="Seleccione las edades de los huéspedes" required>
                                        
                                    </select>
                                    <p><b>Anticipo</b></p>
                                    <input type="int" class="form-control mb-3" id="anticipo" name="anticipo" placeholder="Anticipo (ANOTE SOLAMENTE NÚMEROS SIN SIGNOS NI LETRAS)" onkeypress="return event.charCode>=48 && event.charCode<=57" required>
                                    <!--<p>Servicios Especiales</p>-->
                                    <input type="hidden" class="form-control mb-3" name="sextras" placeholder="Introduzca el monto total de Servicios Especiales" onkeypress="return event.charCode>=48 && event.charCode<=57" >
                                    <!--STATUS DE LA HABITACIÓN--->
                                    <input type="hidden" class="form-control mb-3" name="status" value="Reservado" required>
                                    <!--CONSUMOS EXTRAS--->
                                    <input type="hidden" class="form-control mb-3" name="cextras" placeholder="Consumos Extras (ANOTE SOLAMENTE NÚMEROS SIN SIGNOS NI LETRAS)" required>
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