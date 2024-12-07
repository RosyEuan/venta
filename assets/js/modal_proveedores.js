const app = Vue.createApp({
  data() {
    return {
      isSidebarOpen: false,
      isModalVisible: false,
      isEditing: false,
      searchQuery: '',
      proveedor: { id: null, nombre: '', telefono: '', correo: '' },
      productos: [
        {
          id: 1,
          nombre: 'Proovedor',
          telefono: '9252894503',
          correo: 'prueba@gmail.com'
        },
        {
          id: 2,
          nombre: 'Prueba',
          telefono: '9252894503',
          correo: 'prueba@gmail.com'
        },
        {
          id: 3,
          nombre: 'Admin',
          telefono: '9252894503',
          correo: 'prueba@gmail.com'
        },
        {
          id: 4,
          nombre: 'Empleado',
          telefono: '9252894503',
          correo: 'prueba@gmail.com'
        },
        {
          id: 5,
          nombre: 'Prueba',
          telefono: '9252894503',
          correo: 'prueba@gmail.com'
        }
      ]
    };
  },
  computed: {
    filteredProducts() {
      return this.productos.filter((item) =>
        Object.values(item).some((val) =>
          val.toString().toLowerCase().includes(this.searchQuery.toLowerCase())
        )
      );
    }
  },
  methods: {
    toggleSidebar() {
      this.isSidebarOpen = !this.isSidebarOpen;
    },
    closeSidebar() {
      this.isSidebarOpen = false;
    },
    openModal() {
      this.isModalVisible = true;
      this.isEditing = false;
      this.proveedor = { id: null, nombre: '', telefono: '', correo: '' };
    },
    closeModal() {
      this.isModalVisible = false;
    },
    agregarProveedor() {
      // Verificar si todos los campos están llenos
      if (
        !this.proveedor.nombre ||
        !this.proveedor.telefono ||
        !this.proveedor.correo
      ) {
        return;
      }
      // Generar un ID único basado en el mayor ID actual
      const nuevoId =
        this.productos.length > 0
          ? Math.max(...this.productos.map((item) => item.id)) + 1
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
      const index = this.productos.findIndex(
        (item) => item.id === this.proveedor.id
      );
      if (index !== -1) {
        this.productos[index] = { ...this.proveedor };
      }
      this.closeModal();
    },
    deleteProveedor(id) {
      this.productos = this.productos.filter((item) => item.id !== id);
    }
  }
});
app.mount('#inventario_proveedores');
