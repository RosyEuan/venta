<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario con Modal</title>
  <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>
  <link href="https://fonts.googleapis.com/css2?family=Khmer&family=Konkhmer+Sleokchher&family=Suez+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #fff;
      margin: 0;
      padding: 100px;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .header-buttons {
      display: flex;
      gap: 10px;
      padding-left: 237px;
    }
    .header-buttons button {
      padding: 10px 20px;
      background-color: rgba(50, 42, 127, 0.6);
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-family: EB Garamond;
      font-size: 16px;
    }
    .search-bar {
      display: flex;
      align-items: center;
      padding-right: 180px;
      position: relative;
      margin-top: -120px;
    }
    .search-bar input {
      padding: 10px 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      text-align: left;
      background-color: rgba(247, 247, 247, 1);
      width: 250px;
      padding-left: 35px; /* Espacio para el ícono de la lupa */
      font-size: 16px;
    }

    .search-bar button {
      position: relative;
      right: 40px;
      background-color: transparent;
      border: none;
      cursor: pointer;
      font-size: 20px;
    }

    .search-bar input:focus {
      background-color: #e0e0e0;
    }

    .search-bar i {
      position: relative;
      left: 0px;
      font-size: 18px;
      color: #aaa;
    }

    table {
      width: 80%;
      margin: 0 auto;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    th, td {
      border: 1px solid #ccc;
      text-align: center;
      padding: 5px;
      height: 40px;
    }
    th {
      background-color: #515C64;
      color: white;
      height: 60px;
      font-size: 24px;
    }
    tr:nth-child(even) {
      background-color: rgba(50, 42, 127, 0.35);
    }
    .actions button {
  margin: 0 5px;
  padding: 5px 10px;
  border: none;
  border-radius: 16px;
  cursor: pointer;
    }
    .actions {
  display: flex; /* Alinea los botones horizontalmente */
  justify-content: center; /* Centra los botones dentro de la celda */
  gap: 15px; /* Espacio entre los botones */
  padding-top:10px;
}
    .editar-btn, .eliminar-btn {
  display: flex;
   /* Alinea el texto con el ícono verticalmente */
  justify-content: center;  /* Alinea horizontalmente */
  padding: 8px 15px;
  font-family: Maname;
  font-size: 16px;
  gap:6px; /*ESTE */ 
}
.editar-btn i, .eliminar-btn i {
  position: relative;
  top: 3px; /* Ajusta este valor para mover el ícono */
}

.editar-btn, .eliminar-btn {
  line-height: 1; /* Ajusta la altura de línea para alinear mejor el texto */
}
.editar-btn img, .eliminar-btn img {
    width: 20px;
  height: 20px;
    /* Espacio entre el ícono y el texto */
  margin-right: -4px; /*ESTE */
}

.editar-btn {
  background-color: #0C8217;
  color: white;
  height: 35px;
  width: 100px;
font-family: Maname;
font-size: 16px;
text-align: center;
gap:8px; /*ESTE */
}

.eliminar-btn {
  background-color: #DC730A;
  color: white;
  height: 35px;
  width: 100px;
font-family: Maname;
font-size: 16px;
text-align: center;
}
    .bottom-buttons {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 20px;
      margin-right: 183px;
    }
    .bottom-buttons button {
      padding: 10px;
      background-color: rgba(232, 236, 7, 1);
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 10%;
      font-family: EB Garamond;
      font-size: 16px;
    }
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }
    .modal-content {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      width: 60%;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    max-height: 90vh; /* Limita la altura máxima del modal */
    overflow-y: auto; /* Habilita la barra de desplazamiento vertical si es necesario */
    overflow-x: hidden;
    }
    .modal-header {
        text-align: center;
      margin-bottom: 30px;
      font-family: "EB Garamond";
      font-size: 28px;
    }
  
    .close-btn {
      padding: 10px 20px;
      background-color: #e74c3c;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .siguiente{
        font-family: Maname;
font-size: 20px;
    }
    .lempo{
        color: #FFF;/*para el tamaño del nombre de las columnas */
text-align: center;
font-family: Maname;
font-size: 28px;
font-style: normal;
font-weight: 400;
line-height: normal;
    }
    th:nth-child(2), td:nth-child(2) {  /* Columna de Producto */
  width: 200px;  /* Ajusta el ancho a tu preferencia */
}

        th:nth-child(3), td:nth-child(3) {  /* Columna de Proveedores */
  width: 200px;  /* Ajusta el ancho a tu preferencia */
}

th:nth-child(4), td:nth-child(4) {  /* Columna de Cantidad */
  width: 170px;  /* Ajusta el ancho a tu preferencia */
}
.btn-submit:hover {
      background-color: #ffc107;
    }
    .form-group {
      margin-bottom: 20px;
      font-family: "EB Garamond";
      font-size: 24px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

.orden{
  font-family: "EB Garamond";
  font-size: 16px;
}
.grid-container {
  display: grid;
  grid-template-columns: 1fr 1fr; /* Dos columnas iguales */
  gap: 40px; /* Espaciado amplio entre las columnas */
}

.form-group textarea {
  margin-bottom: 20px; /* Espaciado entre Descripción y el botón */
}

.button-container {
  text-align: left; /* Alinea el botón a la izquierda */
  margin-top: 10px; /* Espaciado entre Descripción y el botón */
}

.grid-container > div:nth-child(2) {
  display: flex;
  flex-direction: column;
  gap: 20px; /* Espacio entre Fecha adquisición y Estado */
}
.grid-container {
  display: grid;
  grid-template-columns: 1fr 1fr; /* Dos columnas iguales */
  gap: 40px; /* Espaciado amplio entre las columnas */
}

textarea#descripcion {
  height: calc(2 * 63px + 20px); /* Altura combinada de "Fecha adquisición" y "Estado" más el espacio entre ellos */
  margin-bottom: 20px; /* Espaciado entre Descripción y el botón */
  resize: none; /* Evita que el usuario cambie el tamaño del cuadro de texto */
}

.button-container {
  text-align: left; /* Alinea el botón a la izquierda */
  margin-top: -40px; /* Espaciado entre Descripción y el botón */
}

.grid-container > div:nth-child(2) {
  display: flex;
  flex-direction: column;
  gap: 20px; /* Espacio entre Fecha adquisición y Estado */
}

input, textarea {
  width: 100%; /* Mantiene el ancho consistente */
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

.boton{
    padding: 10px 15px;
      border: none;
      color: #000;
      font-weight: bold;
      cursor: pointer;
      margin-top: 10px;
      border-radius: 16px;
      background: #E8EC07;
      font-size: 16px;
      text-align: center;
      font-family: "EB Garamond";
      width: 20%;
}
.tit{
  font-family: 'EB Garamond';
  font-size: 28px;
  text-align: left;  
  color: #333;
  position: absolute;  
  top: 15px; 
  margin-bottom: 20px; 
  margin-left:135px;  
}
  </style>
</head>
<body>
  <div id="inventario_utilidades">
  <h2 class="tit">Inventario utilidades</h2> 

    <div class="header">
      <div class="header-buttons">
        <button>Ingredientes</button>
        <button>Utilidades</button>
        <button>Proveedores</button>
      </div>
      <div class="search-bar">
        <input type="text" placeholder="Buscar"  v-model="busqueda">
        <button><i class="fas fa-search"></i></button>
      </div>
    </div>
    
    <table>
      <thead>
        <tr  class="lempo">
          <th>ID</th>
          <th>Utilidad</th>
          <th>Proveedores</th>
          <th>Fecha adquisición</th>
          <th>Cant.</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in productosFiltrados" :key="item.id" class="siguiente">
          <td>{{ item.id }}</td>
          <td>{{ item.utilidad }}</td>
          <td>{{ item.proveedores }}</td>
          <td>{{ item.fecha_adquisicion }}</td>
          <td>{{ item.cant }}</td>
          <td>{{ item.estado }}</td>
          <td class="actions">
            <button class="editar-btn" @click="editarProducto(item)"><i class="fas fa-pencil-alt"></i> Editar</button>
            <button class="eliminar-btn" @click="eliminarProducto(item.id)"><i class="fas fa-trash"></i> Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>

    <div class="bottom-buttons">
      <button type="submit" class="btn-submit">Agregar producto</button>
      <button @click="abrirModal" class="btn-submit">Agregar utilidad</button>
      <button type="submit" class="btn-submit">Agregar proveedor</button>
    </div>

  <!-- Modal -->
<div v-if="mostrarModal" class="modal-overlay">
  <div class="modal-content">
  <h2 class="modal-header">{{ productoEditando ? 'Editar Utilidad' : 'Agregar Utilidad' }}</h2>
  <form @submit.prevent="guardarProducto">
  <div>
    <div class="form-group">
      <label for="nombreProducto">Nombre de la utilidad</label>
      <input class="orden" type="text" id="nombreProducto" v-model="nuevoProducto.utilidad" placeholder="Escribe el nombre de la utilidad" />
    </div>
    <div class="form-group">
      <label for="precioProducto">Precio unitario</label>
      <input class="orden" type="text" id="precioProducto" v-model="nuevoProducto.precio" placeholder="Escribe el precio unitario" />
    </div>
    <div class="form-group">
      <label for="cantidad">Cantidad de stock</label>
      <input class="orden" type="number" id="cantidad" v-model="nuevoProducto.cant" placeholder="Escribe la cantidad disponible" />
    </div>
    <div class="form-group">
      <label for="proveedor">Proveedor</label>
      <input class="orden" type="text" id="proveedor" v-model="nuevoProducto.proveedores" placeholder="Escribe el nombre del proveedor" />
    </div>
  </div>
  <div class="grid-container">
    <div>
      <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="orden" id="descripcion" v-model="nuevoProducto.descripcion" placeholder="Escribe una descripción"></textarea>
      </div>
      <div class="button-container">
        <button type="submit" class="boton" :disabled="!isFormValid">{{ productoEditando ? 'Guardar Cambios' : 'Agregar Utilidad' }}</button>
      </div>
    </div>
    <div>
      <div class="form-group">
        <label for="fechaAdquisicion">Fecha adquisición</label>
        <input class="orden" type="date" id="fechaAdquisicion" v-model="nuevoProducto.fecha_adquisicion" />
      </div>
      <div class="form-group">
        <label for="estado">Estado</label>
        <input class="orden" type="text" id="estado" v-model="nuevoProducto.estado" placeholder="Escribe el estado" />
      </div>
    </div>
  </div>
</form>
  </div>
</div>


   <!-- Modal -->
   <div v-if="mostrarModal" class="modal-overlay">
      <div class="modal-content">
        <h2 class="modal-header">{{ productoEditando ? 'Editar Utilidad' : 'Agregar Utilidad' }}</h2>
        <form @submit.prevent="guardarProducto">
          <div>
            <div class="form-group">
              <label for="nombreProducto">Nombre de la utilidad</label>
              <input class="orden" type="text" id="nombreProducto" v-model="nuevoProducto.utilidad" placeholder="Escribe el nombre de la utilidad" />
            </div>
            <div class="form-group">
              <label for="precioProducto">Precio unitario</label>
              <input class="orden" type="text" id="precioProducto" v-model="nuevoProducto.precio" placeholder="Escribe el precio unitario" />
            </div>
            <div class="form-group">
              <label for="cantidad">Cantidad de stock</label>
              <input class="orden" type="number" id="cantidad" v-model="nuevoProducto.cant" placeholder="Escribe la cantidad disponible" />
            </div>
            <div class="form-group">
              <label for="proveedor">Proveedor</label>
              <input class="orden" type="text" id="proveedor" v-model="nuevoProducto.proveedores" placeholder="Escribe el nombre del proveedor" />
            </div>
          </div>
          <div class="grid-container">
            <div>
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="orden" id="descripcion" v-model="nuevoProducto.descripcion" placeholder="Escribe una descripción"></textarea>
              </div>
              <div class="button-container">
                <button type="submit" class="boton" :disabled="!isFormValid">{{ productoEditando ? 'Guardar Cambios' : 'Agregar Utilidad' }}</button>
              </div>
            </div>
            <div>
              <div class="form-group">
                <label for="fechaAdquisicion">Fecha adquisición</label>
                <input class="orden" type="date" id="fechaAdquisicion" v-model="nuevoProducto.fecha_adquisicion" />
              </div>
              <div class="form-group">
                <label for="estado">Estado</label>
                <input class="orden" type="text" id="estado" v-model="nuevoProducto.estado" placeholder="Escribe el estado" />
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    const app = Vue.createApp({
      data() {
        return {
          busqueda: '',
          productos: [
            { id: 1, utilidad: "Estufa", proveedores: "Prueba", fecha_adquisicion: "2024-11-24", cant: 5, estado: "Nuevo" },
            { id: 2, utilidad: "Cucharas", proveedores: "Prueba", fecha_adquisicion: "2024-11-24", cant: 5, estado: "Usado" },
            { id: 3, utilidad: "Sillas", proveedores: "Prueba", fecha_adquisicion: "2024-11-24", cant: 5, estado: "Dañado" },
            { id: 4, utilidad: "Mesas", proveedores: "Prueba", fecha_adquisicion: "2024-11-24", cant: 5, estado: "Usado" },
            { id: 5, utilidad: "Computadoras", proveedores: "Prueba", fecha_adquisicion: "2024-11-24", cant: 5, estado: "Dañado" },
          ],
          mostrarModal: false,
          productoEditando: null, 
          nuevoProducto: {
            utilidad: "",
            precio: "",
            cant: "",
            proveedores: "",
            descripcion: "",
            fecha_adquisicion: "",
            estado: "",
          },
        };
      },
      computed: {
        productosFiltrados() {
          return this.productos.filter(item => {
            return item.utilidad.toLowerCase().includes(this.busqueda.toLowerCase()) ||
                   item.proveedores.toLowerCase().includes(this.busqueda.toLowerCase());
          });
          
        },
        isFormValid() {
          return this.nuevoProducto.utilidad && this.nuevoProducto.precio && this.nuevoProducto.cant && 
                 this.nuevoProducto.proveedores && this.nuevoProducto.descripcion && 
                 this.nuevoProducto.fecha_adquisicion && this.nuevoProducto.estado;
        }
      },
      methods: {
        abrirModal() {
          this.productoEditando = null;  // Restablecer el estado de edición
          this.mostrarModal = true;
          this.resetFormulario();  // Asegura que el formulario esté vacío al abrir el modal
        },
        cerrarModal() {
          this.mostrarModal = false;
        },
        guardarProducto() {
          if (this.isFormValid) {
            if (this.productoEditando) {
              // Si estamos editando, actualizamos el producto en el array
              const index = this.productos.findIndex(producto => producto.id === this.productoEditando.id);
              if (index !== -1) {
                this.productos[index] = { ...this.productos[index], ...this.nuevoProducto };
              }
            } else {
              // Si estamos agregando un nuevo producto
              this.productos.push({ ...this.nuevoProducto, id: this.productos.length + 1 });
            }
            this.cerrarModal();
            this.resetFormulario();
          }
        },
        editarProducto(item) {
          // Cargamos los datos del producto en el formulario para editar
          this.productoEditando = item;
          this.nuevoProducto = { ...item };  // Hacemos una copia para no mutar el objeto original
          this.mostrarModal = true;
        },
        eliminarProducto(id) {
          this.productos = this.productos.filter(producto => producto.id !== id);
        },
        resetFormulario() {
          this.nuevoProducto = {
            utilidad: "",
            precio: "",
            cant: "",
            proveedores: "",
            descripcion: "",
            fecha_adquisicion: "",
            estado: "",
          };
        },
      },
    });

    app.mount("#inventario_utilidades");
  </script>
</body>
</html>
