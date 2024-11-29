<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login y Registro</title>
  <style>
    .todo {
      margin: auto;
      margin-top: 100px;
    }
    .contenedor__todo {
      width: 100%;
      max-width: 790px;
      margin: auto;
      position: relative;
    }
    .caja__trasera {
      width: 100%;
      padding: 10px 20px;
      display: flex;
      justify-content: center;
      backdrop-filter: blur(10px);
      background: #322A7F;
    }
    .caja__trasera div {
      margin: 100px 40px;
      color: white;
      transition: all 500ms;
    }
    .caja__trasera div h3 {
      font-weight: 400;
      font-size: 20px;
    }

    /* Formularios */
    .contenedor__login-register {
      display: flex;
      align-items: center;
      text-align: center;
      width: 200%;
      max-width: 340px;
      top: -170px;
      position: relative;
      left: 17px;
      transition: left 500ms cubic-bezier(0.175, 0.885, 0.320, 1.275);
    }
    .contenedor__login-register form {
      width: 100%;
      padding: 50px 50px;
      background: #0B0B13;
      position: absolute;
      border-radius: 2px;
    }

    .contenedor__login-register form h2 {
      font-size: 24px;
      text-align: center;
      margin-bottom: 20px;
      color: #F7F7F7;
    }
    .contenedor__login-register form input {
      width: 100%;
      margin-top: 10px;
      padding: 10px 10px;
      border: none;
      border-radius: 8px;
      background: #F7F7F7;
      font-size: 16px;
      outline: none;
    }
    .contenedor__login-register form button {
      padding: 10px 50px;
      margin-top: 30px;
      border: none;
      font-size: 20px;
      border-radius: 8px;
      background: #E8EC07;
      color: #000;
      outline: none;
    }
    .coloe {
      color: white;
    }
    .formulario__login{
opacity:1;
display:block;

    }
    .formulario__register{
      display:none;
    }
  </style>
</head>
<body>

<main class="todo">
  <div class="contenedor__todo">
    <div class="caja__trasera">
      <div class="caja__trasera-login">
        <img src="img/logo.png" class="img" alt="" height="50px">
        <h3>Control total, más ventas, menos estrés</h3>
      </div>
      <div class="caja__trasera-register">
        <img src="img/logo.png" class="img" alt="" height="50px">
        <h3>Control total, más ventas, menos estrés</h3>
      </div>
    </div>

    <!-- Formulario de login y registro -->
    <div class="contenedor__login-register">
      <!-- Iniciar Sesión -->
      <form action="" class="formulario__login">
        <h2>Iniciar sesión</h2>
        <input type="text" placeholder="Usuario">
        <input type="password" placeholder="Contraseña">
        <button type="button" onclick="iniciarSesion()">Ingresar</button>
        <p class="coloe">¿No tienes cuenta? <a href="#" onclick="register()">Crear una cuenta</a></p>
      </form>
      <!-- Crear Cuenta -->
      <form action="" class="formulario__register" style="display: none;">
        <h2>Crear Cuenta</h2>
        <input type="text" placeholder="Nombre">
        <input type="text" placeholder="Usuario">
        <input type="password" placeholder="Contraseña">
        <input type="text" placeholder="Puesto">
        <button type="button">Crear</button>
        <p class="coloe">¿Ya tienes una cuenta? <a href="#" onclick="iniciarSesion()">Iniciar Sesión</a></p>
      </form>
    </div>
  </div>
</main>

<script>
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
</script>

</body>
</html>

