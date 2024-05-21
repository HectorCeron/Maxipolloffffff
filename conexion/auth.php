<?php
include "conexion.php";

// Recibir datos del formulario
$Nombre_Usuario = $_POST['Nombre_Usuario'];
$contraseña = $_POST['contraseña'];

// Consultar la base de datos para verificar credenciales de usuarios
$sql_usuario = "SELECT * FROM Usuarios WHERE Nombre_Usuario='$Nombre_Usuario' AND contraseña='$contraseña'";
$result_usuario = $conn->query($sql_usuario);

// Consultar la base de datos para verificar credenciales de administradores
$sql_administrador = "SELECT * FROM Administradores WHERE Nombre_Usuario='$Nombre_Usuario' AND contraseña='$contraseña'";
$result_administrador = $conn->query($sql_administrador);

if ($result_usuario->num_rows > 0) {
    // Iniciar sesión si las credenciales son válidas para un usuario
    session_start();
    $_SESSION['Nombre_Usuario'] = $Nombre_Usuario;
    // Redirigir a la página maxipollo.php enviando el ID de quien inició sesión
    header("Location: /maxipollo/auth/maxipollo.php?id=$Nombre_Usuario");
    exit(); // Asegurar que el script se detenga después de la redirección
} elseif ($result_administrador->num_rows > 0) {
    // Iniciar sesión si las credenciales son válidas para un administrador
    session_start();
    $_SESSION['Nombre_Usuario'] = $Nombre_Usuario;
    // Redirigir a la página maxipollo.php enviando el ID de quien inició sesión
    header("Location: /maxipollo/auth/admin/admin.php?id=$Nombre_Usuario");
    exit(); // Asegurar que el script se detenga después de la redirección
} else {
    header("Location: /maxipollo/auth/login.php?error");

}

$conn->close();
?>


