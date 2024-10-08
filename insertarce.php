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
    
    $row=mysqli_fetch_array($query);
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Agregar consumos extras - Casa Flora Handmade Hotel</title>
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
        <style>
            .custom-container {
                max-width: 1600px; /* Ajusta el valor según tus necesidades */
                margin: 0 auto; /* Centra el contenido horizontalmente */
            }
            .logo-img {
            max-width: 50px; /* Ajusta el valor según tus necesidades */
            }
        .button1 {
            background-color: #4CAF50; 
            border: none;
            color: white;
            padding: 10px 30px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            margin: 4px 2px;
            cursor: pointer;
        }
        
        .button2 {
            background-color: #f44336; 
            border: none;
            color: white;
            padding: 10px 30px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            margin: 4px 2px;
            cursor: pointer;
        } 

        .button3 {
            background-color: #1e90ff; 
            border: none;
            color: white;
            padding: 10px 30px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            margin: 4px 2px;
            cursor: pointer;
        }    

        .h1{
            text-align: center;
        }
        .h2{
            text-align: center;
        }
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        table-layout:fixed;
        }

        td, th {
        border: 1px solid black;
        text-align: center;
        padding: 0.5% 0;
        overflow:hidden;
        width: 50;
        white-space:nowrap;
        }

        .thd{
            text-align: justify;
        }

        .thx{
            text-align: left;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }
        .thc{
            font-size: 50px;
        }

        .btn {
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

        .h4{
            text-align: center;
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
                                <a href="insertarpos.php?id=<?php  echo $row['cod_reserva']?>">
                                    <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                </a>
                                </div>
                                <form action="updatepos3.php" method="POST" style="max-width:500px;margin:auto">
                                    <h1>Ingrese los Servicios Especiales que desee agregar</h1>
                                    <br>
                                    <hr>
                                    <input type="hidden" name="cod_reserva" value="<?php echo $row['cod_reserva']  ?>">
                                    <input type="hidden" class="form-control mb-3" name="fecha" placeholder="Fecha" value="<?php  echo $row['fecha']?>" required>
                                    <input type="hidden" class="form-control mb-3" name="dia" placeholder="Día" value="<?php  echo $row['dia']?>" readonly>
                                    <input type="hidden" class="form-control mb-3" name="llegada" placeholder="Llegada" value="<?php  echo $row['llegada']?>" readonly>
                                    <input type="hidden" class="form-control mb-3" name="salida" placeholder="Salida" value="<?php  echo $row['salida']?>" required>
                                    <input type="hidden" class="form-control mb-3" name="cliente" placeholder="Cliente" value="<?php  echo $row['cliente']?>" readonly>
                                    <input type="hidden" class="form-control mb-3" name="habitacion" placeholder="Habitación" value="<?php  echo $row['habitacion']?>" readonly>
                                    <input type="hidden" class="form-control mb-3" name="tarifa" placeholder="Tarifa" value="<?php  echo $row['tarifa']?>" readonly>
                                    <input type="hidden" class="form-control mb-3" name="huespedes" placeholder="Tarifa" value="<?php  echo $row['huespedes']?>" readonly>
                                    <input type="hidden" class="form-control mb-3" name="anticipo" placeholder="Anticipo" onkeypress="return event.charCode>=48 && event.charCode<=57" value="<?php  echo $row['anticipo']?>" readonly>
                                    <input type="hidden" class="form-control mb-3" name="via" placeholder="Vía" value="<?php  echo $row['via']?>" readonly>
                                    <p>Elija los consumos</p>
                                    <select class="form-control mb-3" id="opciones" onchange="agregarTabla()">
                                    <option selected>Seleccione una opción</option>
                                            <!--AMENIDADES-->
                                            <hr>
                                            <optgroup label="AMENIDADES">
                                                <option value="10">toalla femenina</option>
                                                <option value="60">pasta dental grande</option>
                                                <option value="50">depend</option>
                                                <option value="40">pasta denta chica</option>
                                                <option value="45">crema</option>
                                                <option value="25">jabón zest</option>
                                                <option value="20">jabón tepeyac, coral, lirio</option>
                                                <option value="35">cepillo de dientes</option>
                                                <option value="30">rastrillo</option>
                                                <option value="90">desodorante</option>
                                                <option value="45">crema de manos</option>
                                                <option value="100">crema para peinar</option>
                                                <option value="30">esponja de baño</option>
                                                <option value="890">guayabera</option>
                                                <!--<option value=""></option>-->
                                            </optgroup>
                                            <!--DESAYUNOS-->
                                            <hr>
                                            <optgroup label="DESAYUNOS">
                                                <option value="125">Desayuno saludable</option>
                                                <option value="125">Chilaquiles</option>
                                                <option value="115">Huevos con chorizo</option>
                                                <option value="110">Huevos a la mexicana</option>
                                                <option value="105">Huevos rancheros</option>
                                                <option value="115">Quesadillas</option>
                                                <option value="119">Enfrijoladas</option>
                                            </optgroup>
                                            <!--ENTRADAS-->
                                            <hr>
                                            <optgroup label="ENTRADAS">
                                                <option value="70">Tlacoyos del pueblo</option>
                                                <option value="310">Gusanos de maguey</option>
                                                <option value="280">Chicatanas</option>
                                            </optgroup>
                                            <!--COMIDA/CENA-->
                                            <hr>
                                            <optgroup label="COMIDAS/CENAS">
                                                <option value="100">Aguachile de hongos</option>
                                                <option value="120">Ensalada de chorizo veggie</option>
                                                <option value="95">Cocktail de hongos</option>
                                                <option value="125">Carpaccio betabel</option>
                                                <option value="99">Tacos al pastor veggie</option>
                                                <option value="125">Tacos de pescado al pastor</option>
                                                <option value="60">Hot dog al pastor</option>
                                                <option value="150">Hamburguesa porto</option>
                                                <option value="138">Albóndigas veggie con linguini</option>
                                                <option value="225">Cecina Atlixquense</option>
                                                <option value="85">Volcán de chocolate oaxaqueño</option>
                                            </optgroup>
                                            <!--BEBIDAS-->
                                            <hr>
                                            <optgroup label="BEBIDAS">
                                                <optgroup label="Cervezas">
                                                    <option value="220">Cerveza Hertog (Holandesa)</option>
                                                    <option value="80">Cerveza Leffe</option>
                                                    <option value="150">Cerveza Alemana</option>
                                                    <option value="140">Cerveza Stout C5</option>
                                                    <option value="75">Cerveza Saga</option>
                                                    <option value="75">Cerveza Osadia</option>
                                                    <option value="90">Cerveza Stout Casa Flora</option>
                                                    <option value="100">Cerveza Artesanal(lata)</option>
                                                    <option value="75">Cerveza Artesanal(botella)</option>
                                                    <option value="50">Cerveza nacional</option>
                                                </optgroup>
                                                <optgroup label="Tragos">
                                                    <option value="125">Gin-Toronja</option>
                                                    <option value="125">Gin-Pepino</option>
                                                    <option value="400">Vino</option>
                                                    <option value="80">Mimosa</option>
                                                    <option value="90">Mezcal shot</option>
                                                    <option value="250">Promo C5</option>
                                                    <option value="150">Promo Licor</option>
                                                    <option value="110">Tequila Maestro Dobel COPA</option>
                                                    <option value="500">Vino espumoso Tierra Sur</option>
                                                    <option value="125">Jack Daniels COPA</option>
                                                    <option value="90">Jager Meister COPA</option>
                                                    <option value="125">Whisky Chivas 12 COPA con mineral</option>
                                                    <option value="90">Tequila HORNITOS COPA</option>
                                                    <option value="90">PRE VENTURA CAVA SEMI SEC RESERVA</option>
                                                </optgroup>
                                                <optgroup label="Otros">
                                                    <option value="45">Agua mineral</option>
                                                    <option value="25">Coca-Cola 235 ml</option>
                                                    <option value="25">Coca-Cola 335 ml</option>
                                                    <option value="25">Agua bonafont 235 ml</option>
                                                    <option value="45">Agua Tónica</option>
                                                    <option value="45">Smoothie</option>
                                                    <option value="45">Soda Italiana y Mineral</option>
                                                    <option value="45">Agua de frutas</option>
                                                    <option value="55">Jugo Verde</option>
                                                    <option value="35">Te Infusión</option>
                                                    <option value="70">Mix Nueces</option>
                                                </optgroup>
                                                <optgroup label="Cafés">
                                                    <option value="30">Café de olla tradicional</option>
                                                    <option value="35">Café americano/capuchino</option>
                                                    <option value="30">Café expreso</option>
                                                    <option value="65">Expreso Tonic</option>
                                                </optgroup>
                                            </optgroup>
                                    </select>

                                    <table id="tabla">
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Monto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                    <br>
                                    <p>Total: $<span id="total">0</span></p>

                                    <input type="int" class="form-control mb-3" name="cextras" placeholder="Introduzca el total de Consumos Extras" pattern="^[^-]*$" oninput="this.value = this.value.replace(/[^\d.-]/g, '')" required>

                                    <input type="hidden" name="desc_servicios" id="descServiciosHidden" value="">
                                   
                                    <input type="hidden" class="form-control mb-3" name="noches" placeholder="Noches" onkeypress="return event.charCode>=48 && event.charCode<=57" value="<?php  echo $row['noches']?>" readonly>
                                    
                                    <input type="hidden" class="form-control mb-3" name="sextras" placeholder="Introduzca el monto total de consumos extras" onkeypress="return event.charCode>=48 && event.charCode<=57" value="<?php  echo $row['cextras']?>" >
                                    
                                    <input type="hidden" class="form-control mb-3" name="comentarios" class="form-control mb-3" placeholder="Comentarios" readonly>
                                    <input type="hidden" class="form-control mb-3" name="total" class="form-control mb-3" value="<?php  echo $row['total']?>">
                                    <br>
                                    <input type="submit" class="btn btn-primary btn-block" value="Añadir">
                                    <br>
                                </form>

                                <script>
    var servicios = [];  // Array para almacenar servicios (valor y descripción)

    function agregarTabla() {
        // Obtener el valor y el texto seleccionado del select
        var select = document.getElementById("opciones");
        var opcionSeleccionada = select.options[select.selectedIndex].text;
        var valorSeleccionado = parseInt(select.value);

        // Actualizar el array de servicios
        servicios.push({ descripcion: opcionSeleccionada, valor: valorSeleccionado });

        // Mostrar los servicios en la tabla
        mostrarTabla();

        // Actualizar el campo oculto con el JSON de descripciones de servicios
        document.getElementById("descServiciosHidden").value = JSON.stringify(servicios.map(servicio => servicio.descripcion));
    }

    function mostrarTabla() {
        // Obtener la tabla y limpiar el cuerpo
        var tabla = document.getElementById("tabla").getElementsByTagName('tbody')[0];
        tabla.innerHTML = "";

        // Recorrer el array de servicios y agregar filas a la tabla
        for (var i = 0; i < servicios.length; i++) {
            var nuevaFila = tabla.insertRow(tabla.rows.length);
            var nuevaCeldaTexto = nuevaFila.insertCell(0);
            var nuevaCeldaValor = nuevaFila.insertCell(1);

            nuevaCeldaTexto.innerHTML = servicios[i].descripcion;
            nuevaCeldaValor.innerHTML = servicios[i].valor;
        }

        // Calcular y mostrar la suma de valores
        var suma = servicios.reduce((total, servicio) => total + servicio.valor, 0);
        document.getElementById("total").innerHTML = suma;
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