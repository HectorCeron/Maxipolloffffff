<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/maxipollo/assets/css/styleslog.css">
    <title>Registrate</title>
    <link rel="icon" type="image/x-icon" href="/maxipollo/assets/images/hero-banner.png" />
</head>
<body>
<style>
   #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: lightgreen;
            border: 2px solid green;
            z-index: 1000;
          
        }
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
  <p>Registrate</p>
  
  <form action="/maxipollo/conexion/agregarUsuario.php" method="post">
    <div class="user-box">
      <input required name="nombre" type="text" id="nombre">
      <label>Nombre</label>
    </div>
    <div class="user-box">
      <input required name="apellido" type="text" id="apellido">
      <label>Apellido</label>
    </div>
    <div class="user-box">
      <input required name="correo" type="text" id="correo">
      <label>Correo</label>
    </div>
    <div class="user-box">
      <input required name="telefono" type="text" id="telefono">
      <label>Celular</label>
    </div>
    <div class="user-box">
      <input required name="nombre_usuario" type="text" id="nombre_usuario">
      <label>Usuario</label>
    </div>
    <div class="user-box">
      <input required name="contrasena" type="password" id="contrasena">
      <label>Contraseña</label>
    </div>
    <button type="submit" class="button">
      <span class="button-content">Registrate</span>
    </button>
  </form>
  <p>¿Ya tienes una cuenta?  <a href="login.php" class="a2">Inicia Sesión</a></p>
  <?php
        if(isset($_GET['error'])) {
          echo "<p style='color: red;'>Error al registrar</p>";
        }
    ?>
</div>
<div id="popup">Registro exitoso!</div>

    <script>
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('exito')) {
                const popup = document.getElementById('popup');
                popup.style.display = 'block';
                setTimeout(() => {
                    popup.style.display = 'none';
                }, 3000);
            }
        };
    </script>


</body>
</html>
