<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reservaciones</title>
  <!-- FullCalendar CSS -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

  <link rel="stylesheet" href="/venta/assets/css/style_reservas.css">
</head>

<body>
  <div id="container">
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
    <div class="contenido">
      <div class="sep"></div>
      <div id="calendar"></div>
      <!-- <div id="user-list">
  <div id="search-bar">
    <input type="text" placeholder="Buscar cliente" class="search-bar">
    <button>
      <i class="fas fa-search"></i>
    </button>
  </div>
  <!-- Lista de usuarios
  <div v-for="(usuario, index) in usuarios" :key="index" class="user-card">
    <div>
      <h4 class="nombre">{{ usuario.cliente }}</h4>
      <p class="nomm">Invitados: {{ usuario.cantidad }} | Mesa: {{ usuario.mesa }}</p>
      <p class="nomm">Hora: {{ usuario.hora }} | Fecha: {{ usuario.fecha }}</p>
    </div>
    <div class="action-buttons">
      <button class="edit-button" @click="openModal(usuario.cliente, usuario.mesa, usuario.hora, usuario.fecha)">Modificar</button>
      <button class="delete-button" @click="eliminarUsuario(index)">Eliminar</button>
    </div>
  </div>
</div> -->

      <div id="user-list">
        <div id="search-bar">
          <input type="text" placeholder="Buscar cliente" class="search-bar">
          <button>
            <i class="fas fa-search"></i>
          </button>
        </div>
        <!-- Lista de usuarios  -->
        <div id="lista-usuarios">
          <div class="user-card">
            <div>
              <h4 class="nombre">Rosy Euan</h4>
              <p class="nomm">Invitados: 3 | Mesa: B3</p>
              <p class="nomm">Hora: 6:15 PM | Fecha: 19/Dic/2024</p>
            </div>
            <div class="action-buttons">
              <button class="edit-button"
                onclick="openModal('Rosy Euan', 'B3', '6:15 PM', '19/Dic/2024')">Modificar</button>
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
              <button class="edit-button"
                onclick="openModal('Salem Ojeda', 'D4', '6:30 PM', '2/Dic/2024')">Modificar</button>
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
              <button class="edit-button"
                onclick="openModal('Shaiel Saucedo', 'E1', '6:35 PM', '1/Ene/2025')">Modificar</button>
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
              <button class="edit-button"
                onclick="openModal('Dania Botello', 'B2', '7:00 PM', '6/Ene/2025')">Modificar</button>
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
              <button class="edit-button"
                onclick="openModal('Angel Chi', 'Pendiente', '7:30 PM', '30/Ene/2025')">Modificar</button>
              <button class="delete-button" onclick="eliminarUsuario(5)">Eliminar</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  </div>

  <!-- Modal de Reservación -->
  <div id="modal" class="modal">
    <div class="modal-content">
      <div id="reservacion" class="form-container">
        <button type="submit" class="close-btn" @click="cancelar">X</button>
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
          <button class="btn_reservar" @click="reservar">Reservar</button>
          <button class="btn_cancelar" @click="cancelar">Cancelar</button>
          <button class="btn_guardar" @click="guardarCambios">Guardar Cambios</button>
        </div>
      </div>
    </div>
  </div>

  <!-- FullCalendar JS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.5/main.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

  <script>
    new Vue({
      el: "#container",
      data: {
        isSidebarOpen: false,
        form: {
          cliente: "",
          telefono: "",
          email: "",
          mesa: "",
          fecha: "",
          cantidad: 1,
          comentarios: ""
        },
        usuarios: []
      },
      mounted() {
        const savedState = localStorage.getItem('sidebarOpen');
        this.isSidebarOpen = savedState === 'true';

        // Aquí inicializamos el calendario de FullCalendar y lo vinculamos al método Vue
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
          },
          locale: 'es',
          events: [{
              title: 'Evento 1',
              start: '2024-12-01'
            },
            {
              title: 'Evento 2',
              start: '2024-12-07',
              end: '2024-12-10'
            },
            {
              title: 'Evento 3',
              start: '2024-12-15'
            },
          ],
          dateClick: (info) => {
            // Abre el modal con la fecha seleccionada
            this.openModal(info.dateStr); // Llamamos a la función openModal en Vue
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
              titleFormat: {
                month: 'long',
                year: 'numeric'
              }
            },
            locale: 'es',
            events: [{
                title: 'Evento 1',
                start: '2024-12-01'
              },
              {
                title: 'Evento 2',
                start: '2024-12-07',
                end: '2024-12-10'
              },
              {
                title: 'Evento 3',
                start: '2024-12-15'
              },
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
                titleFormat: {
                  month: 'long',
                  year: 'numeric'
                }
              },
              timeGridWeek: {
                titleFormat: {
                  week: 'long'
                },
                slotDuration: '00:30:00' // Intervalo de 30 minutos
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
            datesSet: function(info) {
              var titleElement = document.querySelector('.fc-toolbar-title');
              titleElement.style.cursor = 'pointer';
              titleElement.onclick = function() {
                showMonthPicker(info.start);
              };
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
        });

        // Renderizar el calendario
        calendar.render();
      },
      methods: {
        toggleSidebar() {
          this.isSidebarOpen = !this.isSidebarOpen;
          localStorage.setItem('sidebarOpen', this.isSidebarOpen);
        },
        closeSidebar() {
          this.isSidebarOpen = false;
          localStorage.setItem('sidebarOpen', this.isSidebarOpen);
        },
        openModal(date) {
          // Abre el modal de reservación y rellena la fecha seleccionada
          document.getElementById('modal').style.display = 'flex';
          this.form.fecha = date + "T00:00"; // Ajusta la fecha al formato que espera el input datetime-local
        },
        cerrarModal() {
          document.getElementById('modal').style.display = 'none';
        },
        reservar() {
          // Añadir la nueva reservación a la lista de usuarios
          this.usuarios.push({
            cliente: this.form.cliente,
            mesa: this.form.mesa,
            hora: this.form.fecha.split('T')[1], // Solo la hora
            fecha: this.form.fecha.split('T')[0], // Solo la fecha
            cantidad: this.form.cantidad,
          });

          alert("Reservación realizada:\n" + JSON.stringify(this.form, null, 2));
          this.cerrarModal(); // Cierra el modal después de hacer la reservación
        },
        guardarCambios() {
          alert("Cambios guardados:\n" + JSON.stringify(this.form, null, 2));
          this.cerrarModal();
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
          this.cerrarModal(); // Cierra el modal cuando se cancela
        }
      }
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
          this.usuarios.push({
            cliente: this.form.cliente,
            mesa: this.form.mesa,
            hora: this.form.fecha.split('T')[1], // Obtiene solo la hora de la fecha
            fecha: this.form.fecha.split('T')[0], // Obtiene solo la fecha
            cantidad: this.form.cantidad,
          });

          alert("Reservación realizada:\n" + JSON.stringify(this.form, null, 2));
          this.cerrarModal();
        },
        guardarCambios() {
          alert("Cambios guardados:\n" + JSON.stringify(this.form, null, 2));
          this.cerrarModal();
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
</body>

</html>