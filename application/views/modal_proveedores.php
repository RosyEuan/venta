<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario Proveedores</title>

  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

  <link href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/venta/assets/css/style_proveedores.css">
</head>

<body>
  <div id="inventario_proveedores">
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

    <!-- Contenido del Inventario de Proveedores -->
    <div class="content">
      <div id="inventario_proveedores" class="Product">
        <h2 class="titu">Inventario de Proveedores</h2>
        <div class="header">
          <div class="header-buttons">
            <a href="<?= site_url('modal_producto') ?>">
              <button class="inactivo">Ingredientes</button>
            </a>
            <a href="<?= site_url('modal_utilidad') ?>">
              <button class="inactivo">Utilidades</button>
            </a>
            <a href="<?= site_url('modal_proveedores') ?>">
              <button class="activo">Proveedores</button>
            </a>
          </div>
          <div class="search-bar">
            <input type="text" placeholder="Buscar" v-model="searchQuery">
            <button><i class="fas fa-search"></i></button>
          </div>
        </div>
        <div class="table-container">
          <!-- Encabezado -->
          <div class="table-header">
            <table>
              <thead>
                <tr class="columna">
                  <th>ID</th>
                  <th>Nombre</th>
                  <th>Telefono</th>
                  <th>Correo</th>
                  <th>Acciones</th>
                </tr>
              </thead>
            </table>
          </div>

          <!-- Cuerpo -->
          <div id="proveedores" class="table-body" data-controller="<?= site_url('obtener/proveedores'); ?>" method="GET"
            data-controller4="<?= site_url('eliminar/proveedores'); ?>">
            <table>
              <tbody>
                <tr v-for="item in filteredProducts" :key="item.id" :class="{'fila-baja-cantidad': parseInt(item.cantidad) <= 20}"class="itemss">
                  <td>{{ item.id }}</td>
                  <td>{{ item.nombre }}</td>
                  <td>{{ item.telefono}}</td>
                  <td>{{ item.correo }}</td>
                  <td class="actions">
                    <button class="editar-btn" @click="editProveedor(item)"><i class="fas fa-pencil-alt"></i>Editar</button>
                    <button class="eliminar-btn" @click="deleteProveedor(item.id)"><i class="fas fa-trash"></i>Eliminar</button>

                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="bottom-buttons">
          <button type="submit" class="btn-submit" @click="openModal()">Agregar proveedor</button>
        </div>

        <!-- Modal -->
        <div v-if="isModalVisible" class="modal" @click="closeModal" @click.self="closeModal">
          <div class="modal-content" @click.stop>
            <span class="close" @click="closeModal">&times;</span>
            <button type="button" class="btn-close" @click="closeModal" aria-label="Close">X</button>
            <h1 class="pon">{{ isEditing ? "Editar proveedor" : "Agregar proveedor" }}</h1>

            <form @submit.prevent="agregarProveedor"
              id="insertar" data-controller2="<?= site_url('insertar/proveedores'); ?>"
              data-controller3="<?= site_url('actualizar/proveedores'); ?>" method="POST">
              <div class="form-group">
                <label for="nombreproveedor">Nombre proveedor</label>
                <input class="medi" type="text" id="nombreproveedor" v-model="proveedor.nombre"
                  placeholder="Escribe el nombre del proveedor" />
              </div>
              <div class="form-group">
                <label for="telefonoproveedor">Teléfono</label>
                <input class="medi" type="text" id="telefonoproveedor" v-model="proveedor.telefono"
                  placeholder="Teléfono" />
              </div>
              <div class="form-group">
                <label for="correo">Correo</label>
                <input class="medi" type="text" id="correo" v-model="proveedor.correo" placeholder="Correo" />
              </div>
              <button class="boton" type="submit">{{ isEditing ? "Guardar cambios" : "Agregar proveedor" }}</button>
              <div class="modal-footer">
                <button type="button" class="boton_cerrar btn btn-secondary" @click="closeModal">Cerrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="/venta/assets/js/funcionLogout.js"></script>
    <script src="/venta/assets/js/filtroBarra.js"></script>
    <script src="/venta/assets/js/modal_proveedores.js"></script>
</body>

</html>