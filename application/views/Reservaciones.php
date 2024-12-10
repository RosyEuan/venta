<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservaciones</title>

  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>


  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">

  <link rel="stylesheet" href="/venta/assets/css/style_reservas.css">
</head>

<body>
  <div id="container">
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
      <div class="bottom-icons" :class="{ hidden: isSidebarOpen }">

        <a href="<?= site_url('perfil') ?>">
          <img src="img/Admin.png" alt="Usuario">
        </a>
        <img src="img/Logout.png" alt="Salir" id="button_logout"
          data-logout-url="<?= site_url('cerrar_sesion') ?>" data-base-url="<?= site_url('/') ?>">
      </div>
      <div class="admin-info" :class="{ hidden: !isSidebarOpen }">
        <a href="<?= site_url('perfil') ?>">
          <img src="<?= base_url('img/Admin.png') ?>" alt="Usuario">
        </a>
        <span>Hola! <?php echo $this->session->userdata('usuario'); ?><br><?php echo $this->session->userdata('puesto'); ?></span>
      </div>
    </nav>

    <!--contenido principañ -->
    <div class="contenido">
      <div class="sep"></div>
      <div id="calendar"></div>
      <!-- <div id="user-list">
  <div id="search-bar">
    <input type="text" placeholder="Buscar cliente" class="search-bar">
    <button>
      <i class="fas fa-search"></i>
    </button>
  </div>
  <!-- Lista de usuarios
  <div v-for="(usuario, index) in usuarios" :key="index" class="user-card">
    <div>
      <h4 class="nombre">{{ usuario.cliente }}</h4>
      <p class="nomm">Invitados: {{ usuario.cantidad }} | Mesa: {{ usuario.mesa }}</p>
      <p class="nomm">Hora: {{ usuario.hora }} | Fecha: {{ usuario.fecha }}</p>
    </div>
    <div class="action-buttons">
      <button class="edit-button" @click="openModal(usuario.cliente, usuario.mesa, usuario.hora, usuario.fecha)">Modificar</button>
      <button class="delete-button" @click="eliminarUsuario(index)">Eliminar</button>
    </div>
  </div>
</div> -->

      <div id="user-list">
        <div id="search-bar">
          <input type="text" placeholder="Buscar cliente" class="search-bar">
          <button>
            <i class="fas fa-search"></i>
          </button>
        </div>
        <!-- Lista de usuarios  -->
        <div id="lista-usuarios">
          <div class="user-card">
            <div>
              <h4 class="nombre">Rosy Euan</h4>
              <p class="nomm">Invitados: 3 | Mesa: B3</p>
              <p class="nomm">Hora: 6:15 PM | Fecha: 19/Dic/2024</p>
            </div>
            <div class="action-buttons">
              <button class="edit-button"
                onclick="openModal('Rosy Euan', 'B3', '6:15 PM', '19/Dic/2024')">Modificar</button>
              <button class="delete-button" onclick="eliminarUsuario(1)">Eliminar</button>
            </div>
          </div>
          <div class="user-card">
            <div>
              <h4 class="nombre">Salem Ojeda</h4>
              <p class="nomm">Invitados: 2 | Mesa: D4</p>
              <p class="nomm">Hora: 6:30 PM | Fecha: 2/Dic/2024</p>
            </div>
            <div class="action-buttons">
              <button class="edit-button"
                onclick="openModal('Salem Ojeda', 'D4', '6:30 PM', '2/Dic/2024')">Modificar</button>
              <button class="delete-button" onclick="eliminarUsuario(2)">Eliminar</button>
            </div>
          </div>
          <div class="user-card">
            <div>
              <h4 class="nombre">Shaiel Saucedo</h4>
              <p class="nomm">Invitados: 8 | Mesa: E1</p>
              <p class="nomm">Hora: 6:35 PM | Fecha: 1/Ene/2025</p>
            </div>
            <div class="action-buttons">
              <button class="edit-button"
                onclick="openModal('Shaiel Saucedo', 'E1', '6:35 PM', '1/Ene/2025')">Modificar</button>
              <button class="delete-button" onclick="eliminarUsuario(3)">Eliminar</button>
            </div>
          </div>
          <div class="user-card">
            <div>
              <h4 class="nombre">Dania Botello</h4>
              <p class="nomm">Invitados: 4 | Mesa: B2</p>
              <p class="nomm">Hora: 7:00 PM | Fecha: 6/Ene/2025</p>
            </div>
            <div class="action-buttons">
              <button class="edit-button"
                onclick="openModal('Dania Botello', 'B2', '7:00 PM', '6/Ene/2025')">Modificar</button>
              <button class="delete-button" onclick="eliminarUsuario(4)">Eliminar</button>
            </div>
          </div>
          <div class="user-card">
            <div>
              <h4 class="nombre">Angel Chi</h4>
              <p class="nomm">Invitados: 4 | Mesa: Pendiente</p>
              <p class="nomm">Hora: 7:30 PM | Fecha: 30/Ene/2025</p>
            </div>
            <div class="action-buttons">
              <button class="edit-button"
                onclick="openModal('Angel Chi', 'Pendiente', '7:30 PM', '30/Ene/2025')">Modificar</button>
              <button class="delete-button" onclick="eliminarUsuario(5)">Eliminar</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  </div>

  <!-- Modal de Reservación -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <div id="reservacion" class="form-container">
        <button type="submit" class="close-btn" @click="cancelar">X</button>
        <h2 class="til">Agregar Reservación</h2>
        <div class="form-row">
          <div class="form-column">
            <div class="form-group">
              <label for="cliente">Cliente:</label>
              <input type="text" id="cliente" v-model="form.cliente">
            </div>
            <div class="form-group">
              <label for="telefono">Teléfono:</label>
              <input type="text" id="telefono" v-model="form.telefono">
            </div>
            <div class="form-group">
              <label for="fecha">Fecha y hora:</label>
              <input type="datetime-local" id="fecha" v-model="form.fecha">
            </div>
          </div>
          <div class="form-column">
            <div class="form-group">
              <label for="mesa">Mesa asignada:</label>
              <input type="text" id="mesa" v-model="form.mesa">
            </div>
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="email" id="email" v-model="form.email">
            </div>
            <div class="form-group">
              <label for="cantidad">Cantidad de personas:</label>
              <input type="number" id="cantidad" v-model="form.cantidad">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="comentarios">Comentarios:</label>
          <textarea id="comentarios" v-model="form.comentarios"></textarea>
        </div>
        <div class="buttons">
          <button class="btn_reservar" @click="reservar">Reservar</button>
          <button class="btn_cancelar" @click="cancelar">Cancelar</button>
          <button class="btn_guardar" @click="guardarCambios">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>

  <!-- FullCalendar JS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="/venta/assets/js/funcionLogout.js"></script>
  <script src="/venta/assets/js/filtroBarra.js"></script>

  <script src="/venta/assets/js/Reservaciones.js"></script>
</body>

</html>