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

    $sql="SELECT *  FROM ventadirecta";
    $query=mysqli_query($con,$sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Cobrar Venta - Casa Flora Handmade Hotel</title>
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
        <!--SWEET ALERT-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
	    <!-- Template Main Stylesheets -->
	    <link rel="stylesheet" href="css/contact-form.css" type="text/css">	
        <!--SWEET ALERT-->
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
            .h3{
                text-align: center;
            }
            .h2{
                text-align: center;
            }

            .h1{
                text-align: center;
                color: green;
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
                text-align: center;
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
                        <a class="active" href="checkout.php">CheckOut</a>
                        <a href="cajaint.php">Caja Chica</a>
                        <a href="tarifas.php">Tarifas</a>
                        <a href="cotizacion.php">Cotización</a>
                        <a href="contacto.php">CRM</a>
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
                                <h1 style="text-align: center;"><b>Cobrar venta</b></h1>
                                <div class="container mt-5 custom-container">

                                <fieldset> 
                                    <div class="card">
                                    <!--<a style="text-align: right;"  onclick="al()" >
                                        <button class="btn info">Agregar descuento</button>
                                    </a>-->
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
                                                    window.location.href = '/recepcion/adesc2.php?id=<?php echo $row['cod_reserva'] ?>';
                                                }
                                                });
                                                // Redirigir al enlace deseado
                                                //window.location.href = '/recepcion/cerrarcaja.php';
                                            }
                                            })
                                        
                                            
                                        }
                                    </script>

                                    <br>
                                    <div class="container">
                                        <div>
                                        
                                        <table>
                                            <thead class="table-success table-striped">
                                                <tr>
                                                    <tr>
                                                        <th class="thd" colspan="1">Cantidad</th>
                                                        <th class="thd" colspan="5">Descripción</th>
                                                        <th class="thd" colspan="2">Monto</th>
                                                    </tr>
                                                </tr>
                                                <?php
                                                    $total = 0; // Inicializar el total en 0
                                                    
                                                    while($row = mysqli_fetch_array($query)){
                                                        // Obtener el precio y convertirlo a número
                                                        $precio = floatval($row['preciou']);
                                                        
                                                        // Sumar el precio al total
                                                        $total += $precio;
                                                ?>
                                                <tbody>
                                                    <tr>
                                                        <th class="thd" colspan="1"><?php echo $row['cantidad']?></th>
                                                        <th class="thd" colspan="5"><?php echo $row['nombre']?></th>
                                                        <th class="thd" colspan="2">$<?php echo $precio?>.00</th>
                                                    </tr>
                                                <?php
                                                    }
                                                ?>
                                                </tbody>
                                            </thead>
                                        </table> 
                                        <br><br>  
                                        <h2 class="h2">El valor total de los consumos es de:</h2>
                                        <br><br>
                                        <h1 class="h1">
                                            <b>Total: $<?php echo $total?></b>
                                        </h1>

                                        <br><br>
                                        <h3 class="h3">Solicite el monto completo al huésped, una vez finalizado presione el botón "Pagar".</h3>
                                        <br><br>
                                        <div style="text-align: right;">
                                        <a href="ventad.php">
                                            <button class="btn info"><i class="fa1 fa fa-arrow-left"></i></button>
                                        </a>
                                        <a href="pagarventa.php">
                                        <button class="btn success">Pagar</button>
                                        </a>
                                        </div>
                                    </div>
                                </fieldset>
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