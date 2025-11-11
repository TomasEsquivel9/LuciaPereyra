<?php

$servername = "localhost:3306";
$username = "grupodev_pasantes";
$password = "Pasantes2025";
$dbname = "grupodev_pasantes";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

?>
