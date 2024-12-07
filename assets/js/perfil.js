const sidebarApp = Vue.createApp({
  data() {
    return {
      isSidebarOpen: false
    };
  },
  methods: {
    toggleSidebar() {
      this.isSidebarOpen = !this.isSidebarOpen;
    },
    closeSidebar() {
      this.isSidebarOpen = false;
    }
  }
}).mount('#app');
function togglePasswordVisibility() {
  var passwordField = document.getElementById('contraseña');
  var passwordFieldType = passwordField.type;
  // Cambiar el tipo de campo entre 'password' y 'text'
  passwordField.type = passwordFieldType === 'password' ? 'text' : 'password';
  // Cambiar el icono de ojo a ojo tachado y viceversa
  var eyeIcon = document.querySelector('.eye-icon i');
  eyeIcon.classList.toggle('fa-eye');
  eyeIcon.classList.toggle('fa-eye-slash');
}
