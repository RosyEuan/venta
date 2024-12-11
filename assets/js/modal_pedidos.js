const sidebarApp = Vue.createApp({
  data() {
    return {
      isModalOpen: false,
      isSidebarOpen: false,
      nombre: '',
      correo: '',
      mesa: '',
      importe: '',
      metodo: '',
      cambio: '',
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
    openModal(usuario) {
      this.modalNombre = usuario.nombre;
      this.modalcorreo = usuario.correo;
      this.modalMesa = usuario.mesa;
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    },
    registrarPedido(event) {
      event.preventDefault();

      const data = {
        registro_nombre: this.nombre,
        registro_correo: this.correo,
        registro_mesa: this.mesa,
        items: this.items
      };

      fetch('http://localhost/venta/api/pedidos', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === 'success') {
            alert('Pedido registrado correctamente');
            this.nombre = ''; // Limpiar campos
            this.correo = '';
            this.mesa = '';
            this.items = [
              { food: '', quantity: '' },
              { food: '', quantity: '' },
              { food: '', quantity: '' }
            ];
          } else {
            alert('Error: ' + data.message);
            console.error('Error en consola' + data.message);
          }
        })
        .catch((error) => {
          console.error('Error:', error);
          alert('Hubo un problema al registrar el pedido.');
        });
    }

    /*,

    actualizarUsuarios() {
      
    */
  }
}).mount('#app');
