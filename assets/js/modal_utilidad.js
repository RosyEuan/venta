const app = Vue.createApp({
  data() {
    return {
      isSidebarOpen: false,
      busqueda: '',
      productos: [],
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
    cargarUtilidades() {
      // Obtener la URL del atributo data-controller
      const url = $('#utilidades').data('controller');
      
      // Realizar la solicitud AJAX
      $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: (response) => {
          if (response.status === 'success') {
            // Guardar los datos en la variable productos
            this.productos = response.data.map((utilidad) => ({
              id: utilidad.ID,
              utilidad: utilidad.Utilidad,
              descripcion: utilidad.Descripción,
              cant: utilidad.Cant,
              estado: utilidad.Estado,
              proveedores: utilidad.Proveedor,
              fecha_adquisicion: utilidad.FechaAdquisicion,
              precio_unitario: utilidad.PrecioUnitario
            }));
          } else {
            alert('No se pudieron cargar las utilidades.');
          }
        },
        error: (jqXHR, textStatus, error) => {
          console.error('Error al cargar las utilidades:', textStatus, error);
        }
      });
    },
    guardarProducto() {
      const url = document.querySelector('#insertar').getAttribute('data-controller2');
  
      // Preparar los datos a enviar
      const datos = {
        nombre_utilidad: this.nuevoProducto.utilidad,
        descripcion: this.nuevoProducto.descripcion,
        cantidad: this.nuevoProducto.cant,
        estado: this.nuevoProducto.estado,
        id_proveedor: this.nuevoProducto.proveedores, // Reemplaza si es un ID real
        fecha_adquisicion: this.nuevoProducto.fecha_adquisicion,
        precio_unitario: this.nuevoProducto.precio,
      };
  
      // Enviar datos con Fetch API
      fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(datos),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === 'success') {
            alert(data.message);
            // Opcional: limpiar el formulario o actualizar la lista de productos
            this.nuevoProducto = {}; // Resetear el producto
          } else {
            alert(data.message);
          }
        })
        .catch((error) => {
          console.error('Error al guardar el producto:', error);
        });
    },
    // cargarProveedores() {
    //   const url = $('#proveedor').data('controller1');
    //   $.ajax({
    //     url: url,
    //     type: 'GET',
    //     dataType: 'json',
    //     success: (response) => {
    //       if (response.status === 'success') {
    //         this.proveedores = response.data;
    //       } else {
    //         alert('No se pudieron cargar los proveedores');
    //       }
    //     },
    //     error: (jqXHR, textStatus, error) => {
    //       console.error('Error al cargar los proveedores:', textStatus, error);
    //     }
    //   });
    // }, 
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
  },
  mounted() {
    this.cargarUtilidades(); 
    //this.cargarProveedores(); // Llama a cargarProveedores
  }
});
app.mount('#inventario_utilidades');
