<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pruebar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT estado FROM mesas";
$result = $conn->query($sql);

$mesas = array();
    
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mesas[] = $row;
    }
}

$conn->close();

echo json_encode($mesas);
?>
