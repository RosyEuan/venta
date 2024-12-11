<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login y Registro</title>

  <link href="https://fonts.googleapis.com/css2?family=Khmer&family=Konkhmer+Sleokchher&family=Suez+One&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/venta/assets/css/style_login.css">

</head>

<body>
  <main class="todo">
    <div class="contenedor__todo">
      <div class="caja__trasera">
        <div class="caja__trasera-login">
          <img src="img/logo.png" class="img" alt="">
          <h2 class="total">Control total, más ventas, menos estrés</h2>
        </div>
        <div class="caja__trasera-register">
          <img src="img/logo.png" class="img" alt="">
          <h2 class="total">Control total, más ventas, menos estrés</h2>
        </div>
      </div>

      <!-- Formulario de login y registro -->
      <div class="contenedor__login-register">
        <!-- Iniciar Sesión -->
        <form class="formulario__login" id="formulario_inicio_sesion" method="POST"
          data-controller-url="<?= site_url('iniciar_sesion') ?>" data-redirect="<?= site_url('dashboard') ?>">

          <h2 class="sesion">Iniciar sesión</h2>
          <input type="text" name="loginUsuario" placeholder="Usuario">
          <div>
            <input id="password" name="loginContraseña" type="password" placeholder="Contraseña">
            <i id="togglePassword" class="fas fa-eye"></i>
            <a href="#" class="forgot-password" onclick="openPasswordModal()">¿Olvidaste tu contraseña?</a>
          </div>

          <button type="submit">Ingresar</button>
          <p class="coloe">¿No tienes cuenta? <a href="#" onclick="register()" class="crearr">Crear una cuenta</a></p>
          <div class="legal-links">
            <a href="#" class="privacy-link">Aviso de privacidad</a>
            <span>|</span>
            <a href="#" class="terms-link">Términos y condiciones</a>
          </div>
        </form>
        <!-- Crear Cuenta -->
        <form class="formulario__register" style="display: none;" id="formulario_registro" method="POST"
          data-controller-url="<?= site_url('registrarse'); ?>">
          <h2 class="cuenta">Crear Cuenta</h2>
          <input type="text" placeholder="Usuario" class="estedee" name="registro_usuario">
          <div class="password-container" style="position: relative;">
            <input id="register-password" type="password" placeholder="Contraseña" class="estedee" name="registro_contraseña">
            <i id="toggleRegisterPassword" class="fas fa-eye password-icon"></i>
          </div>
          <div class="password-container" style="position: relative;">
            <input id="register-confirm-password" type="password" placeholder="Asegurar contraseña" class="estedee" name="registro_contraseña2">
            <i id="toggleRegisterConfirmPassword" class="fas fa-eye confirm-password-icon"></i>
          </div>
          <input type="text" placeholder="ID" class="estedee" name="registro_id_empleado">
          <button type="submit" class="porq">Crear</button>
          <p class="colpe">¿Ya tienes una cuenta? <a href="#" onclick="iniciarSesion()" class="mercure">Iniciar Sesión</a></p>
          <div class="legal-links">
            <a href="#" class="privacy-linkk">Aviso de privacidad</a>
            <span class="privacy-linkk">|</span>
            <a href="#" class="terms-linkk">Términos y condiciones</a>
          </div>
        </form>
      </div>
    </div>
  </main>

  <!-- Modal de recuperación de contraseña -->
  <form class="password-modal" id="passwordModal" method="POST" data-controller-verify="<?= site_url('verificar_correo'); ?>">
    <div class="password-recovery">
      <h2>¡Recuperar tu contraseña!</h2>
      <p>Te enviaremos un correo para cambiar tu contraseña</p>
      <div class="form-container">
        <input type="email" id="solicitud_recuperar" name="solicitud_recuperar"
          placeholder="Ingrese su correo" required />
        <button type="submit">Enviar</button>
      </div>
      <div class="back">
        <a href="#" onclick="closePasswordModal()">Regresar <i>&#x21B6;</i></a>
      </div>
    </div>
  </form>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="/venta/assets/js/verificar_correo.js"></script>
  <script src="/venta/assets/js/login.js"></script>
</body>

</html>