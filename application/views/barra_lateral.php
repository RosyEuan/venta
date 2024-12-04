<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Punto de Venta</title>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      font-family: 'Merriweather';
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
      width: 92%;
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

    .sidebar.open~.content {
      margin-left: 250px;
    }
  </style>
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
          <a href="#">
            <img src="img/Barras.png" alt="Reportes"><span>Reportes</span>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/Mesa.png" alt="Mesas"><span>Mesas</span>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/Reservas.png" alt="Reservaciones"><span>Reservaciones</span>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/Menus.png" alt="Menú"><span>Menú</span>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/Pedido.png" alt="Pedidos"><span>Pedidos</span>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/Inventarios.png" alt="Inventario"><span>Inventario</span>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/Personales.png" alt="Personal"><span>Personal</span>
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

  </script>



</body>

</html>