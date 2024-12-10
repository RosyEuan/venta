<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mesas</title>

  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="/venta/assets/css/style_mesa.css">
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

    <!-- Contenido de las mesas -->
    <div class="content">
      <div class="mesa-container">
        <div class="mesa-bar">
          <div>
            <span>Seleccione una mesa</span>
          </div>
          <div>
            <div>
              <span class="status">🔵 Reservada</span>
            </div>
            <div>
              <span class="status">🟠 En Uso</span>
            </div>
          </div>
        </div>
        <div class="mesa-grid">
          <div v-for="(mesa, index) in mesas" :key="index">
            <div :class="['mesa', mesa.status, { seleccionada: selectedMesa === index }]" @click="selectMesa(index)">
              <img :src="mesa.img" alt="Mesa" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal de Formulario de Reservacion -->
    <div v-if="showModal" class="modal-overlay" @click.self="closeModal">
      <div class="modal">
        <button type="submit" class="close-btn" @click="closeModal">X</button>
        <h2 class="titulo_modal">Formulario de Reservación</h2>
        <form @submit.prevent="submitForm" class="formulario">
          <div class="form-row">
            <div class="form-column">
              <div class="form-group">
                <label for="cliente">Cliente:</label>
                <input type="text" v-model="formData.cliente" required>
              </div>
              <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" v-model="formData.telefono" required>
              </div>
              <div class="form-group">
                <label for="fechaHora">Fecha y Hora:</label>
                <input type="datetime-local" v-model="formData.fechaHora" required>
              </div>
            </div>
            <div class="form-column">
              <div class="form-group">
                <label for="mesa">Mesa asignada:</label>
                <input type="text" v-model="formData.mesa" :value="formData.mesa" disabled>
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" v-model="formData.email" required>
              </div>
              <div class="form-group">
                <label for="personas">Cantidad de personas:</label>
                <input type="number" v-model="formData.personas" min="1" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="comentario">Comentario:</label>
            <textarea v-model="formData.comentario" rows="3"></textarea>
          </div>
          <div class="buttons">
            <button class="btn_reservar">Reservar</button>
            <button class="btn_cerrar" @click="closeModal">Cancelar</button>
            <button class="btn_guardar">Guardar Cambios</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="/venta/assets/js/funcionLogout.js"></script>
  <script src="/venta/assets/js/filtroBarra.js"></script>
  <script src="/venta/assets/js/mesas.js"></script>


</body>

</html>