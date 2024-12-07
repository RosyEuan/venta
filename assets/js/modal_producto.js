const app = Vue.createApp({
  data() {
    return {
      isSidebarOpen: false,
      productos: [
        { id: 1, producto: 'Pollo asado', proveedores: 'Prueba', cantidad: 5 },
        { id: 2, producto: 'Panuchos', proveedores: 'Prueba', cantidad: 5 },
        {
          id: 3,
          producto: 'Tacos al pastor',
          proveedores: 'Prueba',
          cantidad: 5
        },
        { id: 4, producto: 'Pollo asado', proveedores: 'Prueba', cantidad: 5 },
        { id: 5, producto: 'Pollo asado', proveedores: 'Prueba', cantidad: 5 }
      ],
      textoBusqueda: '', // Agregamos una variable para almacenar el texto de búsqueda
      modalActivo: false,
      nuevoProducto: {
        producto: '',
        proveedores: '',
        cantidad: '',
        precio: ''
      },
      productoSeleccionado: null, // Producto actualmente seleccionado para editar
      editando: false // Estado que indica si el modal está en modo edición
    };
  },
  computed: {
    productosFiltrados() {
      const texto = this.textoBusqueda.toLowerCase();
      return this.productos.filter(
        (producto) =>
          producto.producto.toLowerCase().includes(texto) ||
          producto.proveedores.toLowerCase().includes(texto)
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
      this.modalActivo = true;
      this.nuevoProducto = {
        producto: '',
        proveedores: '',
        cantidad: '',
        precio: ''
      };
      this.editando = false; // Aseguramos que no esté en modo edición
    },
    abrirModalEditar(producto) {
      // Preparar el modal para editar el producto seleccionado
      this.productoSeleccionado = producto; // Guardar referencia al producto original
      this.nuevoProducto = { ...producto }; // Crear una copia para edición
      this.editando = true;
      this.modalActivo = true;
    },
    agregarOEditarProducto() {
      // Verificar que todos los campos estén completos
      if (
        !this.nuevoProducto.producto ||
        !this.nuevoProducto.proveedores ||
        !this.nuevoProducto.cantidad ||
        !this.nuevoProducto.precio
      ) {
        return; // No hacer nada si algún campo está vacío
      }
      if (this.editando) {
        // Actualizar producto existente
        const index = this.productos.findIndex(
          (p) => p.id === this.productoSeleccionado.id
        );
        if (index !== -1) {
          this.productos[index] = { ...this.nuevoProducto }; // Actualizar producto en la lista
        }
      } else {
        // Agregar un nuevo producto
        const nuevoId = this.productos.length + 1;
        this.productos.push({ id: nuevoId, ...this.nuevoProducto });
      }
      // Resetear estado y cerrar modal
      this.cerrarModal();
    },
    cerrarModal() {
      this.modalActivo = false;
      this.nuevoProducto = {
        producto: '',
        proveedores: '',
        cantidad: '',
        precio: ''
      };
      this.productoSeleccionado = null;
      this.editando = false;
    },
    agregarProducto() {
      // Verificar que todos los campos estén completos
      if (
        !this.nuevoProducto.producto ||
        !this.nuevoProducto.proveedores ||
        !this.nuevoProducto.cantidad ||
        !this.nuevoProducto.precio
      ) {
        return; // No hacer nada si algún campo está vacío
      }
      const nuevoId = this.productos.length + 1;
      this.productos.push({ id: nuevoId, ...this.nuevoProducto });
      // Limpiar los campos del formulario
      this.nuevoProducto = {
        producto: '',
        proveedores: '',
        cantidad: '',
        precio: ''
      };
      this.cerrarModal();
    },
    eliminarProducto(id) {
      console.log('Eliminando producto con ID:', id); // Verificar que se ejecuta
      // Filtro para eliminar el producto con el ID especificado
      this.productos = this.productos.filter((producto) => producto.id !== id);
    }
  }
});
app.mount('#inventario_productos');
