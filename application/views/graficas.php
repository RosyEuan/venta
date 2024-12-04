<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Punto de Venta</title>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      overflow-x: hidden;
    }

    /* Barra lateral */
    .sidebar {
      width: 60px;
      height: 100vh;
      background-color: #2A236A;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      transition: width 0.3s;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    .sidebar.open {
      width: 250px;
    }
    .toggle-btn {
      margin: 10px;
      font-size: 24px;
      cursor: pointer;
      background: none;
      border: none;
      outline: none;
      color: white;
    }
    .logo {
      display: none;
      margin: 10px;
      width: 100%;
      text-align: center;
    }
    .sidebar.open .toggle-btn {
      display: none;
    }
    .sidebar.open .logo {
      display: block;
    }
    .logo img {
      max-width: 170px;
      cursor: pointer;
      padding-top: 50px;
    }

    /* Estilos de la lista de navegación */
    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      width: 100%;
    }
    .sidebar ul li {
      width: 100%;
      display: flex;
      align-items: center;
      padding: 15px 10px;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }
    .sidebar ul li:hover {
      background-color: rgba(81, 92, 100, 0.4);
    }
    .sidebar ul li img {
      width: 30px;
      height: 30px;
      margin-right: 10px;
    }
    .sidebar ul li span {
      font-size: 14px;
      color: white;
      display: none;
    }
    .sidebar.open ul li span {
      display: inline-block;
    }
    .admin-info {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      padding: 20px;
      width: 100%;
      border-top: 0 solid #ddd;
      opacity: 0;
      transition: opacity 0.3s;
    }
    .sidebar.open .admin-info {
      opacity: 1;
    }
    .admin-info img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 10px;
    }
    .admin-info span {
      font-size: 14px;
      color: white;
      display: none;
    }
    .sidebar.open .admin-info span {
      display: block;
    }
    .bottom-icons {
      margin-bottom: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
    }
    .bottom-icons img {
      width: 30px;
      height: 30px;
      margin: 10px 0;
    }
    .bottom-icons.hidden {
      display: none;
    }

    /* Contenido principal */
    .content {
      margin-left: 60px;
      padding: 20px;
      flex: 1;
      transition: margin-left 0.3s;
    }
    .sidebar.open ~ .content {
      margin-left: 250px;
    }

    /* Gráficas */
    .reportes-container {
      background-color: rgba(179, 179, 179, 1);
      display: flex;
      flex-direction: column;
      gap: 20px;
      padding: 20px;
      background-color: #f8f8f8;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .header select {
      padding: 10px;
      font-size: 16px;
    }
    .search {
      display: flex;
      align-items: center;
    }
    .search input {
      padding: 8px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px 0 0 4px;
      outline: none;
    }
    .search button {
      padding: 8px;
      font-size: 16px;
      background-color: #ccc;
      border: 1px solid #ccc;
      border-radius: 0 4px 4px 0;
      cursor: pointer;
    }
    .charts {
      display: grid;
      grid-template-columns: 1fr 1fr; /* Ajustado el número de columnas */
      grid-template-rows: auto auto;
      gap: 20px;
      padding-left: 5%;
      justify-content: center;
      margin-bottom: 30px;
    }
    .chart {
      background-color: white;
      padding: 15px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      align-items: center;
    }
    canvas {
      width: 90% !important; /* Ajusta el ancho al 100% */
    }
    .chart.ventas-anuales canvas {
      height: 330px !important; /* Aumentamos la altura de la gráfica de abajo */
      width: 100% !important;  /* Aumentamos un poco el ancho de la gráfica de abajo */
    }
    .chart.ventas-anuales{
      width:100%;
      height: 100%;
    }
    .chart.ventas-dia canvas,
    .chart.venta-semanal canvas {
      height: 250px !important; /* Ajustamos la altura para las gráficas de arriba */
      width: 100% !important; /* Aseguramos que el ancho sea 100% */
    }

    /* Ajustes para la gráfica de pastel */
    .chart.venta-semanal canvas {
      max-width: 300px !important; /* Establecemos un ancho fijo para la gráfica de pastel */
      height: 300px !important;    /* Altura fija para la gráfica de pastel */
      margin: 0 auto;             /* Centrado de la gráfica */
    }
    .legend {
      display: flex;
      justify-content: space-around;
      width: 100%;
      margin-top: 10px;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div id="app">
      <!-- Barra Lateral -->
      <div :class="['sidebar', { open: isSidebarOpen }]">
      <button class="toggle-btn" @click="toggleSidebar">☰</button>
      <div class="logo">
        <img src="img/LogoCytisum.png" alt="Logo" @click="closeSidebar">
      </div>
      <ul>
        <li>
          <a href="<?=site_url('graficas') ?>">
            <img src="<?=base_url('img/Barras.png') ?>" alt="Reportes"><span>Reportes</span>
          </a>
        </li>
        <li>
          <a href="<?=site_url('mesas') ?>">
            <img src="<?= base_url('img/Mesa.png') ?>" alt="Mesas"><span>Mesas</span>
          </a>  
        </li>
        <li>
          <a href="<?=site_url('reservaciones') ?>">
            <img src="<?=base_url('img/Reservas.png') ?>" alt="Reservaciones"><span>Reservaciones</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('menu') ?>">
            <img src="<?= base_url('img/Menus.png') ?>" alt="Menú"><span>Menú</span>
          </a>
        </li>
        <li>
          <a href="<?=site_url('pedidos') ?>">
            <img src="<?= base_url('img/Pedido.png') ?>" alt="Pedidos"><span>Pedidos</span>
          </a>
        </li>
        <li>
          <a href="<?=site_url('modal_producto') ?>">
            <img src="<?=base_url('img/Inventarios.png') ?>" alt="Inventario"><span>Inventario</span>
          </a>
        </li>
        <li>
          <a href="<?=site_url('personal') ?>">
            <img src="<?=base_url('img/Personales.png') ?>" alt="Personal"><span>Personal</span>
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

      <!-- Contenido de Reportes -->
    <div class="content">
      <div class="reportes-container">
        <div class="header">
          <select>
            <option>Ver reportes de...</option>
            <option>Ventas del dia</option>
            <option>Venta semanal</option>
            <option>Ventas Generales</option>
          </select>
          <div class="search">
            <input type="text" placeholder="Buscar">
            <button>🔍</button>
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
    new Chart(ventasAnualesCtx, {
      type: "line",
      data: {
        labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
        datasets: [{
          label: "Ventas Generales-Anual",
          data: [25, 36, 65, 53, 65, 45, 74, 74, 56, 73, 85, 100],
          borderColor: "#000",
          fill: false,
        }],
      },
    });
  </script>
</body>
</html>