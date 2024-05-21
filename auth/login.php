<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/maxipollo/assets/css/styleslog.css">
    <link rel="icon" type="image/x-icon" href="/maxipollo/assets/images/hero-banner.png" />
    <title>Iniciar Sesión</title>
</head>
<body>
<style>
  .logo {
    transition: transform 0.3s ease-in-out;
  }

  .logo:hover {
    transform: scale(1.1);
  }
</style>



<div>
  <a href="/maxipollo/index.html">
    <img src="/maxipollo/assets/images/hero-banner.png" alt="logo" class="logo" width="90px" height="90px">
  </a>
</div>

<div class="login-box">
  <p>Iniciar Sesión</p>
  <form action="/maxipollo/conexion/auth.php"  method="post">
    <div class="user-box">
      <input required="" name="Nombre_Usuario" type="text" id="Nombre_Usuario">
      <label>Usuario</label>
    </div>
    <div class="user-box">
      <input required="" name="contraseña" type="password" id="contraseña">
      <label>Contraseña</label>
    </div>
    <button class="button">
        <span class="button-content">Iniciar Sesión </span>
    </button>
    <?php
        if(isset($_GET['error'])) {
            echo "<p style='color: red;'>Usuario o clontraseña incorrecto</p>";
        }
    ?>
  </form>
  <p>¿No tienes una cuenta?  <a href="registro.php" class="a2">Registrate</a></p>
</div>
</body>
</html>
