

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Maxipollo Admin</title>
        <link rel="icon" type="image/x-icon" href="/maxipollo/assets/images/hero-banner.png" />
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
      
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/maxipollo/auth/admin/admin.php?">Maxipollo</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
           
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="/maxipollo/conexion/cerrarSesion.php">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                    
                            
                            <div class="sb-sidenav-menu-heading">Servicios</div>
                            <a class="nav-link" href="/maxipollo/auth/admin/admin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tiqueteras
                            </a>
                            <a class="nav-link" href="/maxipollo/auth/admin/clientes.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Clientes
                            </a>
                            <a class="nav-link" href="/maxipollo/auth/admin/usuarios.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Usuarios
                            </a>
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logeado con el usuario:</div>
                        <?php
    // Iniciar sesión
    
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
    echo " $Nombre_Usuario";

?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    
                
                <?php
$conn = new mysqli("maxipollodb.clydjthxdmub.us-east-1.rds.amazonaws.com", "root", "12345678", "maxipolloDB");

// Verificar si hay errores de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener los usuarios
$sql = "SELECT * FROM pagos;";
$result = $conn->query($sql);

?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Clientes</h1>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Clientes registrados
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Tiquetera</th>
                        <th>Fecha de pago</th>
                        <th>Forma de pago</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mostrar datos de la consulta en la tabla
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["Nombre"] . "</td>";
                            echo "<td>" . $row["Apellido"] . "</td>";
                            echo "<td>" . $row["Correo"] . "</td>";
                            echo "<td>" . $row["Telefono"] . "</td>";
                            echo "<td>" . $row["Producto"] . "</td>";
                            echo "<td>" . date('Y-m-d', strtotime($row["Fecha"])) . "</td>";
                            echo "<td>" . $row["formaPago"] . "</td>";
                            echo "<td>$ " . number_format($row["totalPago"], 0, ",", ".") . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No hay usuarios registrados</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
// Cerrar conexión a la base de datos
$conn->close();
?>

                            
                </main>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>


