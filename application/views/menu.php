<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú</title>

  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="/venta/assets/css/style_menu.css">

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
          <button @click="openAddModal" class="add-btn">Agregar</button>
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
                <button class="edit-btn" @click="openEditModal(item)">Editar</button>
                <button class="delete-btn" @click="deleteItem(item.id)">Eliminar</button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Modal para Agregar Platillo -->
    <div v-if="showModal" class="modal-overlay" @click="showModal = false">
      <div class="modal-container" @click.stop>
        <button type="button" class="close-btn" @click="closeModal">X</button>
        <h2 class="title">{{ isEditing ? 'Editar Menú' : 'Agregar al menú' }}</h2>
        <!-- Nombre -->
        <div class="form-group" style="grid-column: span 2;">
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" v-model="nombre">
        </div>

        <!-- Categoría y Precio (en la misma fila) -->
        <div class="form-group-row" style="grid-column: span 2;">
          <div class="form-group">
            <label for="categoria">Categoría:</label>
            <select id="categoria" v-model="categoria">
              <option value="">Seleccionar</option>
              <option value="Platillos">Platillos</option>
              <option value="Bebidas">Bebidas</option>
              <option value="Postres">Postres</option>
            </select>
          </div>
          <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" id="precio" v-model="precio" @input="calcularPrecioConDescuento">
          </div>
        </div>

        <!-- Descuento y Precio con descuento (en la misma fila) -->
        <div class="form-group-row" style="grid-column: span 2;">
          <div class="form-group">
            <label for="descuento">Descuento:</label>
            <input type="number" id="descuento" v-model="descuento" @input="calcularPrecioConDescuento">
          </div>
          <div class="form-group">
            <label for="precio-descuento">Precio con descuento:</label>
            <input type="number" id="precio-descuento" :value="precioConDescuento" readonly>
          </div>
        </div>

        <!-- Imagen -->
        <div class="form-group" style="grid-column: 3; display: flex; justify-content: center; align-items: center;">
          <label for="imageUpload" class="image-label">Imagen:</label>
          <div class="image-upload">
            <div id="imageBox" class="image-box"></div>
          </div>
        </div>

        <!-- Descripción -->
        <div class="form-group" style="grid-column: span 2;">
          <label for="descripcion" class="descue">Descripción:</label>
          <textarea id="descripcion" rows="4" v-model="descripcion"></textarea>
        </div>
        <!-- Botón Guardar -->
        <div style="grid-column: span 3; ">
          <button class="btn-cambios" @click="saveChanges">Guardar Cambios</button>
        </div>
        <button class="btn_cerrar" type="button" @click="closeModal">Cancelar</button>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="/venta/assets/js/menu.js"></script>
  <script src="/venta/assets/js/filtroBarra.js"></script>
  <script src="/venta/assets/js/funcionLogout.js"></script>

</body>

</html>