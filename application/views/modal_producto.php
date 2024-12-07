<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario Ingredientes</title>
  <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
  rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/venta/assets/css/style_producto.css">
</head>
<body>
  <div id="inventario_productos">
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

    <!-- Contenido del Inventario de Productos -->
    <div class="content">
      <div id="inventario_productos" class="Product">
        <h2 class="titul">Inventario de Ingredientes</h2>
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
            <input type="text" v-model="textoBusqueda" placeholder="Buscar">
            <button><i class="fas fa-search"></i></button>
          </div>
        </div>
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
          <tbody>
            <tr v-for="item in productosFiltrados" :key="item.id" class="cosas">
              <td>{{ item.id }}</td>
              <td>{{ item.producto }}</td>
              <td>{{ item.proveedores }}</td>
              <td>{{ item.cantidad }}</td>
              <td class="actions">
                <button class="editar-btn" @click="abrirModalEditar(item)">
                  <i class="fas fa-pencil-alt"></i>Editar</button>
                <button class="eliminar-btn" @click="eliminarProducto(item.id)">
                  <i class="fas fa-trash"></i>Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="bottom-buttons">
          <button @click="abrirModal" class="btn-colore">Agregar producto</button>
        </div>
        <!-- Modal -->
        <div class="modal" :class="{ active: modalActivo }" @click.self="cerrarModal">
          <div class="modal-content">
            <button type="button" class="btn-close" @click="cerrarModal" aria-label="Close">X</button>
            <h2 class="poner">{{ editando ? "Editar producto" : "Agregar producto" }}</h2>
            <form @submit.prevent="agregarOEditarProducto">
              <label for="nombreProducto" class="estil">Nombre producto</label>
              <input class="intento" id="nombreProducto" v-model="nuevoProducto.producto"
                placeholder="Escribe el nombre del producto">
              <label for="precioProducto" class="estil">Precio producto</label>
              <input class="intento" id="precioProducto" v-model="nuevoProducto.precio"
                placeholder="Escribe el precio del producto">
              <label for="cantidadStock" class="estil">Cantidad en stock</label>
              <input class="intento" id="cantidadStock" v-model="nuevoProducto.cantidad"
                placeholder="Escribe la cantidad disponible">
              <label for="proveedor" class="estil">Proveedor</label>
              <input class="intento" id="proveedor" v-model="nuevoProducto.proveedores"
                placeholder="Escribe el nombre del proveedor">
              <button type="submit" class="close-btn">{{ editando ? "Guardar cambios" : "Agregar producto" }}</button>
              <div class="modal-footer">
                <button type="button" class="boton_cerrar btn btn-secondary" @click="cerrarModal">Cerrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <script>
        const app = Vue.createApp({
          data() {
            return {
              isSidebarOpen: false,
              productos: [
                { id: 1, producto: "Pollo asado", proveedores: "Prueba", cantidad: 5 },
                { id: 2, producto: "Panuchos", proveedores: "Prueba", cantidad: 5 },
                { id: 3, producto: "Tacos al pastor", proveedores: "Prueba", cantidad: 5 },
                { id: 4, producto: "Pollo asado", proveedores: "Prueba", cantidad: 5 },
                { id: 5, producto: "Pollo asado", proveedores: "Prueba", cantidad: 5 },
              ],
              textoBusqueda: "", // Agregamos una variable para almacenar el texto de búsqueda
              modalActivo: false,
              nuevoProducto: { producto: "", proveedores: "", cantidad: "", precio: "" },
              productoSeleccionado: null, // Producto actualmente seleccionado para editar
              editando: false, // Estado que indica si el modal está en modo edición
            };
          },
          computed: {
            productosFiltrados() {
              const texto = this.textoBusqueda.toLowerCase();
              return this.productos.filter(producto =>
                producto.producto.toLowerCase().includes(texto) ||
                producto.proveedores.toLowerCase().includes(texto)
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
            abrirModal() {
              this.modalActivo = true;
              this.nuevoProducto = { producto: "", proveedores: "", cantidad: "", precio: "" };
              this.editando = false; // Aseguramos que no esté en modo edición
            },
            abrirModalEditar(producto) {
              // Preparar el modal para editar el producto seleccionado
              this.productoSeleccionado = producto; // Guardar referencia al producto original
              this.nuevoProducto = { ...producto }; // Crear una copia para edición
              this.editando = true;
              this.modalActivo = true;
            },
            agregarOEditarProducto() {
              // Verificar que todos los campos estén completos
              if (!this.nuevoProducto.producto || !this.nuevoProducto.proveedores || !this.nuevoProducto.cantidad || !this.nuevoProducto.precio) {
                return; // No hacer nada si algún campo está vacío
              }
              if (this.editando) {
                // Actualizar producto existente
                const index = this.productos.findIndex(p => p.id === this.productoSeleccionado.id);
                if (index !== -1) {
                  this.productos[index] = { ...this.nuevoProducto }; // Actualizar producto en la lista
                }
              } else {
                // Agregar un nuevo producto
                const nuevoId = this.productos.length + 1;
                this.productos.push({ id: nuevoId, ...this.nuevoProducto });
              }
              // Resetear estado y cerrar modal
              this.cerrarModal();
            },
            cerrarModal() {
              this.modalActivo = false;
              this.nuevoProducto = { producto: "", proveedores: "", cantidad: "", precio: "" };
              this.productoSeleccionado = null;
              this.editando = false;
            },
            agregarProducto() {
              // Verificar que todos los campos estén completos
              if (!this.nuevoProducto.producto || !this.nuevoProducto.proveedores || !this.nuevoProducto.cantidad || !this.nuevoProducto.precio) {
                return; // No hacer nada si algún campo está vacío
              }
              const nuevoId = this.productos.length + 1;
              this.productos.push({ id: nuevoId, ...this.nuevoProducto });
              // Limpiar los campos del formulario
              this.nuevoProducto = { producto: "", proveedores: "", cantidad: "", precio: "" };
              this.cerrarModal();
            },
            eliminarProducto(id) {
              console.log("Eliminando producto con ID:", id); // Verificar que se ejecuta
              // Filtro para eliminar el producto con el ID especificado
              this.productos = this.productos.filter(producto => producto.id !== id);
            },
          },
        });
        app.mount("#inventario_productos");
      </script>
</body>
</html>