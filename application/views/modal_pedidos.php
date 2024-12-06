<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Punto de Venta</title>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Maname&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

  <style>
    body {
      margin: 0;
      padding: 0;
      display: flex;
      font-family: Arial, sans-serif;
      background-color: #0F0D26;
      overflow-x: hidden;
    }

    /* Barra lateral */
    .sidebar {
      width: 60px;
      height: 100vh;
      background-color: #231F5A;
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
      transition: background-color 0.3s ease;
    }

    .sidebar ul li:hover {
      background-color: rgba(81, 92, 100, 0.4);
    }

    .sidebar ul li img {
      width: 30px;
      height: 30px;
      margin-right: 10px;
      line-height: 1.2; /* Ajusta el valor según lo necesites */
      vertical-align: middle; /* Centra el texto verticalmente */
    }

    .sidebar ul li span {
      font-size: 16px;
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
      display: flex;
      gap: 30px;
    }

    .sidebar.open ~ .content {
      margin-left: 250px;
    }

    /* Registro de pedido */
    .registro-pedidoss {
  background: white;
  padding: 30px;
  border-radius: 8px;
  width: 100%;  /* Aumentamos el ancho a un 80% de la pantalla */
  max-height: 650px;
  margin-left: 20px; 
  overflow-y: auto;
}

    .registro-pedidoss h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .registro-pedidoss .form-group {
      margin-bottom: 15px;
      display: flex;
      flex-direction: row; /* Colocar los campos al lado */
      gap: 20px;
    }
    .registro-pedidoss label,
.registro-pedidoss input {
  margin-left: 20px; /* Ajusta este valor según necesites */
}
    .registro-pedidoss label {
      font-weight: bold;
      margin-bottom: 5px;
    }

    .registro-pedidoss input {
      padding: 10px;
      border-radius: 5px;
      border: 2px solid #000;
      width: 100%;
      height: auto; 
    }
    

    /* Estilo para la mesa */
    .registro-pedidoss .mesa {
      width: 100%; /* Ancho completo */
    }

    .registro-pedidoss table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
      width: 94%; /* Cambia este valor según lo necesites, por ejemplo, 50% o un valor fijo como 500px */
      margin: 0 auto; /* Para centrar la tabla */
      border: 3px solid #000; /* Contorno externo de la tabla */
      border-collapse: collapse; /* Combina los bordes de celdas adyacentes */
    }

    .registro-pedidoss table,
    .registro-pedidoss th,
    .registro-pedidoss td {
      border:1px solid #ddd;

    }

    .registro-pedidoss th,
    .registro-pedidoss td {
      padding: 10px;
      text-align: left;
      border: 2px solid #000; /* Borde interno de las celdas */

    }

    .registro-pedidoss th {
      text-align: center;
      
    }

    .registro-pedidoss .btn {
      display: block;
      font-weight: bold;
      width: 150px;
      margin: 15px auto;
      padding: 10px;
      background-color: #E8EC07;
      color: #000;
      font-size:20px;
      font-family: EB Garamond;
      border: none;
      border-radius: 16px;
      cursor: pointer;
    }

    .registro-pedidoss .btn:hover {
      background-color: #D7DB08;
    }

    /* Sección de usuarios */
    .usuarios-list {
      background: white;
      padding: 10px;
      border-radius: 8px;
      width: 30%;
      height: 500px;
      overflow-y: auto;
    }

    .usuario {
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }

    .usuario:last-child {
      border-bottom: none;
    }

    .usuario button {
      margin-top: 10px;
      padding: 5px 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
    }

    .usuario button:hover {
      background-color: #45a049;
    }

    /* Estilo para celdas editables */
    .editable {
  border: none;
  background: transparent;
  outline: none;
  width: 100%;
  text-align: left; /* Alinea el texto a la izquierda */
  word-wrap: break-word; /* Permite que el texto se divida cuando sea demasiado largo */
  white-space: normal; /* Permite que el texto se ajuste al tamaño de la celda */
  padding: 5px;
  font-family: "Merriweather";
font-size:16px;
}

table td {
  word-wrap: break-word; /* Asegura que el texto se rompa dentro de las celdas */
  max-width: 200px; /* Puedes ajustar el ancho máximo de las celdas según sea necesario */

}

    .editable:focus {
        outline: none; 
    }
    .col-alimento {
  width: 52%; /* Ajusta el ancho */
  font-family: "Merriweather";
font-size:20px;
}
.alimentos{
    font-size:24px;
    font-family: "Merriweather";
    background: #D9D9D9;
}
.alimento{
    font-size:20px;
    font-family: "Merriweather";
    
}
.campo-nombre {
  width: 80% !important;
  font-size:16px;
  font-family: "Merriweather";
}
.campo-apellido{
  width: 80% !important;
  font-size:16px;
  font-family: "Merriweather";

}
.campo-mesa{
  width: 100% !important;
  font-size:16px !important;
  font-family: "Merriweather" !important;

}
.titulo-registro{
    font-size:32px;
    font-family: "Merriweather";

}
.nombre-cliente{
    font-size:20px;
    font-family: "Merriweather";
}
.apellido-cliente{
    font-size:20px;
    font-family: "Merriweather";
}
.mesa{
    font-size:20px;
    font-family: "Merriweather";
}

/**usuarios */

.usuarios-list {
  display: flex;
  flex-direction: column;
  gap: 20px;
  background: #515C64;
  padding: 15px;
  border-radius: 8px;
  width: 50%; /* Cambia el ancho del contenedor principal (antes era 100%) */
  max-width: 600px; /* Agrega un máximo ancho para que no ocupe todo el espacio */
  margin: 0 auto; /* Centra el contenedor */
  overflow-y: auto;
  scrollbar-width: thin;
  margin-top:0%;
  height:615px;
}

.usuario {
  background: #f5f5f5;
  padding: 15px;
  border-radius: 8px;
  border: 1px solid #ddd;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.usuario-header {
  border-bottom: 1px solid #ccc;
  padding-bottom: 10px;
  flex-direction: column;
}

.usuario-header h3 {
  margin: 0;
  font-size:20px;
font-family:"Merriweather";
}
.fecha{
  
  font-size:16px;
font-family:"Merriweather";
color:#515C64;
}
.usuario-meta {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 2px;
  margin-top:-50px;
  font-size:16px;
font-family:"Merriweather";
}
.estado-info {
  display: flex;
  align-items: center;
  gap: 8px;
}
.hora{
  color:#515C64;
}

.estado {
  background-color: #E8EC07;
  padding: 6px 8px;
  border-radius: 16px;
  font-size:12px;
  color:#515C64;

}

.usuario-fecha-hora p {
  margin: 0;
  font-size: 0.8rem;
}

.usuario-detalle {
  padding-top: 10px;
}

.detalle-item {
  display: flex;
  justify-content: space-between;
font-family:"Merriweather";
  font-size: 16px;
  padding: 10px 0;
  text-decoration: none; /* Elimina el subrayado */
}
.total{
  font-family:"Merriweather";
  font-size: 16px;
}

.usuario-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.usuario-footer button {
  background-color: #0C8217;
  font-family:"Merriweather";

  color: white;
  padding: 15px 30px;
  border: none;
  border-radius: 16px;
  cursor: pointer;
}

.usuario-footer button:hover {
  background-color: #45a049;
}

.usuario-footer .total {
  font-weight: bold;
}

/**buscador */
.search-bar input {
      padding: 10px 35px;
      border: 1px solid #ccc;
      border-radius: 8px;
      text-align: left !important;
      background-color: rgba(247, 247, 247, 1);
      width: 250px;
      font-size: 16px;
      margin-left:645px;
      margin-top:10px;
  font-family:"Merriweather";
      transition: top 0.3s ease; /* Movimiento del input */
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
      background-color: #fff;
    }

    .search-bar i {
      position: relative;
      left: 0px;
      font-size: 18px;
      color: #aaa;
      
    }

   /* Modal */
.popup {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background: rgba(0, 0, 0, 0.5); /* Fondo semitransparente */
  z-index: 9999;
  overflow: hidden;
  overflow-y: auto;
}

.popup-content {
  background: white;
  padding: 30px;
  border-radius: 8px;
  width: 100%;
  margin: 0 auto;
  max-width: 900px;
  max-height: 90vh;
  overflow: hidden;
}

.popup-title {
  text-align: center;
  margin-bottom: 20px;
  font-size: 32px;
  font-family: "Merriweather";
}

.form-section {
  margin-bottom: 15px;
  display: flex;
  flex-direction: row;
  gap: 20px;
}

.form-label {
  font-weight: bold;
  font-size: 20px;
  font-family: "Merriweather";
  margin-bottom: 5px;
}

.form-input {
  padding: 10px;
  border-radius: 5px;
  border: 2px solid #000;
  width: 100%;
  height: auto;
  font-size: 16px;
  font-family: "Merriweather";
}

.nombre-input,
.apellido-input,
.mesa-input, .importe-input, .cambio-input, .metodo-input {
  width: 75%;
}
.importe-input, .cambio-input, .metodo-input {
  gap:20px;
  width:85%;
}

.popup-table {
  width: 94%;
  margin: 20px auto;
  border: 3px solid #000;
  border-collapse: collapse;
}

.table-header {
  text-align: center;
  background: #D9D9D9;
  font-size: 24px;
  font-family: "Merriweather";
}

.table-column-header,
.table-cell {
  padding: 10px;
  text-align: left;
  border: 2px solid #000;
  font-size:24px;
  font-family: "Merriweather";
  width: 52%; /* Ajusta el ancho */
}

.editable-cell {
  border: none;
  background: transparent;
  outline: none;
  width: 100%;
  text-align: left;
  padding: 5px;
  font-family: "Merriweather";
  font-size: 16px;
}

.popup-btn {
  display: block;
  font-weight: bold;
  margin: 15px auto;
  padding: 10px;
  background-color: #0C8217;
  border: none;
  border-radius: 16px;
  cursor: pointer;
  color: white;
  font-size: 20px;
  font-family: "Merriweather";
}

.popup-btn:hover {
  background-color: #0B6E14;
}

.button-group {
  display: flex;
  gap: 80px;
  justify-content: center;
}

.popup-warning {
  font-size: 20px;
  font-family: "Merriweather";
  text-align: center;
  margin-top: 10px;
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
            <a href="<?=site_url('reportes') ?>"><img src="<?=base_url('img/reportes.png') ?>" alt="Reportes"><span>Reportes</span>
        </a>
    </li>
        <li>
            <a href="<?=site_url('mesas') ?>"><img src="<?= base_url('img/mesas.png') ?>" alt="Mesas"><span>Mesas</span>
        </a>
    </li>
        <li>
            <a href="<?=site_url('reservaciones') ?>"><img src="<?=base_url('img/reservaciones.png') ?>" alt="Reservaciones"><span>Reservaciones</span>
        </a>
    </li>
        <li><a href="<?= site_url('menu') ?>"><img src="<?= base_url('img/menu.png') ?>" alt="Menú"><span>Menú</span>
    </a>
</li>
        <li><a href="<?=site_url('pedidos') ?>"><img src="<?= base_url('img/inventario.png') ?>" alt="Pedidos"><span>Pedidos</span>
    </a>
</li>
        <li><a href="<?=site_url('modal_producto') ?>"><img  src="<?=base_url('img/pedidos.png') ?>" alt="Inventario"><span>Inventario</span>
    </a>
</li>
        <li><a href="<?=site_url('personal') ?>"><img src="<?=base_url('img/personal.png') ?>" alt="Personal"><span>Personal</span>
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
            <input type="number" id="mesa" v-model="mesa" placeholder="Num.Mesa" class="campo-mesa"  min="1" max="200">
          </div>
        </div>

        <table>
          <thead>
            <tr>
              <th colspan="2" class="alimentos">Registrar Alimentos</th>
            </tr>
            <tr>
              <th  class="col-alimento">Alimento/Bebida</th>
              <th class="alimento">Cantidad</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in items" :key="index" style="cursor: pointer;">
            <td class="col-alimento">
              <div class="editable" contenteditable="true" v-text="item.food" @input="item.food = $event.target.innerText"></div>
            </td>

              <td><div class="editable" contenteditable="true" v-text="item.quantity" @input="item.quantity = $event.target.innerText"></div></td>
            </tr>
          </tbody>
        </table>
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
    <button class="popup-close-btn" @click="closeModal">X</button>
    <h2 class="popup-title">Registro de Pedido</h2>

    <div class="form-section">
  <div>
    <label for="modal-nombre" class="form-label">Nombre(s) del cliente</label>
    <input type="text" id="modal-nombre" v-model="modalNombre" placeholder="Nombre(s)" class="form-input nombre-input">
  </div>
  <div>
    <label for="modal-mesa" class="form-label">Mesa</label>
    <input type="text" id="modal-mesa" v-model="modalMesa" placeholder="Num.Mesa" class="form-input mesa-input" min="1" max="200">
  </div>
  <div>
    <label for="modal-apellido" class="form-label">Apellido(s) del cliente</label>
    <input type="text" id="modal-apellido" v-model="modalApellido" placeholder="Apellido(s)" class="form-input apellido-input">
  </div>
</div>
<div class="form-section">
      <div>
        <label for="modal-importe" class="form-label">Importe</label>
        <input type="number" id="modal-importe" v-model="modalImporte" placeholder="Importe total" class="form-input importe-input" min="0">
      </div>
      <div>
        <label for="modal-cambio" class="form-label">Cambio</label>
        <input type="number" id="modal-cambio" v-model="modalCambio" placeholder="Cambio" class="form-input cambio-input" min="0">
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

    <table class="popup-table">
      <thead>
        <tr>
          <th colspan="2" class="table-header" >Registrar Alimentos</th>
        </tr>
        <tr>
          <th class="table-column-header">Alimento/Bebida</th>
          <th class="table-column-header">Cantidad</th>
        </tr>
      </thead>
      <tbody>
      <tr v-for="(item, index) in modalItems" :key="index">
      <td class="table-cell">
        <div class="editable-cell" contenteditable="true" v-text="item.food" @input="item.food = $event.target.innerText"></div>
      </td>
      <td class="table-cell">
        <div class="editable-cell" contenteditable="true" v-text="item.quantity" @input="item.quantity = $event.target.innerText"></div>
      </td>
    </tr>
      </tbody>
    </table>
  </div>
</div>

  <script>
   const sidebarApp = Vue.createApp({
    data() {
      return {
        isModalOpen: false,
        isSidebarOpen: false,
        nombre: '',
          apellido: '',
          mesa: '',
          importe:'',
          metodo:'',
          cambio:'',
          items: [
            { food: '', quantity: ''},
            { food: '', quantity: ''},
            { food: '', quantity: ''},
          ],
          modalItems: [
            { food: '', quantity: ''},
            { food: '', quantity: ''},
            { food: '', quantity: ''},
          ], // Esta es la copia local de los datos de la tabla para el modal
        usuarios: [
          {
            id: 1,
            nombre: 'Alfredo Gomez',
            fecha: "03/Nov/2023 Domingo",
            numero: 98,
            estado: 'En espera',
            hora: '10:12 AM',
            total: 378.98,
            detalles: [
              { producto: 'Frijolito con puerquito', cantidad: 2, precio: 149.98 },
              { producto: 'Frijolito con puerquito', cantidad: 2, precio: 149.98 },
              { producto: 'Frijolito con puerquito', cantidad: 2, precio: 149.98 },
              { producto: 'Frijolito con puerquito', cantidad: 2, precio: 149.98 },

            ],
          },
          {
            id: 2,
            nombre: 'Alfredo Gomez',
            fecha: '03/Nov/2023 Domingo',
            numero: 98,
            estado: 'En espera',
            hora: '10:12 AM',
            total: 378.98,
            detalles: [
              { producto: 'Frijolito con puerquito', cantidad: 2, precio: 149.98 },
              { producto: 'Frijolito con puerquito', cantidad: 2, precio: 149.98 },
              { producto: 'Frijolito con puerquito', cantidad: 2, precio: 149.98 },
              { producto: 'Frijolito con puerquito', cantidad: 2, precio: 149.98 },
            ],
          },
        ],
      };
    },
    methods: {
        toggleSidebar() {
    this.isSidebarOpen = !this.isSidebarOpen;
  },
  closeSidebar() {
    this.isSidebarOpen = false;
  },
  openModal(usuario) {
    this.modalNombre = usuario.nombre; 
    this.modalApellido = usuario.apellido; 
    this.modalMesa = usuario.mesa;
    this.isModalOpen = true;
  },
  closeModal() {
    this.isModalOpen = false;
  },
    },
  }).mount('#app');
  </script>
</body>
</html>
