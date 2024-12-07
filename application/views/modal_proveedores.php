<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario Proveedores</title>
  <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
  rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/venta/assets/css/style_proveedores.css">
</head>
<body>
  <div id="inventario_proveedores">
    <!-- Barra Lateral -->
    <div :class="['sidebar', { open: isSidebarOpen }]">
      <button class="toggle-btn" @click="toggleSidebar">☰</button>
      <div class="logo">
        <img src="img/LogoCytisum.png" alt="Logo" @click="closeSidebar">
      </div>
      <ul>
        <li>
          <a href="<?= site_url('graficas2') ?>">
            <img src="<?= base_url('img/Barras.png') ?>" alt="Reportes"><span>Reportes</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('mesas') ?>">
            <img src="<?= base_url('img/Mesa.png') ?>" alt="Mesas"><span>Mesas</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('reservaciones') ?>">
            <img src="<?= base_url('img/Reservas.png') ?>" alt="Reservaciones"><span>Reservaciones</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('menu') ?>">
            <img src="<?= base_url('img/Menus.png') ?>" alt="Menú"><span>Menú</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('modal_pedidos') ?>">
            <img src="<?= base_url('img/Pedido.png') ?>" alt="Pedidos"><span>Pedidos</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('modal_producto') ?>">
            <img src="<?= base_url('img/Inventarios.png') ?>" alt="Inventario"><span>Inventario</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('personal') ?>">
            <img src="<?= base_url('img/Personales.png') ?>" alt="Personal"><span>Personal</span>
          </a>
        </li>
      </ul>
      <div class="bottom-icons" :class="{ hidden: isSidebarOpen }">
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
    </div>

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
          <tbody>
            <tr v-for="item in filteredProducts" :key="item.id" class="itemss">
              <td>{{ item.id }}</td>
              <td>{{ item.nombre }}</td>
              <td>{{ item.telefono}}</td>
              <td>{{ item.correo }}</td>
              <td class="actions">
                <button class="editar-btn" @click="editProveedor(item)"><i class="fas fa-pencil-alt"></i>Editar</button>
                <button class="eliminar-btn" @click="deleteProveedor(item.id)"><i
                    class="fas fa-trash"></i>Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="bottom-buttons">
          <button type="submit" class="btn-submit" @click="openModal()">Agregar proveedor</button>
        </div>

        <!-- Modal -->
        <div v-if="isModalVisible" class="modal" @click="closeModal" @click.self="closeModal">
          <div class="modal-content" @click.stop>
            <span class="close" @click="closeModal">&times;</span>
            <button type="button" class="btn-close" @click="closeModal" aria-label="Close">X</button>
            <h1 class="pon">{{ isEditing ? "Editar proveedor" : "Agregar proveedor" }}</h1>
            <form @submit.prevent="isEditing ? updateProveedor() : agregarProveedor()">
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

    <script>
      const app = Vue.createApp({
        data() {
          return {
            isSidebarOpen: false,
            isModalVisible: false,
            isEditing: false,
            searchQuery: "",
            proveedor: { id: null, nombre: "", telefono: "", correo: "" },
            productos: [
              { id: 1, nombre: "Proovedor", telefono: "9252894503", correo: "prueba@gmail.com" },
              { id: 2, nombre: "Prueba", telefono: "9252894503", correo: "prueba@gmail.com" },
              { id: 3, nombre: "Admin", telefono: "9252894503", correo: "prueba@gmail.com" },
              { id: 4, nombre: "Empleado", telefono: "9252894503", correo: "prueba@gmail.com" },
              { id: 5, nombre: "Prueba", telefono: "9252894503", correo: "prueba@gmail.com" },
            ],
          };
        },
        computed: {
          filteredProducts() {
            return this.productos.filter((item) =>
              Object.values(item).some((val) =>
                val.toString().toLowerCase().includes(this.searchQuery.toLowerCase())
              )
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
          openModal() {
            this.isModalVisible = true;
            this.isEditing = false;
            this.proveedor = { id: null, nombre: "", telefono: "", correo: "" };
          },
          closeModal() {
            this.isModalVisible = false;
          },
          agregarProveedor() {
            // Verificar si todos los campos están llenos
            if (!this.proveedor.nombre || !this.proveedor.telefono || !this.proveedor.correo) {
              return;
            }
            // Generar un ID único basado en el mayor ID actual
            const nuevoId = this.productos.length > 0
              ? Math.max(...this.productos.map(item => item.id)) + 1
              : 1;

            const nuevoProveedor = { ...this.proveedor, id: nuevoId };
            // Agregar el nuevo proveedor a la lista
            this.productos.push(nuevoProveedor);
            // Cerrar el modal
            this.closeModal();
          },
          editProveedor(proveedor) {
            this.isEditing = true;
            this.isModalVisible = true;
            this.proveedor = { ...proveedor };
          },
          updateProveedor() {
            const index = this.productos.findIndex((item) => item.id === this.proveedor.id);
            if (index !== -1) {
              this.productos[index] = { ...this.proveedor };
            }
            this.closeModal();
          },
          deleteProveedor(id) {
            this.productos = this.productos.filter((item) => item.id !== id);
          },
        },
      });
      app.mount("#inventario_proveedores");
    </script>
</body>
</html>