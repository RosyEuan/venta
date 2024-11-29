<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario de Proveedores</title>
  <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Khmer&family=Konkhmer+Sleokchher&family=Suez+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <style>
    /* Estilos generales */
    body {
      background-color: #fff;
      margin: 0;
      padding: 100px;
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
   /* Alinea el texto con el ícono verticalmente */
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

    /* Modal Styles */
    .modal {
      display: flex;
      justify-content: center;
      align-items: center;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: white;
      padding: 30px;
      border-radius: 8px;
      width: 50%;
      max-width: 630px;

    }

    .close {
      color: #aaa;
      font-size: 30px;
      font-weight: bold;
      position: absolute;
      top: 5px;
      right: 5px;
      cursor: pointer;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }

    .modal-content form {
      font-family: 'Maname', sans-serif;
      display: flex;
      flex-direction: column;
    }

    .modal-content input {
      padding: 10px;
      margin: 10px 0;
      font-size: 16px;
      border: 1px solid #ddd;
      border-radius: 4px;
      background-color: #f9f9f9;
    }

    .modal-content button {
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

    .pon {
        text-align: center;
      margin-bottom: 30px;
      font-family: "EB Garamond";
font-size: 28px;
    }
    .itemss{
font-family: Maname;
font-size: 20px;}
th:first-child, td:first-child {
        width: 120px; /* Ajusta este valor a lo que necesites */}

        th:nth-child(2), td:nth-child(2) {  /* Columna de Producto */
  width: 200px;  /* Ajusta el ancho a tu preferencia */
}

        th:nth-child(3), td:nth-child(3) {  /* Columna de Proveedores */
  width: 200px;  /* Ajusta el ancho a tu preferencia */
}

th:nth-child(4), td:nth-child(4) {  /* Columna de Cantidad */
  width: 200px;  /* Ajusta el ancho a tu preferencia */
}
.btn-submit:hover {
      background-color: #ffc107;
    }

    .form-group {
      margin-bottom: 20px;
      font-family: "EB Garamond";
font-size: 24px;
align-items: flex-start; /* Alinea los cuadros a la izquierda */
position: relative; 
    }
    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    
    .medi{
        font-family: "EB Garamond";
font-size: 16px;
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
      .columna{
        color: #FFF;/*para el tamaño del nombre de las columnas */
text-align: center;
font-family: Maname;
font-size: 28px;
font-style: normal;
font-weight: 400;
line-height: normal;}
.titu{
  font-family: 'EB Garamond';
  font-size: 28px;
  text-align: left; 
  color: #333;
  position: absolute; 
  top: 15px;
  margin-bottom: 20px;  
  margin-left:135px;  
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


  <script>
    const app = Vue.createApp({
      data() {
        return {
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
    // Si alguno de los campos está vacío, no hacer nada
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
