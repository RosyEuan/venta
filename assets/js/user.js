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

function togglePasswordVisibility(id = 'contraseña') {
  var passwordField = document.getElementById(id);
  var passwordFieldType = passwordField.type;
  passwordField.type = passwordFieldType === 'password' ? 'text' : 'password';
  var eyeIcon = document.querySelector(`#${id} ~ .eye-icon i`);
  eyeIcon.classList.toggle('fa-eye');
  eyeIcon.classList.toggle('fa-eye-slash');
}

function openModal() {
  document.getElementById('passwordModal').classList.add('show');
}

function closeModal() {
  document.getElementById('passwordModal').classList.remove('show');
}
