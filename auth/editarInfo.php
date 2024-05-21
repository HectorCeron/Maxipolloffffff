<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Información</title>

    <link rel="icon" type="image/x-icon" href="/maxipollo/assets/images/hero-banner.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php
session_start();
    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['Nombre_Usuario'])) {
        // Si no ha iniciado sesión, redirigirlo al formulario de inicio de sesión
        header("Location: /maxipollo/auth/login.php");
        exit(); // Asegurar que el script se detenga después de la redirección
    }

    // Obtener el ID del usuario que ha iniciado sesión
    $Nombre_Usuario = $_SESSION['Nombre_Usuario'];



?>
    <div class="cont">
        <style>
            body{
             background-color:#e5e5e5;;
             display: flex;
             justify-content: center;
             align-items: center;
             height: 60vh;
            }
            .cont {
                padding: 10px;
                background-color: white;
                border-radius: 5px;
                width: 800px;
                flex-direction: column;
            }
            .row {
                padding: 20px;
            }

           
        </style>
            <a href="/maxipollo/auth/maxipollo.php">
        <img src="/maxipollo/auth/admin/assets/img/atras.png" height="40px" width="50px">
    </a>

    <?php
$conn = new mysqli("maxipollodb.clydjthxdmub.us-east-1.rds.amazonaws.com", "root", "12345678", "maxipolloDB");

// Verificar si hay errores de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
if(isset($_POST['idUsuario'])) {
    // Obtener el ID enviado por el formulario
    $idUsuario = $_POST['idUsuario'];

    // Preparar la consulta SQL con una declaración preparada para evitar inyección de SQL
    $sql = "SELECT * FROM Usuarios WHERE idUsuario = ?";
    $stmt = $conn->prepare($sql);

    // Vincular parámetros y ejecutar la consulta
    $stmt->bind_param("i", $idUsuario); // "i" indica que se espera un parámetro entero
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        // Obtener la fila de resultados como un array asociativo
        $row = $result->fetch_assoc();

        // Rellenar los valores de los campos de entrada con la información obtenida
        $Nombre = $row['Nombre'];
        $Apellido = $row['Apellido'];
        $Correo = $row['Correo'];
        $Telefono = $row['Telefono'];
    } else {
        // Si no se encuentra ninguna fila, inicializar las variables de los campos de entrada
        $Nombre = 'No encontrado';
        $Apellido='No encontrado';
        $Correo = 'No encontrado';
        $Telefono = 'No encontrado';
    }
    // Liberar los resultados y cerrar la consulta
    $stmt->close();
} else {
    // Si no se ha enviado un ID, inicializar las variables de los campos de entrada
    $Nombre = '';
    $Apellido='';
    $Correo = '';
    $Telefono = '';
}
?>









    <form action="/maxipollo/conexion/editarUsuario.php" method="post">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" name="Nombre" value="<?php echo $Nombre; ?>" >
            </div>
            <div class="col">
                <input type="text" class="form-control" name="Apellido" value = "<?php echo $Apellido; ?>" >
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" name="Correo" value="<?php echo $Correo; ?>" >
            </div>
            <div class="col">
                <input type="text" class="form-control" name="Telefono" value="<?php echo $Telefono; ?>" >
                <input type="hidden" class="form-control" name="idUsuario" value="<?php echo $idUsuario; ?>" >

            </div>
        </div>


       <button type="submit" class="btn btn-outline-success">Guardar</button>


        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>