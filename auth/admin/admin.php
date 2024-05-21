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
    <link href="css/style.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="/maxipollo/auth/admin/admin.php?">Maxipollo</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"></form>
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
                        session_start();
                        if (!isset($_SESSION['Nombre_Usuario'])) {
                            header("Location: /maxipollo/auth/login.php");
                            exit();
                        }
                        $Nombre_Usuario = $_SESSION['Nombre_Usuario'];
                        echo " $Nombre_Usuario";
                    ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tiqueteras</h1>
                    <a href="/maxipollo/auth/admin/agregar-tiqutera.php" class="text">
                        <div class="agregar">
                            <button clase="add">Agregar Tiquetera</button>
                        </div>
                    </a>
                    <?php
                        $conn = new mysqli("maxipollodb.clydjthxdmub.us-east-1.rds.amazonaws.com", "root", "12345678", "maxipolloDB");
                        if ($conn->connect_error) {
                            die("Error de conexión: " . $conn->connect_error);
                        }
                        $sql = "SELECT ID, Nombre_Categoria, Descripcion, precio FROM Categorias_Tiquetera ";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $counter = 0; // Counter to track containers
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($counter % 4 == 0) { // Start a new row after every 4 containers
                                    echo '<div class="row">';
                                }
                                echo '<div class="col-lg-3 col-md-3">';
                                echo '<div class="card">';
                                echo '<div class="card-border-top"></div>';
                                echo '<span>' . $row['Nombre_Categoria'] . '</span>';
                                echo '<p class="job">' . $row['Descripcion'] . '</p>';
                                echo '<p class="job">$' . number_format($row['precio'], 0, ',', '.') . '</p>';
                                echo '<div class="botones">';
                                echo '<form action="/maxipollo/conexion/eliminarTiquetera.php" method="POST">';
                                echo '<input type="hidden" name="ID" value="' . $row['ID'] . '">';
                                echo '<button type="submit" class="eliminar">Eliminar</button>';
                                echo '</form>';
                                echo '<form action="/maxipollo/auth/admin/editar-tiquetera.php" method="POST">';
                                echo '<input type="hidden" name="ID" value="' . $row['ID'] . '" >';
                                echo '<button type="submit" class="editar">Editar</button>';
                                echo '</form>';
                                echo '</div>';
                                echo '</div>'; // Cierre de la tarjeta
                                echo '</div>'; // Cierre de la columna
                                if (($counter + 1) % 4 == 0 || mysqli_num_rows($result) - $counter == 1) { // Close the row after every 4 containers or on the last container
                                    echo '</div>'; // Cierre del row
                                }
                                $counter++;
                            }
                        } else {
                            echo "No se encontraron resultados.";
                        }
                        mysqli_close($conn);
                    ?>
                </div>
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
    
        <script>
    // Obtener el parámetro de error de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const error = urlParams.get('error');

    // Si hay un error fatal, mostrar una alerta
    if (error === 'FatalError') {
        alert('No puedes eliminar esta tiquetera.');
    }
</script>

    </body>
</html>


