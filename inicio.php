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

    $sql="SELECT *  FROM reservaciones ORDER BY fecha DESC";
    $query=mysqli_query($con,$sql);

    $sql2="SELECT *  FROM entrec";
    $query2=mysqli_query($con,$sql2);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Inicio - Casa Flora Handmade Hotel</title>
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
        <link rel="stylesheet" href="css/button1.css?v=2">
        <link rel="stylesheet" href="css/estilo4.css?v=2">
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX=" crossorigin="anonymous" />
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
            .fa1 {
                font-size: 2em;
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
                                <br>
                                
                                <div style="text-align: right;">
                                <!--Descontar inventario-->
                                <a href="desc_inv.php">
                                    <button class="btn danger"><i class="fa1 fa fa-list-alt"></i></button>
                                </a>
                                <!--Venta directa-->
                                <a href="ventad.php">
                                    <button class="btn danger"><i class="fa1 fa fa-shopping-cart"></i></button>
                                </a>
                                <!--Cliente frecuente-->
                                <a href="clientefrec.php">
                                    <button class="btn btn-primary"><i class="fa1 fa fa-user-plus"></i></button>
                                </a>
                                <!--Nueva reservación-->
                                <a href="exp1.php">
                                    <button class="btn info"><i class="fa1 fa fa-calendar-plus-o"></i></button>
                                </a>
                                <!--Nueva reservación Alianza-->
                                <a onclick="al()">
                                    <button class="btn warning"><i class="fa1 fa fa-calendar-plus-o"></i></button>
                                </a>
                                <script type="text/javascript">
                                    function al() {
                                            
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
                                            window.location.href = '/recepcion/nra.php';
                                        }
                                        });
                                        // Redirigir al enlace deseado
                                        //window.location.href = '/recepcion/cerrarcaja.php';
                                    }
                                    })
                                
                                    
                                }
                                </script>
                                <a href="search.php">
                                    <button class="btn success"><i class="fa1 fa fa-search"></i></button>
                                </a>
                                <a href="habitaciones.php">
                                    <button class="btn btn-dark"><i class="fa1 fa fa-bed"></i></button>
                                </a>
                                <a onclick="scrollToBottom()">
                                    <button class="btn btn-dark"><i class="fa1 fa fa-arrow-circle-down"></i></button>
                                </a>
                                <script>
                                    function scrollToBottom() {
                                        window.scrollTo(0, document.body.scrollHeight);
                                    }
                                </script>
                                </div>
                                <br>
                                <h1 style="text-align: center;"><b>Reservaciones</b></h1>

                                <?php
                                // Obtener el valor seleccionado del filtro
                                $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

                                // Consulta SQL base para todas las reservas
                                $sql = "SELECT * FROM reservaciones";

                                // Agregar condiciones según el filtro seleccionado
                                if ($filter === 'hoy') {
                                    $sql .= " WHERE fecha = CURDATE()";
                                } elseif ($filter === 'mes') {
                                    $sql .= " WHERE MONTH(fecha) = MONTH(CURDATE())";
                                } elseif ($filter === 'semana') {
                                    $sql .= " WHERE YEARWEEK(fecha, 1) = YEARWEEK(CURDATE(), 1)";
                                }

                                // Ordenar las reservas por fecha descendente
                                $sql .= " ORDER BY fecha DESC";

                                // Ejecutar la consulta
                                $query = mysqli_query($con, $sql);

                                // Código HTML de la tabla
                                ?>
                                <div class="filter-section">
                                    <label for="filter">Filtrar reservas:</label>
                                    <select id="filter" onchange="applyFilter()">
                                        <option value="">Seleccione una opción</option>
                                        <option value="">Todas las reservas</option>
                                        <option value="hoy">Reservas para hoy</option>
                                        <option value="mes">Reservas por mes</option>
                                        <option value="semana">Reservas por semana</option>
                                    </select>
                                </div>

                                <table>
                                    <thead class="table-success table-striped">
                                        <tr>
                                            <th>Info</th>
                                            <!--<th>Código de Reserva</th>-->
                                            <th colspan="3">Cliente</th>
                                            <th colspan="2">Check In</th>
                                            <!--<th>Día</th>-->
                                            <th>Vía</th>
                                            <TH colspan="2">Habitación</TH>
                                            <th>Servicios</th>
                                            <th>Huéspedes</th>
                                            <!--<th>Noches</th>-->
                                            <th colspan="2"> Saldo Total</th>
                                            <th colspan="2">Garantía</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                             <?php
                                            while ($row = mysqli_fetch_array($query)) {
                                                $desc_servicios_json = $row['desc_servicios'];
                                                $desc_servicios = json_decode($desc_servicios_json, true);

                                                // Verificar si $desc_servicios es un array antes de contar sus elementos
                                                $num_desc_servicios = is_array($desc_servicios) ? count($desc_servicios) : 0;
                                            ?>
                                        <tr>
                                            <th><a href="infores.php?id=<?php echo $row['cod_reserva'] ?>" class="btni fa fa-eye"></a></th>
                                            <!--<th><?php  echo $row['cod_reserva']?></th>-->
                                            <th colspan="3"><?php  echo $row['cliente']?></th>
                                            <th colspan="2"><?php echo date_format(date_create($row['fecha']), 'd-m-Y') ?></th>
                                            <!--<th><?php  echo $row['dia']?></th>-->
                                            <th><?php  echo $row['via']?></th>
                                            <th colspan="2
                                            "><?php  echo $row['habitacion']?></th>
                                            <td><?php echo (!empty($desc_servicios_json) && $desc_servicios_json != '[]') ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>'; ?></td>
                                            <th><?php  echo $row['huespedes']?></th>
                                            <!--<th><?php  echo $row['noches']?></th>-->
                                            <th colspan="2" style="<?php echo ($row['gtotal'] < 0) ? 'color: red;' : '' ?>">
                                                <b>$<?php echo $row['gtotal'] ?></b>
                                            </th>
                                            <th colspan="2"><?php  echo $row['garantia']?></th>
                                            <th>
                                                <?php
                                                // Verificar si la garantía está vacía
                                                if (empty($row['garantia'])) {
                                                    // Si está vacía, el botón estará habilitado
                                                    echo '<a href="actualizar.php?id=' . $row['cod_reserva'] . '"><button class="btn info"><i class="fa fa-calendar-check-o"></i></button></a>';
                                                } else {
                                                    // Si no está vacía, el botón estará deshabilitado
                                                    echo '<button class="btn info" disabled><i class="fa fa-calendar-check-o"></i></button>';
                                                }
                                                ?>
                                            </th>

                                            <!--<th><a href="actualizar.php?id=<?php echo $row['cod_reserva'] ?>" class="btni fa fa-eye"></a></th>-->
                                            <th>
                                                <a href="insertarpos.php?id=<?php echo $row['cod_reserva'] ?>">
                                                    <button class="btn success"><i class="fa fa-pencil-square-o"></i></button>
                                                </a>
                                            </th>
                                            <th>
                                                <a href="inforeserv.php?id=<?php echo $row['cod_reserva'] ?>">
                                                    <button class="btn btn-dark"><i class="fa fa-paper-plane"></i></button>
                                                </a>
                                            </th>
                                            <th>
                                                <a href="insertarcn.php?id=<?php echo $row['cod_reserva'] ?>">
                                                    <button class="btn danger"><i class="fa fa-ban"></i></button>
                                                </a>
                                            </th>
                                        </tr>
                                        <?php 
                                        }
                                        ?>
                                    </tbody>
	                            </table>

                                <script>
                                    function applyFilter() {
                                        var filter = document.getElementById("filter").value;

                                        if (filter === "") {
                                            // Redirigir a la misma página sin el parámetro de filtro
                                            window.location.href = "inicio.php";
                                        } else {
                                            // Redirigir a la misma página con el filtro como parámetro GET
                                            window.location.href = "inicio.php?filter=" + filter;
                                        }
                                    }
                                </script>

                                
                                <br><br>
                                <br><br>
                        </div>
                    </div>
                    </div>  
            </div>
            <a onclick="pen()" class="btn-wsp">
	            <i class="fa fa-lightbulb-o"></i>
	        </a>
            <?php
            while($row=mysqli_fetch_array($query2)){
            ?>
            <script>
                        function pen() {
                            alert('\nPENDIENTES POR REALIZAR:\n \n°<?php  echo $row['pendiente1']?>\n \n°<?php  echo $row['pendiente2']?>\n \n°<?php  echo $row['pendiente3']?>');
                        }
            </script>
            <?php 
            }
        ?>
	</a>
    </body>
    <!--Fin de la página-->
    <br><br>
    <footer class="footer">
          <p><b>Hotel Casa Flora Atlixco, Todos los derechos reservados &copy; 2022</b></p>
    </footer>
</html>