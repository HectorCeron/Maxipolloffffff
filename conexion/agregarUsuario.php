<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena']; 

    // Consulta para insertar un nuevo registro en la tabla Usuarios
    $sql = "INSERT INTO Usuarios (Nombre, Apellido, Correo, Telefono, Nombre_Usuario, Contraseña)
    VALUES ('$nombre', '$apellido', '$correo', '$telefono', '$nombre_usuario', '$contrasena')";

    if ($conn->query($sql) === TRUE) {
        
        header("Location: /maxipollo/auth/registro.php?exito");
        exit();
    } else {
        header("Location: /maxipollo/auth/registro.php?error");
    }
}

// Cerrar conexión
$conn->close();
?>
