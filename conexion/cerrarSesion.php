<?php
session_start(); // Inicia la sesión

// Destruye todas las variables de sesión
$_SESSION = array();

// Destruye la sesión completamente
session_destroy();

// Redirige al usuario a la página de inicio de sesión o a otra página
header("Location: /maxipollo/auth/login.php");
exit();
?>
