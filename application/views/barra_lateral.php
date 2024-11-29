<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Punto de Venta</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.js"></script>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Khmer&family=Konkhmer+Sleokchher&family=Suez+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      overflow-x: hidden;
    }

    /* Barra lateral */
    .sidebar {
      width: 60px;
      height: 100vh;
      background-color: #f8f8f8;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: center;
      position: fixed;
      transition: width 0.3s;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .sidebar.open {
      width: 250px;
    }

    .toggle-btn {
      margin: 10px;
      font-size: 24px;
      cursor: pointer;
      background: none;
      border: none;
      outline: none;
    }

    .logo {
      display: none;
      margin: 10px;
      width: 100%;
      text-align: center;
    }

    .sidebar.open .toggle-btn {
      display: none;
    }

    .sidebar.open .logo {
      display: block;
    }

    .logo img {
      max-width: 170px;
      cursor: pointer;
      padding-top: 50px;
    }

    /* Estilos de la lista de navegación */
    .sidebar ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      width: 100%;
    }

    .sidebar ul li {
      width: 100%;
      display: flex;
      align-items: center;
      padding: 15px 10px;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .sidebar ul li:hover {
      background-color: rgba(81, 92, 100, 0.4);
    }

    .sidebar ul li img {
      width: 30px;
      height: 30px;
      margin-right: 10px;
    }

    .sidebar ul li span {
      font-size: 14px;
      color: black;
      display: none;
    }

    .sidebar.open ul li span {
      display: inline-block;
    }

    .admin-info {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      padding: 20px;
      width: 100%;
      border-top: 1px solid #ddd;
      opacity: 0;
      transition: opacity 0.3s;
    }

    .sidebar.open .admin-info {
      opacity: 1;
    }

    .admin-info img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .admin-info span {
      font-size: 14px;
      color: black;
      display: none;
    }

    .sidebar.open .admin-info span {
      display: block;
    }

    .bottom-icons {
      margin-bottom: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
    }

    .bottom-icons img {
      width: 30px;
      height: 30px;
      margin: 10px 0;
    }

    .bottom-icons.hidden {
      display: none;
    }

    /* Contenido principal */
    .content {
      margin-left: 60px;
      padding: 20px;
      flex: 1;
      transition: margin-left 0.3s;
    }

    .sidebar.open ~ .content {
      margin-left: 250px;
    }



    body {
      background-color: #F7F7F7;
      margin: 0;
      padding: 100px;
      overflow: hidden;  /* Evita las barras de desplazamiento */
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .header-buttons {
      display: flex;
      gap: 10px;
      padding-left: 237px;
    }
    .header-buttons button {
      padding: 10px 20px;
      background-color: rgba(50, 42, 127, 0.6);
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-family: EB Garamond;
      font-size: 16px;
    }
    .search-bar {
      display: flex;
      align-items: center;
      padding-right: 180px;
      position: relative;
      margin-top: -120px;      
    }
    .search-bar input {
      padding: 10px 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      text-align: left;
      background-color: rgba(247, 247, 247, 1);
      width: 250px;
      padding-left: 35px;
      font-size: 16px;
    }
    .search-bar button {
      position: relative;
      right: 40px;
      background-color: transparent;
      border: none;
      cursor: pointer;
      font-size: 20px;
    }
    .search-bar input:focus {
      background-color: #e0e0e0;
    }
    .search-bar i {
      position: relative;
      left: 0px;
      font-size: 18px;
      color: #aaa;
    }
    table {
      width: 80%;
      margin: 0 auto;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th, td {
      border: 1px solid #ccc;
      text-align: center;
      padding: 5px;
      height: 40px;
    }
    th {
      background-color: #515C64;
      color: white;
      height: 60px;
      font-size: 24px;
    }
    tr:nth-child(even) {
      background-color: rgba(50, 42, 127, 0.35);
    }
    .actions button {
      margin: 0 5px;
      padding: 5px 10px;
      border: none;
      border-radius: 16px;
      cursor: pointer;
    }
    .actions {
      display: flex; /* Alinea los botones horizontalmente */
      justify-content: center; /* Centra los botones dentro de la celda */
      gap: 15px; /* Espacio entre los botones */
      padding-top:10px;
    }
    .editar-btn, .eliminar-btn {
      display: flex;
      justify-content: center;  /* Alinea horizontalmente */
      padding: 8px 15px;
      font-family: Maname;
      font-size: 16px;
      gap:6px; /*ESTE */ 
    }
    .editar-btn i, .eliminar-btn i {
      position: relative;
      top: 3px; /* Ajusta este valor para mover el ícono */
    }
    .editar-btn, .eliminar-btn {
      line-height: 1; /* Ajusta la altura de línea para alinear mejor el texto */
    }
    .editar-btn img, .eliminar-btn img {
      width: 20px;
      height: 20px;
      /* Espacio entre el ícono y el texto */
      margin-right: -4px; /*ESTE */
    }
    .editar-btn {
      background-color: #0C8217;
      color: white;
      height: 35px;
      width: 100px;
      font-family: Maname;
      font-size: 16px;
      text-align: center;
      gap:8px; /*ESTE */
    }
    .eliminar-btn {
      background-color: #DC730A;
      color: white;
      height: 35px;
      width: 100px;
      font-family: Maname;
      font-size: 16px;
      text-align: center;
    }
    .bottom-buttons {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 20px;
      margin-right: 183px;
    }
    .bottom-buttons button {
      padding: 10px;
      background-color: rgba(232, 236, 7, 1);
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 10%;
      font-family: EB Garamond;
      font-size: 16px;
    }
    .tipo{
      color: #FFF;/*para el tamaño del nombre de las columnas */
      text-align: center;
      font-family: Maname;
      font-size: 28px;
      font-style: normal;
      font-weight: 400;
      line-height: normal;
    }
    .cosas{
      font-family: Maname;
      font-size: 20px;
    }
    th:first-child, td:first-child {
      width: 120px; /* Ajusta este valor a lo que necesites */
    }
    th:nth-child(2), td:nth-child(2) {  /* Columna de Producto */
      width: 200px;  /* Ajusta el ancho a tu preferencia */
    }
    th:nth-child(3), td:nth-child(3) {  /* Columna de Proveedores */
      width: 200px;  /* Ajusta el ancho a tu preferencia */
    }
    th:nth-child(4), td:nth-child(4) {  /* Columna de Cantidad */
      width: 200px;  /* Ajusta el ancho a tu preferencia */
    }

    /* Estilos del modal */
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }
    .modal.active {
      display: flex;
    }
    .modal-content {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      max-width: 630px;
      width: 90%;
      text-align: left;
    }
    .close-btn {
      padding: 10px 15px;
      padding-left:30;
      margin-left:0;
      border: none;
      color: #000;
      font-weight: bold;
      cursor: pointer;
      margin-top: 10px;
      border-radius: 16px;
      background: #E8EC07;
      font-size:16px;
      text-align: center;
      font-family: "EB Garamond";
      width: 20%;
    }
    input {
      width: 110%;
      max-width: 600px;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
      max-width: 600px;
      width: 600px;
    }
    button[type="submit"] {
      background-color: #0C8217;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }
    .poner {
      text-align: center;
      margin-bottom: 30px;
      font-family: "EB Garamond";
      font-size: 28px;
    }
    .estil{
      font-family: "EB Garamond";
      font-size: 24px;
    }
    .intento{
      font-family: "EB Garamond";
      font-size: 16px;
    }
    button[type="submit"] {
      background-color: #E8EC07;
      color: black; 
    }
    .btn-colore:hover {
      background-color: #ffc107;
    }
    .titul {
      font-family: 'EB Garamond';
      font-size: 28px;
      text-align: left; 
      color: #333;
      position: absolute;  
      top: 15px;  
      margin-bottom: 20px;  
      margin-left:135px;  
    }
    .btn-close{
      color: #515C64;
      font-size: 16px;
      width: 25px;
      height: 25px;
      margin-left: 95%;
      cursor: pointer;
      border: none;
      background-color: white;
    }
    .modal-footer{
      display: flex;
      flex-direction: row-reverse;
    }
    .boton_cerrar{
      background-color: #515C64;
      color: white;    
      font-family: "EB Garamond";
      font-size: 16px;
      border-radius: 8px;
      border: none;
      width: 70px;
      height: 35px;
      cursor: pointer;
    } 
  </style>
</head>
<body>
  <div id="app">
    <div :class="['sidebar', { open: isSidebarOpen }]">
      <button class="toggle-btn" @click="toggleSidebar">☰</button>
      <div class="logo">
        <img src="img/logoo.png" alt="Logo" @click="closeSidebar">
      </div>
      <ul>
        <li>
          <a href="<?=site_url('reportes') ?>">
            <img src="<?=base_url('img/reportes.png') ?>" alt="Reportes"><span>Reportes</span>
          </a>
        </li>
        <li>
          <a href="<?=site_url('mesas') ?>">
            <img src="<?= base_url('img/mesas.png') ?>" alt="Mesas"><span>Mesas</span>
          </a>  
        </li>
        <li>
          <a href="<?=site_url('reservaciones') ?>">
            <img src="<?=base_url('img/reservaciones.png') ?>" alt="Reservaciones"><span>Reservaciones</span>
          </a>
        </li>
        <li>
          <a href="<?= site_url('menu') ?>">
            <img src="<?= base_url('img/menu.png') ?>" alt="Menú"><span>Menú</span>
          </a>
        </li>
        <li>
          <a href="<?=site_url('pedidos') ?>">
            <img src="<?= base_url('img/inventario.png') ?>" alt="Pedidos"><span>Pedidos</span>
          </a>
        </li>
        <li>
          <a href="<?=site_url('modal_producto') ?>">
            <img src="<?=base_url('img/pedidos.png') ?>" alt="Inventario"><span>Inventario</span>
          </a>
        </li>
        <li>
          <a href="<?=site_url('personal') ?>">
            <img src="<?=base_url('img/personal.png') ?>" alt="Personal"><span>Personal</span>
          </a>
        </li>
      </ul>
      <div class="bottom-icons" :class="{ hidden: isSidebarOpen }">
        <img src="img/person.png" alt="Usuario">
        <img src="img/salida.png" alt="Salir">
      </div>
      <div class="admin-info" :class="{ hidden: !isSidebarOpen }">
        <img src="<?= base_url('img/user.png') ?>" alt="Usuario">
        <span>Angel Chi<br>Administrador</span>
      </div>
    </div>
<div id="inventario_proveedores">
  <h2 class="titu">Inventario proveedores</h2> 
    <div class="header">
      <div class="header-buttons">
        <a href="<?=site_url('modal_producto') ?>">
          <button>Ingredientes</button>
        </a>
        <a href="<?=site_url('modal_utilidad') ?>">
          <button >Utilidades</button>
        </a>
        <a href="<?=site_url('modal_proveedores') ?>">        
          <button>Proveedores</button>
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
            <button class="editar-btn"  @click="editProveedor(item)"><i class="fas fa-pencil-alt"></i>Editar</button>
            <button class="eliminar-btn" @click="deleteProveedor(item.id)"><i class="fas fa-trash" ></i>Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="bottom-buttons">
    <button type="submit" class="btn-submit">Agregar producto</button>
    <button type="submit" class="btn-submit">Agregar utilidad</button>
      <button type="submit" class="btn-submit" @click="openModal()">Agregar proveedor</button>
    </div>

     <!-- Modal for adding/editing provider -->
     <div v-if="isModalVisible" class="modal" @click="closeModal">
      <div class="modal-content" @click.stop>
        <span class="close" @click="closeModal">&times;</span>
        <h1 class="pon">{{ isEditing ? "Editar proveedor" : "Agregar proveedor" }}</h1>
        <form @submit.prevent="isEditing ? updateProveedor() : agregarProveedor()">
          <div class="form-group">
            <label for="nombreproveedor">Nombre proveedor</label>
            <input class="medi"
              type="text"
              id="nombreproveedor"
              v-model="proveedor.nombre"
              placeholder="Escribe el nombre del proveedor"
            />
          </div>
          <div class="form-group">
            <label for="telefonoproveedor">Teléfono</label>
            <input class="medi"
              type="text"
              id="telefonoproveedor"
              v-model="proveedor.telefono"
              placeholder="Teléfono"
            />
          </div>
          <div class="form-group">
            <label for="correo">Correo</label>
            <input class="medi"
              type="text"
              id="correo"
              v-model="proveedor.correo"
              placeholder="Correo"
            />
          </div>
          <button type="submit">{{ isEditing ? "Guardar cambios" : "Agregar proveedor" }}</button>
        </form>
      </div>
    </div>
  </div>

  </div>

  

  <script>
    const sidebarApp = Vue.createApp({
      data() {
        return {
          isSidebarOpen: false,
        };
      },
      methods: {
        toggleSidebar() {
          this.isSidebarOpen = !this.isSidebarOpen;
        },
        closeSidebar() {
          this.isSidebarOpen = false;
        },
      },
    }).mount("#app");

  </script>



<script>
    const app = Vue.createApp({
      data() {
        return {
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