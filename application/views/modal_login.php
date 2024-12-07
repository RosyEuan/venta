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
        <form action="" class="formulario__login">
          <h2 class="sesion">Iniciar sesión</h2>
          <input type="text" placeholder="Usuario">
          <div>
            <input id="password" type="password" placeholder="Contraseña">
            <i id="togglePassword" class="fas fa-eye"></i>
            <a href="#" class="forgot-password" onclick="openPasswordModal()">¿Olvidaste tu contraseña?</a>
          </div>

          <button type="button" onclick="iniciarSesion()">Ingresar</button>
          <p class="coloe">¿No tienes cuenta? <a href="#" onclick="register()" class="crearr">Crear una cuenta</a></p>
          <div class="legal-links">
            <a href="#" class="privacy-link">Aviso de privacidad</a>
            <span>|</span>
            <a href="#" class="terms-link">Términos y condiciones</a>
          </div>
        </form>
        <!-- Crear Cuenta -->
        <form action="" class="formulario__register" style="display: none;">
          <h2 class="cuenta">Crear Cuenta</h2>
          <input type="text" placeholder="Usuario" class="estedee">
          <div class="password-container" style="position: relative;">
            <input id="register-password" type="password" placeholder="Contraseña" class="estedee">
            <i id="toggleRegisterPassword" class="fas fa-eye password-icon"></i>
          </div>
          <div class="password-container" style="position: relative;">
            <input id="register-confirm-password" type="password" placeholder="Asegurar contraseña" class="estedee">
            <i id="toggleRegisterConfirmPassword" class="fas fa-eye confirm-password-icon"></i>
          </div>
          <input type="text" placeholder="Código" class="estemm">

          <button type="button" class="porq">Crear</button>
          <p class="colpe">¿Ya tienes una cuenta? <a href="#" onclick="iniciarSesion()" class="mercure">Iniciar
              Sesión</a></p>
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
  <div class="password-modal" id="passwordModal">
    <div class="password-recovery">
      <h2>¡Recuperar tu contraseña!</h2>
      <p>Te enviaremos un correo para cambiar tu contraseña</p>
      <div class="form-container">
        <input type="email" placeholder="Ingrese su correo" required />
        <button type="submit">Enviar</button>
      </div>
      <div class="back">
        <a href="#" onclick="closePasswordModal()">Regresar <i>&#x21B6;</i></a>
      </div>
    </div>
  </div>

  <script>
    // Función para mostrar el modal de recuperación de contraseña
    function openPasswordModal() {
      document.getElementById('passwordModal').style.display = 'flex';
    }

    // Función para cerrar el modal
    function closePasswordModal() {
      document.getElementById('passwordModal').style.display = 'none';
    }

    // Variables de referencia
    var contenedor_login_register = document.querySelector(".contenedor__login-register");
    var formulario_login = document.querySelector(".formulario__login");
    var formulario_register = document.querySelector(".formulario__register");
    var caja_trasera_login = document.querySelector(".caja__trasera-login");
    var caja_trasera_register = document.querySelector(".caja__trasera-register");

    // Función para mostrar el formulario de registro
    function register() {
      formulario_register.style.display = "block";
      formulario_login.style.display = "none";
      contenedor_login_register.style.left = "410px";
      caja_trasera_register.style.opacity = "0";
      caja_trasera_login.style.opacity = "1";
    }

    // Función para mostrar el formulario de inicio de sesión
    function iniciarSesion() {
      formulario_register.style.display = "none";
      formulario_login.style.display = "block";
      contenedor_login_register.style.left = "10px";
      caja_trasera_register.style.opacity = "1";
      caja_trasera_login.style.opacity = "0";
    }
    document.getElementById("togglePassword").addEventListener("click", function () {
      const passwordInput = document.getElementById("password");
      const isPasswordVisible = passwordInput.type === "password";
      passwordInput.type = isPasswordVisible ? "text" : "password";

      // Cambia el ícono
      this.classList.toggle("fa-eye");
      this.classList.toggle("fa-eye-slash");
    });
    // Mostrar/ocultar contraseña (Campo Contraseña)
    document.getElementById("toggleRegisterPassword").addEventListener("click", function () {
      const passwordInput = document.getElementById("register-password");
      const isPasswordVisible = passwordInput.type === "password";
      passwordInput.type = isPasswordVisible ? "text" : "password";

      // Cambia el ícono
      this.classList.toggle("fa-eye");
      this.classList.toggle("fa-eye-slash");
    });

    // Mostrar/ocultar confirmar contraseña (Campo Asegurar Contraseña)
    document.getElementById("toggleRegisterConfirmPassword").addEventListener("click", function () {
      const confirmPasswordInput = document.getElementById("register-confirm-password");
      const isConfirmPasswordVisible = confirmPasswordInput.type === "password";
      confirmPasswordInput.type = isConfirmPasswordVisible ? "text" : "password";

      // Cambia el ícono
      this.classList.toggle("fa-eye");
      this.classList.toggle("fa-eye-slash");
    });
  </script>
</body>
</html>