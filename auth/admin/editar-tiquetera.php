

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
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
           
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
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
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
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
                    
                <a href="/maxipollo/auth/admin/admin.php">
    <img src="/maxipollo/auth/admin/assets/img/atras.png" height="40px" width="50px">
</a>

                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Editar Tiqueteras</h1>




                        <?php
$conn = new mysqli("maxipollodb.clydjthxdmub.us-east-1.rds.amazonaws.com", "root", "12345678", "maxipolloDB");

// Verificar si hay errores de conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
if(isset($_POST['ID'])) {
    // Obtener el ID enviado por el formulario
    $ID = $_POST['ID'];

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
    } else {
        // Si no se encuentra ninguna fila, inicializar las variables de los campos de entrada
        $Nombre_Categoria = 'No encontrado';
        $Descripcion = '';
        $precio = '';
    }
    // Liberar los resultados y cerrar la consulta
    $stmt->close();
} else {
    // Si no se ha enviado un ID, inicializar las variables de los campos de entrada
    $Nombre_Categoria = '';
    $Descripcion = '';
    $precio = '';
}
?>


<div class="form-container">
  <form class="form" method="post" action="/maxipollo/conexion/editarTiquetera.php">
    <div class="form-group">
    <input required="" name="ID" id="ID" type="hidden" value="<?php echo $ID; ?>">
      <label for="text">Nombre de tiquetera</label>
      <!-- Rellenar el campo con el valor obtenido -->
      <input required="" name="Nombre_Categoria" id="Nombre_Categoria" type="text" value="<?php echo $Nombre_Categoria; ?>">
    </div>
    <div class="form-group">
      <label for="text">Descripción de la tiquetera</label>
      <!-- Rellenar el campo con el valor obtenido -->
      <input required="" name="Descripcion" id="Descripcion" type="text" value="<?php echo $Descripcion; ?>">
    </div>
    <div class="form-group">
      <label for="text">Precio de tiquetera</label>
      <!-- Rellenar el campo con el valor obtenido -->
      <input required="" name="precio" id="precio" type="text" value="<?php echo $precio; ?>">
    </div>
   
    <button type="submit" class="form-submit-btn">Guardar cambios</button>
  </form>
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
    </body>
</html>
