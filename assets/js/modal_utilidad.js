const app = Vue.createApp({
  data() {
    return {
      isSidebarOpen: false,
      busqueda: '',
      productos: [
        {
          id: 1,
          utilidad: 'Estufa',
          proveedores: 'Prueba',
          fecha_adquisicion: '2024-11-24',
          cant: 5,
          estado: 'Nuevo'
        },
        {
          id: 2,
          utilidad: 'Cucharas',
          proveedores: 'Prueba',
          fecha_adquisicion: '2024-11-24',
          cant: 5,
          estado: 'Usado'
        },
        {
          id: 3,
          utilidad: 'Sillas',
          proveedores: 'Prueba',
          fecha_adquisicion: '2024-11-24',
          cant: 5,
          estado: 'Dañado'
        },
        {
          id: 4,
          utilidad: 'Mesas',
          proveedores: 'Prueba',
          fecha_adquisicion: '2024-11-24',
          cant: 5,
          estado: 'Usado'
        },
        {
          id: 5,
          utilidad: 'Computadoras',
          proveedores: 'Prueba',
          fecha_adquisicion: '2024-11-24',
          cant: 5,
          estado: 'Dañado'
        }
      ],
      mostrarModal: false,
      productoEditando: null,
      nuevoProducto: {
        utilidad: '',
        precio: '',
        cant: '',
        proveedores: '',
        descripcion: '',
        fecha_adquisicion: '',
        estado: ''
      }
    };
  },
  computed: {
    productosFiltrados() {
      return this.productos.filter((item) => {
        return (
          item.utilidad.toLowerCase().includes(this.busqueda.toLowerCase()) ||
          item.proveedores.toLowerCase().includes(this.busqueda.toLowerCase())
        );
      });
    },
    isFormValid() {
      return (
        this.nuevoProducto.utilidad &&
        this.nuevoProducto.precio &&
        this.nuevoProducto.cant &&
        this.nuevoProducto.proveedores &&
        this.nuevoProducto.descripcion &&
        this.nuevoProducto.fecha_adquisicion &&
        this.nuevoProducto.estado
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
    abrirModal() {
      this.productoEditando = null;
      this.mostrarModal = true;
      this.resetFormulario();
    },
    cerrarModal() {
      this.mostrarModal = false;
    },
    guardarProducto() {
      if (this.isFormValid) {
        if (this.productoEditando) {
          const index = this.productos.findIndex(
            (producto) => producto.id === this.productoEditando.id
          );
          if (index !== -1) {
            this.productos[index] = {
              ...this.productos[index],
              ...this.nuevoProducto
            };
          }
        } else {
          this.productos.push({
            ...this.nuevoProducto,
            id: this.productos.length + 1
          });
        }
        this.cerrarModal();
        this.resetFormulario();
      }
    },
    editarProducto(item) {
      this.productoEditando = item;
      this.nuevoProducto = { ...item };
      this.mostrarModal = true;
    },
    eliminarProducto(id) {
      this.productos = this.productos.filter((producto) => producto.id !== id);
    },
    resetFormulario() {
      this.nuevoProducto = {
        utilidad: '',
        precio: '',
        cant: '',
        proveedores: '',
        descripcion: '',
        fecha_adquisicion: '',
        estado: ''
      };
    }
  }
});
app.mount('#inventario_utilidades');
