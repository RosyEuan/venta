<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Punto de Venta</title>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <!-- Font Awesome para los iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Maname&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/venta/style_user.css">
</head>
<body>

<div id="app">
    <!-- Barra lateral -->
    <div :class="['sidebar', { open: isSidebarOpen }]">
      <button class="toggle-btn" @click="toggleSidebar">☰</button>
      <div class="logo">
        <img src="img/LogoCytisum.png" alt="Logo" @click="closeSidebar">
      </div>
      <ul>
        <li>
          <a href="<?= site_url('graficas2') ?>">
            <img src="<?= base_url('img/Barras.png') ?>" alt="Reportes"><span>Reportes</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('mesas') ?>">
            <img src="<?= base_url('img/Mesa.png') ?>" alt="Mesas"><span>Mesas</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('reservaciones') ?>">
            <img src="<?= base_url('img/Reservas.png') ?>" alt="Reservaciones"><span>Reservaciones</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('menu') ?>">
            <img src="<?= base_url('img/Menus.png') ?>" alt="Menú"><span>Menú</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('pedidos') ?>">
            <img src="<?= base_url('img/Pedido.png') ?>" alt="Pedidos"><span>Pedidos</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('modal_producto') ?>">
            <img src="<?= base_url('img/Inventarios.png') ?>" alt="Inventario"><span>Inventario</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('personal') ?>">
            <img src="<?= base_url('img/Personales.png') ?>" alt="Personal"><span>Personal</span>
          </a>
        </li>
      </ul>
      <div class="bottom-icons" :class="{ hidden: isSidebarOpen }">
        <a href="<?= site_url('perfil') ?>">
          <img src="img/Admin.png" alt="Usuario">
        </a>
        <img src="img/Logout.png" alt="Salir">
      </div>
      <div class="admin-info" :class="{ hidden: !isSidebarOpen }">
        <a href="<?= site_url('perfil') ?>">
          <img src="<?= base_url('img/Admin.png') ?>" alt="Usuario">
        </a>
        <span>Angel Chi<br>Administrador</span>
      </div>
    </div>

  <div class="content">
  <h2 class="content-title">Perfil</h2> 
    <div class="profile-container">
      <!-- Sección izquierda: campos en dos columnas -->
      <div class="left-section">
        <div class="form-group">
          <label for="nombre">Nombre(s):</label>
          <input type="text" id="nombre" placeholder="Ej. Jorge Alejandro">
        </div>

        <div class="form-group">
          <label for="apellidos">Apellidos:</label>
          <input type="text" id="apellidos" placeholder="Ej. Pérez Domínguez">
        </div>

        <div class="form-group">
          <label for="fecha-nacimiento">Fecha de nacimiento:</label>
          <input type="date" id="fecha-nacimiento" class="fecha">
        </div>

        <div class="form-group">
          <label for="domicilio">Domicilio:</label>
          <input type="text" id="domicilio" placeholder="Ej. C32 M52 L9">
        </div>

        <div class="form-group">
          <label for="usuario">Usuario:</label>
          <input type="text" id="usuario" placeholder="Ej. JorgePerez">
        </div>

        <!-- Campo de contraseña con el icono de ojito dentro del campo y botón azul al lado -->
        <div class="form-group">
          <label for="contraseña">Contraseña:</label>
          <div class="password-container">
            <input type="password" id="contraseña" placeholder="**********">
            <span class="eye-icon" onclick="togglePasswordVisibility()">
              <i class="fas fa-eye"></i> 
            </span>
            <button class="edit-button" onclick="openModal()">✎</button> <!-- Botón azul con lapicito -->
          </div>
        </div>

        <div class="form-group">
          <label for="correo">Correo electrónico:</label>
          <input type="email" id="correo" placeholder="Ej. JorgePD@gmail.com">
        </div>

        <div class="form-group">
          <label for="telefono">Teléfono:</label>
          <input type="text" id="telefono" placeholder="Ej. +52 998 424 2539">
        </div>

        <div class="form-group">
          <label for="curp">CURP:</label>
          <input type="text" id="curp" placeholder="Ej. PEDJ010118HQRRNA5">
        </div>

        <div class="form-group">
          <label for="rfc">RFC:</label>
          <input type="text" id="rfc" placeholder="Ej. PEDJ010118PY7">
        </div>

        <div class="form-group">
          <label for="puesto">Puesto:</label>
          <input type="text" id="puesto" placeholder="Ej. Mesero">
        </div>

        <div class="form-group">
          <label for="salario">Salario:</label>
          <input type="text" id="salario" placeholder="Ej. $10,000 MXN">
        </div>
      </div>

      <div class="right-section">
        <div class="profile-image">
          <img src="img/usuario.png" alt="Foto de perfil">
          <button class="cambiar-button">Cambiar foto de perfil</button>
        </div>


        <div class="stats">
          <div>Vacaciones: 12</div>
          <div>Descansos: 2</div>
        </div>

        <button class="guardar-button">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

    <!-- Modal de cambiar contraseña -->
    <div class="modal" id="passwordModal">
    <div class="password-recovery">
      <h2>Cambiar Contraseña</h2>
      <p>Contraseña anterior</p>
      <div class="form-container">
        <input id="old-password" type="password" placeholder="Contraseña" required />
        <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('old-password')"></i>
      </div>
      <p>Nueva contraseña</p>
      <div class="form-container">
        <input id="new-password" type="password" placeholder="Nueva Contraseña" required />
        <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('new-password')"></i>
      </div>
      <button>Cambiar</button>
      <div class="back">
        <a href="#" onclick="closeModal()">Regresar <i>&#x21B6;</i></a>
      </div>
    </div>
  </div>
</div>


  <script>
     const sidebarApp = Vue.createApp({
    data() {
      return {
        isSidebarOpen: false,
      };
    },
    methods: {
      toggleSidebar() {
        this.isSidebarOpen = !this.isSidebarOpen;
      },
      closeSidebar() {
        this.isSidebarOpen = false;
      },
    },
  }).mount("#app");

  function togglePasswordVisibility(id = "contraseña") {
    var passwordField = document.getElementById(id);
    var passwordFieldType = passwordField.type;
    passwordField.type = passwordFieldType === "password" ? "text" : "password";
    var eyeIcon = document.querySelector(`#${id} ~ .eye-icon i`);
    eyeIcon.classList.toggle("fa-eye");
    eyeIcon.classList.toggle("fa-eye-slash");
  }
  
 


  function openModal() {
    document.getElementById("passwordModal").classList.add("show");
  }

  function closeModal() {
    document.getElementById("passwordModal").classList.remove("show");
  }
  </script>
</body>
</html>
