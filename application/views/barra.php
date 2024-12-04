<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Punto de Venta</title>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">

  <style>
    /*body {
      margin: 0;
      padding: 0;
      display: flex;
      font-family: 'Merriweather';
      background-color: #f8f8f8;
      overflow-x: hidden;
    }*/

    /* Barra lateral */
    .sidebar {
      width: 60px;
      height: 100vh;
      background-color: #2A236A;
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
      color: white;
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
      width: 92%;
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
      color: white;
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
      border-top: 0 solid #ddd;
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
      color: white;
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

    .sidebar.open~.content {
      margin-left: 250px;
    }

    body {
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    height: 100vh;
    background-color: #090A18;
  }

  #container {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    width: 90%;
    max-width: 1300px;
    margin-top: 0%; /* Ajuste del margen superior */
  }

  #calendar {
    width: 60%;
    background-color: #222;
    color: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    margin-right: 20px;
    margin-top:3%;
  }


  #user-list {
    width: 50%; /* Aumentamos el ancho de la lista de usuarios */
    padding: 20px;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 0%; /* Eliminamos el margen superior o lo ajustamos según necesidad */
    height: 688px; /* Dejamos que el contenedor crezca según el contenido */
    overflow-y: auto; /* Eliminamos la barra de desplazamiento */
    padding-left:50x;
  }

  #search-bar {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    margin-left:30px;
    
  }

  #search-bar input {
    flex: 1;
    padding: 12px 18px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 1.2em;
    background-color: rgba(247, 247, 247, 1);
    font-family: "EB Garamond";
    font-size: 24px;
  }

  #search-bar button {
    position: relative;
    padding: 12px;
    border: none;
    border-radius: 10px;
    background-color: transparent;
    font-size: 1.3em;
    cursor: pointer;
    right: 50px;
  }
  #search-bar input:focus {
    background-color: #e0e0e0;
  }
  #search-bar i {
    position: relative;
    left: 0px;
    font-size: 18px;
    color: #aaa;
  }

  .user-card {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    border: 1px solid #ccc;
    padding: 20px;
    margin-bottom: 0px; /* Ajuste en el margen entre tarjetas */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: white;
    transition: box-shadow 0.3s;
  }

  .user-card:hover {
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
  }

  .user-card h4 {
    margin: 0;
    font-size: 24px; /* Ajusté el tamaño del texto */
    font-weight: bold;
    color: #333;
  }

  .user-card p {
    margin: 5px 0;
    font-size: 16px;
    color: #555;
  }

  .action-buttons {
    display: flex;
    flex-direction: column;
    gap: 10px;
    align-items: flex-end;
    
    
  }

  .action-buttons button {
    padding: 12px 25px;
    font-size: 0.8em; /* Ajusté el tamaño de los botones */
    border: none;
    border-radius: 8px;
    cursor: pointer;
    width: 120px; /* Ajusté el ancho de los botones */
    font-size: 16px;
  }

  .edit-button {
    background-color: #322A7FF2;
    color: #F7F7F7;
    font-family: "EB Garamond";
    font-size: 20px;

  }

  .delete-button {
    background-color: #DC730A;
    color: white;
    font-family: "EB Garamond";
    font-size: 20px;

  }

  /* Estilos del modal */
  .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    justify-content: center;
    align-items: center;
  }

  .modal-content {
    background-color: white;
padding: 20px; /* Aumenta el padding para dar espacio */
border-radius: 8px;
width: 70%; /* Ocupará el 80% del ancho de la pantalla */
max-width: 1000px; /* Limita el ancho máximo */
height: auto;
max-height: 100vh;
overflow-y: auto;
display: flex;
flex-direction: column;
justify-content: flex-start;
align-items: center;
box-sizing: border-box; /* Asegura que el padding no afecte el ancho total */
overflow: hidden;
  }

  .form-container {
    background: #f7f7f7;
border: 2px solid #000; /* Bordes más visibles */
width: 100%; /* Ajusta el formulario al ancho del modal */
padding: 20px; /* Espacio interno para separar los elementos del borde */
box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
color: #000;
border-radius: 8px;
box-sizing: border-box; /* Asegura que los bordes y el padding estén incluidos */
  }

  .form-container h1 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
  }

  .form-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }

  .form-column {
    width: 48%;
  }

  .form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
    font-family: 'EB Garamond';
font-size: 24px;
  }

  .form-group label {
    margin-bottom: 5px;
    font-weight: bold;
    
  }

  .form-group input,
  .form-group textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: rgba(81, 92, 100, 0.3);
    font-family: "EB Garamond";
    font-size: 16px;
  }

  .form-group textarea {
    resize: none;
    height: 100px;
  }

  .buttons {
    display: flex;
    justify-content: space-around;
    margin-top: 30px;
  }

  .buttons button {
    width: 30%;
    padding: 10px;
    border: none;
    border-radius: 16px;
    font-size: 24px;
    cursor: pointer;
  }

  .btn-reservar,
  .btn-guardar {
    background-color: #E8EC07;
    color: black;
    font-family: "EB Garamond";

  }

  .btn-cancelar {
    background-color: #DC730A;
    color: black;
    margin-top: 15px;
    font-family: "EB Garamond";

  }
  .nombre{
      font-family: "EB Garamond";
      
  }
  .nomm{
      font-family: "Maname";
  }
  .til{
    font-family: 'EB Garamond';
font-size: 28px;
text-align:center;
  }
  </style>
</head>

<body>
  <div id="app">
    <div :class="['sidebar', { open: isSidebarOpen }]">
      <button class="toggle-btn" @click="toggleSidebar">☰</button>
      <div class="logo">
        <img src="img/LogoCytisum.png" alt="Logo" @click="closeSidebar">
      </div>
      <ul>
        <li>
          <a href="#">
            <img src="img/Barras.png" alt="Reportes"><span>Reportes</span>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/Mesa.png" alt="Mesas"><span>Mesas</span>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/Reservas.png" alt="Reservaciones"><span>Reservaciones</span>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/Menus.png" alt="Menú"><span>Menú</span>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/Pedido.png" alt="Pedidos"><span>Pedidos</span>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/Inventarios.png" alt="Inventario"><span>Inventario</span>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/Personales.png" alt="Personal"><span>Personal</span>
          </a>
        </li>
      </ul>
      <div class="bottom-icons" :class="{ hidden: isSidebarOpen }">
        <img src="img/Admin.png" alt="Usuario">
        <img src="img/Logout.png" alt="Salir">
      </div>
      <div class="admin-info" :class="{ hidden: !isSidebarOpen }">
        <img src="img/Admin.png" alt="Usuario">
        <span>Angel Chi<br>Administrador</span>
      </div>
    </div>
  </div>
  <div id="container">
    <div id="calendar"></div>

    <div id="user-list">
      <div id="search-bar">
        <input type="text" placeholder="Buscar cliente" class="search-bar">
        <button>
        <i class="fas fa-search"></i>
        </button>
      </div>
      <!-- Lista de usuarios -->
      <div class="user-card">
        <div>
          <h4 class="nombre">Rosy Euan</h4>
          <p class="nomm">Invitados: 3 | Mesa: B3</p>
          <p class="nomm">Hora: 6:15 PM | Fecha: 19/Dic/2024</p>
        </div>
        <div class="action-buttons">
          <button class="edit-button" onclick="openModal('Rosy Euan', 'B3', '6:15 PM', '19/Dic/2024')">Modificar</button>
          <button class="delete-button" onclick="eliminarUsuario(1)">Eliminar</button>
        </div>
      </div>
      <div class="user-card">
        <div>
          <h4 class="nombre">Salem Ojeda</h4>
          <p class="nomm">Invitados: 2 | Mesa: D4</p>
          <p class="nomm">Hora: 6:30 PM | Fecha: 2/Dic/2024</p>
        </div>
        <div class="action-buttons">
          <button class="edit-button" onclick="openModal('Salem Ojeda', 'D4', '6:30 PM', '2/Dic/2024')">Modificar</button>
          <button class="delete-button" onclick="eliminarUsuario(2)">Eliminar</button>
        </div>
      </div>
      <div class="user-card">
        <div>
          <h4 class="nombre">Shaiel Saucedo</h4>
          <p class="nomm">Invitados: 8 | Mesa: E1</p>
          <p class="nomm">Hora: 6:35 PM | Fecha: 1/Ene/2025</p>
        </div>
        <div class="action-buttons">
          <button class="edit-button" onclick="openModal('Shaiel Saucedo', 'E1', '6:35 PM', '1/Ene/2025')">Modificar</button>
          <button class="delete-button" onclick="eliminarUsuario(3)">Eliminar</button>
        </div>
      </div>
      <div class="user-card">
        <div>
          <h4 class="nombre">Dania Botello</h4>
          <p class="nomm">Invitados: 4 | Mesa: B2</p>
          <p class="nomm">Hora: 7:00 PM | Fecha: 6/Ene/2025</p>
        </div>
        <div class="action-buttons">
          <button class="edit-button" onclick="openModal('Dania Botello', 'B2', '7:00 PM', '6/Ene/2025')">Modificar</button>
          <button class="delete-button" onclick="eliminarUsuario(4)">Eliminar</button>
        </div>
      </div>
      <div class="user-card">
        <div>
          <h4 class="nombre">Angel Chi</h4>
          <p class="nomm">Invitados: 4 | Mesa: Pendiente</p>
          <p class="nomm">Hora: 7:30 PM | Fecha: 30/Ene/2025</p>
        </div>
        <div class="action-buttons">
          <button class="edit-button" onclick="openModal('Angel Chi', 'Pendiente', '7:30 PM', '30/Ene/2025')">Modificar</button>
          <button class="delete-button" onclick="eliminarUsuario(5)">Eliminar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de Reservación -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <div id="reservacion" class="form-container">
        <h2 class="til">Agregar Reservación</h2>
        <div class="form-row">
          <div class="form-column">
            <div class="form-group">
              <label for="cliente">Cliente:</label>
              <input type="text" id="cliente" v-model="form.cliente">
            </div>
            <div class="form-group">
              <label for="telefono">Teléfono:</label>
              <input type="text" id="telefono" v-model="form.telefono">
            </div>
            <div class="form-group">
              <label for="fecha">Fecha y hora:</label>
              <input type="datetime-local" id="fecha" v-model="form.fecha">
            </div>
          </div>
          <div class="form-column">
            <div class="form-group">
              <label for="mesa">Mesa asignada:</label>
              <input type="text" id="mesa" v-model="form.mesa">
            </div>
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="email" id="email" v-model="form.email">
            </div>
            <div class="form-group">
              <label for="cantidad">Cantidad de personas:</label>
              <input type="number" id="cantidad" v-model="form.cantidad">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="comentarios">Comentarios:</label>
          <textarea id="comentarios" v-model="form.comentarios"></textarea>
        </div>

        <div class="buttons">
          <button class="btn-reservar" @click="reservar">Reservar</button>
          <button class="btn-cancelar" @click="cancelar">Cancelar</button>
          <button class="btn-guardar" @click="guardarCambios">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>

  <!-- FullCalendar JS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>

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

  document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var searchBar = document.getElementById('search-bar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek'
      },
      locale: 'es',
      events: [
        { title: 'Evento 1', start: '2024-12-01' },
        { title: 'Evento 2', start: '2024-12-07', end: '2024-12-10' },
        { title: 'Evento 3', start: '2024-12-15' },
      ],
      dateClick: function(info) {
        var title = prompt("Ingrese el título del evento:");
        if (title) {
          calendar.addEvent({
            title: title,
            start: info.dateStr,
            allDay: true
          });
        }
      },
      eventClick: function(info) {
        var action = prompt('¿Quieres editar o eliminar el evento? (e/d)', 'e');
        if (action === 'e') {
          var newTitle = prompt("Editar título del evento:", info.event.title);
          if (newTitle) {
            info.event.setProp('title', newTitle);
          }
        } else if (action === 'd') {
          if (confirm("¿Seguro que deseas eliminar este evento?")) {
            info.event.remove();
          }
        }
      },
      editable: true,
      selectable: true,
      nowIndicator: true,
      eventTimeFormat: {
        hour: '2-digit',
        minute: '2-digit',
        meridiem: 'short'
      },
      views: {
        dayGridMonth: {
          titleFormat: { month: 'long', year: 'numeric' }
        },
        timeGridWeek: {
          titleFormat: { week: 'long' },
          slotDuration: '00:30:00'  // Intervalo de 30 minutos
        }
      },
      navLinks: true, // Permite hacer clic en una fecha para navegar
      eventDurationEditable: true, // Permite cambiar la duración de los eventos
      rerenderDelay: 10, // Asegura que la vista se actualice de inmediato cuando se cambie de vista
      validRange: { // Rango válido de fechas sin restricciones
        start: '1900-01-01',
        end: '2099-12-31'
      },
      buttonText: {
        today: 'Hoy',
        month: 'Mes',
        week: 'Semana',
        day: 'Día',
        list: 'Lista'
      },
      allDayText: 'Todo el día', 
      noEventsText: 'No hay eventos para mostrar', 

      // Evento que se ejecuta después de cargar el calendario
      datesSet: function (info) {
        var titleElement = document.querySelector('.fc-toolbar-title');
        titleElement.style.cursor = 'pointer';
        titleElement.onclick = function () {
          showMonthPicker(info.start);
        };
      }
    });

    calendar.render();

    function showMonthPicker(currentDate) {
      var monthPicker = document.createElement('div');
      monthPicker.id = 'month-picker';
      monthPicker.style.position = 'absolute';
      monthPicker.style.background = 'white';
      monthPicker.style.border = '1px solid #ccc';
      monthPicker.style.padding = '10px';
      monthPicker.style.zIndex = '1000';
      monthPicker.style.boxShadow = '0 4px 6px rgba(0,0,0,0.1)';
      monthPicker.style.borderRadius = '8px';

      // Crear el selector de años
      var yearSelector = document.createElement('select');
      yearSelector.style.width = '100%';
      yearSelector.style.padding = '5px';
      yearSelector.style.marginBottom = '10px';
      var currentYear = currentDate.getFullYear();

      // Rango de años para seleccionar
      for (let i = currentYear - 5; i <= currentYear + 5; i++) {
        var option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        if (i === currentYear) option.selected = true;
        yearSelector.appendChild(option);
      }

      // Crear selector de meses
      var monthSelector = document.createElement('select');
      monthSelector.style.width = '100%';
      monthSelector.style.padding = '5px';
      monthSelector.style.marginBottom = '10px';

      for (let i = 0; i < 12; i++) {
        var option = document.createElement('option');
        option.value = i;
        option.textContent = new Date(0, i).toLocaleString('es', { month: 'long' });
        if (i === currentDate.getMonth()) option.selected = true;
        monthSelector.appendChild(option);
      }

      monthSelector.onchange = function() {
        updateMonthGrid(parseInt(yearSelector.value), parseInt(monthSelector.value));
      };

      monthPicker.appendChild(yearSelector);
      monthPicker.appendChild(monthSelector);

      document.body.appendChild(monthPicker);

      // Posicionar el selector cerca del título
      var titleElement = document.querySelector('.fc-toolbar-title');
      var rect = titleElement.getBoundingClientRect();
      monthPicker.style.top = `${rect.bottom + window.scrollY + 5}px`;
      monthPicker.style.left = `${rect.left + window.scrollX}px`;
    }

    function updateMonthGrid(year, month) {
      // Cambia la fecha del calendario para el mes seleccionado
      calendar.gotoDate(new Date(year, month)); // El mes se ajusta porque es base 0
    }

  });

  var searchBar = document.querySelector('.search-bar');

  searchBar.addEventListener('input', function () {
    var query = searchBar.value.toLowerCase();
    var userCards = document.querySelectorAll('.user-card');

    userCards.forEach(card => {
      var userName = card.querySelector('h4')?.textContent.toLowerCase() || '';
      var userDetails = card.querySelectorAll('p');
      var userText = Array.from(userDetails).map(p => p.textContent.toLowerCase()).join(' ');

      if (userName.includes(query) || userText.includes(query)) {
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });
  });

  // Eliminar usuario cuando se hace clic en el botón "Eliminar"
  document.querySelectorAll('.delete-button').forEach(button => {
    button.addEventListener('click', function() {
      // Eliminar el "user-card" que contiene este botón
      var userCard = button.closest('.user-card');
      if (userCard) {
        userCard.remove();
      }
    });
  });

  new Vue({
    el: "#reservacion",
    data: {
      form: {
        cliente: "",
        telefono: "",
        email: "",
        mesa: "",
        fecha: "",
        cantidad: 1,
        comentarios: ""
      }
    },
    methods: {
      reservar() {
        alert("Reservación realizada:\n" + JSON.stringify(this.form, null, 2));
        this.cerrarModal(); // Cierra el modal después de reservar
      },
      guardarCambios() {
        alert("Cambios guardados:\n" + JSON.stringify(this.form, null, 2));
        this.cerrarModal(); // Cierra el modal después de guardar los cambios
      },
      cancelar() {
        this.form = {
          cliente: "",
          telefono: "",
          email: "",
          mesa: "",
          fecha: "",
          cantidad: 1,
          comentarios: ""
        };
        this.cerrarModal(); // Cierra el modal al cancelar
      },
      cerrarModal() {
        document.getElementById('modal').style.display = 'none';
      }
    }
  });

  function openModal(cliente, mesa, hora, fecha) {
    document.getElementById('modal').style.display = 'flex';
    document.getElementById('cliente').value = cliente;
    document.getElementById('mesa').value = mesa;
    document.getElementById('fecha').value = hora;
    document.getElementById('fecha').value = fecha;
  }
</script>


  <script>
    

  </script>



</body>

</html>