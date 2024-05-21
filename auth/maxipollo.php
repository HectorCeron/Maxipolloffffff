<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Maxipollo</title>

    <link rel="icon" type="image/x-icon" href="/maxipollo/assets/images/hero-banner.png" />
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>

    <!-- Header-->
    <div class="encabezado">
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

        // Aquí puedes mostrar el nombre del usuario o realizar otras acciones según tus necesidades
        echo "<h3> Bienvenido  $Nombre_Usuario </h3>";
        ?>
        <label class="popup">
            <input type="checkbox">
            <div class="burger" tabindex="0">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <nav class="popup-window">
                <legend>Acciones</legend>
                <ul>
                    <hr>
                    <li>
                 
                        
                        <?php
                         $conn = new mysqli("maxipollodb.clydjthxdmub.us-east-1.rds.amazonaws.com", "root", "12345678", "maxipolloDB");
                         $sql = "SELECT * FROM pagos";
                         $result = $conn->query($sql);
                 
                        echo '<form action="/maxipollo/auth/historial.php" method="POST">';
                        
                        $sql_usuario = "SELECT idUsuario FROM Usuarios WHERE Nombre_Usuario = '$Nombre_Usuario'";
                         $result_usuario = $conn->query($sql_usuario);

                if ($result_usuario !== null && $result_usuario->num_rows > 0) {
                    while ($row_usuario = $result_usuario->fetch_assoc()) {
                        echo '<input type="hidden" name="idUsuario" value="' . $row_usuario['idUsuario'] . '">';
                    }
                }
                        echo '<button type="submit" class="cta hover-underline-animation" >Historial <span>&nbsp;</span> ' ;
                        echo '</form>';

                        echo '<form action="/maxipollo/auth/editarInfo.php" method="POST">';
                        
                        $sql_usuario = "SELECT idUsuario FROM Usuarios WHERE Nombre_Usuario = '$Nombre_Usuario'";
                         $result_usuario = $conn->query($sql_usuario);

                if ($result_usuario !== null && $result_usuario->num_rows > 0) {
                    while ($row_usuario = $result_usuario->fetch_assoc()) {
                        echo '<input type="hidden" name="idUsuario" value="' . $row_usuario['idUsuario'] . '">';
                    }
                }
                        echo '<button type="submit" class="cta hover-underline-animation" >Editar <span>&nbsp;</span> ' ;
                        echo '</form>';
                    

                   

                    ?>
                    <hr>
                    <li>
                        <button onclick="window.location.href = '/maxipollo/conexion/cerrarSesion.php';">
                            <svg stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="14" width="14" xmlns="http://www.w3.org/2000/svg">
                                <line y2="18" x2="6" y1="6" x1="18"></line>
                                <line y2="18" x2="18" y1="6" x1="6"></line>
                            </svg>
                            <span>Salir</span>
                        </button>
                    </li>
                </ul>
            </nav>
        </label>
    </div>

   
    <!-- Contenedor de productos -->
<div class="container" style="display: flex; ">


        <?php
        $conn = new mysqli("maxipollodb.clydjthxdmub.us-east-1.rds.amazonaws.com", "root", "12345678", "maxipolloDB");

        // Verificar si hay errores de conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Consulta SQL
        $sql = "SELECT * FROM Categorias_Tiquetera";
        $result = $conn->query($sql);

        // Mostrar resultados en la plantilla HTML
        if ($result !== null && $result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo '<div class="elemento">';
                echo '<div class="card h-100">';
                echo '<img  src="/maxipollo/assets/images/hero-banner.png" width="200" height="200" />';
                echo '<div class="card-body p-4">';
                echo '<div class="text-center">';
                echo '<h5 class="Nombre_Categoria">' . $row["Nombre_Categoria"] . '</h5>';
                echo '<h6 class="Descripcion">' . $row["Descripcion"] . '</h6>';
                echo '<h4 class="precio">' . $row["precio"] . '</h4>';
                echo '</div>';
                echo '<br>';
                echo '<form action="/maxipollo/conexion/pagos.php" method="POST">';
                echo '<input type="hidden" name="ID" value="' . $row['ID'] . '">';

                $sql_usuario = "SELECT idUsuario FROM Usuarios WHERE Nombre_Usuario = '$Nombre_Usuario'";
                $result_usuario = $conn->query($sql_usuario);

                if ($result_usuario !== null && $result_usuario->num_rows > 0) {
                    while ($row_usuario = $result_usuario->fetch_assoc()) {
                        echo '<input type="hidden" name="idUsuario" value="' . $row_usuario['idUsuario'] . '">';
                    }
                }

                echo '<button type="submit" class="cta hover-underline-animation" >Comprar <span>&nbsp;</span> ' ;
                echo '<svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 46 16">';
                echo '<path id="Path_10" data-name="Path 10" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" transform="translate(30)"></path>';
                echo '</svg>';
                echo '</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "0 resultados";
        }
        $conn->close();
        ?>
    </div>

</body>

</html>
