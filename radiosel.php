<?php 
    include("conexion.php");
    $con=conectar();

$id=$_GET['id'];

$sql="SELECT * FROM reservaciones WHERE cod_reserva='$id'";
$query=mysqli_query($con,$sql);

$row=mysqli_fetch_array($query);
?>
<script>
    function sel() {
        window.location.href = "pagospei.php?id=<?php echo $row['cod_reserva'] ?>";
            };
</script>

<?php 
//Reseteo.
$seccion = '';
//Si está definido el formulario.
if (isset($_POST)) {
    //Comprobamos que no este vacío input.
    if (empty($_POST['seccion'])) {
        echo "Elige una opción. <a href='formulario.php'><i class="fa1 fa fa-arrow-left"></i></a>";
    } else {

        //Obtenemos valor input radio.
        $seccion = $_POST['seccion'] ?: '';

        //Redirigimos según opción seleccionado.
        
        if ($seccion == 'Transferencia') {
            echo "<script>sel();</script>";
        }
        else {
            echo '<script>window.location="inicio.php"</script>';
        }
        
    }   
}
?>