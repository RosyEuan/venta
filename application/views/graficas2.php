<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reportes</title>

  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <link href="https://fonts.googleapis.com/css2?family=Khmer&family=Konkhmer+Sleokchher&family=Suez+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="/venta/assets/css/style_graficas.css">

</head>

<body>
  <div id="app">
    <!-- Barra Lateral -->
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

  </div>

  <div class="content">
    <div class="reportes-container">
      <div class="header">
        <select>
          <option>Filtrar por...</option>
          <option>Ventas del dia</option>
          <option>Venta semanal</option>
          <option>Ventas Generales</option>
        </select>
      </div>
      <div id="user-list">
        <div class="charts">
          <div class="chart ventas-dia">
            <canvas id="ventasDiarias"></canvas>
            <div class="legend">
              <span>🟡 Platillos</span>
              <span>🔵 Bebidas</span>
              <span>🟢 Alcohol</span>
              <span>🔴 Postres</span>
            </div>
          </div>
          <!-- Venta Semanal -->
          <div class="chart venta-semanal">
            <canvas id="ventasSemanales"></canvas>
            <div class="legend">
              <span class="center">Ventas Semanales:</span>
              <span style="">🟡 Platillos</span>
              <span style="">🔵 Bebidas</span>
              <span style="">🟢 Alcohol</span>
              <span style="">🔴 Postres</span>
            </div>
          </div>
          <div class="chart ventas-anuales">
            <canvas id="ventasAnuales"></canvas>
          </div>
          <div class="chart estadisticas">
            <div class="stat-item nivel-1">
              <span class="box"></span>
              <h3>Diario</h3>
              <p>$68,434</p>
              <span class="growth">↑ 10%</span>
            </div>
            <div class="stat-item nivel-2">
              <span class="box"></span>
              <h3>Mensual</h3>
              <p>$2,053,020</p>
              <span class="growth">↑ 10%</span>
            </div>
            <div class="stat-item nivel-3">
              <span class="box"></span>
              <h3>Anual</h3>
              <p>$24,636,240</p>
              <span class="growth">↑ 10%</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="/venta/assets/js/graficas.js"></script>
  <script src="/venta/assets/js/filtroBarra.js"></script>
  <script src="/venta/assets/js/funcionLogout.js"></script>
</body>

</html>