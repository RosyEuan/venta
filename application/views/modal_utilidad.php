<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario Utilidades</title>

  <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>

  <link href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/venta/assets/css/style_utilidades.css">
</head>

<body>
  <div id="inventario_utilidades">
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

    <!-- Contenido del inventario de Utilidades -->
    <div class="content">
      <div id="inventario_utilidades" class="Product">
        <h2 class="tit">Inventario utilidades</h2>
        <div class="header">
          <div class="header-buttons">
            <a href="<?= site_url('modal_producto') ?>">
              <button class="inactivo">Ingredientes</button>
            </a>
            <a href="<?= site_url('modal_utilidad') ?>">
              <button class="activo">Utilidades</button>
            </a>
            <a href="<?= site_url('modal_proveedores') ?>">
              <button class="inactivo">Proveedores</button>
            </a>
          </div>
          <div class="search-bar">
            <input type="text" placeholder="Buscar" v-model="busqueda">
            <button><i class="fas fa-search"></i></button>
          </div>
        </div>
        
        <div class="table-container">
  <!-- Encabezado -->
  <div class="table-header">
    <table>
      <thead>
        <tr class="lempo">
        <th>ID</th>
          <th>Utilidad</th>
          <th>Proveedores</th>
          <th>Fecha adquisición</th>
          <th>Cant.</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
    </table>
  </div>

  <!-- Cuerpo -->
  <div class="table-body">
    <table>
      <tbody>
        <tr v-for="item in productosFiltrados" :key="item.id" class="siguiente">
            <td>{{ item.id }}</td>
              <td>{{ item.utilidad }}</td>
              <td>{{ item.proveedores }}</td>
              <td>{{ item.fecha_adquisicion }}</td>
              <td>{{ item.cant }}</td>
              <td>{{ item.estado }}</td>
          <td class="actions">
            <button class="editar-btn" @click="abrirModalEditar(item)"><i class="fas fa-pencil-alt"></i>Editar</button>
            <button class="eliminar-btn" @click="eliminarProducto(item.id)"><i class="fas fa-trash"></i>Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
        <!-- <table>
          <thead>
            <tr class="lempo">
              <th>ID</th>
              <th>Utilidad</th>
              <th>Proveedores</th>
              <th>Fecha adquisición</th>
              <th>Cant.</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in productosFiltrados" :key="item.id" class="siguiente">
              <td>{{ item.id }}</td>
              <td>{{ item.utilidad }}</td>
              <td>{{ item.proveedores }}</td>
              <td>{{ item.fecha_adquisicion }}</td>
              <td>{{ item.cant }}</td>
              <td>{{ item.estado }}</td>
              <td class="actions">
                <button class="editar-btn" @click="editarProducto(item)"><i class="fas fa-pencil-alt"></i>
                  Editar</button>
                <button class="eliminar-btn" @click="eliminarProducto(item.id)"><i class="fas fa-trash"></i>
                  Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table> -->
        <div class="bottom-buttons">
          <button @click="abrirModal" class="btn-submit">Agregar utilidad</button>
        </div>

        <!-- Modal -->
        <div v-if="mostrarModal" class="modal-overlay" @click.self="cerrarModal">
          <div class="modal-content">
            <button type="button" class="btn-close" @click="cerrarModal" aria-label="Close">X</button>
            <h2 class="modal-header">{{ productoEditando ? 'Editar Utilidad' : 'Agregar Utilidad' }}</h2>
            <form @submit.prevent="guardarProducto">
              <div>
                <div class="form-group">
                  <label for="nombreProducto">Nombre de la utilidad</label>
                  <input class="orden" type="text" id="nombreProducto" v-model="nuevoProducto.utilidad"
                    placeholder="Escribe el nombre de la utilidad" />
                </div>
                <div class="form-group">
                  <label for="precioProducto">Precio unitario</label>
                  <input class="orden" type="text" id="precioProducto" v-model="nuevoProducto.precio"
                    placeholder="Escribe el precio unitario" />
                </div>
                <div class="form-group">
                  <label for="cantidad">Cantidad de stock</label>
                  <input class="orden" type="number" id="cantidad" v-model="nuevoProducto.cant"
                    placeholder="Escribe la cantidad disponible" />
                </div>
                <div class="form-group">
                  <label for="proveedor">Proveedor</label>
                  <input class="orden" type="text" id="proveedor" v-model="nuevoProducto.proveedores"
                    placeholder="Escribe el nombre del proveedor" />
                </div>
              </div>
              <div class="grid-container">
                <div>
                  <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea class="orden" id="descripcion" v-model="nuevoProducto.descripcion"
                      placeholder="Escribe una descripción"></textarea>
                  </div>
                  <div class="button-container">
                    <button type="submit" class="boton" :disabled="!isFormValid">{{ productoEditando ? 'Guardar Cambios'
                      : 'Agregar Utilidad' }}</button>
                  </div>
                </div>
                <div>
                  <div class="form-group">
                    <label for="fechaAdquisicion">Fecha adquisición</label>
                    <input class="orden" type="date" id="fechaAdquisicion" v-model="nuevoProducto.fecha_adquisicion" />
                  </div>
                  <div class="form-group">
                    <label for="estado">Estado</label>
                    <input class="orden" type="text" id="estado" v-model="nuevoProducto.estado"
                      placeholder="Escribe el estado" />
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="boton_cerrar btn btn-secondary" @click="cerrarModal">Cerrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="/venta/assets/js/funcionLogout.js"></script>
    <script src="/venta/assets/js/filtroBarra.js"></script>

    <script src="/venta/assets/js/modal_utilidad.js"></script>
</body>

</html>