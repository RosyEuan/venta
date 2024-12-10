const { createApp } = Vue;
createApp({
  data() {
    return {
      isSidebarOpen: false,
      showModal: false,
      isEditing: false,
      editingItemId: null,
      nombre: '',
      categoria: '',
      precio: 0,
      descuento: 0,
      descripcion: '',
      precioConDescuento: 0,
      search: '',
      filter: 'all',
      menuItems: [],
      categorias: []
    };
  },
  computed: {
    filteredMenu() {
      const filteredBySearch = this.menuItems.filter((item) =>
        item.name.toLowerCase().includes(this.search.toLowerCase())
      );
      if (this.filter === 'all') return filteredBySearch;
      return filteredBySearch.filter((item) => item.category === this.filter);
    }
  },
  methods: {
    toggleSidebar() {
      this.isSidebarOpen = !this.isSidebarOpen;
    },
    closeSidebar() {
      this.isSidebarOpen = false;
    },
    editItem(id) {
      alert(`Editar platillo con ID: ${id}`);
    },
    deleteItem(id) {
      this.menuItems = this.menuItems.filter((item) => item.id !== id);
    },
    calcularPrecioConDescuento() {
      this.precioConDescuento =
        this.precio - (this.precio * this.descuento) / 100;
    },
    guardarCambios() {
      alert('Guardando cambios...');
      this.showModal = false;
    },
    setFilter(filter) {
      this.filter = filter;
    },
    closeModal() {
      this.showModal = false;
      this.resetForm();
    },
    resetForm() {
      this.isEditing = false;
      this.editingItemId = null;
      this.nombre = '';
      this.categoria = '';
      this.precio = 0;
      this.descuento = 0;
      this.descripcion = '';
      this.precioConDescuento = 0;
    },
    openAddModal() {
      // Limpiar datos para agregar nuevo
      this.resetForm();
      this.showModal = true;
    },
    openEditModal(item) {
      // Configurar datos para edición
      this.isEditing = true;
      this.showModal = true;
      this.editingItemId = item.id;
      this.nombre = item.name;
      this.categoria = item.category;
      this.precio = item.price;
      this.descuento = 0;
      this.descripcion = item.description;
      this.precioConDescuento = item.price; // Puedes ajustar según la lógica
    },
    saveChanges() {
      const data = {
        nombre_platillo: this.nombre,
        categorias_platillo: this.categoria,
        precio_platillo: this.precio,
        descuento_platillo: this.descuento,
        descripcion_platillo: this.descripcion,
        imagen: this.imagen_platillo
      };

      const url = this.isEditing
        ? 'http://localhost/venta/api/menu/actualizarplatillo'
        : 'http://localhost/venta/api/menu/guardarplatillo';

      // Enviar datos con AJAX
      $.ajax({
        url: url,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: (response) => {
          if (this.isEditing) {
            const index = this.menuItems.findIndex(
              (item) => item.id === this.editingItemId
            );
            if (index !== -1) {
              this.menuItems[index] = { ...response, id: this.editingItemId };
            }
          } else {
            this.menuItems.push(response);
          }
          console.log('Respuesta del servidor', response);
          alert(this.isEditing ? 'Platillo actualizado' : 'Platillo agregado');
          this.closeModal();
        },
        error: (xhr, status, error) => {
          console.error(
            'Error al hacer la solicitud:',
            xhr.responseText || error
          );
          alert(
            'Hubo un error al guardar el platillo: ' +
              (xhr.responseJSON?.message || 'Desconocido')
          );
        }
      });
    },
    fetchMenu() {
      $.ajax({
        url: 'http://localhost/venta/api/menu/mostrarplatillo',
        type: 'GET',
        dataType: 'json',
        success: (response) => {
          this.menuItems = response.map((platillo) => ({
            id: platillo.id_platillo,
            name: platillo.nombre_platillo,
            category: platillo.nombre_menu,
            price: platillo.precio,
            description: platillo.descripcion,
            discount: platillo.descuento,
            image: platillo.imagen_platillo
          }));
          console.log(response);
        },
        error: (xhr, status, error) => {
          console.error('Error al cargar el menú:', error);
          console.error(xhr.responseText);
          if (xhr.responseJSON && xhr.responseJSON.message) {
            console.error('Error dicho', xhr.responseJSON.message);
          }
          alert('Hubo un problema al cargar el menú.');
        }
      });
    }
  },
  mounted() {
    this.fetchMenu();
  }
}).mount('#app');
