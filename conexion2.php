<?php
function conectar2(){
    $host="localhost";
    $user="root";
    $pass="";

    $bd="prueba_demor";

    $con=mysqli_connect($host,$user,$pass);

    mysqli_select_db($con,$bd);

    return $con;
}
?>
