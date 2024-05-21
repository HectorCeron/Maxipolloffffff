<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
    <!-- Include external CSS for table styling -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <!-- Custom CSS for additional styling -->
    <link rel="icon" type="image/x-icon" href="/maxipollo/assets/images/hero-banner.png" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <a href="/maxipollo/auth/maxipollo.php">
        <img src="/maxipollo/auth/admin/assets/img/atras.png" height="40px" width="50px">
    </a>
    <!-- Removed unnecessary closing div tags -->
    <div id="layoutSidenav_content">

        <div class="container-fluid px-4">
            <h1 class="mt-4">Historial</h1>
            <div class="card mb-4">
                <div class="card-header"></div>
                <div class="card">
                    <div class="card-body">
                        <table id="datatablesSimple" class="table table-bordered table-striped">
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
                                   $conn = new mysqli("maxipollodb.clydjthxdmub.us-east-1.rds.amazonaws.com", "root", "12345678", "maxipolloDB");
                                   if ($conn->connect_error) {
                                       die("Error de conexión: " . $conn->connect_error);
                                   }
                                   if(isset($_POST['idUsuario'])) {
                                   
                                       
                                       $idUsuario = $_POST['idUsuario'];
                                     
                           
                                       $sql = "SELECT * FROM pagos WHERE idUsuario='$idUsuario';";
                                       $result = $conn->query($sql);
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
                                    echo "<tr><td colspan='8'>No hay pagos registrados</td></tr>";
                                }
                            }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Removed unnecessary script imports -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
