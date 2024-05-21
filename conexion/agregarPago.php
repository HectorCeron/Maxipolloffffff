<?php
include "conexion.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Recibir datos del formulario
$producto = $_POST['producto'];
$bancos = $_POST['bancos'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$tipoDocumento = $_POST['tipoDocumento'];
$numeroDocumento = $_POST['numeroDocumento'];
$fecha = $_POST['fecha'];
$formaPago = $_POST['formaPago'];
$totalPago = $_POST['totalPago'];
$idCategorias_Tiquetera = $_POST['idCategorias_Tiquetera'];
$idUsuario = $_POST['idUsuario'];

// Preparar y ejecutar la consulta SQL para insertar datos
$sql = "INSERT INTO pagos (Producto, Bancos, Nombre, Apellido, Correo, Telefono, TipoDocumento, NumeroDocumento, Fecha, formaPago, totalPago, idCategorias_Tiquetera, idUsuario) 
        VALUES ('$producto', '$bancos', '$nombre', '$apellido', '$correo', '$telefono', '$tipoDocumento', '$numeroDocumento', '$fecha', '$formaPago', '$totalPago ', '$idCategorias_Tiquetera', '$idUsuario')";

if ($conn->query($sql) === TRUE) {
    header("Location: /maxipollo/auth/maxipollo.php?");
} else {
    echo "Error al insertar datos: " . $conn->error;
}
}
// Cerrar conexión
$conn->close();
?>
