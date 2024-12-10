<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario Ingredientes</title>
  <!--Se carga vue de forma sincrona para evitar parpadeos y ejecutarlo junto al DOM -->
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>

  <link href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/venta/assets/css/style_producto.css">
</head>

<body>
  <div id="inventario_productos">
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

    <!-- Contenido del Inventario de Productos -->
    <div class="content">
      <div id="inventario_productos" class="Product">
        <h2 class="titul">Inventario de ingredientes</h2>
        <div class="header">
          <div class="header-buttons">
            <a href="<?= site_url('modal_producto') ?>">
              <button class="activo">Ingredientes</button>
            </a>
            <a href="<?= site_url('modal_utilidad') ?>">
              <button class="inactivo">Utilidades</button>
            </a>
            <a href="<?= site_url('modal_proveedores') ?>">
              <button class="inactivo">Proveedores</button>
            </a>
          </div>
          <div class="search-bar">
            <input type="text" v-model="searchQuery" placeholder="Buscar">
            <button><i class="fas fa-search"></i></button>
          </div>
        </div>

        <div class="table-container">
          <!-- Encabezado -->
          <div class="table-header">
            <table>
              <thead>
                <tr class="tipo">
                  <th>ID</th>
                  <th>Producto</th>
                  <th>Proveedores</th>
                  <th>Cantidad</th>
                  <th>Acciones</th>
                </tr>
              </thead>
            </table>
          </div>

          <!-- Cuerpo -->
          <div id="inventario" class="table-body" data-controller="<?= site_url('productos/inventario'); ?>" method="GET"
          data-controller4="<?= site_url('eliminar/inventario'); ?>">
            <table>
              <tbody>
                <tr v-for="item in productosFiltrados" :key="item.id" :class="{'fila-baja-cantidad': parseInt(item.cantidad) <= 20}" class="cosas">
                  <td>{{ item.id }}</td>
                  <td>{{ item.producto }}</td>
                  <td>{{ item.proveedores }}</td>
                  <td>{{ item.cantidad }}</td>
                  <td class="actions">
                    <button class="editar-btn" @click="abrirModalEditar(item)"> <i class="fas fa-pencil-alt"></i>Editar</button>
                    <button class="eliminar-btn" @click="eliminarProducto(item.id)"> <i class="fas fa-trash"></i>Eliminar</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="bottom-buttons">
          <button @click="abrirModal" class="btn-colore">Agregar producto</button>
        </div>
        <!-- Modal -->
        <div class="modal" :class="{ active: modalActivo }" @click.self="cerrarModal">
          <div class="modal-content">
            <button type="button" class="btn-close" @click="cerrarModal" aria-label="Close">X</button>
            <h2 class="poner">{{ editando ? "Editar producto" : "Agregar producto" }}</h2>

            <form @submit.prevent="agregarOEditarProducto" id="insertar" data-controller2="<?= site_url('insertar/inventario'); ?>"
               data-controller3="<?= site_url('actualizar/inventario'); ?>" method="POST">
              <label for="nombreProducto" class="estil">Nombre producto</label>
              <input class="intento" id="nombreProducto" v-model="nuevoProducto.producto"
                placeholder="Escribe el nombre del producto">
              <!-- <label for="precioProducto" class="estil">Precio producto</label>
              <input class="intento" id="precioProducto" v-model="nuevoProducto.precio"
                placeholder="Escribe el precio del producto"> -->
              <label for="cantidadStock" class="estil">Cantidad en stock</label>
              <input class="intento" id="cantidadStock" type="number" v-model="nuevoProducto.cantidad"
                placeholder="Escribe la cantidad disponible">
              <!-- <input class="intento" id="proveedor" v-model="nuevoProducto.proveedores"
                placeholder="Escribe el nombre del proveedor"> -->
              <div>
                <label for="proveedor" class="estil">Proveedor</label>
                <select class="intento" id="proveedor" v-model="nuevoProducto.proveedores"
                  data-controller1="<?= site_url('proveedores/inventario'); ?>" method="GET" 
                  placeholder="Seleccionar">
                  <!-- <option value="">Seleccionar</option> -->
                  <option v-for="proveedor in proveedores" :key="proveedor.id_proveedor" :value="proveedor.id_proveedor">
                    {{ proveedor.nombre_proveedor }}
                  </option>
                </select>
              </div>
              <button type="submit" class="close-btn">{{ editando ? "Guardar cambios" : "Agregar producto" }}</button>
              <div class="modal-footer">
                <button type="button" class="boton_cerrar btn btn-secondary" @click="cerrarModal">Cerrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <script src="/venta/assets/js/funcionLogout.js"></script>
      <script src="/venta/assets/js/filtroBarra.js"></script>

      <script src="/venta/assets/js/modal_producto.js"></script>
</body>

</html>