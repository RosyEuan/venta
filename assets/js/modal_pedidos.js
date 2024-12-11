const sidebarApp = Vue.createApp({
  data() {
    return {
      isModalOpen: false,
      isSidebarOpen: false,
      nombre: '',
      apellido: '',
      mesa: '',
      importe: '',
      metodo: '',
      cambio: '',
      platillos: [],
      items: [
        { food: '', quantity: '' },
        { food: '', quantity: '' },
        { food: '', quantity: '' }
      ],
      modalItems: [
        { food: '', quantity: '' },
        { food: '', quantity: '' },
        { food: '', quantity: '' }
      ], // Esta es la copia local de los datos de la tabla para el modal
      usuarios: [
        {
          id: 1,
          nombre: 'Alfredo Gomez',
          fecha: '03/Nov/2023 Domingo',
          numero: 98,
          estado: 'En espera',
          hora: '10:12 AM',
          total: 378.98,
          detalles: [
            {
              producto: 'Frijolito con puerquito',
              cantidad: 2,
              precio: 149.98
            },
            {
              producto: 'Frijolito con puerquito',
              cantidad: 2,
              precio: 149.98
            },
            {
              producto: 'Frijolito con puerquito',
              cantidad: 2,
              precio: 149.98
            },
            { producto: 'Frijolito con puerquito', cantidad: 2, precio: 149.98 }
          ]
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
            {
              producto: 'Frijolito con puerquito',
              cantidad: 2,
              precio: 149.98
            },
            {
              producto: 'Frijolito con puerquito',
              cantidad: 2,
              precio: 149.98
            },
            {
              producto: 'Frijolito con puerquito',
              cantidad: 2,
              precio: 149.98
            },
            { producto: 'Frijolito con puerquito', cantidad: 2, precio: 149.98 }
          ]
        }
      ]
    };
  },
  methods: {
    toggleSidebar() {
      this.isSidebarOpen = !this.isSidebarOpen;
    },
    closeSidebar() {
      this.isSidebarOpen = false;
    },
    cargarPlatillos() {
      const url = $('#platillo').data('controller1');
      $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: (response) => {
          if (response.status === 'success') {
            this.platillos = response.data;
          } else {
            alert('No se pudieron cargar los platillos');
          }
        },
        error: (jqXHR, textStatus, error) => {
          console.error('Error al cargar los platillos:', textStatus, error);
        }
      });
    },
    openModal(usuario) {
      this.modalNombre = usuario.nombre;
      this.modalApellido = usuario.apellido;
      this.modalMesa = usuario.mesa;
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    }
  },
  mounted() {
    this.cargarPlatillos();
  }
}).mount('#app');
