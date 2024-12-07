<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login y Registro</title>
  <link href="https://fonts.googleapis.com/css2?family=Khmer&family=Konkhmer+Sleokchher&family=Suez+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      background: linear-gradient(90deg, #06041B 16.85%, #0E0E3D 42.71%, #110F47 53.85%, #010008 100%);

    }

    .todo {
      margin: auto;
      margin-top: 100px;
      padding-top: 50px;

    }

    .contenedor__todo {
      width: 100%;
      max-width: 800px;
      margin: auto;
      position: relative;
    }

    .caja__trasera {
      width: 103%;
      padding: 10px 20px;
      display: flex;
      justify-content: center;
      backdrop-filter: blur(10px);
      background: linear-gradient(261deg, #211A68 7.9%, #19125A 45.91%, #211A68 78.9%);
      position: relative;
      top: 15px;
    }

    .caja__trasera div {
      margin: 100px 40px;
      color: white;
      transition: all 500ms;
    }

    .caja__trasera div h3 {
      font-weight: 400;
      font-size: 24px;
    }

    /* Formularios */
    .contenedor__login-register {
      display: flex;
      align-items: center;
      text-align: center;
      max-width: 340px;
      top: -180px;
      position: relative;
      left: 10px;
      transition: left 500ms cubic-bezier(0.175, 0.885, 0.320, 1.275);
      width: 100%;
      /* Asegúrate de que ocupe el 100% del ancho disponible */
    }

    .formulario__login,
    .formulario__register {
      min-height: 450px;
      /* Mantén la misma altura para ambos formularios */

    }


    .contenedor__login-register form {
      width: 100%;
      padding: 50px 50px;
      background: #0B0B13;
      position: absolute;
      border-radius: 2px;
      height: 550px;
      overflow: visible;
      /* Asegura que no se recorten partes de las letras */
    }

    .contenedor__login-register form h2 {
      font-size: 24px;
      text-align: center;
      margin-bottom: 20px;
      color: #F7F7F7;
    }

    .contenedor__login-register form input {
      width: 90%;
      margin-top: 10px;
      padding: 15px 18px;
      border: none;
      border-radius: 8px;
      background: #F7F7F7;
      font-size: 20px;
      font-family: "Maname";
      outline: none;
      line-height: 1.6;
      /* Asegura que las letras tengan espacio vertical */
      margin-top: 30px;
      /* Aumenta este valor para mayor separación */
      margin-bottom: 5px;
      /* Opcional, si necesitas espacio abajo */
      /* Ajusta este valor para mover el texto más arriba */
      padding-bottom: 10px;
      /* Ajusta el relleno inferior si es necesario */
      overflow: visible;
      /* Asegura que no se recorten partes de las letras */
      height: auto;
      /* O una altura que se adapte al contenido */

    }

    .formulario__register {
      display: none;
      /* Lo mantengo oculto inicialmente */
      min-height: 450px;
      /* Ajusta la altura mínima */
      overflow: hidden;
      /* Evita el desbordamiento */
      max-width: 400px;
      /* Define un ancho máximo adecuado */
    }

    .contenedor__login-register form button {
      padding: 15px 60px;
      margin-top: 40px;
      border: none;
      font-size: 16px;
      font-family: "Merriweather";
      border-radius: 8px;
      background: #E8EC07;
      color: #000;
      outline: none;
    }

    .coloe {
      color: white;
      font-size: 16px;
      font-family: "Merriweather";
      padding-top: 30px;
    }

    .formulario__login {
      opacity: 1;
      display: block;
      min-height: 450px;

    }

    .formulario__register {
      display: none;
      min-height: 450px;
    }

    .total {
      font-family: "Merriweather";
      font-size: 24px !important;
      text-align: center;
    }

    .img {
      height: 70px;
      /* Ajusta la altura */
      width: 100%;
      /* Ajusta el ancho */
      margin-left: -18px;
      /* Ajusta el valor según necesites */
    }

    .sesion {
      font-family: "Merriweather";
      font-size: 32px !important;
    }

    .cuenta {
      font-family: "Merriweather";
      font-size: 32px !important;
      margin-top: -10px !important;

    }

    #togglePassword {
      position: absolute;
      right: 70px;
      top: 45%;
      transform: translateY(-50%);
      cursor: pointer;
      color: gray;
      font-size: 18px;
    }



    .forgot-password {
      display: block;
      /* Para que quede en una línea separada */
      text-align: left;
      /* Alineación a la derecha (opcional) */
      margin-top: 15px;
      /* Espaciado entre el enlace y el campo */
      font-size: 20px;
      /* Tamaño de fuente más pequeño */
      color: #6F56FF;
      /* Color del enlace */
      transition: color 0.3s;
    }

    .forgot-password:hover {
      color: #FFD700;
      /* Color cuando se pasa el mouse */
    }

    .legal-links {
      padding-top: 30px;
      display: flex;
      /* Alinea los elementos en fila */
      justify-content: center;
      /* Centra el contenido */
      gap: 25px;
      /* Espaciado más amplio entre los enlaces y el separador */
      margin-top: 10px;
      /* Espaciado respecto al contenido superior */
      font-size: 16px;
      /* Ajusta el tamaño de la fuente */
    }

    .legal-links a {
      color: white;
      /* Color del texto de los enlaces */
      text-decoration: none;
      /* Sin subrayado */
      transition: color 0.3s;
    }

    .legal-links a:hover {
      color: #FFD700;
      /* Cambia el color al pasar el mouse */
    }

    .legal-links span {
      color: #FFFFFF;
      /* Color del separador */
      font-size: 16px;
    }

    .crearr {
      color: #6F56FF;
    }

    .crearr:hover {
      color: #FFD700;
      /* Color cuando se pasa el mouse */
    }

    .mercu {
      color: #6F56FF;
    }

    .mercu:hover {
      color: #FFD700;
      /* Color cuando se pasa el mouse */
    }

    /* Estilo para los íconos de Contraseña */
    .password-icon {
      position: absolute;
      right: 15px;
      top: 60%;
      transform: translateY(-50%);
      cursor: pointer;
      color: gray;
      font-size: 18px;
      /* Estilo específico para el ícono de contraseña */
    }

    /* Estilo para los íconos de Asegurar Contraseña */
    .confirm-password-icon {
      position: absolute;
      right: 15px;
      top: 60%;
      transform: translateY(-50%);
      cursor: pointer;
      color: gray;
      font-size: 18px;
      /* Estilo específico para el ícono de confirmar contraseña */
      transition: color 0.3s ease;
      /* Agregar animación de color al pasar el cursor */
    }

    input[type="password"] {
      width: 90%;
      margin-top: 10px;
      padding: 15px 12px;
      border: none;
      border-radius: 8px;
      background: #F7F7F7;
      font-size: 20px;
      font-family: "Maname";
      outline: none;
      line-height: 1.6;
      margin-top: 10px;
      margin-bottom: 5px;
      padding-bottom: 15px;
      /* Aumenta este valor para dar más espacio a las letras descendentes */
      height: auto;
      /* Esto permite que la altura se ajuste según el contenido */
    }

    /* Asegura que los íconos de ojo no interfieran con el texto */
    .password-container {
      position: relative;
      width: 100%;
    }

    .estemm {
      margin-top: 5px !important;
    }

    .estedee {
      margin-top: 15px !important;
    }

    .porq {
      margin-top: 15px !important;
    }

    .colpe {
      color: white;
      font-family: "Merriweather";
      padding-top: 8px;
    }

    .mercure {
      color: #6F56FF;
      font-size: 16px;
      font-family: "Merriweather";


    }

    .mercure:hover {
      color: #FFD700;
      /* Color cuando se pasa el mouse */
    }

    .privacy-linkk {
      margin-top: -18px;
    }

    .terms-linkk {
      margin-top: -18px;
    }

    /*modal */
    .password-modal {
      display: none;
      /* Ocultar el modal por defecto */
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      /* Fondo translúcido */
      justify-content: center;
      align-items: center;
    }

    .password-recovery {
      background-color: #1D247F;
      color: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      text-align: center;
      width: 550px;
      height: 360px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      position: relative;
      /* Importante para posicionar el botón dentro */
    }

    .password-recovery h2 {
      margin: 0 0 40px 0;
      font-size: 32px;
      font-family: "Merriweather";
    }

    .password-recovery p {
      margin: 0 0 30px 0;
      line-height: 1.4;
      font-size: 20px;
      font-family: "Merriweather";
    }

    .form-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .password-recovery input {
      width: 150%;
      padding: 20px;
      margin-bottom: 15px;
      border: none;
      border-radius: 8px;
      font-size: 1em;
      text-align: center;
      font-size: 20px;
      font-family: "Merriweather";
    }

    .password-recovery button {
      background-color: #E8EC07;
      color: #16225a;
      border: none;
      padding: 15px 50px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 1em;
      font-weight: bold;
      font-size: 20px;
      font-family: "Merriweather";
      margin-bottom: 30px;
    }

    .password-recovery button:hover {
      background-color: #e0c200;
    }

    /* Ajustar el botón "Regresar" en la esquina inferior derecha */
    .back {
      position: absolute;
      /* Asegura que esté posicionado respecto al contenedor */
      bottom: 20px;
      right: 20px;
      color: white;
      font-size: 0.9em;
      font-weight: bold;
      font-family: "Merriweather";
    }

    .back a {
      text-decoration: none;
      color: white;
    }

    .back a:hover {
      color: #E8EC07;
    }
  </style>
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
        <form class="formulario__login" id="formulario_inicio_sesion" method="POST">
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
        <form class="formulario__register" style="display: none;" id="formulario_registro" method="POST">
          <h2 class="cuenta">Crear Cuenta</h2>
          <input type="text" placeholder="Nombre" class="estemm" name="registro_nombre">
          <input type="text" placeholder="Usuario" class="estedee" name="registro_usuario">
          <div class="password-container" style="position: relative;">
            <input id="register-password" type="password" placeholder="Contraseña" class="estedee" name="registro_contraseña">
            <i id="toggleRegisterPassword" class="fas fa-eye password-icon"></i>
          </div>
          <div class="password-container" style="position: relative;">
            <input id="register-confirm-password" type="password" placeholder="Asegurar contraseña" class="estedee" name="registro_contraseña2">
            <i id="toggleRegisterConfirmPassword" class="fas fa-eye confirm-password-icon"></i>
          </div>
          <input type="text" placeholder="Puesto" class="estedee" name="registro_id_empleado">
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
  <!-- verificacion de login y registro -->
  <script>
    $(document).ready(function() {
      //Verificacion de usuario
      $('#formulario_inicio_sesion').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
          url: "<?php echo base_url('iniciar_sesion'); ?>",
          method: 'POST',
          data: $(this).serialize(),
          dataType: "json",
          success: function(response) {
            console.log('Verificación correcta:', response.message);
            alert("¡Bienvenido!" + response.message);
            window.location.href = "<?php echo base_url('dashboard'); ?>"
          },
          error: function(xhr, status, error) {
            console.error('Ocurrio un error inesperado', error);
            console.error('Detalles del error', xhr.responseText);

            alert('Ocurrio un error', error);
          }
        });
      });
      //Formulario de registro
      $('#formulario_registro').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
          url: "<?php echo base_url('registrarse'); ?>",
          method: 'POST',
          data: $(this).serialize(),
          dataType: 'json',
          success: function(response) {
            console.log('Success', response.message);

            alert('mensajito:' + response.message);
            //window.location.reload();
          },
          error: function(xhr, status, error) {
            console.error('Hubo un error:' + error);
            console.error('Detalles del error:' + xhr.responseText);
            alert('Hubo un error:', error);
          }
        });
      });
    });
  </script>

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

    document.getElementById("togglePassword").addEventListener("click", function() {
      const passwordInput = document.getElementById("password");
      const isPasswordVisible = passwordInput.type === "password";
      passwordInput.type = isPasswordVisible ? "text" : "password";

      // Cambia el ícono
      this.classList.toggle("fa-eye");
      this.classList.toggle("fa-eye-slash");
    });
    // Mostrar/ocultar contraseña (Campo Contraseña)
    document.getElementById("toggleRegisterPassword").addEventListener("click", function() {
      const passwordInput = document.getElementById("register-password");
      const isPasswordVisible = passwordInput.type === "password";
      passwordInput.type = isPasswordVisible ? "text" : "password";

      // Cambia el ícono
      this.classList.toggle("fa-eye");
      this.classList.toggle("fa-eye-slash");
    });

    // Mostrar/ocultar confirmar contraseña (Campo Asegurar Contraseña)
    document.getElementById("toggleRegisterConfirmPassword").addEventListener("click", function() {
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