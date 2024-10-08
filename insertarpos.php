<?php 
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
    include("conexion.php");
    include("conexion2.php");
    $con=conectar();
    $con2=conectar2();

    $id=$_GET['id'];

    $sql="SELECT * FROM reservaciones WHERE cod_reserva='$id'";
    $query=mysqli_query($con,$sql);
    
    $row=mysqli_fetch_array($query);
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Editar Información - Casa Flora Handmade Hotel</title>
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
                font-size: 30px;
            }
            .thb{
                font-size: 25px;
            }

            form input {
                text-align: center;
            }
            .cont{
                display: flex;
                justify-content: right;
            }
        </style>
        <script>
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

        <h1 style="text-align: center;"><b>Revise los datos que desea editar</b></h1>
        <div class="cont">
            <a href="factura.php?id=<?php echo $row['cod_reserva'] ?>" target="_blank">
                <input class="btn btn-primary btn-lg btn-dark" type="button" value="Facturar">
            </a>
        </div>
        <BR></BR>
        <HR></HR>

      <div class="col-md-6" style="border-right: 1px solid #ccc;">
        <!-- Contenido del formulario ... -->
        <form action="updatepos.php" method="POST" style="max-width:500px;margin:auto; text-align: center;">
                                
                                    <div style="border: 10px solid #ccc; padding: 10px; border-radius: 15px;">
                                        <input type="hidden" name="cod_reserva" value="<?php echo $row['cod_reserva'] ?>">
                                        <p><b>Entrada</b></p>
                                        <input type="date" class="form-control mb-3" onblur="dif()" id="fecha" name="fecha" value="<?php echo $row['fecha'] ?>" onChange="dif()" required>
                                        <p><b>Salida</b></p>
                                        <input type="date" class="form-control mb-3" onchange="dif()" onblur="dif()" id="salida" name="salida" value="<?php echo $row['salida'] ?>" required>
                                        <p><b>Número de noches</b></p>
                                        <input class="form-control mb-3" id="noches" name="noches" placeholder="Noches" onkeypress="return event.charCode>=48 && event.charCode<=57" value="<?php echo $row['noches'] ?>" readonly required>
                                        <p><b>Día</b></p>
                                        <input type="int" class="form-control mb-3" name="dia" placeholder="Día" value="<?php echo $row['dia'] ?>" readonly>
                                        <?php
                                                // Verificar si la garantía está vacía
                                                if (empty($row['garantia'])) {
                                                    // Si no está vacía, el botón estará deshabilitado
                                                    echo '<button class="btn btn-primary btn-primary" disabled>Extender/Eliminar noches</button>';
                                                } else {
                                                    
                                                    // Si está vacía, el botón estará habilitado
                                                    echo '<a href="extnoches.php?id=' . $row['cod_reserva'] . '"><input type="button" class="btn btn-primary btn-primary" value="Extender/Eliminar noches"></a>';
                                                }
                                        ?>
                                        
                                        <BR></BR>
                                        <p><b>Hora de llegada</b></p>
                                        <input type="time" class="form-control mb-3" name="llegada" placeholder="Llegada" value="<?php echo $row['llegada'] ?>" readonly>
                                        <p><b>Cliente</b></p>
                                        <input type="int" class="form-control mb-3" id="cliente" name="cliente" placeholder="Cliente" value="<?php  echo $row['cliente']?>" readonly>
                                        <input type="button" class="btn btn-primary btn-primary" value="Editar Nombre del Cliente" onclick="editarCliente()">
                                        <script type="text/javascript">
                                            function editarCliente() {
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
                                                        if (password !== '251200') {
                                                            Swal.showValidationMessage('La contraseña ingresada es incorrecta');
                                                        }
                                                    },
                                                    allowOutsideClick: () => !Swal.isLoading()
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        // Contraseña correcta, permitir la edición del campo "cliente"
                                                        document.getElementById('cliente').readOnly = false;
                                                        Swal.fire({
                                                            title: 'Contraseña confirmada',
                                                            icon: 'success'
                                                        });
                                                    }
                                                });
                                            }
                                        </script>
                                        <BR></BR>
                                        <p><b>Número de huéspedes</b></p>
                                        <select class="form-control mb-3" name="huespedes" placeholder="Número de huéspedes" readonly>
                                            <option value="1 Adulto">1 Adulto (18 años +)</option>
                                            <option value="1 Adolescente">1 Adolescente (13 a 17 años)</option>
                                            <option value="1 Niño">1 Niño (3 a 12 años)</option>
                                            <option value="1 Bebé">1 Bebé (0 a 2 años)</option>
                                        </select>

                                        <p><b>Reserva Vía</b></p>
                                        <input type="int" class="form-control mb-3" name="via" placeholder="Vía" value="<?php echo $row['via'] ?>" readonly>

                                        <br>
                                        <input type="submit" class="btn btn-success btn-block" value="Confirmar edición" style="font-size: 20px; padding: 15px;">

                                    </div>
                                    <BR>

                                    <br><br>
                                    <div style="border: 10px solid #ccc; padding: 10px; border-radius: 15px;">
                                        <p><b>Habitación</b></p>
                                        <input type="int" class="form-control mb-3" name="habitacion" placeholder="Habitación" value="<?php  echo $row['habitacion']?>" readonly>
                                        <!--APARTADO PARA REALIZAR UPGRADE/DOWNGRADE EN LA HABITACIÓN-->
                                        <a onclick="ud()">
                                        <input type="button" class="btn btn-primary btn-secondary" value="Realizar Up/Down (sin costo)">
                                        </a>
                                        <br><br>
                                        <a onclick="ud2()">
                                        <input type="button" class="btn btn-primary btn-secondary" value="Realizar Up/Down (con costo)">
                                        </a>
                                        <script type="text/javascript">
                                            function ud() {
                                                    
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
                                                    if (password !== '251200') {
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

                                            function ud2() {
                                                    
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
                                                            if (password !== '251200') {
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
                                                            window.location.href = '/recepcion/2ud.php?id=<?php  echo $row['cod_reserva']?>';
                                                            //href="ud.php?id=<?php  echo $row['cod_reserva']?>"
                                                        }
                                                        });
                                                        // Redirigir al enlace deseado
                                                        //window.location.href = '/recepcion/cerrarcaja.php';
                                                        }
                                                        })
                                                    
                                                        
                                                    }
                                        </script>
                                    </div>
                                    <BR></BR>

                                    <div style="border: 10px solid #ccc; padding: 10px; border-radius: 15px;">
                                        <!--Termina apartado de upgrade/downgrade-->
                                        <p><b>Tarifa</b></p>
                                        <input type="int" class="form-control mb-3" name="tarifa" placeholder="Tarifa" value="<?php  echo $row['tarifa']?>" readonly>
                                            <a onclick="desc()">
                                            <input type="button" class="btn btn-primary btn-primary" value="Aplicar descuento">
                                            </a>
                                            <br><br>
                                        
                                            <a onclick="edita()">
                                            <input type="button" class="btn btn-primary btn-primary" value="Editar tarifa">
                                            </a>
                                        <!--Termina apartado de descuento-->
                                    </div>

                                    <BR></BR>

                                    <div style="border: 10px solid #ccc; padding: 10px; border-radius: 15px;">
                                        <p><b>Anticipo</b></p>
                                        <input type="int" class="form-control mb-3" name="anticipo" placeholder="Anticipo" value="<?php  echo $row['anticipo']?>" readonly>
                                        <a href="insertarant.php?id=<?php  echo $row['cod_reserva']?>">
                                            <input type="button" class="btn btn-primary btn-primary" value="Añadir anticipo">
                                        </a>
                                        <br><br>
                                    </div>

                                    <BR></BR>
                                    
                                    <div style="border: 10px solid #ccc; padding: 10px; border-radius: 15px;">
                                        <p><b>Garantía</b></p>
                                        <input type="int" class="form-control mb-3" name="garantia" placeholder="Garantia" value="<?php  echo $row['garantia']?>" readonly>
                                        <a href="insertargarant.php?id=<?php  echo $row['cod_reserva']?>">
                                            <input type="button" class="btn btn-primary btn-primary" value="Actualizar Garantía">
                                        </a>
                                        <br><br>
                                    </div>

                                    <BR></BR>

                                    <div style="border: 10px solid #ccc; padding: 10px; border-radius: 15px;">
                                        <p><b>Comentarios</b></p>
                                        <textarea class="form-control mb-3" name="comentarios" rows="3" readonly><?php echo $row['comentarios'] ?></textarea>
                                        <a href="insertarcom.php?id=<?php  echo $row['cod_reserva']?>">
                                            <input type="button" class="btn btn-primary btn-primary" value="Actualizar comentario">
                                        </a>
                                        <input type="hidden" class="form-control mb-3" name="total" class="form-control mb-3" placeholder="Total" value="<?php  echo $row['total']?>">
                                    </div>
                                    <BR></BR>
                                    
                                    <br>
                                </form>


                                </div>

                                <div class="col-md-6" style="border-left: 1px solid #ccc;">
                                    <BR></BR>
                                    <style>
                                        .ticket-container {
                                            width: 600px; /* Cambiar este valor al ancho deseado */
                                            margin: 0 auto; /* Esto mantendrá el contenedor centrado en la página */
                                        }
                                        .ticket {
                                            width: 100%; /* Para que el ticket ocupe todo el ancho del contenedor */
                                            max-width: 600px; /* Limitamos el ancho máximo del ticket para que no se estire demasiado */
                                            margin: 0 auto; /* Hacemos que los márgenes izquierdo y derecho sean automáticos */
                                            font-family: Arial, sans-serif;
                                            background: #fff;
                                            padding: 20px; /* Aumentamos el espacio interno del ticket */
                                            border: 2px solid #000; /* Aumentamos el grosor del borde */
                                            box-shadow: 5px 5px 8px #888; /* Aumentamos la sombra */
                                            text-align: center;
                                        }

                                        .ticket img {
                                            width: 100px; /* Aumentamos el tamaño del logo */
                                            height: 100px; /* Ajustamos la altura del logo */
                                        }

                                        .ticket h1 {
                                            font-size: 24px; /* Aumentamos el tamaño del título */
                                            margin: 10px 0; /* Aumentamos el espacio entre el título y otros elementos */
                                        }

                                        .ticket p {
                                            font-size: 14px; /* Aumentamos el tamaño del texto */
                                            margin: 5px 0; /* Ajustamos el espacio entre párrafos */
                                        }

                                        .ticket hr {
                                            border: none;
                                            border-top: 2px dashed #888; /* Aumentamos el grosor del borde punteado */
                                            height: 2px; /* Aumentamos la altura del borde punteado */
                                            margin: 15px 0; /* Aumentamos el espacio alrededor del borde punteado */
                                        }

                                        .item {
                                            display: flex;
                                            justify-content: space-between;
                                            font-size: 18px; /* Aumentamos el tamaño del texto de los elementos */
                                            margin: 10px 0; /* Aumentamos el espacio entre elementos */
                                        }

                                        .item span:first-child {
                                            flex: 1;
                                            text-align: left;
                                        }

                                        .item span:last-child {
                                            flex: 1;
                                            text-align: right;
                                        }

                                        .total {
                                            font-weight: bold;
                                            font-size: 20px; /* Aumentamos el tamaño del texto del total */
                                            margin-top: 15px; /* Ajustamos el espacio entre el total y otros elementos */
                                        }

                                    </style>
                                    <!-- Contenido de la tabla ... -->
                                    <div class="ticket-container">
                                        <div class="ticket">
                                            <img src="https://static.wixstatic.com/media/9ed84f_e9388ac15d374e77aa9c89cdb80e014a~mv2.png" alt="Logo">
                                            <h1><b>CASA FLORA HANDMADE HOTEL</b></h1>
                                            <p>Habitación: <?php echo $row['habitacion']?></p>
                                            <p>Cliente: <?php echo $row['cliente']?></p>
                                            <p>Empleado: Propietario</p>
                                            <p>TPV: Recepción</p>
                                            <hr>

                                            <div class="item">
                                                <span><b>- Consumos extras</b></span>
                                                <span style="<?php echo ($row['cextras'] > 0) ? 'color: red;' : '' ?>"><b>$<?php echo $row['cextras'] ?></b></span>
                                            </div>
                                            <div class="item">
                                            <ul>
                                                <?php
$desc_servicios_json = $row['desc_servicios'];
        
// Lista de servicios que NO deben aparecer en Consumos Extras
$servicios_excluidos = [
    "Adulto extra (12 años en adelante)",
    "Menor extra (3-11 años)",
    "Descorche por botella o six",
    "Decoración romántica",
    "Atardecer romántico",
    "Velada romántica",
    "Early check in",
    "Late check out",
    "Eventos especiales",
    "Masajes"
];

// Utilizar expresión regular para extraer elementos de la cadena JSON
preg_match_all('/"([^"]+)"/', $desc_servicios_json, $matches);

// Verificar si se encontraron coincidencias
if (!empty($matches[1])) {
    $consumos_extras_filtrados = array_filter($matches[1], function($servicio) use ($servicios_excluidos) {
        return !in_array($servicio, $servicios_excluidos);
    });

    if (!empty($consumos_extras_filtrados)) {
        echo '<div class="item">';
        echo '</div>';
        echo '<div class="item">';
        echo '<ul>'; // Iniciar lista
        foreach ($consumos_extras_filtrados as $servicio) {
            echo '<li>' . htmlspecialchars($servicio) . '</li>'; // Agregar cada servicio como un elemento de la lista
        }
        echo '</ul>'; // Cerrar lista
        echo '</div>';
    } else {
        echo '<div class="item">';
        echo '<span>No hay consumos extras</span>';
        echo '</div>';
    }
} else {
    echo '<div class="item">';
    echo '<span>No hay consumos extras</span>';
    echo '</div>';
}

                                                $sql_reservaciones = "SELECT * FROM prueba_demo.reservaciones WHERE cod_reserva = '$id'";
                                                $result_reservaciones = mysqli_query($con2, $sql_reservaciones);
                                                
                                                if (!$result_reservaciones) {
                                                    die('Error en la consulta SQL de reservaciones: ' . mysqli_error($con2));
                                                }
                                                
                                                while ($row_reservacion = mysqli_fetch_assoc($result_reservaciones)) {
                                                    $habitacion = $row_reservacion['habitacion'];
                                                    $comensal = $row_reservacion['cliente'];
                                                
                                                    $sql_tickets = "SELECT * FROM prueba_demor.tickets WHERE habitacion = '$habitacion' AND comensal = '$comensal'";
                                                    $result_tickets = mysqli_query($con, $sql_tickets);
                                                    
                                                    if (!$result_tickets) {
                                                        die('Error en la consulta SQL de tickets: ' . mysqli_error($con));
                                                    }
                                                    
                                                    // Iterar sobre los tickets y mostrar solo los que coincidan con la reserva
                                                    while ($row_ticket = mysqli_fetch_assoc($result_tickets)) {
                                                        $datos_ticket = json_decode($row_ticket['datos_json'], true);
                                                        $fyh = $row_ticket['fyh'];

                                                        // Formatear la fecha y hora al formato deseado
                                                        $fecha_hora = date('d-m-Y g:i A', strtotime($fyh));

                                                        // Verificar si los datos del ticket coinciden con los de la reserva
                                                        if ($row_ticket['habitacion'] == $row_reservacion['habitacion'] && $row_ticket['comensal'] == $row_reservacion['cliente']) {
                                                            // Verificar si el mensaje es "Mandado a la habitación"
                                                            $mensaje = isset($datos_ticket[0]['mensaje']) ? $datos_ticket[0]['mensaje'] : '';
                                                            if ($mensaje === "Mandado a la habitación") {
                                                                // Mostrar el ticket en la lista de consumos
                                                                echo "<li>Ticket $fecha_hora Total: <b>$" . number_format(array_sum(array_column($datos_ticket, 'preciou')), 2) . "</b></li>";
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </ul>

                                            </div>
                                            <hr>
                                            <div class="item">
                                                <span><b>- Servicios Especiales</b></span>
                                                <span style="<?php echo ($row['sextras'] > 0) ? 'color: red;' : '' ?>"><b>$<?php echo $row['sextras'] ?></b></span>
                                            </div>
                                            <?php
$desc_servicios_json = $row['desc_servicios'];

// Lista de servicios que deben aparecer en Servicios Especiales
$servicios_incluidos = [
    "Adulto extra (12 años en adelante)",
    "Menor extra (3-11 años)",
    "Descorche por botella o six",
    "Decoración romántica",
    "Atardecer romántico",
    "Velada romántica",
    "Early check in",
    "Late check out",
    "Eventos especiales",
    "Masajes"
];

// Utilizar expresión regular para extraer elementos de la cadena JSON
preg_match_all('/"([^"]+)"/', $desc_servicios_json, $matches);

// Verificar si se encontraron coincidencias
if (!empty($matches[1])) {
    $servicios_especiales_filtrados = array_filter($matches[1], function($servicio) use ($servicios_incluidos) {
        return in_array($servicio, $servicios_incluidos);
    });

    if (!empty($servicios_especiales_filtrados)) {
        echo '<div class="item">';
        echo '</div>';
        echo '<div class="item">';
        echo '<ul>'; // Iniciar lista
        foreach ($servicios_especiales_filtrados as $servicio) {
            echo '<li>' . htmlspecialchars($servicio) . '</li>'; // Agregar cada servicio como un elemento de la lista
        }
        echo '</ul>'; // Cerrar lista
        echo '</div>';
    } else {
        echo '<div class="item">';
        echo '<span>No hay servicios especiales</span>';
        echo '</div>';
    }
} else {
    echo '<div class="item">';
    echo '<span>No hay servicios especiales</span>';
    echo '</div>';
}
?>
                                            <hr>
                                            <div class="item">
                                                <span><b>- Total habitación</b></span>
                                                <span style="<?php echo ($row['total'] < 0) ? 'color: red;' : '' ?>"><b>$<?php echo $row['total'] ?></b></span>
                                            </div>
                                            <hr>
                                            <div class="item">
                                                <span>- Pagos</span>
                                                <span style="<?php echo (($row['anticipo'] + ($row['tarifa'] * $row['noches'])) < 0) ? 'color: red;' : '' ?>">
                                                    <b>$<?php echo ($row['tarifa'] * $row['noches']); ?></b>
                                                </span>
                                            </div>
                                            <div class="item">
                                                <ul>
                                                    <li>ANTICIPO: <b>$<?php echo $row['anticipo'] ?></b></li><br>
                                                    <li>HABITACIÓN: <b>$<?php echo ($row['tarifa'] * $row['noches']) - $row['anticipo']; ?></b></li>
                                                    <ul>
                                                        <li><b>Pago en <?php echo $row['pago'] ?></b></li>
                                                    </ul><br>
                                                    <li>CONSUMOS:</li>
                                                    <ul>
                                                        <?php
                                                        $sql_reservaciones = "SELECT * FROM prueba_demo.reservaciones WHERE cod_reserva = '$id'";
                                                        $result_reservaciones = mysqli_query($con2, $sql_reservaciones);
                                                        
                                                        if (!$result_reservaciones) {
                                                            die('Error en la consulta SQL de reservaciones: ' . mysqli_error($con2));
                                                        }
                                                        
                                                        while ($row_reservacion = mysqli_fetch_assoc($result_reservaciones)) {
                                                            $habitacion = $row_reservacion['habitacion'];
                                                            $comensal = $row_reservacion['cliente'];
                                                        
                                                            $sql_tickets = "SELECT * FROM prueba_demor.tickets WHERE habitacion = '$habitacion' AND comensal = '$comensal'";
                                                            $result_tickets = mysqli_query($con, $sql_tickets);
                                                            
                                                            if (!$result_tickets) {
                                                                die('Error en la consulta SQL de tickets: ' . mysqli_error($con));
                                                            }
                                                            
                                                            // Iterar sobre los tickets y mostrar solo los que coincidan con la reserva
                                                            while ($row_ticket = mysqli_fetch_assoc($result_tickets)) {
                                                                $datos_ticket = json_decode($row_ticket['datos_json'], true);
                                                                $fyh = $row_ticket['fyh'];

                                                                // Formatear la fecha y hora al formato deseado
                                                                $fecha_hora = date('d-m-Y g:i A', strtotime($fyh));

                                                                // Verificar si los datos del ticket coinciden con los de la reserva
                                                                if ($row_ticket['habitacion'] == $row_reservacion['habitacion'] && $row_ticket['comensal'] == $row_reservacion['cliente']) {
                                                                    // Verificar si el mensaje es "PAGADO AL MOMENTO"
                                                                    $mensaje = isset($datos_ticket[0]['mensaje']) ? $datos_ticket[0]['mensaje'] : '';
                                                                    if ($mensaje === "PAGADO AL MOMENTO") {
                                                                        // Mostrar el ticket en la lista de consumos
                                                                        echo "<li>Ticket $fecha_hora Total: <b>$" . number_format(array_sum(array_column($datos_ticket, 'preciou')), 2) . "</b></li>";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </ul>

                                                </ul>
                                            </div>
                                            <hr>
                                            <h4 class="total">SALDO TOTAL: <span style="<?php echo ($row['gtotal'] < 0) ? 'color: red;' : '' ?>">$<?php echo $row['gtotal'] ?></span></h4>
                                            <hr>
                                            <p>¡GRACIAS POR TU PREFERENCIA!</p>
                                            <p>Eventos y comentarios:</p>
                                            <p>experiencias@casaflora.mx</p>
                                            <p>Cel/Whats: 2441440564</p>
                                            <p>Privada Rio Nazas 312, Atlixco, Pue.</p>
                                        </div>
                                    </div>


                                    <br><br>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; text-align: center; align-items: center; justify-content: center;">
                                        <div>
                                            <p>Servicios Especiales</p>
                                            <input type="hidden" class="form-control mb-3" name="sextras" placeholder="Introduzca el monto total de Servicios Especiales" onkeypress="return event.charCode>=48 && event.charCode<=57" value="<?php echo $row['sextras']?>">
                                            <a href="insertarse.php?id=<?php echo $row['cod_reserva']?>">
                                                <input type="button" class="btn btn-primary btn-primary" value="Añadir Servicios Especiales">
                                            </a>
                                        </div>
                                        <div>
                                            <p>Consumos Extras</p>
                                            <input type="hidden" class="form-control mb-3" name="cextras" placeholder="Introduzca el monto total de consumos extras" onkeypress="return event.charCode>=48 && event.charCode<=57" value="<?php echo $row['cextras']?>">
                                            <a href="insertarce.php?id=<?php echo $row['cod_reserva']?>">
                                                <input type="button" class="btn btn-primary btn-primary" value="Añadir consumos extra">
                                            </a>
                                        </div>
                                        <br>
                                        <!-- Nuevo div con el botón "Pagar" -->
                                        <div style="grid-column: span 2; text-align: center;">
                                            <a href="cobrarc2.php?id=<?php echo $row['cod_reserva']?>">
                                                <input type="button" class="btn btn-success" style="width: 100%;" value="Pagar">
                                            </a>
                                        </div>

                                        <div style="grid-column: span 2; text-align: center;">
                                            <input type="button" class="btn btn-info" style="width: 100%;" value="Transferir tickets (Particular)" onclick="pedirContraseña()">
                                        </div>

                                        <script>
                                            // Función para mostrar el cuadro de diálogo de SweetAlert para ingresar la contraseña
                                            function pedirContraseña() {
                                                Swal.fire({
                                                    title: 'Ingrese la contraseña:',
                                                    input: 'password',
                                                    inputAttributes: {
                                                        autocapitalize: 'off'
                                                    },
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Confirmar',
                                                    cancelButtonText: 'Cancelar',
                                                    showLoaderOnConfirm: true,
                                                    preConfirm: (contraseña) => {
                                                        // Aquí puedes verificar la contraseña ingresada
                                                        // En este ejemplo, se verifica que la contraseña sea "123456"
                                                        if (contraseña === '251200') {
                                                            return Promise.resolve();
                                                        } else {
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Contraseña incorrecta',
                                                                text: 'Por favor, inténtelo de nuevo.'
                                                            });
                                                            return false;
                                                        }
                                                    }
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        // Redirigir al sitio deseado si la contraseña es correcta
                                                        window.location.href = "transft1.php?id=<?php echo $row['cod_reserva']?>";
                                                    }
                                                });
                                            }
                                            </script>



                                        <div style="grid-column: span 2; text-align: center;">
                                            <a href="transft2.php?id=<?php echo $row['cod_reserva']?>">
                                                <input type="button" class="btn btn-info" style="width: 100%;" value="Transferir tickets (General)">
                                            </a>
                                        </div>

                                        <div style="grid-column: span 2; text-align: center;">
                                            <a href="consumos.php?id=<?php echo $id; ?>" target="_blank">
                                                <input type="button" class="btn btn-secondary" style="width: 100%;" value="Ver consumos">
                                            </a>
                                        </div>

                                    </div>

                                    <hr>


                                    <script type="text/javascript">
                                            function desc() {
                                                    
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
                                                    window.location.href = '/recepcion/desh.php?id=<?php  echo $row['cod_reserva']?>';
                                                    //href="desh.php?id=<?php  echo $row['cod_reserva']?>"
                                                }
                                                });
                                                // Redirigir al enlace deseado
                                                //window.location.href = '/recepcion/cerrarcaja.php';
                                            }
                                            })
                                        
                                            
                                            }
                                    </script>
                                    <script type="text/javascript">
                                            function edita() {
                                                    
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
                                                    if (password !== '251200') {
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
                                                    window.location.href = '/recepcion/insertarta.php?id=<?php  echo $row['cod_reserva']?>';
                                                    //href="desh.php?id=<?php  echo $row['cod_reserva']?>"
                                                }
                                                });
                                                // Redirigir al enlace deseado
                                                //window.location.href = '/recepcion/cerrarcaja.php';
                                            }
                                            })
                                        
                                            
                                            }
                                    </script>
        </table>
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