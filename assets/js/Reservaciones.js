new Vue({
  el: '#container',
  data: {
    isSidebarOpen: false,
    form: {
      cliente: '',
      telefono: '',
      email: '',
      mesa: '',
      fecha: '',
      cantidad: 1,
      comentarios: ''
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
      events: [
        {
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
        }
      ],
      dateClick: (info) => {
        // Abre el modal con la fecha seleccionada
        this.openModal(info.dateStr); // Llamamos a la función openModal en Vue
      },
      eventClick: function (info) {
        var action = prompt('¿Quieres editar o eliminar el evento? (e/d)', 'e');
        if (action === 'e') {
          var newTitle = prompt('Editar título del evento:', info.event.title);
          if (newTitle) {
            info.event.setProp('title', newTitle);
          }
        } else if (action === 'd') {
          if (confirm('¿Seguro que deseas eliminar este evento?')) {
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
        events: [
          {
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
          }
        ],
        dateClick: function (info) {
          var title = prompt('Ingrese el título del evento:');
          if (title) {
            calendar.addEvent({
              title: title,
              start: info.dateStr,
              allDay: true
            });
          }
        },
        eventClick: function (info) {
          var action = prompt(
            '¿Quieres editar o eliminar el evento? (e/d)',
            'e'
          );
          if (action === 'e') {
            var newTitle = prompt(
              'Editar título del evento:',
              info.event.title
            );
            if (newTitle) {
              info.event.setProp('title', newTitle);
            }
          } else if (action === 'd') {
            if (confirm('¿Seguro que deseas eliminar este evento?')) {
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
        validRange: {
          // Rango válido de fechas sin restricciones
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
      },
      navLinks: true, // Permite hacer clic en una fecha para navegar
      eventDurationEditable: true, // Permite cambiar la duración de los eventos
      rerenderDelay: 10, // Asegura que la vista se actualice de inmediato cuando se cambie de vista
      validRange: {
        // Rango válido de fechas sin restricciones
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
      noEventsText: 'No hay eventos para mostrar'
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
      this.form.fecha = date + 'T00:00'; // Ajusta la fecha al formato que espera el input datetime-local
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
        cantidad: this.form.cantidad
      });

      alert('Reservación realizada:\n' + JSON.stringify(this.form, null, 2));
      this.cerrarModal(); // Cierra el modal después de hacer la reservación
    },
    guardarCambios() {
      alert('Cambios guardados:\n' + JSON.stringify(this.form, null, 2));
      this.cerrarModal();
    },
    cancelar() {
      this.form = {
        cliente: '',
        telefono: '',
        email: '',
        mesa: '',
        fecha: '',
        cantidad: 1,
        comentarios: ''
      };
      this.cerrarModal(); // Cierra el modal cuando se cancela
    }
  }
});

new Vue({
  el: '#reservacion',
  data: {
    form: {
      cliente: '',
      telefono: '',
      email: '',
      mesa: '',
      fecha: '',
      cantidad: 1,
      comentarios: ''
    }
  },
  methods: {
    reservar() {
      this.usuarios.push({
        cliente: this.form.cliente,
        mesa: this.form.mesa,
        hora: this.form.fecha.split('T')[1], // Obtiene solo la hora de la fecha
        fecha: this.form.fecha.split('T')[0], // Obtiene solo la fecha
        cantidad: this.form.cantidad
      });

      alert('Reservación realizada:\n' + JSON.stringify(this.form, null, 2));
      this.cerrarModal();
    },
    guardarCambios() {
      alert('Cambios guardados:\n' + JSON.stringify(this.form, null, 2));
      this.cerrarModal();
    },
    cancelar() {
      this.form = {
        cliente: '',
        telefono: '',
        email: '',
        mesa: '',
        fecha: '',
        cantidad: 1,
        comentarios: ''
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
