const app = Vue.createApp({
  data() {
    return {
      isSidebarOpen: false,
      isModalVisible: false,
      isEditing: false,
      proveedores: [],
      searchQuery: '',
      proveedor: { id: null, nombre: '', telefono: '', correo: '' }
    };
  },
  computed: {
    filteredProducts() {
      return this.proveedores.filter((item) =>
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
    cargarProveedores() {
      const controllerUrl = $('#proveedores').data('controller');
      // Obtenemos la URL desde data-controller
      $.ajax({
        url: controllerUrl,
        method: 'GET',
        dataType: 'json',
        success: (response) => {
          console.log('Respuesta de proveedores:', response); 
          this.proveedores = response.data.map(producto => ({
            id: producto.ID,
            nombre: producto.Nombre,
            telefono: producto.Telefono,
            correo: producto.Correo
          }));
          //alert(response.data);
        },
        error: (jqXHR, textStatus, errorThrown) => {
          console.error('Error en AJAX:', textStatus, errorThrown);
          console.error('Detalles del error:', jqXHR.responseText);
          alert('Error al cargar al proveedor');
        }
      });
    },
    openModal() {
      this.isModalVisible = true;
      this.proveedor = { id: null, nombre: '', telefono: '', correo: '' };this.isEditing = false;
    },
    closeModal() {
      this.isModalVisible = false;
      this.proveedorSeleccionado = null;
      this.proveedor = { id: null, nombre: '', telefono: '', correo: '' };  // Limpia los datos del proveedor al cerrar el modal
      this.isEditing = false;
    },    
    agregarProveedor() {
      // Verificar si todos los campos están llenos
      if (
        !this.proveedor.nombre ||
        !this.proveedor.telefono ||
        !this.proveedor.correo
      ) {
        alert('Por favor, completa todos los campos.');
        return;
      }
    
      // Verificamos si estamos en modo de edición o no
      const controllerUrl = this.isEditing 
        ? $('#insertar').data('controller3')  // Controlador de actualización
        : $('#insertar').data('controller2'); // Controlador de inserción
    
      const methodType = this.isEditing ? 'POST' : 'POST'; // En este caso, ambos pueden ser POST, solo se cambia la lógica
    
      $.ajax({
        url: controllerUrl,
        method: methodType,
        data: {
          id: this.proveedor.id,
          nombre: this.proveedor.nombre,
          telefono: this.proveedor.telefono,
          correo: this.proveedor.correo
        },
        dataType: 'json',
        success: (response) => {
          if (response.status === 'success') {
            alert(response.message);
            this.closeModal();
            this.cargarProveedores(); // Recargar los proveedores desde la base de datos
          } else {
            alert('Error al procesar proveedor: ' + response.message);
          }
        },
        error: (jqXHR, textStatus, errorThrown) => {
          console.error('Error en AJAX:', textStatus, errorThrown);
          alert('Ocurrió un error al intentar agregar o actualizar el proveedor.');
        }
      });
    },       
    editProveedor(proveedor) {
      this.isModalVisible = true;  // Activa el modal
      this.proveedorSeleccionado = proveedor;  // Guarda temporalmente el proveedor seleccionado
      this.proveedor = { 
        id: proveedor.id, 
        nombre: proveedor.nombre, 
        telefono: proveedor.telefono, 
        correo: proveedor.correo 
      };  // Llena el formulario con los datos del proveedor
      this.isEditing = true;  // Cambia al modo edición
    },    
    // abrirModalEditar(producto) {
    //   this.modalActivo = true;
    //   this.productoSeleccionado = producto;
    //   this.nuevoProducto = { 
    //     producto: producto.producto, 
    //     proveedores: producto.id_proveedor, // Asegúrate de que este valor sea el ID del proveedor
    //     cantidad: producto.cantidad 
    //   };
    //   this.editando = true;
    // },    
    deleteProveedor(id) {
      if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
        const url = $('#proveedores').data('controller4'); // URL del controlador para eliminar producto
    
        $.ajax({
          url: url,
          type: 'POST',
          data: { id: id },
          dataType: 'json',
          success: (response) => {
            if (response.status === 'success') {
              alert(response.message);
              this.proveedores = this.proveedores.filter((item) => item.id !== id); // Eliminar localmente
            } else {
              alert('Error: ' + response.message);
            }
          },
          error: (jqXHR, textStatus, errorThrown) => {
            console.error('Error en la petición AJAX:', textStatus, errorThrown);
            alert('Hubo un problema al eliminar el proveedor.');
          }
        });
      }
      //this.proveedores = this.proveedores.filter((item) => item.id !== id);
    }
  },
  mounted() {
    this.cargarProveedores(); // Llama a cargarProveedores

    // isSidebarOpen: false,
    //   isModalVisible: false,
    //   isEditing: false,
    //   proveedores: [],
    //   searchQuery: '',
    //   proveedor: { id: null, nombre: '', telefono: '', correo: '' }
  }
});
app.mount('#inventario_proveedores');
