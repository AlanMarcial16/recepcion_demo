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
        <title>Nueva Reserva (Alianza) - Casa Flora Handmade Hotel</title>
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
        <!--SCRIPT PARA LLENADO AUTOMÁTICO DE SELECTS 2 -->
        <!--VERIFICACIÓN PARA INCLUIR ALIANZA-->
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
                                    function ver() {
                                            
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
                                    /* Read more about isConfirmed, isDenied below */
                                    if (result.isConfirmed) {
                                        Swal.fire('Para confirmar cualquier tarea llamar al administrador', '', 'warning')
                                    } else if (result.isDenied) {

                                        Swal.fire({
                                        title: 'Ingrese su contraseña',
                                        input: 'password',
                                        inputAttributes: {
                                            autocapitalize: 'off'
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
                                            // Hacer algo cuando se confirma la contraseña
                                            Swal.fire({
                                            title: 'Contraseña confirmada',
                                            icon: 'success'
                                            });
                                            window.location.href = '/recepcion/ud.php?id=<?php  echo $row['cod_reserva']?>';
                                            //href="ud.php?id=<?php  echo $row['cod_reserva']?>"
                                        }
                                        });
                                        // Redirigir al enlace deseado
                                        //window.location.href = '/recepcion/cerrarcaja.php';
                                    }
                                    })
                                
                                    
                                }
                                </script>

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
            


            function LlenarTarifa2()
            {
                const selectElement = document.querySelector('#habitacion');
                var tarifas = document.getElementById("tarifa");
                selectElement.addEventListener('change', (event) => {
                    const seleccionado = event.target.value;
                    //Habitaciones Estandar
                    if(seleccionado === 'Cuna de Moisés'){
                        tarifas.options[1] = new Option('725.90');
                        //tarifas.options[2] = new Option('1046'); 
                    }
                    else if(seleccionado === 'Dalia'){
                        tarifas.options[1] = new Option('725.90');
                        //tarifas.options[2] = new Option('1046'); 
                    }
                    //Habitacones Superior
                    else if(seleccionado === 'Bugambilia'){
                        tarifas.options[1] = new Option('844.90');
                        //tarifas.options[2] = new Option('1177');
                    }
                    else if(seleccionado === 'Tulipan'){
                        tarifas.options[1] = new Option('844.90');
                        //tarifas.options[2] = new Option('1177'); 
                    }
                    else if(seleccionado === 'Jazmín'){
                        tarifas.options[1] = new Option('844.90');
                        //tarifas.options[2] = new Option('1177');
                    }
                    else if(seleccionado === 'Violeta'){
                        tarifas.options[1] = new Option('844.90');
                        //tarifas.options[2] = new Option('1177');
                    }
                    //Habitaciones Superior Deluxe
                    else if(seleccionado === 'Lily'){
                        tarifas.options[1] = new Option('963.90');
                        //tarifas.options[2] = new Option('1338');
                    }
                    else if(seleccionado === 'Girasol'){
                        tarifas.options[1] = new Option('963.90');
                        //tarifas.options[2] = new Option('1338');
                    }
                    //Habitaciones Deluxe con vista a los volcanes
                    else if(seleccionado === 'Margarita'){
                        tarifas.options[1] = new Option('1118.60');
                        //tarifas.options[2] = new Option('1394.09');
                    }
                    else if(seleccionado === 'Noche Buena'){
                        tarifas.options[1] = new Option('1118.60');
                        //tarifas.options[2] = new Option('1522');
                    }
                    //Especiales
                    else if(seleccionado === 'Ocaso Terraza'){
                        tarifas.options[1] = new Option('2500');
                        //tarifas.options[2] = new Option('5000');
                    }
                    else if(seleccionado === 'Sala de Negocios'){
                        tarifas.options[1] = new Option('2500');
                        //tarifas.options[2] = new Option('5000');
                    }
                });
            }
        </script>

        <!--SCRIPT PARA LLENADO DE HUÉSPEDES PARA HABITACIONES ESTÁNDAR Y SUPERIOR -->



        <!--SCRIPT PARA LLENADO DE HUÉSPEDES PARA EL RESTO DE HABITACIONES -->
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
                    /*else if(seleccionado === '2'){
                        descripcion.options[1] = new Option('2 Adultos (18 años +)');
                        descripcion.options[2] = new Option('1 Adultos (18 años +) y 1 Adolescente (13 a 17 años)');
                        descripcion.options[3] = new Option('1 Adultos (18 años +) y 1 Niño (3 a 12 años)'); 
                        descripcion.options[4] = new Option('1 Adultos (18 años +) y 1 Bebé (0 a 2 años)'); 
                    }
                    else if(seleccionado === '3'){
                        descripcion.options[1] = new Option('3+ Pack se cobrará como servicio extra');
                    }
                    //3 o 4 pack se reservan para habitaciones especiales además de que se cobrarán como servicio extra
                    else if(seleccionado === '3'){
                        descripcion.options[1] = new Option('3 Adultos (18 años +)');
                        descripcion.options[2] = new Option('2 Adultos (18 años +) y 1 Adolescente (13 a 17 años)');
                        descripcion.options[3] = new Option('2 Adultos (18 años +) y 1 Niño (3 a 12 años)'); 
                        descripcion.options[4] = new Option('2 Adultos (18 años +) y 1 Bebé (0 a 2 años)'); 
                        descripcion.options[5] = new Option('1 Adultos (18 años +) y 2 Adolescentes (13 a 17 años');
                        descripcion.options[6] = new Option('1 Adultos (18 años +) y 2 Niños (3 a 12 años)'); 
                        descripcion.options[7] = new Option('1 Adultos (18 años +) y 2 Bebés (0 a 2 años)');
                        descripcion.options[8] = new Option('1 Adultos (18 años +), 1 Adolescente (13 a 17 años) y 1 Niño (3 a 12 años)');
                        descripcion.options[9] = new Option('1 Adultos (18 años +), 1 Adolescente (13 a 17 años) y 1 Bebé (0 a 2 años)');
                        descripcion.options[10] = new Option('1 Adultos (18 años +), 1 Niño (3 a 12 años) y 1 Bebé (0 a 2 años)');
                    }
                    else if(seleccionado === '4'){
                        descripcion.options[1] = new Option('4 Adultos (18 años +)');
                        descripcion.options[2] = new Option('3 Adultos (18 años +) y 1 Adolescente (13 a 17 años)');
                        descripcion.options[3] = new Option('3 Adultos (18 años +) y 1 Niño (3 a 12 años)'); 
                        descripcion.options[4] = new Option('3 Adultos (18 años +) y 1 Bebé (0 a 2 años)'); 
                        descripcion.options[5] = new Option('2 Adultos (18 años +) y 2 Adolescentes (13 a 17 años');
                        descripcion.options[6] = new Option('2 Adultos (18 años +) y 2 Niños (3 a 12 años)'); 
                        descripcion.options[7] = new Option('2 Adultos (18 años +) y 2 Bebés (0 a 2 años)');
                        descripcion.options[8] = new Option('2 Adultos (18 años +), 1 Adolescente (13 a 17 años) y 1 Niño (3 a 12 años)');
                        descripcion.options[9] = new Option('2 Adultos (18 años +), 1 Adolescente (13 a 17 años) y 1 Bebé (0 a 2 años)');
                        descripcion.options[10] = new Option('1 Adultos (18 años +), 2 Adolescentes (13 a 17 años) y 1 Niño (3 a 12 años)');
                        descripcion.options[11] = new Option('1 Adultos (18 años +), 2 Adolescentes (13 a 17 años) y 1 Bebé (0 a 2 años)'); 
                        descripcion.options[12] = new Option('1 Adultos (18 años +), 1 Adolescente (13 a 17 años) y 2 Niños (3 a 12 años)');
                        descripcion.options[13] = new Option('1 Adultos (18 años +), 1 Adolescente (13 a 17 años), 1 Niño (3 a 12 años) y 1 Bebé (0 a 2 años)');
                    }*/

                    
                });
            }
        </script>
    </head>
    <body onLoad="LlenarTarifa2(),LlenarHuesped()">
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
                                </div>

                                <br>


                                <form action="insertar.php" method="POST" style="max-width:500px;margin:auto">
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
                                        <optgroup label="CORPORATE TRAVEL SERVICES WORDLWIDE SAPI" class="grupo1">
                                            <option value="CORPORATETRAVEL">CORPORATETRAVEL Directa</option>
                                            <option value="CTSemanaSanta">CORPORATETRAVEL Semana Santa (1-16 de Abril)</option>
                                            <option value="CTRecesoEscolar">CORPORATETRAVEL Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="CTAtlixcayotlDiadeMuertos">CORPORATETRAVEL Atlixcayotl/Dia de Muertos</option>
                                            <option value="CTVillaIluminada">CORPORATETRAVEL Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="CTFinDeAno">CORPORATETRAVEL Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>  
                                        <hr>
                                        <optgroup label="AMERICAN EXPRESS" class="grupo2"> 
                                            <option value="AMEX">AMERICAN EXPRESS Directa</option>
                                            <option value="AMEXSemanaSanta">AMERICAN EXPRESS Semana Santa (1-16 de Abril)</option>
                                            <option value="AMEXRecesoEscolar">AMERICAN EXPRESS Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="AMEXAtlixcayotlDiadeMuertos">AMERICAN EXPRESS Atlixcayotl/Dia de Muertos</option>
                                            <option value="AMEXVillaIluminada">AMERICAN EXPRESS Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="AMEXFinDeAno">AMERICAN EXPRESS Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>
                                        <hr>
                                        <optgroup label="GLOBAL BUSINESS" class="grupo1"> 
                                            <option value="GBUSINESS">GLOBAL BUSINESS Directa</option>
                                            <option value="GBSemanaSanta">GLOBAL BUSINESS Semana Santa (1-16 de Abril)</option>
                                            <option value="GBRecesoEscolar">GLOBAL BUSINESS Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="GBAtlixcayotlDiadeMuertos">GLOBAL BUSINESS Atlixcayotl/Dia de Muertos</option>
                                            <option value="GBVillaIluminada">GLOBAL BUSINESS Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="GBFinDeAno">GLOBAL BUSINESS Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>
                                        <hr>
                                        <optgroup label="HUELLITAS MEXICANAS" class="grupo2"> 
                                            <option value="HMEXICANAS">HUELLITAS MEXICANAS Directa</option>
                                            <option value="HMSemanaSanta">HUELLITAS MEXICANAS Semana Santa (1-16 de Abril)</option>
                                            <option value="HMRecesoEscolar">HUELLITAS MEXICANAS Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="HMAtlixcayotlDiadeMuertos">HUELLITAS MEXICANAS Atlixcayotl/Dia de Muertos</option>
                                            <option value="HMVillaIluminada">HUELLITAS MEXICANAS Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="HMFinDeAno">HUELLITAS MEXICANAS Fin De Año (23 de Diciembre-3 de Enero)</option>
                                        </optgroup>
                                        <hr>
                                        <optgroup label="VIAJES POLANCO" class="grupo1"> 
                                            <option value="VPOLANCO">VIAJES POLANCO Directa</option>
                                            <option value="VPSemanaSanta">VIAJES POLANCO Semana Santa (1-16 de Abril)</option>
                                            <option value="VPRecesoEscolar">VIAJES POLANCO Receso Escolar (27 de Julio-27 de Agosto)</option>
                                            <option value="VPAtlixcayotlDiadeMuertos">VIAJES POLANCO Atlixcayotl/Dia de Muertos</option>
                                            <option value="VPVillaIluminada">VIAJES POLANCO Villa Iluminada (19 de Noviembre-22 de Diciembre)</option>
                                            <option value="VPFinDeAno">VIAJES POLANCO Fin De Año (23 de Diciembre-3 de Enero)</option>
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
                                        CORPORATETRAVEL: {
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
                                                    874.92: ['$874.92 (Lunes - Jueves)'],
                                                    962.32: ['$962.32 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    874.92: ['$874.92 (Lunes - Jueves)'],
                                                    962.32: ['$962.32 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1122.4: ['$1122.4 (Lunes - Jueves)'],
                                                    1230.96: ['$1230.96 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1122.4: ['$1122.4 (Lunes - Jueves)'],
                                                    1230.96: ['$1230.96 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1268.68: ['$1268.68 (Lunes - Jueves)'],
                                                    1400.24: ['$1400.24 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1268.68: ['$1268.68 (Lunes - Jueves)'],
                                                    1400.24: ['$1400.24 (Viernes-Domingo)'],
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
                                        CTSemanaSanta: {
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
                                                    1058.56: ['$1058.56'],
                                                },
                                                Dalia:{
                                                    1058.56: ['$1058.56'],
                                                },
                                                Bugambilia: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Tulipan: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Jazmín: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Violeta: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Lily: {
                                                    1353.61: ['$1353.61'],
                                                },
                                                Girasol: {
                                                    1353.61: ['$1353.61'],
                                                },
                                                Margarita: {
                                                    1540.27: ['$1540.27'],
                                                },
                                                NocheBuena: {
                                                    1540.27: ['$1540.27'],
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
                                        CTRecesoEscolar: {
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
                                                    892.24: ['$892.24 (Lunes - Jueves)'],
                                                    1010.45: ['$1010.45 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    892.24: ['$892.24 (Lunes - Jueves)'],
                                                    1010.45: ['$1010.45 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1178.28: ['$1178.28(Lunes - Jueves)'],
                                                    1292.08: ['$1292.08 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1178.28: ['$1178.28(Lunes - Jueves)'],
                                                    1292.08: ['$1292.08 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1306.94: ['$1306.94 (Lunes - Jueves)'],
                                                    1470.26: ['$1470.26 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1306.94: ['$1306.94 (Lunes - Jueves)'],
                                                    1470.26: ['$1470.26 (Viernes-Domingo)'],
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
                                        CTAtlixcayotlDiadeMuertos: {
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
                                                    1077.81: ['$1077.81 (Lunes - Jueves)'],
                                                },
                                                Dalia:{
                                                    1077.81: ['$1077.81 (Lunes - Jueves)'],
                                                },
                                                Bugambilia: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Tulipan: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Jazmín: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Violeta: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Lily: {
                                                    1378.22: ['$1378.22 (Lunes - Jueves)'],
                                                },
                                                Girasol: {
                                                    1378.22: ['$1378.22 (Lunes - Jueves)'],
                                                },
                                                Margarita: {
                                                    1568.28: ['$1568.28 (Lunes - Jueves)'],
                                                },
                                                NocheBuena: {
                                                    1568.28: ['$1568.28 (Lunes - Jueves)'],
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
                                        CTVillaIluminada: {
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
                                                    970.97: ['$970.97 (Lunes - Jueves)'],
                                                    1087.43: ['$1087.43 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    970.97: ['$970.97 (Lunes - Jueves)'],
                                                    1087.43: ['$1087.43 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1245.61: ['$1245.61 (Lunes - Jueves)'],
                                                    1390.52: ['$1390.52 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1245.61: ['$1245.61 (Lunes - Jueves)'],
                                                    1390.52: ['$1390.52 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1408.45: ['$1408.45 (Lunes - Jueves)'],
                                                    1582.28: ['$1582.28 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1408.45: ['$1408.45 (Lunes - Jueves)'],
                                                    1582.28: ['$1582.28 (Viernes-Domingo)'],
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
                                        CTFinDeAno: {
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
                                                    1260.65: ['$1260.65'],
                                                },
                                                Dalia:{
                                                    1260.65: ['$1260.65'],
                                                },
                                                Bugambilia: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Tulipan: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Jazmín: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Violeta: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Lily: {
                                                    1612.02: ['$1612.02'],
                                                },
                                                Girasol: {
                                                    1612.02: ['$1612.02'],
                                                },
                                                Margarita: {
                                                    1834.32: ['$1834.32'],
                                                },
                                                NocheBuena: {
                                                    1834.32: ['$1834.32'],
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
                                        /*option2: {
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
                                        },*/
                                        //PRECIOS PARA RESERVAS EN OTA
                                        AMEX: {
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
                                                    874.92: ['$874.92 (Lunes - Jueves)'],
                                                    962.32: ['$962.32 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    874.92: ['$874.92 (Lunes - Jueves)'],
                                                    962.32: ['$962.32 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1122.4: ['$1122.4 (Lunes - Jueves)'],
                                                    1230.96: ['$1230.96 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1122.4: ['$1122.4 (Lunes - Jueves)'],
                                                    1230.96: ['$1230.96 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1268.68: ['$1268.68 (Lunes - Jueves)'],
                                                    1400.24: ['$1400.24 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1268.68: ['$1268.68 (Lunes - Jueves)'],
                                                    1400.24: ['$1400.24 (Viernes-Domingo)'],
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
                                        AMEXSemanaSanta: {
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
                                                    1058.56: ['$1058.56'],
                                                },
                                                Dalia:{
                                                    1058.56: ['$1058.56'],
                                                },
                                                Bugambilia: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Tulipan: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Jazmín: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Violeta: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Lily: {
                                                    1353.61: ['$1353.61'],
                                                },
                                                Girasol: {
                                                    1353.61: ['$1353.61'],
                                                },
                                                Margarita: {
                                                    1540.27: ['$1540.27'],
                                                },
                                                NocheBuena: {
                                                    1540.27: ['$1540.27'],
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
                                        AMEXRecesoEscolar: {
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
                                                    892.24: ['$892.24 (Lunes - Jueves)'],
                                                    1010.45: ['$1010.45 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    892.24: ['$892.24 (Lunes - Jueves)'],
                                                    1010.45: ['$1010.45 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1178.28: ['$1178.28(Lunes - Jueves)'],
                                                    1292.08: ['$1292.08 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1178.28: ['$1178.28(Lunes - Jueves)'],
                                                    1292.08: ['$1292.08 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1306.94: ['$1306.94 (Lunes - Jueves)'],
                                                    1470.26: ['$1470.26 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1306.94: ['$1306.94 (Lunes - Jueves)'],
                                                    1470.26: ['$1470.26 (Viernes-Domingo)'],
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
                                        AMEXAtlixcayotlDiadeMuertos: {
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
                                                    1077.81: ['$1077.81 (Lunes - Jueves)'],
                                                },
                                                Dalia:{
                                                    1077.81: ['$1077.81 (Lunes - Jueves)'],
                                                },
                                                Bugambilia: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Tulipan: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Jazmín: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Violeta: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Lily: {
                                                    1378.22: ['$1378.22 (Lunes - Jueves)'],
                                                },
                                                Girasol: {
                                                    1378.22: ['$1378.22 (Lunes - Jueves)'],
                                                },
                                                Margarita: {
                                                    1568.28: ['$1568.28 (Lunes - Jueves)'],
                                                },
                                                NocheBuena: {
                                                    1568.28: ['$1568.28 (Lunes - Jueves)'],
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
                                        AMEXVillaIluminada: {
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
                                                    970.97: ['$970.97 (Lunes - Jueves)'],
                                                    1087.43: ['$1087.43 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    970.97: ['$970.97 (Lunes - Jueves)'],
                                                    1087.43: ['$1087.43 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1245.61: ['$1245.61 (Lunes - Jueves)'],
                                                    1390.52: ['$1390.52 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1245.61: ['$1245.61 (Lunes - Jueves)'],
                                                    1390.52: ['$1390.52 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1408.45: ['$1408.45 (Lunes - Jueves)'],
                                                    1582.28: ['$1582.28 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1408.45: ['$1408.45 (Lunes - Jueves)'],
                                                    1582.28: ['$1582.28 (Viernes-Domingo)'],
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
                                        AMEXFinDeAno: {
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
                                                    1260.65: ['$1260.65'],
                                                },
                                                Dalia:{
                                                    1260.65: ['$1260.65'],
                                                },
                                                Bugambilia: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Tulipan: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Jazmín: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Violeta: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Lily: {
                                                    1612.02: ['$1612.02'],
                                                },
                                                Girasol: {
                                                    1612.02: ['$1612.02'],
                                                },
                                                Margarita: {
                                                    1834.32: ['$1834.32'],
                                                },
                                                NocheBuena: {
                                                    1834.32: ['$1834.32'],
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
                                        GBUSINESS: {
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
                                                    874.92: ['$874.92 (Lunes - Jueves)'],
                                                    962.32: ['$962.32 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    874.92: ['$874.92 (Lunes - Jueves)'],
                                                    962.32: ['$962.32 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1122.4: ['$1122.4 (Lunes - Jueves)'],
                                                    1230.96: ['$1230.96 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1122.4: ['$1122.4 (Lunes - Jueves)'],
                                                    1230.96: ['$1230.96 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1268.68: ['$1268.68 (Lunes - Jueves)'],
                                                    1400.24: ['$1400.24 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1268.68: ['$1268.68 (Lunes - Jueves)'],
                                                    1400.24: ['$1400.24 (Viernes-Domingo)'],
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
                                        GBSemanaSanta: {
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
                                                    1058.56: ['$1058.56'],
                                                },
                                                Dalia:{
                                                    1058.56: ['$1058.56'],
                                                },
                                                Bugambilia: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Tulipan: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Jazmín: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Violeta: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Lily: {
                                                    1353.61: ['$1353.61'],
                                                },
                                                Girasol: {
                                                    1353.61: ['$1353.61'],
                                                },
                                                Margarita: {
                                                    1540.27: ['$1540.27'],
                                                },
                                                NocheBuena: {
                                                    1540.27: ['$1540.27'],
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
                                        GBRecesoEscolar: {
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
                                                    892.24: ['$892.24 (Lunes - Jueves)'],
                                                    1010.45: ['$1010.45 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    892.24: ['$892.24 (Lunes - Jueves)'],
                                                    1010.45: ['$1010.45 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1178.28: ['$1178.28(Lunes - Jueves)'],
                                                    1292.08: ['$1292.08 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1178.28: ['$1178.28(Lunes - Jueves)'],
                                                    1292.08: ['$1292.08 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1306.94: ['$1306.94 (Lunes - Jueves)'],
                                                    1470.26: ['$1470.26 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1306.94: ['$1306.94 (Lunes - Jueves)'],
                                                    1470.26: ['$1470.26 (Viernes-Domingo)'],
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
                                        GBAtlixcayotlDiadeMuertos: {
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
                                                    1077.81: ['$1077.81 (Lunes - Jueves)'],
                                                },
                                                Dalia:{
                                                    1077.81: ['$1077.81 (Lunes - Jueves)'],
                                                },
                                                Bugambilia: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Tulipan: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Jazmín: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Violeta: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Lily: {
                                                    1378.22: ['$1378.22 (Lunes - Jueves)'],
                                                },
                                                Girasol: {
                                                    1378.22: ['$1378.22 (Lunes - Jueves)'],
                                                },
                                                Margarita: {
                                                    1568.28: ['$1568.28 (Lunes - Jueves)'],
                                                },
                                                NocheBuena: {
                                                    1568.28: ['$1568.28 (Lunes - Jueves)'],
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
                                        GBVillaIluminada: {
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
                                                    970.97: ['$970.97 (Lunes - Jueves)'],
                                                    1087.43: ['$1087.43 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    970.97: ['$970.97 (Lunes - Jueves)'],
                                                    1087.43: ['$1087.43 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1245.61: ['$1245.61 (Lunes - Jueves)'],
                                                    1390.52: ['$1390.52 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1245.61: ['$1245.61 (Lunes - Jueves)'],
                                                    1390.52: ['$1390.52 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1408.45: ['$1408.45 (Lunes - Jueves)'],
                                                    1582.28: ['$1582.28 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1408.45: ['$1408.45 (Lunes - Jueves)'],
                                                    1582.28: ['$1582.28 (Viernes-Domingo)'],
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
                                        GBFinDeAno: {
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
                                                    1260.65: ['$1260.65'],
                                                },
                                                Dalia:{
                                                    1260.65: ['$1260.65'],
                                                },
                                                Bugambilia: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Tulipan: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Jazmín: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Violeta: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Lily: {
                                                    1612.02: ['$1612.02'],
                                                },
                                                Girasol: {
                                                    1612.02: ['$1612.02'],
                                                },
                                                Margarita: {
                                                    1834.32: ['$1834.32'],
                                                },
                                                NocheBuena: {
                                                    1834.32: ['$1834.32'],
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
                                        HMEXICANAS: {
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
                                                    874.92: ['$874.92 (Lunes - Jueves)'],
                                                    962.32: ['$962.32 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    874.92: ['$874.92 (Lunes - Jueves)'],
                                                    962.32: ['$962.32 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1122.4: ['$1122.4 (Lunes - Jueves)'],
                                                    1230.96: ['$1230.96 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1122.4: ['$1122.4 (Lunes - Jueves)'],
                                                    1230.96: ['$1230.96 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1268.68: ['$1268.68 (Lunes - Jueves)'],
                                                    1400.24: ['$1400.24 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1268.68: ['$1268.68 (Lunes - Jueves)'],
                                                    1400.24: ['$1400.24 (Viernes-Domingo)'],
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
                                        HMSemanaSanta: {
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
                                                    1058.56: ['$1058.56'],
                                                },
                                                Dalia:{
                                                    1058.56: ['$1058.56'],
                                                },
                                                Bugambilia: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Tulipan: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Jazmín: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Violeta: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Lily: {
                                                    1353.61: ['$1353.61'],
                                                },
                                                Girasol: {
                                                    1353.61: ['$1353.61'],
                                                },
                                                Margarita: {
                                                    1540.27: ['$1540.27'],
                                                },
                                                NocheBuena: {
                                                    1540.27: ['$1540.27'],
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
                                        HMRecesoEscolar: {
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
                                                    892.24: ['$892.24 (Lunes - Jueves)'],
                                                    1010.45: ['$1010.45 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    892.24: ['$892.24 (Lunes - Jueves)'],
                                                    1010.45: ['$1010.45 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1178.28: ['$1178.28(Lunes - Jueves)'],
                                                    1292.08: ['$1292.08 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1178.28: ['$1178.28(Lunes - Jueves)'],
                                                    1292.08: ['$1292.08 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1306.94: ['$1306.94 (Lunes - Jueves)'],
                                                    1470.26: ['$1470.26 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1306.94: ['$1306.94 (Lunes - Jueves)'],
                                                    1470.26: ['$1470.26 (Viernes-Domingo)'],
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
                                        HMAtlixcayotlDiadeMuertos: {
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
                                                    1077.81: ['$1077.81 (Lunes - Jueves)'],
                                                },
                                                Dalia:{
                                                    1077.81: ['$1077.81 (Lunes - Jueves)'],
                                                },
                                                Bugambilia: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Tulipan: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Jazmín: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Violeta: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Lily: {
                                                    1378.22: ['$1378.22 (Lunes - Jueves)'],
                                                },
                                                Girasol: {
                                                    1378.22: ['$1378.22 (Lunes - Jueves)'],
                                                },
                                                Margarita: {
                                                    1568.28: ['$1568.28 (Lunes - Jueves)'],
                                                },
                                                NocheBuena: {
                                                    1568.28: ['$1568.28 (Lunes - Jueves)'],
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
                                        HMVillaIluminada: {
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
                                                    970.97: ['$970.97 (Lunes - Jueves)'],
                                                    1087.43: ['$1087.43 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    970.97: ['$970.97 (Lunes - Jueves)'],
                                                    1087.43: ['$1087.43 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1245.61: ['$1245.61 (Lunes - Jueves)'],
                                                    1390.52: ['$1390.52 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1245.61: ['$1245.61 (Lunes - Jueves)'],
                                                    1390.52: ['$1390.52 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1408.45: ['$1408.45 (Lunes - Jueves)'],
                                                    1582.28: ['$1582.28 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1408.45: ['$1408.45 (Lunes - Jueves)'],
                                                    1582.28: ['$1582.28 (Viernes-Domingo)'],
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
                                        HMFinDeAno: {
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
                                                    1260.65: ['$1260.65'],
                                                },
                                                Dalia:{
                                                    1260.65: ['$1260.65'],
                                                },
                                                Bugambilia: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Tulipan: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Jazmín: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Violeta: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Lily: {
                                                    1612.02: ['$1612.02'],
                                                },
                                                Girasol: {
                                                    1612.02: ['$1612.02'],
                                                },
                                                Margarita: {
                                                    1834.32: ['$1834.32'],
                                                },
                                                NocheBuena: {
                                                    1834.32: ['$1834.32'],
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
                                        VPOLANCO: {
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
                                                    874.92: ['$874.92 (Lunes - Jueves)'],
                                                    962.32: ['$962.32 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    874.92: ['$874.92 (Lunes - Jueves)'],
                                                    962.32: ['$962.32 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    984.4: ['$984.4 (Lunes - Jueves)'],
                                                    1082.84: ['$1082.84 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1122.4: ['$1122.4 (Lunes - Jueves)'],
                                                    1230.96: ['$1230.96 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1122.4: ['$1122.4 (Lunes - Jueves)'],
                                                    1230.96: ['$1230.96 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1268.68: ['$1268.68 (Lunes - Jueves)'],
                                                    1400.24: ['$1400.24 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1268.68: ['$1268.68 (Lunes - Jueves)'],
                                                    1400.24: ['$1400.24 (Viernes-Domingo)'],
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
                                        VPSemanaSanta: {
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
                                                    1058.56: ['$1058.56'],
                                                },
                                                Dalia:{
                                                    1058.56: ['$1058.56'],
                                                },
                                                Bugambilia: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Tulipan: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Jazmín: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Violeta: {
                                                    1191.03: ['$1191.03'],
                                                },
                                                Lily: {
                                                    1353.61: ['$1353.61'],
                                                },
                                                Girasol: {
                                                    1353.61: ['$1353.61'],
                                                },
                                                Margarita: {
                                                    1540.27: ['$1540.27'],
                                                },
                                                NocheBuena: {
                                                    1540.27: ['$1540.27'],
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
                                        VPRecesoEscolar: {
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
                                                    892.24: ['$892.24 (Lunes - Jueves)'],
                                                    1010.45: ['$1010.45 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    892.24: ['$892.24 (Lunes - Jueves)'],
                                                    1010.45: ['$1010.45 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    984.23: ['$984.23 (Lunes - Jueves)'],
                                                    1136.9: ['$1136.9 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1178.28: ['$1178.28(Lunes - Jueves)'],
                                                    1292.08: ['$1292.08 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1178.28: ['$1178.28(Lunes - Jueves)'],
                                                    1292.08: ['$1292.08 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1306.94: ['$1306.94 (Lunes - Jueves)'],
                                                    1470.26: ['$1470.26 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1306.94: ['$1306.94 (Lunes - Jueves)'],
                                                    1470.26: ['$1470.26 (Viernes-Domingo)'],
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
                                        VPAtlixcayotlDiadeMuertos: {
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
                                                    1077.81: ['$1077.81 (Lunes - Jueves)'],
                                                },
                                                Dalia:{
                                                    1077.81: ['$1077.81 (Lunes - Jueves)'],
                                                },
                                                Bugambilia: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Tulipan: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Jazmín: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Violeta: {
                                                    1212.69: ['$1212.69 (Lunes - Jueves)'],
                                                },
                                                Lily: {
                                                    1378.22: ['$1378.22 (Lunes - Jueves)'],
                                                },
                                                Girasol: {
                                                    1378.22: ['$1378.22 (Lunes - Jueves)'],
                                                },
                                                Margarita: {
                                                    1568.28: ['$1568.28 (Lunes - Jueves)'],
                                                },
                                                NocheBuena: {
                                                    1568.28: ['$1568.28 (Lunes - Jueves)'],
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
                                        VPVillaIluminada: {
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
                                                    970.97: ['$970.97 (Lunes - Jueves)'],
                                                    1087.43: ['$1087.43 (Viernes-Domingo)'],
                                                },
                                                Dalia:{
                                                    970.97: ['$970.97 (Lunes - Jueves)'],
                                                    1087.43: ['$1087.43 (Viernes-Domingo)'],
                                                },
                                                Bugambilia: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Tulipan: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Jazmín: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Violeta: {
                                                    1092.49: ['$1092.49 (Lunes - Jueves)'],
                                                    1223.52: ['$1223.52 (Viernes-Domingo)'],
                                                },
                                                Lily: {
                                                    1245.61: ['$1245.61 (Lunes - Jueves)'],
                                                    1390.52: ['$1390.52 (Viernes-Domingo)'],
                                                },
                                                Girasol: {
                                                    1245.61: ['$1245.61 (Lunes - Jueves)'],
                                                    1390.52: ['$1390.52 (Viernes-Domingo)'],
                                                },
                                                Margarita: {
                                                    1408.45: ['$1408.45 (Lunes - Jueves)'],
                                                    1582.28: ['$1582.28 (Viernes-Domingo)'],
                                                },
                                                NocheBuena: {
                                                    1408.45: ['$1408.45 (Lunes - Jueves)'],
                                                    1582.28: ['$1582.28 (Viernes-Domingo)'],
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
                                        VPFinDeAno: {
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
                                                    1260.65: ['$1260.65'],
                                                },
                                                Dalia:{
                                                    1260.65: ['$1260.65'],
                                                },
                                                Bugambilia: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Tulipan: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Jazmín: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Violeta: {
                                                    1418.41: ['$1418.41'],
                                                },
                                                Lily: {
                                                    1612.02: ['$1612.02'],
                                                },
                                                Girasol: {
                                                    1612.02: ['$1612.02'],
                                                },
                                                Margarita: {
                                                    1834.32: ['$1834.32'],
                                                },
                                                NocheBuena: {
                                                    1834.32: ['$1834.32'],
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
                                    <input type="int" class="form-control mb-3" name="anticipo" placeholder="Anticipo (ANOTE SOLAMENTE NÚMEROS SIN SIGNOS NI LETRAS)" onkeypress="return event.charCode>=48 && event.charCode<=57" required>
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