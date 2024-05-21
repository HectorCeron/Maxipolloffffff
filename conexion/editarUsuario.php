<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = intval($_POST['idUsuario']);
    $Nombre = $conn->real_escape_string($_POST['Nombre']);
    $Apellido = $conn->real_escape_string($_POST['Apellido']);
    $Correo = $conn->real_escape_string($_POST['Correo']);
    $Telefono = $conn->real_escape_string($_POST['Telefono']);
    
    $sql = "UPDATE Usuarios SET Nombre='$Nombre', Apellido='$Apellido', Correo='$Correo', Telefono='$Telefono' WHERE idUsuario='$idUsuario'";

    if ($conn->query($sql) === TRUE) {
        header("Location: /maxipollo/auth/maxipollo.php");
        exit(); // Añadir exit después de header
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error; // Muestra el error si la consulta falla
    }
}

// Cerrar conexión
$conn->close();
?>
