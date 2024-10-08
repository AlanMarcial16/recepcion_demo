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

<script>

        function redirect(){
            window.location.href = "checkin.php?id=<?php echo $row['cod_reserva'] ?>";
        }
</script>

<body onLoad="redirect()">
    </body> 