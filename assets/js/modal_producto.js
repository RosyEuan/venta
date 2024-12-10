const app = Vue.createApp({
  data() {
    return {
      isSidebarOpen:false,
      productos: [],
      searchQuery: '',
      modalActivo: false,
      nuevoProducto: {
        producto: '',
        proveedores: '',
        cantidad: '',
        //id_proveedor: ''
        //precio: ''
      },
      proveedores: [], // Aquí se almacenarán los proveedores
      productoSeleccionado: null,
      editando: false
    };
  },
  computed: {
    productosFiltrados() {
      
      return this.productos.filter((item)=>
        Object.values(item).some((val)=>
          val.toString().toLowerCase().includes(this.searchQuery.toLowerCase())
      // const texto = this.textoBusqueda.toLowerCase();
      // return this.productos.filter(
      //   (producto) =>
      //     producto.producto.toLowerCase().includes(texto)
    )
      );
    }
  },
  methods: {
    toggleSiderbar(){
      this.isSidebarOpen  = !this.isSidebarOpen;
    },
    closeSidebar(){
      this.isSidebarOpen = false;
    },
    cargarInventario() {
      const controllerUrl = $('#inventario').data('controller'); // Obtenemos la URL desde data-controller
      $.ajax({
        url: controllerUrl,
        method: 'GET',
        dataType: 'json',
        success: (response) => {
          this.productos = response.data.map(producto => ({
            id: producto.ID,
            producto: producto.Producto,
            id_proveedor: producto.ProveedorID, // Asegúrate de que esto sea el ID
            proveedores: producto.Proveedores,
            cantidad: producto.Cantidad
            //precio:producto,
          }));
          //alert(response.data);
        },
        error: (jqXHR, textStatus, errorThrown) => {
          console.error('Error en AJAX:', textStatus, errorThrown);
          console.error('Detalles del error:', jqXHR.responseText);
          alert('Error al cargar el inventario');
        }
      });
    },
    cargarProveedores() {
      const url = $('#proveedor').data('controller1');
      $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: (response) => {
          if (response.status === 'success') {
            this.proveedores = response.data;
          } else {
            alert('No se pudieron cargar los proveedores');
          }
        },
        error: (jqXHR, textStatus, error) => {
          console.error('Error al cargar los proveedores:', textStatus, error);
        }
      });
    },   
    abrirModal() {
      this.modalActivo = true;
      this.nuevoProducto = {
        producto: '',
        proveedores: '',
        cantidad: '',
        //precio: ''
      };
      this.editando = false;
    },
    cerrarModal() {
      this.modalActivo = false;
      this.nuevoProducto = {
        producto: '',
        proveedores: '',
        cantidad: '',
        //precio: ''
      };
      this.productoSeleccionado = null;
      this.editando = false;
    },
    // abrirModalEditar(producto) {
    //   this.modalActivo = true;
    //   this.productoSeleccionado = producto;
    //   this.nuevoProducto = { ...producto };
    //   this.editando = true;
    // },
    abrirModalEditar(producto) {
      this.modalActivo = true;
      this.productoSeleccionado = producto;
      this.nuevoProducto = { 
        producto: producto.producto, 
        proveedores: producto.id_proveedor, // Asegúrate de que este valor sea el ID del proveedor
        cantidad: producto.cantidad 
      };
      this.editando = true;
    },
    agregarOEditarProducto() {
      const url = $('#insertar').data('controller2'); // URL del controlador
      if (this.editando) {
        // // Lógica para editar el producto localmente
        // Object.assign(this.productoSeleccionado, this.nuevoProducto);
        // this.cerrarModal();
        // Enviar datos al backend para editar el producto
        const url2 = $('#insertar').data('controller3'); 
      $.ajax({
        url: url2, // Asumiendo que tienes una ruta para actualizar
        type: 'POST',
        data: {
          id_producto: this.productoSeleccionado.id,
          id_proveedor: this.nuevoProducto.proveedores,
          nombre_producto: this.nuevoProducto.producto,
          stock: this.nuevoProducto.cantidad
        },
        dataType: 'json',
        success: (response) => {
          if (response.status === 'success') {
            alert(response.message);
            Object.assign(this.productoSeleccionado, this.nuevoProducto); // Actualiza el producto localmente
            this.cerrarModal();
            this.cargarInventario(); // Recargar el inventario desde la base de datos
          } else {
            alert('Error: ' + response.message);
          }
        },
        error: (jqXHR, textStatus, errorThrown) => {
          console.error(jqXHR.responseText);
          console.error('Error en la petición AJAX:', textStatus, errorThrown);
          alert('Hubo un problema al actualizar el producto.');
        }
      });
      } else {
        // // Lógica para agregar un nuevo producto localmente
        // this.productos.push({ ...this.nuevoProducto, id: Date.now() });
    
        // Insertar el producto en la base de datos
        
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            id_proveedor: this.nuevoProducto.proveedores,
            nombre_producto: this.nuevoProducto.producto,
            stock: this.nuevoProducto.cantidad
          },
          dataType: 'json',
          success: (response) => {
            if (response.status === 'success') {
              alert(response.message);
              this.cerrarModal();
              this.cargarInventario(); // Recargar inventario desde la base de datos
            } else {
              alert('Error: ' + response.message);
            }
          },
          error: (jqXHR, textStatus, errorThrown) => {
            console.error('Error en la petición AJAX:', textStatus, errorThrown);
            alert('Hubo un problema al insertar el producto.');
          }
        });
      }
    },    
    eliminarProducto(id) {
      if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        const url = $('#inventario').data('controller4'); // URL del controlador para eliminar producto
    
        $.ajax({
          url: url,
          type: 'POST',
          data: { id_producto: id },
          dataType: 'json',
          success: (response) => {
            if (response.status === 'success') {
              alert(response.message);
              this.productos = this.productos.filter((producto) => producto.id !== id); // Eliminar localmente
            } else {
              alert('Error: ' + response.message);
            }
          },
          error: (jqXHR, textStatus, errorThrown) => {
            console.error('Error en la petición AJAX:', textStatus, errorThrown);
            alert('Hubo un problema al eliminar el producto.');
          }
        });
      }
    }
  },    
  mounted() {
    this.cargarInventario(); // Llamamos a cargarInventario al montar la aplicación
    this.cargarProveedores(); // Llama a cargarProveedores
  }
});

app.mount('#inventario_productos');
