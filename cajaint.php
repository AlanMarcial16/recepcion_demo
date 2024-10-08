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

    $sql="SELECT *  FROM cajaop";
    $query=mysqli_query($con,$sql);

    $sql2="SELECT *  FROM cajach";
    $query2=mysqli_query($con,$sql2);

    $sql3="SELECT *  FROM cajach";
    $query3=mysqli_query($con,$sql3);
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Caja Chica - Casa Flora Handmade Hotel</title>
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

            .buttonr {
                background-color: purple; 
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
            
            .button4 {
                background-color: orange; 
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

            .thz{
                font-size: 30px;
            }

            .th2{
                font-size: 20px;
            }

            .thx{
                text-align: left;
            }

            tr:nth-child(even) {
            background-color: #dddddd;
            }

            .thc{
                font-size: 60px;
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
        <script>
                                    function test(){
                                        $.ajax({url:"obtotal.php", success:function(result){
                                        }
                                    })
                                    } 
                                </script>
    </head>
    <body onload="test()">

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
                        <a class="active" href="cajaint.php">Caja Chica</a>
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
                            <h1 style="text-align: center;"><b>Caja Chica</b></h1>
                            <br><br>
                            <div style="text-align: right;">
                                
                                <a href="insertar_gasto.php">
                                    <button class="buttonr">Registrar gasto</button>
                                </a>
                                <a onclick="apertura()">
                                    <button class="button3">Apertura de caja</button>
                                </a>
                                <a onclick="eliminar()">
                                    <button class="button4">Eliminar operación</button>
                                </a>
                                <script type="text/javascript">
                                function apertura() {

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
                                            window.location.href = '/recepcion/cajach.php';
                                        }
                                        });
                                        // Redirigir al enlace deseado
                                        //window.location.href = '/recepcion/cerrarcaja.php';
                                    }
                                    })
                                
                                    
                                }

                                function eliminar() {

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
                                            window.location.href = '/recepcion/elimoperacion.php';
                                        }
                                        });
                                        // Redirigir al enlace deseado
                                        //window.location.href = '/recepcion/cerrarcaja.php';
                                    }
                                    })


                                    }
                                </script>
                                <a href="insertope.php">
                                    <button class="button1">Insertar operación</button>
                                </a>
                            </div>
                            <br>
                            <!-- Tabla de incidencias -->
                            <table>
                                <thead class="table-success table-striped">
                                    <?php
                                        while($row=mysqli_fetch_array($query3)){
                                    ?>
                                    <tr>
                                        <tr>
                                        <th class="th2">Fecha:<?php  echo $row['fecha']?></th>
                                        <th class="thc" colspan="5">Control de Caja Diario</th>
                                        <th class="th2">Saldo inicial: $<?php  echo $row['montoi']?></th>
                                        </tr>
                                        <tr>
                                        <th class="th2" colspan="5">Datos de la operación</th>
                                        <th class="th2" colspan="2">Importe</th>
                                        </tr>
                                        <tr>
                                        <!--<th>Tipo</th>-->
                                        <th class="th2" colspan="4">Descripción</th>
                                        <th class="th2" colspan>Fecha y hora</th>
                                        <th class="th2" colspan>Entrada</th>
                                        <th class="th2" colspan>Salida</th>
                                    </tr>
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                </thead>
                                <tbody>
                                    <?php
                                        while($row=mysqli_fetch_array($query)){
                                            // Calcula el color y el signo según la operación
                                            $color = ($row['importesalida']) ? 'red' : 'green';
                                            $signo = ($row['importesalida']) ? '- $' : '+ $';
                                    ?>
                                    <tr>
                                        <th class="th2"><?php echo $row['tipodeoperacion']?></th>
                                        <!--<tr id="fila-<?php echo $row['cod_operacion']; ?>">
                                            <td class="th2" colspan="3"><?php echo $row['descripcion']; ?></td>
                                            <td>
                                                <button onclick="eliminarFila(<?php echo $row['cod_operacion']; ?>)">
                                                    <img src="eliminar.png" alt="Eliminar" width="20" height="20">
                                                </button>
                                            </td>
                                        </tr>-->
                                        <th class="th2" colspan="3"><?php echo $row['descripcion']?></th>
                                        <th class="th2"><?php echo $row['fecha_hora_registro']?></th>
                                        <th class="th2" style="color: <?php echo ($row['importeentrada']) ? 'green' : 'red'; ?>">
                                            <?php echo ($row['importeentrada']) ? $signo . $row['importeentrada'] : ''; ?>
                                        </th>
                                        <th class="th2" style="color: <?php echo ($row['importesalida']) ? 'red' : 'green'; ?>">
                                            <?php echo ($row['importesalida']) ? $signo . $row['importesalida'] : ''; ?>
                                        </th>
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                </tbody>

                                <!--<script>
                                    function eliminarFila(cod_operacion) {
                                        if (confirm('¿Estás seguro de que quieres eliminar esta entrada?')) {
                                            // Envía una solicitud AJAX para eliminar la fila
                                            var xhr = new XMLHttpRequest();
                                            xhr.open('POST', 'eliminar.php', true);
                                            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                            xhr.onload = function() {
                                                if (xhr.status === 200) {
                                                    // Elimina la fila de la tabla
                                                    var fila = document.getElementById('fila-' + cod_operacion);
                                                    fila.parentNode.removeChild(fila);
                                                    alert('Entrada eliminada correctamente.');
                                                } else {
                                                    alert('Error al eliminar la entrada.');
                                                }
                                            };
                                            xhr.send('cod_operacion=' + cod_operacion);
                                        }
                                    }
                                </script>-->


                                <tfoot class="table-success table-striped">
                                    <?php
                                        while($row=mysqli_fetch_array($query2)){
                                    ?>
                                    <tr>
                                        <th class="thz" colspan="5">Total Entradas</th>
                                        <th class="thz" colspan="2" style="color: green;">+ $<?php echo $row['totale']?></th>
                                    </tr>
                                    <tr>
                                        <th class="thz" colspan="5">Total Salidas</th>
                                        <th class="thz" colspan="2" style="color: red;">- $<?php echo $row['totals']?></th>
                                    </tr>

                                    <tr>
                                        <th class="thz" colspan="5">SALDO TOTAL</th>
                                        <th class="thz" colspan="2"> $<?php  echo $row['gtotal']?></th>
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                </tfoot>
                                
	                        </table>
                            <br>
                            <div style="text-align: right;">
                                <!--<a href="obtotal.php">
                                    <button class="btn btn-danger">Obtener totales</button>
                                </a>-->
                                <!--href="cerrarcaja.php"-->
                                <a onclick="retirar()">
                                    <button class="button2">Retiro de efectivo</button>
                                </a>
                                <a onclick="cerrar()">
                                    <button class="button2">Cerrar caja</button>
                                </a>
                                
                                <script type="text/javascript">
                                function cerrar() {

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
                                            window.location.href = '/recepcion/cerrarcaja.php';
                                        }
                                        });
                                        // Redirigir al enlace deseado
                                        //window.location.href = '/recepcion/cerrarcaja.php';
                                    }
                                    })
                                
                                    
                                }

                                function retirar() {

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
                                            window.location.href = '/recepcion/retiroe.php';
                                        }
                                        });
                                        // Redirigir al enlace deseado
                                        //window.location.href = '/recepcion/cerrarcaja.php';
                                    }
                                    })


                                    }   
                                </script>

                            </div>
                            <br>
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