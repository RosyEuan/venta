<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pedidos</title>

  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

  <link href="https://fonts.googleapis.com/css2?family=Maname&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="/venta/assets/css/style_pedidos.css">
</head>

<body>
  <div id="app">
    <!-- Barra lateral-->
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

    <!--contenido -->
    <div class="search-bar">
      <input type="text" placeholder="Buscar pedido por Nombre o Num#" v-model="searchQuery">
      <button><i class="fas fa-search"></i></button>
    </div>

    <div class="content">
      <!-- Registro de pedido -->
      <div class="registro-pedidoss">
        <h2 class="titulo-registro">Registro de Pedido</h2>

        <div class="form-group">
          <div>
            <label for="nombre" class="nombre-cliente">Nombre(s) del cliente</label>
            <input type="text" id="nombre" v-model="nombre" placeholder="Nombre(s)" class="campo-nombre">
          </div>
          <div>
            <label for="apellido" class="apellido-cliente">Apellido(s) del cliente</label>
            <input type="text" id="apellido" v-model="apellido(s)" placeholder="Apellido(s)" class="campo-apellido">
          </div>
        </div>
        <div class="form-group">
          <div>
            <label for="mesa" class="mesa">Mesa</label>
            <input type="number" id="mesa" v-model="mesa" placeholder="Num.Mesa" class="campo-mesa" min="1" max="200">
          </div>
        </div>

        <div class="table-wrapper">
          <table style="width: 100%;">
            <thead>
              <tr>
                <th colspan="2" class="alimentos">Registrar Alimentos</th>
              </tr>
              <tr>
                <th class="col-alimento">Alimento/Bebida</th>
                <th class="alimento">Cantidad</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in items" :key="index" style="cursor: pointer;">
                <!-- <td class="col-alimento">
                  <select v-model="item.food" class="select-alimento editable">
                    <option value="" disabled selected>Seleccionar Alimento/Bebida</option>
                    <option value="Frijolito con puerquito">Frijolito con puerquito</option>
                    <option value="Tacos al pastor">Tacos al pastor</option>
                  </select>
                </td> -->
                <td class="col-alimento">
                  <select v-model="item.food" id="platillo" class="select-alimento editable"
                    data-controller1="<?= site_url('obtener/platillos'); ?>" method="GET">
                    <option value="" disabled selected>Seleccionar Alimento/Bebida</option>
                    <option v-for="platillo in platillos" :key="platillo.id_platillo" :value="platillo.id_platillo">
                      {{ platillo.nombre_platillo }}
                    </option>
                  </select>
                </td>
                <td>
                  <div class="editable" contenteditable="true" v-text="item.quantity"
                    @input="updateRow(index, 'quantity', $event.target.innerText)"></div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <button class="btn">Registrar</button>
      </div>


      <!-- Usuarios -->
      <div class="usuarios-list">
        <div class="usuario" v-for="usuario in usuarios" :key="usuario.id">
          <!-- Encabezado -->
          <div class="usuario-header">
            <h3>{{ usuario.nombre }}</h3>
            <span class="fecha">{{usuario.fecha}}</span>
            <div class="usuario-meta">
              <div class="estado-info">
                <span class="numero">#{{ usuario.numero }}</span>
                <span class="estado">{{ usuario.estado }}</span>
              </div>
              <span class="hora">{{ usuario.hora }}</span>
            </div>
          </div>
          <!-- Detalle del pedido -->
          <div class="usuario-detalle">
            <div class="detalle-item" v-for="detalle in usuario.detalles" :key="detalle.producto">
              <span class="producto">{{ detalle.producto }}</span>
              <span class="cantidad">{{ detalle.cantidad }}</span>
              <span class="precio">{{ detalle.precio | currency }}</span>
            </div>
          </div>
          <!-- Total y botón -->
          <div class="usuario-footer">
            <button @click="openModal">Detalles</button>
            <span class="total">Total: ${{ usuario.total }}</span>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="popup" v-if="isModalOpen">
        <div class="popup-content">
          <button type="submit" class="close-btn" @click="closeModal">X</button>
          <h2 class="popup-title">Registro de Pedido</h2>

          <div class="form-section">
            <div>
              <label for="modal-nombre" class="form-label">Nombre(s) del cliente</label>
              <input type="text" id="modal-nombre" v-model="modalNombre" placeholder="Nombre(s)"
                class="form-input nombre-input">
            </div>
            <div class="mesa-tam">
              <label for="modal-mesa" class="form-label">Mesa</label>
              <input type="text" id="modal-mesa" v-model="modalMesa" placeholder="Num.Mesa"
                class="form-input mesa-input" min="1" max="200">
            </div>
            <div class="apellido-tam">
              <label for="modal-apellido" class="form-label">Apellido(s) del cliente</label>
              <input type="text" id="modal-apellido" v-model="modalApellido" placeholder="Apellido(s)"
                class="form-input apellido-input">
            </div>
          </div>
          <div class="form-section">
            <div>
              <label for="modal-importe" class="form-label">Importe</label>
              <input type="number" id="modal-importe" v-model="modalImporte" placeholder="Importe total"
                class="form-input importe-input" min="0">
            </div>
            <div>
              <label for="modal-cambio" class="form-label">Cambio</label>
              <input type="number" id="modal-cambio" v-model="modalCambio" placeholder="Cambio"
                class="form-input cambio-input" min="0">
            </div>
            <div>
              <label for="modal-metodoPago" class="form-label">Tipo de método a pagar</label>
              <select id="modal-metodoPago" v-model="modalMetodoPago" class="form-input metodo-input">
                <option value="Efectivo">Efectivo</option>
                <option value="Tarjeta">Tarjeta</option>
                <option value="Transferencia">Transferencia</option>
              </select>
            </div>
          </div>

          <div class="button-group">
            <button class="popup-btn">Actualizar datos</button>
            <button class="popup-btn">Completar pedido</button>
          </div>

          <div class="popup-warning">
            <p>Actualizar estos datos modificaría el ticket final.</p>
          </div>

          <div class="table-wrapper2">
            <table class="popup-table" style="width: 100%;">
              <thead>
                <tr>
                  <th colspan="2" class="table-header">Registrar Alimentos</th>
                </tr>
                <tr>
                  <th class="table-column-header">Alimento/Bebida</th>
                  <th class="table-column-header">Cantidad</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in modalItems" :key="index" style="cursor: pointer;">
                  <td class="table-cell">
                    <select v-model="item.food" id="platillo" class="select-table-column-header editable"
                      data-controller1="<?= site_url('obtener/platillos'); ?>" method="GET">
                      <option value="" disabled selected>Seleccionar Alimento/Bebida</option>
                      <option v-for="platillo in platillos" :key="platillo.id_platillo" :value="platillo.id_platillo">
                        {{ platillo.nombre_platillo }}
                      </option>
                    </select>
                  </td>
                  <!-- <td class="col-alimento">
                <select v-model="item.food" id="platillo" class="select-alimento editable"
                  data-controller1="<?= site_url('obtener/platillos'); ?>" method="GET">
                  <option value="" disabled selected>Seleccionar Alimento/Bebida</option>
                  <option v-for="platillo in platillos" :key="platillo.id_platillo" :value="platillo.id_platillo">
                    {{ platillo.nombre_platillo }}
                  </option>
                </select>
              </td> -->
                  <td class="table-cell">
                    <div class="editable-cell" contenteditable="true" v-text="item.quantity"
                      @input="updateModalRow(index, 'quantity', $event.target.innerText)"></div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- <table class="popup-table">
            <thead>
              <tr>
                <th colspan="2" class="table-header">Registrar Alimentos</th>
              </tr>
              <tr>
                <th class="table-column-header">Alimento/Bebida</th>
                <th class="table-column-header">Cantidad</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in modalItems" :key="index">
                <td class="table-cell">
                  <div class="editable-cell" contenteditable="true" v-text="item.food"
                    @input="item.food = $event.target.innerText"></div>
                </td>
                <td class="table-cell">
                  <div class="editable-cell" contenteditable="true" v-text="item.quantity"
                    @input="item.quantity = $event.target.innerText"></div>
                </td>
              </tr>
            </tbody>
          </table> -->
          <div class="modal-footer">
            <button type="button" class="boton_cerrar btn btn-secondary" @click="closeModal">Cerrar</button>
          </div>
        </div>


      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="/venta/assets/js/funcionLogout.js"></script>
    <script src="/venta/assets/js/filtroBarra.js"></script>

    <script src="/venta/assets/js/modal_pedidos.js"></script>

</body>


</html>