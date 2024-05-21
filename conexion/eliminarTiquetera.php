<?php
include 'conexion.php';

// Verificar si se ha enviado un ID por POST
if(isset($_POST['ID'])){
    // Obtener el ID del usuario a eliminar
    $ID = $_POST['ID'];

    try {
        // Sentencia SQL para eliminar el usuario
        $sql = "DELETE FROM Categorias_Tiquetera WHERE ID = $ID";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: /maxipollo/auth/admin/admin.php");
        } else {
            header("Location: /maxipollo/auth/admin/admin.php?");
        }
    } catch (Exception $e) {
        header("Location: /maxipollo/auth/admin/admin.php?error=FatalError");
    }
} else {
    header("Location: /maxipollo/auth/admin/admin.php");
}

// Cerrar conexión
$conn->close();
?>
