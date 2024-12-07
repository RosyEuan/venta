const { createApp } = Vue;
createApp({
  data() {
    return {
      isSidebarOpen: false,
      search: '',
      filter: 'all',
      Employees: [
        {
          id: 1,
          name: 'Sofía Ramírez',
          position: 'Supervisor',
          status: 'Activo',
          salary: 18000,
          image: 'img/Empleado.png',
          history: [
            {
              date: '12/Nov/2024',
              details: 'Llegó tarde al trabajo.',
              isOpen: false
            },
            {
              date: '13/Nov/2024',
              details: 'Completó tareas asignadas.',
              isOpen: false
            },
            { date: '14/Nov/2024', details: 'Faltó sin aviso.', isOpen: false },
            {
              date: '15/Nov/2024',
              details: 'Recibió una felicitación.',
              isOpen: false
            },
            {
              date: '16/Nov/2024',
              details: 'Participó en capacitación.',
              isOpen: false
            }
          ]
        },

        {
          id: 2,
          name: 'Lucas Fernández',
          position: 'Almacenista',
          status: 'Inactivo',
          salary: 15000,
          image: 'img/Empleado.png',
          history: [
            {
              date: '12/Nov/2024',
              details: 'Llegó tarde al trabajo.',
              isOpen: false
            },
            {
              date: '13/Nov/2024',
              details: 'Completó tareas asignadas.',
              isOpen: false
            },
            { date: '14/Nov/2024', details: 'Faltó sin aviso.', isOpen: false },
            {
              date: '15/Nov/2024',
              details: 'Recibió una felicitación.',
              isOpen: false
            },
            {
              date: '16/Nov/2024',
              details: 'Participó en capacitación.',
              isOpen: false
            }
          ]
        },

        {
          id: 3,
          name: 'Camila Torres',
          position: 'Mesera',
          status: 'Inactivo',
          salary: 10000,
          image: 'img/Empleado.png',
          history: [
            {
              date: '12/Nov/2024',
              details: 'Llegó tarde al trabajo.',
              isOpen: false
            },
            {
              date: '13/Nov/2024',
              details: 'Completó tareas asignadas.',
              isOpen: false
            },
            { date: '14/Nov/2024', details: 'Faltó sin aviso.', isOpen: false },
            {
              date: '15/Nov/2024',
              details: 'Recibió una felicitación.',
              isOpen: false
            },
            {
              date: '16/Nov/2024',
              details: 'Participó en capacitación.',
              isOpen: false
            }
          ]
        },
        {
          id: 4,
          name: 'Juan Peréz',
          position: 'Cajero',
          status: 'Activo',
          salary: 8000,
          image: 'img/Empleado.png',
          history: [
            {
              date: '12/Nov/2024',
              details: 'Llegó tarde al trabajo.',
              isOpen: false
            },
            {
              date: '13/Nov/2024',
              details: 'Completó tareas asignadas.',
              isOpen: false
            },
            { date: '14/Nov/2024', details: 'Faltó sin aviso.', isOpen: false },
            {
              date: '15/Nov/2024',
              details: 'Recibió una felicitación.',
              isOpen: false
            },
            {
              date: '16/Nov/2024',
              details: 'Participó en capacitación.',
              isOpen: false
            }
          ]
        },
        {
          id: 5,
          name: 'Shaiel Euan',
          position: 'Gerente',
          status: 'Activo',
          salary: 10000,
          image: 'img/Empleado.png',
          history: [
            {
              date: '12/Nov/2024',
              details: 'Llegó tarde al trabajo.',
              isOpen: false
            },
            {
              date: '13/Nov/2024',
              details: 'Completó tareas asignadas.',
              isOpen: false
            },
            { date: '14/Nov/2024', details: 'Faltó sin aviso.', isOpen: false },
            {
              date: '15/Nov/2024',
              details: 'Recibió una felicitación.',
              isOpen: false
            },
            {
              date: '16/Nov/2024',
              details: 'Participó en capacitación.',
              isOpen: false
            }
          ]
        }
      ],
      isModalOpen: false,
      isHistoryModalOpen: false,
      isEditModalOpen: false,
      isDeleteConfirmOpen: false,
      employeeToDelete: false,
      newEmployee: {
        name: '',
        dob: '',
        curp: '',
        position: '',
        email: '',
        rfc: '',
        salary: ''
      },
      currentEmployee: {
        id: '',
        name: '',
        dob: '',
        curp: '',
        position: '',
        email: '',
        rfc: '',
        salary: ''
      }
    };
  },
  computed: {
    filteredEmployees() {
      return this.Employees.filter((employee) => {
        if (this.filter === 'all') return true;
        if (this.filter === 'puesto') return employee.position === this.search;
        return true;
      });
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
    deleteItem(id) {
      this.employeeToDelete = id;
      this.isDeleteConfirmOpen = true;
    },
    deleteEmployee() {
      this.Employees = this.Employees.filter(
        (employee) => employee.id !== this.employeeToDelete
      );
      this.isDeleteConfirmOpen = false;
      this.employeeToDelete = null;
    },
    closeDeleteConfirmModal() {
      this.isDeleteConfirmOpen = false;
      this.employeeToDelete = null;
    },
    openModal() {
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
      this.resetNewEmployee();
    },
    openEditModal(employeeId) {
      const employee = this.Employees.find((emp) => emp.id === employeeId);
      if (employee) {
        this.currentEmployee = { ...employee };
      }
      this.isEditModalOpen = true;
    },
    closeEditModal() {
      this.isEditModalOpen = false;
    },
    openHistoryModal(employeeId) {
      const employee = this.Employees.find((emp) => emp.id === employeeId);
      if (employee) {
        this.currentEmployee = { ...employee };
      }
      this.isHistoryModalOpen = true;
    },
    closeHistoryModal() {
      this.isHistoryModalOpen = false;
      this.currentEmployee = null;
    },
    toggleCard(index) {
      this.currentEmployee.history[index].isOpen =
        !this.currentEmployee.history[index].isOpen;
    },

    addEmployee() {
      if (this.idValidEmployeeData()) {
        const newId = this.Employees.length + 1;
        this.Employees.push({ id: newId, ...this.newEmployee });
        this.closeModal();
      } else {
        alert('Por favor, complete todos los campos del empleado.');
      }
    },
    updateEmployee() {
      const index = this.Employees.findIndex(
        (emp) => emp.id === this.currentEmployee.id
      );
      if (index !== -1) {
        this.Employees[index] = { ...this.currentEmployee };
        this.closeEditModal();
      }
    },
    idValidEmployeeData() {
      return Object.values(this.newEmployee).every(
        (value) => value.trim() !== '' && value !== null
      );
    },
    resetNewEmployee() {
      this.newEmployee = {
        name: '',
        dob: '',
        curp: '',
        position: '',
        email: '',
        rfc: '',
        salary: ''
      };
    }
  }
}).mount('#app');
