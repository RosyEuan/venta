<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfil</title>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <!-- Font Awesome para los iconos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Maname&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="/venta/assets/css/style_perfil.css">
</head>

<body>
  <div id="app">
    <!-- Barra lateral -->
    <nav :class="['sidebar', { open: isSidebarOpen }]" id="barra_navegacion" data-url-nav="<?= site_url('iniciar_sesion') ?>">
      <button class="toggle-btn" @click="toggleSidebar">☰</button>
      <div class="logo">
        <img src="img/LogoCytisum.png" alt="Logo" @click="closeSidebar">
      </div>
      <ul>
        <li id="reportes_filtro" data-puesto="1 2">
          <a href="<?= site_url('graficas2') ?>">
            <img src="<?= base_url('img/Barras.png') ?>" alt="Reportes"><span>Reportes</span>
          </a>
        </li>
        <li id="mesas_filtro" data-puesto="1 2 5 6">
          <a href="<?= site_url('mesas') ?>">
            <img src="<?= base_url('img/Mesa.png') ?>" alt="Mesas"><span>Mesas</span>
          </a>
        </li>
        <li id="reservaciones_filtro" data-puesto="1 2 5 6">
          <a href="<?= site_url('reservaciones') ?>">
            <img src="<?= base_url('img/Reservas.png') ?>" alt="Reservaciones"><span>Reservaciones</span>
          </a>
        </li>
        <li id="menu_filtro" data-puesto="1 2 5 6">
          <a href="<?= site_url('menu') ?>">
            <img src="<?= base_url('img/Menus.png') ?>" alt="Menú"><span>Menú</span>
          </a>
        </li>
        <li id="pedidos_filtro" data-puesto="1 2 4">
          <a href="<?= site_url('modal_pedidos') ?>">
            <img src="<?= base_url('img/Pedido.png') ?>" alt="Pedidos"><span>Pedidos</span>
          </a>
        </li>
        <li id="inventario_filtro" data-puesto="1 2 3">
          <a href="<?= site_url('modal_producto') ?>">
            <img src="<?= base_url('img/Inventarios.png') ?>" alt="Inventario"><span>Inventario</span>
          </a>
        </li>
        <li id="personal_filtro" data-puesto="1 2">
          <a href="<?= site_url('personal') ?>">
            <img src="<?= base_url('img/Personales.png') ?>" alt="Personal"><span>Personal</span>
          </a>
        </li>
      </ul>
      <div class="bottom-icons" :class="{ hidden: isSidebarOpen }" id="button_logout"
        data-logout-url="<?= site_url('cerrar_sesion') ?>" data-base-url="<?= site_url('/') ?>">

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
    </nav>

    <!-- Contenido del Perfil -->
    <div class="content">
      <h2 class="content-title">Perfil</h2>
      <div class="profile-container">
        <!-- Sección izquierda: campos en dos columnas -->
        <form class="left-section" method ="GET" id="formulario_datosPerfil"
            data-controller ="<?=site_url('datos_perfil');?>"> <!-- Debe iniciar siempre con data y '-' -->
          <div class="form-group">
            <label for="nombre">Nombre(s):</label>
            <input type="text" id="nombre" name="nombre" placeholder="Ej. Jorge Alejandro" disabled>
          </div>
          <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos"name="apellidos" placeholder="Ej. Pérez Domínguez" disabled>
          </div>
          <div class="form-group">
            <label for="fecha-nacimiento">Fecha de nacimiento:</label>
            <input type="date" id="fecha-nacimiento" name="fecha-nacimiento"class="fecha" disabled>
          </div>
          <div class="form-group">
            <label for="domicilio">Domicilio:</label>
            <input type="text" id="domicilio"name="domicilio" placeholder="Ej. C32 M52 L9" disabled>
          </div>
          <div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario"name="usuario" placeholder="Ej. JorgePerez" disabled>
          </div>

          <!-- Campo de contraseña con el icono de ojito dentro del campo y botón azul al lado -->
          <div class="form-group">
            <label for="contraseña">Contraseña:</label>
            <div class="password-container">
              <input type="password" id="contraseña" placeholder="**********" disabled>
              <span class="eye-icon" onclick="togglePasswordVisibility()">
                <i class="fas fa-eye"></i>
              </span>
            </div>
          </div>
          <div class="form-group">
            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" placeholder="Ej. JorgePD@gmail.com" disabled>
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" placeholder="Ej. +52 998 424 2539" disabled>
          </div>
          <div class="form-group">
            <label for="curp">CURP:</label>
            <input type="text" id="curp" placeholder="Ej. PEDJ010118HQRRNA5" disabled>
          </div>
          <div class="form-group">
            <label for="rfc">RFC:</label>
            <input type="text" id="rfc" placeholder="Ej. PEDJ010118PY7" disabled>
          </div>
          <div class="form-group">
            <label for="puesto">Puesto:</label>
            <input type="text" id="puesto" placeholder="Ej. Mesero" disabled>
          </div>
          <div class="form-group">
            <label for="salario">Salario:</label>
            <input type="text" id="salario" placeholder="Ej. $10,000 MXN" disabled>
          </div>
        </form>

        <div class="right-section">
          <div class="profile-image">
            <img src="img/Empleado.png" alt="Foto de perfil">
          </div>
          <div class="stats">
            <div>Vacaciones: 12</div>
            <div>Descansos: 2</div>
          </div>
          <a href="<?= site_url('user') ?>" style="color: inherit; text-decoration: none;">
            <button class="guardar-button">Editar</button>
          </a>
        </div>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>           
  <script src="/venta/assets/js/funcionLogout.js"></script>
  <script src="/venta/assets/js/filtroBarra.js"></script>
  <script src="/venta/assets/js/Mostrardatosperfil.js"></script>
  <script src="/venta/assets/js/perfil.js"></script>
</body>

</html>