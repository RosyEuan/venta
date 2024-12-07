const sidebarApp = Vue.createApp({
  data() {
    return {
      isSidebarOpen: false,
      mesas: [
        { numero: 'A1', status: '', img: 'img/mesa_A1.png' },
        { numero: 'B1', status: '', img: 'img/mesa_B1.png' },
        { numero: 'C1', status: '', img: 'img/mesa_C1.png' },
        { numero: 'D1', status: '', img: 'img/mesa_D1.png' },
        { numero: 'A2', status: '', img: 'img/mesa_A2.png' },
        { numero: 'B2', status: '', img: 'img/mesa_B2.png' },
        { numero: 'C2', status: '', img: 'img/mesa_C2.png' },
        { numero: 'D2', status: '', img: 'img/mesa_D2.png' },
        { numero: 'A3', status: '', img: 'img/mesa_A3.png' },
        { numero: 'B3', status: '', img: 'img/mesa_B3.png' },
        { numero: 'C3', status: '', img: 'img/mesa_C3.png' },
        { numero: 'D3', status: '', img: 'img/mesa_D3.png' },
        { numero: 'A4', status: '', img: 'img/mesa_A4.png' },
        { numero: 'B4', status: '', img: 'img/mesa_B4.png' },
        { numero: 'C4', status: '', img: 'img/mesa_C4.png' },
        { numero: 'D4', status: '', img: 'img/mesa_D4.png' }
      ],
      selectedMesa: null,
      showModal: false,
      formData: {
        cliente: '',
        telefono: '',
        fechaHora: '',
        mesa: '',
        email: '',
        personas: 1,
        comentario: ''
      }
    };
  },
  methods: {
    toggleSidebar() {
      this.isSidebarOpen = !this.isSidebarOpen;
    },
    closeSidebar() {
      this.isSidebarOpen = false;
    },
    selectMesa(index) {
      this.selectedMesa = index;
      this.formData.mesa = this.mesas[index].numero;
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
      this.selectedMesa = null;
      this.formData = {
        cliente: '',
        telefono: '',
        fechaHora: '',
        mesa: '',
        email: '',
        personas: 1,
        comentario: ''
      }; // Reset form data
    },
    submitForm() {
      if (
        this.formData.cliente &&
        this.formData.telefono &&
        this.formData.fechaHora &&
        this.formData.email &&
        this.formData.personas >= 1
      ) {
        this.mesas[this.selectedMesa].status = 'reservada';
        this.showModal = false;
        this.selectedMesa = null;
        this.formData = {
          cliente: '',
          telefono: '',
          fechaHora: '',
          mesa: '',
          email: '',
          personas: 1,
          comentario: ''
        };
      }
    }
  }
}).mount('#app');
