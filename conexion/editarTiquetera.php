<?php
include 'conexion.php';

// Verificar si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $ID = $_POST['ID'];
    $Nombre_Categoria = $_POST['Nombre_Categoria'];
    $Descripcion = $_POST['Descripcion'];
    $precio = $_POST['precio'];

    // Consulta para actualizar el registro
    $sql = "UPDATE Categorias_Tiquetera SET Nombre_Categoria='$Nombre_Categoria', Descripcion='$Descripcion', precio=$precio WHERE ID=$ID";

    if ($conn->query($sql) === TRUE) {
        header("Location: /maxipollo/auth/admin/admin.php");
    } else {
        header("Location: /maxipollo/auth/admin/admin.php");
    }
}

// Cerrar conexión
$conn->close();
?>
