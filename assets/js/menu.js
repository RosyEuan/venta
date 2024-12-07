const { createApp } = Vue;
createApp({
  data() {
    return {
      isSidebarOpen: false,
      showModal: false,
      isEditing: false, // Nueva variable para controlar el modo
      editingItemId: null, // ID del elemento que se está editando
      nombre: '',
      categoria: '',
      precio: 0,
      descuento: 0,
      descripcion: '',
      precioConDescuento: 0,
      search: '',
      filter: 'all',
      menuItems: [
        {
          id: 1,
          name: 'Tacos al pastor',
          price: 30.0,
          description:
            'Tortillas de maíz con carne de cerdo marinada en adobo, acompañados de piña fresca, cebolla y cilantro. Servidos con salsa verde o roja.',
          image: 'img/platillo1.png',
          category: 'postres'
        },
        {
          id: 2,
          name: 'Tacos de asada',
          price: 20.0,
          description:
            'Tortillas de maíz con carne asada de res, marinada en especias y a la parrilla. Acompañados de cebolla, cilantro y salsa al gusto.',
          image: 'img/platillo2.png',
          category: 'bebidas'
        }
      ]
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
    setFilter(filter) {
      this.filter = filter;
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
      this.resetNewEmployee();
    },
    openAddModal() {
      // Limpiar datos para agregar nuevo
      this.isEditing = false;
      this.showModal = true;
      this.nombre = '';
      this.categoria = '';
      this.precio = 0;
      this.descuento = 0;
      this.descripcion = '';
      this.precioConDescuento = 0;
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
      if (this.isEditing) {
        // Editar el elemento existente
        const index = this.menuItems.findIndex(
          (item) => item.id === this.editingItemId
        );
        if (index !== -1) {
          this.menuItems[index] = {
            id: this.editingItemId,
            name: this.nombre,
            category: this.categoria,
            price: this.precio,
            description: this.descripcion,
            image: 'img/platillo1.png' // Puedes implementar lógica para cambiar la imagen
          };
        }
      } else {
        // Agregar un nuevo elemento
        const newItem = {
          id: this.menuItems.length + 1,
          name: this.nombre,
          category: this.categoria,
          price: this.precio,
          description: this.descripcion,
          image: 'img/platillo1.png' // Puedes implementar lógica para cargar la imagen
        };
        this.menuItems.push(newItem);
      }
      this.showModal = false;
    }
  }
}).mount('#app');
