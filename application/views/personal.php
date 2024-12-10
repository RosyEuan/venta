<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personal</title>

  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@3"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="/venta/assets/css/style_personal.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
  <div id="app">
    <!-- Barra lateral -->
    <nav :class="['sidebar', { open: isSidebarOpen }]" id="barra_navegacion" data-url-nav="<?= site_url('iniciar_sesion') ?>">
      <button class="toggle-btn" @click="toggleSidebar">☰</button>
      <div class="logo">
        <img src="img/LogoCytisum.png" alt="Logo" @click="closeSidebar">
      </div>
      <ul>
        <li id="reportes_filtro" data-puesto="1 2">
          <a href="<?= site_url('graficas2') ?>">
            <img src="<?= base_url('img/Barras.png') ?>" alt="Reportes"><span>Reportes</span>
          </a>
        </li>
        <li id="mesas_filtro" data-puesto="1 2 5 6">
          <a href="<?= site_url('mesas') ?>">
            <img src="<?= base_url('img/Mesa.png') ?>" alt="Mesas"><span>Mesas</span>
          </a>
        </li>
        <li id="reservaciones_filtro" data-puesto="1 2 5 6">
          <a href="<?= site_url('reservaciones') ?>">
            <img src="<?= base_url('img/Reservas.png') ?>" alt="Reservaciones"><span>Reservaciones</span>
          </a>
        </li>
        <li id="menu_filtro" data-puesto="1 2 5 6">
          <a href="<?= site_url('menu') ?>">
            <img src="<?= base_url('img/Menus.png') ?>" alt="Menú"><span>Menú</span>
          </a>
        </li>
        <li id="pedidos_filtro" data-puesto="1 2 4">
          <a href="<?= site_url('modal_pedidos') ?>">
            <img src="<?= base_url('img/Pedido.png') ?>" alt="Pedidos"><span>Pedidos</span>
          </a>
        </li>
        <li id="inventario_filtro" data-puesto="1 2 3">
          <a href="<?= site_url('modal_producto') ?>">
            <img src="<?= base_url('img/Inventarios.png') ?>" alt="Inventario"><span>Inventario</span>
          </a>
        </li>
        <li id="personal_filtro" data-puesto="1 2">
          <a href="<?= site_url('personal') ?>">
            <img src="<?= base_url('img/Personales.png') ?>" alt="Personal"><span>Personal</span>
          </a>
        </li>
      </ul>
      <div class="bottom-icons" :class="{ hidden: isSidebarOpen }">

        <a href="<?= site_url('perfil') ?>">
          <img src="img/Admin.png" alt="Usuario">
        </a>
        <img src="img/Logout.png" alt="Salir" id="button_logout"
          data-logout-url="<?= site_url('cerrar_sesion') ?>" data-base-url="<?= site_url('/') ?>">
      </div>
      <div class="admin-info" :class="{ hidden: !isSidebarOpen }">
        <a href="<?= site_url('perfil') ?>">
          <img src="<?= base_url('img/Admin.png') ?>" alt="Usuario">
        </a>
        <span>Hola! <?php echo $this->session->userdata('usuario'); ?><br><?php echo $this->session->userdata('puesto'); ?></span>
      </div>
    </nav>

    <!-- Contenido principal -->
    <div class="content">
      <div class="employees-container">
        <h1>Personal</h1>
        <div class="search-bar">
          <div class="filters">
            <button :class="{ active: filter === 'all' }" @click="setFilter('all')">Todo</button>
          </div>
          <input type="text" placeholder="Buscar empleado" v-model="search" />
          <button class="add-btn" @click="openModal">Agregar</button>
        </div>
        <div id="user-list">
          <div class="employee-container">
            <div class="employee-item" v-for="employee in filteredEmployees" :key="employee.id">
              <img :src="employee.image" alt="Imagen del empleado" class="menu-img" />
              <span class="employee-name">{{ employee.name }}</span>
              <span class="employee-position">{{ employee.position }}</span>
              <span class="employee-status" :class="{ active: employee.status == 'Activo' }">{{ employee.status
                }}</span>
              <span class="employee-salary">${{ employee.salary }}</span>
              <div class="employee-actions">
                <button class="historial-btn" @click="openHistoryModal(employee.id)">Historial</button>
                <button class="edit-btn" @click="openEditModal(employee.id)">Editar</button>
                <button class="delete-btn" @click="deleteItem(employee.id)">Eliminar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal para Historial -->
    <div v-if="isHistoryModalOpen" class="modal-overlay" @click="closeHistoryModal">
      <div class="modal-content" @click.stop>
        <button type="button" class="close-btn" @click="closeHistoryModal">X</button>
        <h2>Historial de {{ currentEmployee.name }}</h2>
        <div v-for="(history, index) in currentEmployee.history" :key="index" class="history-item">
          <button class="history-button" @click="toggleCard(index)">{{ history.date }}</button>
          <div class="detail-card" v-show="history.isOpen">
            <strong>Detalles:</strong>
            <p>{{ history.details }}</p>
          </div>
        </div>
        <button class="return-button" @click="closeHistoryModal">Regresar</button>
      </div>
    </div>

    <!-- Modal  para agregar Personal -->
    <div v-if="isModalOpen" class="modal-overlay" @click="closeModal">
      <div class="modal-content" @click.stop>
        <button type="submit" class="close-btn" @click="closeModal">X</button>
        <h2>Agregar Personal</h2>
        <form @submit.prevent="addEmployee">
          <div class="form-row align-items-center mb-3">
            <div class="col-4">
              <label for="name">Nombre</label>
            </div>
            <div class="col-8">
              <input type="text" id="name" v-model="newEmployee.name" required />
            </div>
          </div>
          <div class="form-row align-items-center mb-3">
            <div class="col-4">
              <label for="dob">Fecha de Nacimiento</label>
            </div class="col-8">
            <div>
              <input type="date" id="dob" v-model="newEmployee.dob" required />
            </div>
          </div>
          <div class="form-row align-items-center mb-3">
            <div class="col-4">
              <label for="curp">CURP</label>
            </div class="col-8">
            <div>
              <input type="text" id="curp" v-model="newEmployee.curp" required />
            </div>
          </div>
          <div class="form-row align-items-center mb-3">
            <div class="col-4">
              <label for="position">Puesto</label>
            </div class="col-8">
            <div>
              <select class="select-tx" id="position" v-model="newEmployee.position" required>
                <option value="Mesero">Mesero</option>
                <option value="Cajero">Cajero</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Recepcionista">Recepcionista</option>
                <option value="Almacenista">Almacenista</option>
              </select>
            </div>
          </div>
          <div class="form-row align-items-center mb-3">
            <div class="col-4">
              <label for="email">Email</label>
            </div class="col-8">
            <div>
              <input type="email" id="email" v-model="newEmployee.email" required />
            </div>
          </div>
          <div class="form-row align-items-center mb-3">
            <div class="col-4">
              <label for="rfc">RFC</label>
            </div class="col-8">
            <div>
              <input type="text" id="rfc" v-model="newEmployee.rfc" required />
            </div>
          </div>
          <div class="form-row align-items-center mb-3">
            <div class="col-4">
              <label for="salary">Salario</label>
            </div class="col-8">
            <div>
              <input type="number" id="salary" v-model="newEmployee.salary" required />
            </div>
          </div>
          <div class="buttons">
            <button class="btn_agregar" type="button" @click="addEmployee">Agregar</button>
            <button class="btn_cerrar" type="button" @click="closeModal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal de confirmación de eliminación -->
    <div v-if="isDeleteConfirmOpen" class="modal-overlay" @click="closeDeleteConfirmModal">
      <div class="modal-content" @click.stop>
        <button type="button" class="close-btn" @click="closeDeleteConfirmModal">X</button>
        <h2>¿Estás seguro de que deseas eliminar este empleado?</h2>
        <div class="buttons">
          <button class="btn-confirm" @click="deleteEmployee">Confirmar</button>
          <button class="btn-cerrar" @click="closeDeleteConfirmModal">Cancelar</button>
        </div>
      </div>
    </div>

    <!-- Modal para editar Personal -->
    <div v-if="isEditModalOpen" class="modaledit-overlay" @click="closeEditModal">
      <div class="modaledit-content" @click.stop>
        <button type="submit" class="close-btn" @click="closeEditModal">X</button>
        <h2>Editar Personal</h2>
        <div class="modale row">
          <div class="col-md-4 offset-md-1">
            <img src="img/editPerfil.png" alt="Imagen del empleado" class="empleado">
          </div>
          <form @submit.prevent="updateEmployee" class="informacion">
            <div class="forms-row align-items-center mb-3">
              <div class="principal col-6">
                <input class="info-principal" type="text" id="name" v-model="currentEmployee.name" disabled />
              </div>
              <div class="principal col-6">
                <input class="info-principal" type="text" id="dob" v-model="currentEmployee.dob" disabled />
              </div>
            </div>
            <hr class="linea" />
            <!-- Campos de usuario, email, curp, rfc, puesto, salario -->
            <div class="form-rows align-items-center mb-3">
              <div class="datos col-4">
                <label class="txt-info" for="usuario">Usuario</label>
                <input class="info" type="text" id="usuario" v-model="currentEmployee.usuario" disabled />
              </div>
              <div class="datos col-4">
                <label class="txt-info" for="email">Email</label>
                <input class="info" type="email" id="email" v-model="currentEmployee.email" disabled />
              </div>
            </div>
            <div class="form-rows align-items-center mb-3">
              <div class="datos col-4">
                <label class="txt-info" for="curp">CURP</label>
                <input class="info" type="text" id="curp" v-model="currentEmployee.curp" disabled />
              </div>
              <div class="datos col-4">
                <label class="txt-info" for="rfc">RFC</label>
                <input class="info" type="text" id="rfc" v-model="currentEmployee.rfc" disabled />
              </div>
            </div>
            <div class="form-rows align-items-center mb-3">
              <div class="datos col-4">
                <label class="txt-info" for="position">Puesto</label>
                <select class="selectedit-tx" id="position" v-model="currentEmployee.position" required>
                  <option value="Mesero">Mesero</option>
                  <option value="Cajero">Cajero</option>
                  <option value="Supervisor">Supervisor</option>
                  <option value="Recepcionista">Recepcionista</option>
                  <option value="Almacenista">Almacenista</option>
                </select>
              </div>
              <div class="datos col-4">
                <label class="txt-info" for="salary">Salario</label>
                <input class="info" type="number" id="salary" v-model="currentEmployee.salary" required />
              </div>
            </div>
            <div class="forms-rows align-items-center mb-3">
              <div class="secundaria col-6">
                <label class="txt-infoSec" for="vacaciones">Vacaciones</label>
                <label class="txt-num">12</label>
                <label class="txt-infoSec" for="vacaciones">Dias de descanso</label>
                <label class="txt-num">2</label>
              </div>
              <div class="secundaria col-6">
                <label class="txt-infoSec" for="observaciones">Observaciones</label>
                <textarea class="info-secundaria" id="observaciones" v-model="currentEmployee.observaciones"
                  rows="3"></textarea>
              </div>
            </div>
            <!-- Botones: generar reporte, actualizar, y agregar observaciones -->
            <div class="buttons-edit">
              <button class="btn-reporte" type="button">Generar Reporte</button>
              <button class="btn-update" type="submit">Actualizar Información</button>
              <button class="btn-observacion" type="button">Agregar observación</button>
            </div>
          </form>
          <div class="buttons-cerrar">
            <button class="btn-cerrar" type="button" @click="closeEditModal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="/venta/assets/js/funcionLogout.js"></script>
  <script src="/venta/assets/js/filtroBarra.js"></script>

  <script src="/venta/assets/js/personal.js"></script>
</body>

</html>