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
        <title>Tarifas - Casa Flora Handmade Hotel</title>
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

            .h2 {
                text-align: center;
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
        </style>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
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
                        <a class="active" href="tarifas.php">Tarifas</a>
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
                            <h1 style="text-align: center;"><b>Tarifas (ACTUALIZADAS 2023)</b></h1>
                            <br>
                            <hr>
                            <!--Tarifas base-->
                            <table>
                                <h2 class="h2">TARIFAS DIRECTAS BASE</h2>
                                <br>
                                <h4>Laboral (Lunes, Martes, Miércoles y Jueves)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio</th>
                                        <th>Total IVA/ISH (3%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$820.00</th>
                                        <th>$976.00</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$899.00</th>
                                        <th>$1070.00</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1025.00</th>
                                        <th>$1220.00</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1159.00</th>
                                        <th>$1379.00</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Fin de semana (Viernes, Sábado y Domingo)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio</th>
                                        <th>Total IVA/ISH (3%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$879.00</th>
                                        <th>$1046.00</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$989.00</th>
                                        <th>$1177.00</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1124.00</th>
                                        <th>$1338.00</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1279.00</th>
                                        <th>$1522.00</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Semana Santa (26 de Marzo - 11 de Abril)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Base</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$967.00</th>
                                        <th>$1150.61</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1088.00</th>
                                        <th>$1294.60</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1236.00</th>
                                        <th>$1471.32</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1407.00</th>
                                        <th>$1674.21</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Receso Escolar (9 de Julio - 9 de Agosto)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio (L,A,M,J)</th>
                                        <th>ISH + IVA (19%)</th>
                                        <th>Precio (Fin de semana)</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$815.00</th>
                                        <th>$969.83</th>
                                        <th>$923.00</th>
                                        <th>$1098.31</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$899.00</th>
                                        <th>$1069.81</th>
                                        <th>$1038.00</th>
                                        <th>$1235.76</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1076.00</th>
                                        <th>$1280.74</th>
                                        <th>$1180.00</th>
                                        <th>$1404.44</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1194.00</th>
                                        <th>$1420.59</th>
                                        <th>$1343.00</th>
                                        <th>$1598.11</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Atlixcáyotl/Día de Muertos</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio (Fin de Semana)</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$984.00</th>
                                        <th>$1171.53</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1108.00</th>
                                        <th>$1318.14</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1259.00</th>
                                        <th>$1498.07</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1432.00</th>
                                        <th>$1704.65</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Villa Iluminada (19 de Noviembre - 22 de Diciembre)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio (L,A,M,J)</th>
                                        <th>ISH + IVA (19%)</th>
                                        <th>Precio (Fin de semana)</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$886.89</th>
                                        <th>$1055.40</th>
                                        <th>$993.27</th>
                                        <th>$1181.99</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$997.89</th>
                                        <th>$1187.49</th>
                                        <th>$1117.57</th>
                                        <th>$1329.91</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1137.75</th>
                                        <th>$1353.92</th>
                                        <th>$1270.12</th>
                                        <th>$1511.44</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1286.49</th>
                                        <th>$1530.92</th>
                                        <th>$1445.27</th>
                                        <th>$1719.87</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Fin de Año (23 de Diciembre - 28 de Enero)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Base</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$1151.49</th>
                                        <th>$1370.27</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1295.59</th>
                                        <th>$1541.75</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1472.44</th>
                                        <th>$1752.20</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1675.49</th>
                                        <th>$1993.83</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <br><br>
                            <!--Precios Especiales y Paquetes-->
                            <table>
                                <h2 class="h2">Precios especiales y paquetes</h2>
                                <br>
                                <h4>Precios especiales para empresas 1 PERSONA/NO INCLUYE DESAYUNO</h4>
                                <h6>(SIEMPRE RESTAR $90 A LA TARIFA BASE DE LA FECHA)</h6>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio</th>
                                        <th>Total IVA/ISH (3%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$610.00</th>
                                        <th>$725.90</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$710.00</th>
                                        <th>$844.90</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$810.00</th>
                                        <th>$963.90</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$940.00</th>
                                        <th>$1118.60</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Paquetes románticos</h4>
                                <H6>ADULTO EXTRA (10 AÑOS O MÁS)$300</H6>
                                <h6>NIÑOS (2 A 9 AÑOS) $180</h6>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>SUPERIOR DELUX DECORADA+BOTELLA DE VINO+ POSTRE</th>
                                        <th>$1850.00</th>
                                    </tr>
                                    <tr>
                                        <th>DELUX CON VISTA+ MASAJE EN PAREJA+ BEBIDA DE CORTESIA</th>
                                        <th>$2400.00</th>
                                    </tr>
                                    <tr>
                                        <th>SUPERIOR DELUX+PASEO A CABALLO</th>
                                        <th>$2500.00</th>
                                    </tr>
                                    <tr>
                                        <th>ATARDECER ROMÁNTICO (Decoración con pétalos en la habitación, una botella de vino de la casa, un postre, un ramo de flores, decoración especial en una mesa de la terraza)</th>
                                        <th>$900.00</th>
                                    </tr>
                                    <tr>
                                        <th>DECORACIÓN ROMÁNTICA (PÉTALOS EN LA HABITACIÓN Y RAMO DE FLORES)</th>
                                        <th>$500.00</th>
                                    </tr>
                                    <tr>
                                        <th>VELADA ROMÁNTICA (decoración con pétalos en la habitación, una botella de vino espumoso, dos postres, un ramo de flores, decoración especial en una mesa de la terraza)</th>
                                        <th>$1600.00</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <br><br>
                            <!--Tarifas OTA c/Desayuno-->
                            <table>
                                <h2 class="h2">TARIFAS OTA's CON DESAYUNO</h2>
                                <br>
                                <h4>Laboral (Lunes, Martes, Miércoles y Jueves)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio</th>
                                        <th>Total IVA/ISH (3%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$934.83</th>
                                        <th>$1112.45</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1051.83</th>
                                        <th>$1251.68</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1199.25</th>
                                        <th>$1427.11</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1356.03</th>
                                        <th>$1613.68</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Fin de semana (Viernes, Sábado y Domingo)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio</th>
                                        <th>Total IVA/ISH (3%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$1046.01</th>
                                        <th>$1244.75</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1176.91</th>
                                        <th>$1400.52</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1337.56</th>
                                        <th>$1591.70</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1522.01</th>
                                        <th>$1811.19</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Semana Santa (26 de Marzo - 11 de Abril)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Fin de semana</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$1112.00</th>
                                        <th>$1323.20</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1251.00</th>
                                        <th>$1488.79</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1422.00</th>
                                        <th>$1692.01</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1618.00</th>
                                        <th>$1925.34</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Receso Escolar (9 de Julio - 9 de Agosto)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio (L,A,M,J)</th>
                                        <th>ISH + IVA (19%)</th>
                                        <th>Precio (Fin de semana)</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$937.00</th>
                                        <th>$1115.30</th>
                                        <th>$1061.00</th>
                                        <th>$1263.06</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1034.00</th>
                                        <th>$1230.28</th>
                                        <th>$1194.00</th>
                                        <th>$1421.12</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1238.00</th>
                                        <th>$1472.85</th>
                                        <th>$1357.00</th>
                                        <th>$1615.10</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1373.00</th>
                                        <th>$1633.67</th>
                                        <th>$1544.00</th>
                                        <th>$1837.83</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Atlixcáyotl/Día de Muertos</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio (Fin de Semana)</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$1132.00</th>
                                        <th>$1347.26</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1274.00</th>
                                        <th>$1515.86</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1448.00</th>
                                        <th>$1722.78</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1647.00</th>
                                        <th>$1960.35</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Villa Iluminada (19 de Noviembre - 22 de Diciembre)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio (L,A,M,J)</th>
                                        <th>ISH + IVA (19%)</th>
                                        <th>Precio (Fin de semana)</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$993.00</th>
                                        <th>$1182.05</th>
                                        <th>$1122.00</th>
                                        <th>$1335.65</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1118.00</th>
                                        <th>$1329.99</th>
                                        <th>$1263.00</th>
                                        <th>$1502.80</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1274.00</th>
                                        <th>$1516.39</th>
                                        <th>$1435.00</th>
                                        <th>$1707.93</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1441.00</th>
                                        <th>$1714.63</th>
                                        <th>$1633.00</th>
                                        <th>$1943.45</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Fin de Año (23 de Diciembre - 28 de Enero)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Base</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$1324.00</th>
                                        <th>$1575.81</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1490.02</th>
                                        <th>$1773.01</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1693.00</th>
                                        <th>$2015.03</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1927.00</th>
                                        <th>$2292.91</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <br><br>
                            <!--TARIFAS "EXPEDIA"-->
                            <table>
                                <h2 class="h2">TARIFAS "EXPEDIA" CON DESAYUNO</h2>
                                <br>
                                <h4>Laboral (Lunes, Martes, Miércoles y Jueves)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio</th>
                                        <th>Total IVA/ISH (3%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$1028.31</th>
                                        <th>$1223.69</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1157.01</th>
                                        <th>$1376.85</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1319.18</th>
                                        <th>$1569.82</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1491.63</th>
                                        <th>$1775.04</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Fin de semana (Viernes, Sábado y Domingo)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio</th>
                                        <th>Total IVA/ISH (3%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$1150.61</th>
                                        <th>$1369.23</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1294.60</th>
                                        <th>$1540.58</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1471.32</th>
                                        <th>$1750.87</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1674.21</th>
                                        <th>$1992.31</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Semana Santa (26 de Marzo - 11 de Abril)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Fin de semana</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$1223.13</th>
                                        <th>$1455.52</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1376.19</th>
                                        <th>$1637.67</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1564.05</th>
                                        <th>$1861.21</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1779.73</th>
                                        <th>$2117.88</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Receso Escolar (9 de Julio - 9 de Agosto)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio (L,A,M,J)</th>
                                        <th>ISH + IVA (19%)</th>
                                        <th>Precio (Fin de semana)</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$1030.95</th>
                                        <th>$1226.83</th>
                                        <th>$1167.53</th>
                                        <th>$1389.36</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1137.24</th>
                                        <th>$1353.31</th>
                                        <th>$1313.64</th>
                                        <th>$1563.23</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1361.46</th>
                                        <th>$1620.13</th>
                                        <th>$1492.95</th>
                                        <th>$1776.61</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1510.12</th>
                                        <th>$1797.04</th>
                                        <th>$1698.83</th>
                                        <th>$2021.61</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Atlixcáyotl/Día de Muertos</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio (Fin de Semana)</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$1245.00</th>
                                        <th>$1481.99</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1401.22</th>
                                        <th>$1667.45</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1592.48</th>
                                        <th>$1895.06</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1812.09</th>
                                        <th>$2156.38</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Villa Iluminada (19 de Noviembre - 22 de Diciembre)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Precio (L,A,M,J)</th>
                                        <th>ISH + IVA (19%)</th>
                                        <th>Precio (Fin de semana)</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$1092.65</th>
                                        <th>$1300.25</th>
                                        <th>$1234.63</th>
                                        <th>$1469.22</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1229.40</th>
                                        <th>$1462.99</th>
                                        <th>$1389.14</th>
                                        <th>$1653.08</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1401.71</th>
                                        <th>$1668.03</th>
                                        <th>$1578.76</th>
                                        <th>$1878.72</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$1584.96</th>
                                        <th>$1886.10</th>
                                        <th>$1796.47</th>
                                        <th>$2137.80</th>
                                    </tr>
                                </tbody>
	                        </table>
                            <hr>
                            <table>
                                <h4>Fin de Año (23 de Diciembre - 28 de Enero)</h4>
                                <thead class="table-success table-striped">
                                    <tr>
                                        <th>Tipo de Habitación</th>
                                        <th>Base</th>
                                        <th>ISH + IVA (19%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Habitación Estándar</th>
                                        <th>$1496.63</th>
                                        <th>$1733.40</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior</th>
                                        <th>$1638.92</th>
                                        <th>$1950.32</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Superior Deluxe</th>
                                        <th>$1862.64</th>
                                        <th>$2216.54</th>
                                    </tr>
                                    <tr>
                                        <th>Habitación Deluxe con vista</th>
                                        <th>$2119.49</th>
                                        <th>$2522.20</th>
                                    </tr>
                                </tbody>
	                        </table>
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