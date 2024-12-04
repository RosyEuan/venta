<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barra lateral dinámica</title>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    body {
    margin: 0;
    padding: 0;
    background-color: #090526;
    display: flex;
    font-family: 'Merriweather';
    overflow: hidden;
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

/* Botón de toggle */
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
    padding-top:50px;
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
/* Información del administrador */
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

/* Íconos de usuario y salir */
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
    overflow-y: hidden;
}
.sidebar.open ~ .content {
    margin-left: 250px;
}
h1 {
    font-family: "Lucida Bright", serif;
    font-size: 40px;
    color: white;
    text-align: center;
    margin-top: 0;
}
.employees-container{
    display: flex;
    flex-direction: column;
    padding: 20px;
    gap: 8px;
    max-width: 100%;
}
.employee-container{
    display: flex;
    flex-direction: column;
    padding: 20px;
    gap: 8px;
}

/* Buscador y filtros */
.search-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
    margin-left: 2%;
    width: 96%;
}
.search-bar input {
    font-family: "Lucida Bright", serif;
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
}
.filters {
    display: flex;
    gap: 10px;
}
.filters button {
    font-family: "Lucida Bright", serif;
    padding: 8px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    cursor: pointer;
    background-color: #f7f7f7;
    transition: 0.3s;
    color: black;
}
.filters button.active {
    background-color: #27AE60;
    color: white;
    border-color: #27AE60;
}
.filters button:hover {
    background-color: #ecf0f1;
    color: black;
}
.add-btn {
    font-family: "Lucida Bright", serif;
    background-color: rgba(220, 115, 10, 0.80);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
}
.add-btn:hover {
    background-color: #BB6106;
}

/* Menú */
.employee-item {
    display: flex;
    align-items: center;
    padding: 15px;
    font-size: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    gap: 100px;
    width: calc(100% - 30px); /* Añadimos márgenes si es necesario */
    margin: 0 auto; /* Centra los elementos si hay espacio extra */
}
.employee-img {
    width: 102px;
    height: 102px;
    object-fit: cover;
    border-radius: 8px;
}
.employee-info {
    flex: 1;
}
.employee-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 5px;
}
.employee-title {
    font-family: "Lucida Bright", serif;
    font-size: 26px;
    font-weight: bold;
    color: #333;
    margin: 0;
}
.employee-price {
    font-family: "Lucida Bright", serif;
    font-size: 20px;
    font-weight: bold;
    color: black;
}
.employee-description {
    font-family: "Maname";
    font-size: 18px;
    color: #666;
}
.employee-actions {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.employee-actions button {
    font-family: "Lucida Bright", serif;
    margin: 4px;
    padding: 8px 16px;
    font-size: 14px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
}
.edit-btn {
    background-color: #27AE60;
    color: white;
}
.edit-btn:hover {
    background-color: #1E8449;
}
.delete-btn {
    background-color: #DC730A;
    color: white;
}
.delete-btn:hover {
    background-color: #C0392B;
}
#user-list {
    width: 100%; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 0%; 
    height: 688px; 
    overflow-y: auto;
    scrollbar-width: none;
}
#user-list::-webkit-scrollbar{
  display: none;
}
  </style>

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
          <a href="<?=site_url('graficas2') ?>">
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
    
    <!-- Contenido principal -->
    <div class="content">
      <div class="employees-container">
        <h1>Personal</h1>
        <div class="search-bar">
          <input type="text" placeholder="Buscar empleado" v-model="search" />
          <div class="filters">
            <button :class="{ active: filter === 'all' }" @click="setFilter('all')">Todo</button>
            <button :class="{ active: filter === 'platillos' }" @click="setFilter('platillos')">Platillos</button>
          </div>
          <button class="add-btn">Agregar</button>
        </div>
        <div id="user-list">
          <div class="employee-container">
            <div class="employee-item" v-for="employee in filteredEmployees" :key="employee.id">
              <img :src="employee.image" alt="Imagen del platillo" class="menu-img" />
                <span class="employee-name">{{ employee.name }}</span>
                <span class="employee-position">{{ employee.position }}</span>
                <span class="employee-status" :class="{ active: employee.status == 'Activo' }">{{ employee.status }}</span>
                <span class="employee-salary">${{ employee.salary }}</span>

              <div class="employee-actions">
                <button class="edit-btn" @click="editItem(employee.id)">Editar</button>
                <button class="delete-btn" @click="deleteItem(employee.id)">Eliminar</button>
              </div>
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
          
          search: '',
          filter: 'all',
          Employees: [
            { id: 1, name: 'Sofía Ramírez', position: 'Supervisor', status: 'Activo', salary: 1800, image: 'img/Empleado.png'},
            { id: 2, name: 'Sofía Ramírez', position: 'Supervisor', status: 'Activo', salary: 1800, image: 'img/Empleado.png'},
            { id: 3, name: 'Sofía Ramírez', position: 'Supervisor', status: 'Activo', salary: 1800, image: 'img/Empleado.png'},
            { id: 4, name: 'Sofía Ramírez', position: 'Supervisor', status: 'Activo', salary: 1800, image: 'img/Empleado.png'},
            { id: 5, name: 'Sofía Ramírez', position: 'Supervisor', status: 'Activo', salary: 1800, image: 'img/Empleado.png'},
          ]
        };
      },
      computed: {
        filteredEmployees() {
          return this.Employees.filter(employee =>
            employee.name.toLowerCase().includes(this.search.toLowerCase())
          );
        },
      },
      methods: {
        toggleSidebar() {
          this.isSidebarOpen = !this.isSidebarOpen;
        },
        closeSidebar() {
          this.isSidebarOpen = false;
        },
        setFilter(filter) {
          this.filter = filter;
        },
        editItem(id) {
          alert(`Editar platillo con ID: ${id}`);
        },
        deleteItem(id) {
          this.Employees = this.Employees.filter(employee => employee.id !== id);
        }
      }
    }).mount('#app');
  </script>
  
</body>
</html>