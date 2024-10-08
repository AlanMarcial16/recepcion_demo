<?php 
$conexion=mysqli_connect('localhost','root','','prueba');
$habitacion=$_POST['habitacion'];

	$sql="SELECT id,
			 id_habitacion,
			 tarifa 
		from t_habitacion 
		where id_habitacion='$habitacion'";

	$result=mysqli_query($conexion,$sql);

	$cadena="<label>Tarifas</label> 
			<select id='lista2' name='lista2'>";

	while ($ver=mysqli_fetch_row($result)) {
		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[2]).'</option>';
	}

	echo  $cadena."</select>";
	

?>