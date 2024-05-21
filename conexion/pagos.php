<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago</title>
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

    <a href="/maxipollo/auth/maxipollo.php">
        <img src="/maxipollo/auth/admin/assets/img/atras.png" height="40px" width="50px">
    </a>
    <h2>Ingresa la información de tu pago</h2>

    <?php
    $conn = new mysqli("maxipollodb.clydjthxdmub.us-east-1.rds.amazonaws.com", "root", "12345678", "maxipolloDB");

    // Verificar si hay errores de conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $Nombre_Categoria = $Descripcion = $precio = "";

    if(isset($_POST['ID'])) {
        // Obtener el ID enviado por el formulario
        $ID = $_POST['ID'];
        $idUsuario = $_POST['idUsuario'];

        // Preparar la consulta SQL con una declaración preparada para evitar inyección de SQL
        $sql = "SELECT ID, Nombre_Categoria, Descripcion, precio FROM Categorias_Tiquetera WHERE ID = ?";
        $stmt = $conn->prepare($sql);

        // Vincular parámetros y ejecutar la consulta
        $stmt->bind_param("i", $ID); // "i" indica que se espera un parámetro entero
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            // Obtener la fila de resultados como un array asociativo
            $row = $result->fetch_assoc();

            // Rellenar los valores de los campos de entrada con la información obtenida
            $Nombre_Categoria = $row['Nombre_Categoria'];
            $Descripcion = $row['Descripcion'];
            $precio = $row['precio'];
        } 
        // Liberar los resultados y cerrar la consulta
        $stmt->close();
    } 
    ?>

    <form action="agregarPago.php" method="post">
        <label for="producto">Producto:</label><br>
        <input type="text" id="producto" name="producto" readonly value="<?php echo htmlspecialchars($Nombre_Categoria); ?>"><br>

        <label for="bancos">Bancos:</label><br>
        <select name="bancos" id="bancos" required>
            <option value="">Seleccionar</option>
            <option value="Banco1">Nequi</option>

            <!-- Agrega más opciones de bancos según sea necesario -->
        </select><br>

        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" required><br>

        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" required><br>

        <label for="tipoDocumento">Tipo de documento:</label><br>
        <select name="tipoDocumento" id="tipoDocumento" required>
            <option value="">Seleccionar</option>
            <option value="CC">CC</option>
            <option value="TI">TI</option>
            <option value="CE">CE</option>
            <!-- Agrega más opciones de tipo de documento según sea necesario -->
        </select><br>

        <label for="idPago">Número de documento:</label><br>
        <input type="text" id="numeroDocumento" name="numeroDocumento" required><br>

        <label for="totalPago">Total a pagar:</label><br>
        <input type="text" id="totalPago " name="totalPago" readonly value="<?php echo htmlspecialchars($precio); ?>"><br>


       
        <input type="hidden" id="formaPago" name="formaPago" required value="Tranferencia Bnacaria">

        <input type="hidden" id="idCategorias_Tiquetera" name="idCategorias_Tiquetera" value="<?php echo $ID; ?>" required>

        <input type="hidden" id="idUsuario" name="idUsuario"  value="<?php echo $idUsuario; ?>" required>

        <input type="hidden" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>

<input type="submit" value="Pagar">

       
    </form>

</body>
</html>