<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barra lateral dinámica</title>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/venta/style_menu.css">


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
      <div class="menus-container">
        <h1>Menú</h1>
        <div class="search-bar">
          <input type="text" placeholder="Buscar en el menú" v-model="search" />
          <div class="filters">
            <button :class="{ active: filter === 'all' }" @click="setFilter('all')">Todo</button>
            <button :class="{ active: filter === 'platillos' }" @click="setFilter('platillos')">Platillos</button>
            <button :class="{ active: filter === 'bebidas' }" @click="setFilter('bebidas')">Bebidas</button>
            <button :class="{ active: filter === 'postres' }" @click="setFilter('postres')">Postres</button>
          </div>
          <button class="add-btn">Agregar</button>
        </div>
        <div id="user-list">
          <div class="menu-container">
            <div class="menu-item" v-for="item in filteredMenu" :key="item.id">
              <img :src="item.image" alt="Imagen del platillo" class="menu-img" />
              <div class="menu-info">
                <div class="menu-header">
                  <h3 class="menu-title">{{ item.name }}</h3>
                  <span class="menu-price">${{ item.price }}</span>
                </div>
                <p class="menu-description">{{ item.description }}</p>
              </div>
              <div class="menu-actions">
                <button class="edit-btn" @click="editItem(item.id)">Editar</button>
                <button class="delete-btn" @click="deleteItem(item.id)">Eliminar</button>
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
          menuItems: [
            { id: 1, name: 'Tacos al pastor', price: 30.00, description: 'Tortillas de maíz con carne de cerdo marinada en adobo, acompañados de piña fresca, cebolla y cilantro. Servidos con salsa verde o roja.', image: 'img/platillo1.png', category: 'postres' },
            { id: 2, name: 'Tacos de asada', price: 20.00, description: 'Tortillas de maíz con carne asada de res, marinada en especias y a la parrilla. Acompañados de cebolla, cilantro y salsa al gusto.', image: 'img/platillo2.png', category: 'bebidas' },
            { id: 3, name: 'Mole de olla', price: 176.00, description: 'Tradicional sopa mexicana con carne de res, chayote, zanahorias y elote en un caldo rojo condimentado con chile y especias.', image: 'img/platillo3.png', category: 'platillos' },
            { id: 4, name: 'Relleno negro', price: 250.00, description: 'Tortillas de maíz con carne de cerdo marinada en adobo, acompañados de piña fresca, cebolla y cilantro. Servidos con salsa verde o roja', image: 'img/platillo4.png', category: 'platillos' },
            { id: 5, name: 'Omelette a la mexicana', price: 200.00, description: 'Huevos con jitomate, cebolla y chile serrano. Ideal para el desayuno, servido con frijoles refritos y tortillas.', image: 'img/platillo5.png', category: 'platillos' }
          ]
        };
      },
      computed: {
        filteredMenu() {
          const filteredBySearch = this.menuItems.filter(item =>
            item.name.toLowerCase().includes(this.search.toLowerCase())
          );
          if (this.filter === 'all') return filteredBySearch;
          return filteredBySearch.filter(item => item.category === this.filter);
        }
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
          this.menuItems = this.menuItems.filter(item => item.id !== id);
        }
      }
    }).mount('#app');
  </script>
  
</body>
</html>