<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nombre_Categoria = $_POST['Nombre_Categoria'];
    $Descripcion = $_POST['Descripcion'];
    $precio = $_POST['precio'];
   

    // Consulta para insertar un nuevo registro en la tabla Usuarios
    $sql = "INSERT INTO Categorias_Tiquetera (Nombre_Categoria, Descripcion, precio)
    VALUES ('$Nombre_Categoria', '$Descripcion', '$precio')";

    if ($conn->query($sql) === TRUE) {
        // Redireccionar a index.php si el registro es exitoso
        header("Location: /maxipollo/auth/admin/admin.php");
        exit();
    } else {
        header("Location: /maxipollo/auth/admin/agregar-tiqutera.php");
    }
}

// Cerrar conexión
$conn->close();
?>
