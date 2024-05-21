<?php
$servername = "maxipollodb.clydjthxdmub.us-east-1.rds.amazonaws.com";
$username = "root";
$password = "12345678";
$database = "maxipolloDB";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
} 
echo "Conexión exitosa";
?>
