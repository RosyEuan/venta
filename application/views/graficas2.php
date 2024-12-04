<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barra Lateral y Gráficas</title>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Khmer&family=Konkhmer+Sleokchher&family=Suez+One&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="/venta/style_graficas.css">
</head>

<body>
  <div id="app">
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
        <img src="img/Admin.png" alt="Usuario">
        <img src="img/Logout.png" alt="Salir">
      </div>
      <div class="admin-info" :class="{ hidden: !isSidebarOpen }">
        <img src="img/Admin.png" alt="Usuario">
        <span>Angel Chi<br>Administrador</span>
      </div>
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
          <div class="search-bar">
            <input type="text" placeholder="Buscar" v-model="searchQuery">
            <button><i class="fas fa-search"></i></button>
          </div>
        </div>
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


  <script>
    const { createApp } = Vue;

    createApp({
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

    // Ventas Diarias
    const ventasDiariasCtx = document.getElementById("ventasDiarias").getContext("2d");
    new Chart(ventasDiariasCtx, {
      type: "bar",
      data: {
        labels: ["🟡Platillos", "🔵Bebidas", "🟢Alcohol", "🔴Postres"],
        datasets: [{
          label: "Ventas del Día",
          data: [50, 75, 80, 78, 100],
          backgroundColor: ["#EEE651", "#322A7F", "#77C97A", "#D64040"],
        }],
      },
    });

    // Ventas Semanales
    const ventasSemanalesCtx = document.getElementById("ventasSemanales").getContext("2d");
    new Chart(ventasSemanalesCtx, {
      type: "pie",
      data: {
        labels: ["Platillos", "Bebidas", "Alcohol", "Postres"],
        datasets: [{
          data: [20, 25, 15, 40],
          backgroundColor: ["#4B51B8", "#E8EC07", "#D64040", "#77C97A"],
        }],
      },
    });

    // Ventas Anuales
    const ventasAnualesCtx = document.getElementById("ventasAnuales").getContext("2d");
    // Crear el gradiente
    const gradient = ventasAnualesCtx.createLinearGradient(0, 0, 0, 400); // De arriba a abajo (puedes ajustar las coordenadas)
    gradient.addColorStop(0, "rgba(139, 146, 241, 0.40)");  // Color inicial
    gradient.addColorStop(0.7, "rgba(119, 126, 232, 0.40)");  // Color intermedio
    gradient.addColorStop(0.91, "rgba(128, 136, 251, 0.40)"); // Otro color intermedio
    gradient.addColorStop(1, "rgba(129, 138, 255, 0.40)");  // Color final

    new Chart(ventasAnualesCtx, {
      type: "line",
      data: {
        labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        datasets: [{
          label: "Ventas Generales-Anual",
          data: [25, 36, 65, 53, 65, 45, 74, 74, 56, 73, 85, 100],
          borderColor: "#4B51B8",
          backgroundColor: gradient,
          fill: true,
        }],
      },
    });
  </script>
</body>

</html>