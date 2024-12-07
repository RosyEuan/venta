//
$(document).ready(function () {
  // Verificación de usuario
  $('#formulario_inicio_sesion').on('submit', function (event) {
    event.preventDefault();
    const controller_iniciar_sesion = $(this).data('controller-url');
    const redirect = $(this).data('redirect');

    $.ajax({
      url: controller_iniciar_sesion,
      method: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function (response) {
        if (response.status === 'success') {
          console.log('Verificación correcta:', response.message);
          sessionStorage.setItem('puesto', response.id_puesto);
          alert('¡Bienvenido! ' + response.message);
          window.location.href = redirect;
        } else {
          alert('Error: ' + response.message);
        }
      },
      error: function (xhr, status, error) {
        console.error('status ', status);
        console.error('Error ', error);
        console.error(
          'Ocurrió un error inesperado:',
          xhr.status,
          xhr.statusText
        );

        console.error('Detalles del error:', xhr.responseText);

        alert(
          'Error de servidor: ' +
            (xhr.responseJSON ? xhr.responseJSON.message : 'Error desconocido')
        );
      }
    });
  });

  // Formulario de registro
  $('#formulario_registro').on('submit', function (event) {
    event.preventDefault();
    const controller_registrarse = $(this).data('controller-url');

    $.ajax({
      url: controller_registrarse,
      method: 'POST',
      data: $(this).serialize(),
      dataType: 'json', // Asegúrate de que el servidor responde con JSON
      success: function (response) {
        console.log('Registro exitoso:', response.message);
        alert('¡Registro exitoso! ' + response.message); // Mensaje al usuario
      },
      error: function (xhr, status, error) {
        // Si hubo un error en el registro
        console.error('status', status);
        console.error('Hubo un error:', error);
        console.error('Detalles del error:', xhr.responseText);
        alert(
          'Hubo un error: ' +
            (xhr.responseJSON ? xhr.responseJSON.message : 'Error desconocido')
        );
      }
    });
  });
});

//-----------------------------------------------------------------------------------------------------------------------------------

// Función para mostrar el modal de recuperación de contraseña
function openPasswordModal() {
  document.getElementById('passwordModal').style.display = 'flex';
}

// Función para cerrar el modal
function closePasswordModal() {
  document.getElementById('passwordModal').style.display = 'none';
}

// Variables de referencia
var contenedor_login_register = document.querySelector(
  '.contenedor__login-register'
);
var formulario_login = document.querySelector('.formulario__login');
var formulario_register = document.querySelector('.formulario__register');
var caja_trasera_login = document.querySelector('.caja__trasera-login');
var caja_trasera_register = document.querySelector('.caja__trasera-register');

// Función para mostrar el formulario de registro
function register() {
  formulario_register.style.display = 'block';
  formulario_login.style.display = 'none';
  contenedor_login_register.style.left = '410px';
  caja_trasera_register.style.opacity = '0';
  caja_trasera_login.style.opacity = '1';
}

// Función para mostrar el formulario de inicio de sesión
function iniciarSesion() {
  formulario_register.style.display = 'none';
  formulario_login.style.display = 'block';
  contenedor_login_register.style.left = '10px';
  caja_trasera_register.style.opacity = '1';
  caja_trasera_login.style.opacity = '0';
}
document
  .getElementById('togglePassword')
  .addEventListener('click', function () {
    const passwordInput = document.getElementById('password');
    const isPasswordVisible = passwordInput.type === 'password';
    passwordInput.type = isPasswordVisible ? 'text' : 'password';

    // Cambia el ícono
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
  });
// Mostrar/ocultar contraseña (Campo Contraseña)
document
  .getElementById('toggleRegisterPassword')
  .addEventListener('click', function () {
    const passwordInput = document.getElementById('register-password');
    const isPasswordVisible = passwordInput.type === 'password';
    passwordInput.type = isPasswordVisible ? 'text' : 'password';

    // Cambia el ícono
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
  });
// Mostrar/ocultar contraseña (Campo Contraseña)
document
  .getElementById('toggleRegisterPassword')
  .addEventListener('click', function () {
    const passwordInput = document.getElementById('register-password');
    const isPasswordVisible = passwordInput.type === 'password';
    passwordInput.type = isPasswordVisible ? 'text' : 'password';

    // Cambia el ícono
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
  });

// Mostrar/ocultar confirmar contraseña (Campo Asegurar Contraseña)
document
  .getElementById('toggleRegisterConfirmPassword')
  .addEventListener('click', function () {
    const confirmPasswordInput = document.getElementById(
      'register-confirm-password'
    );
    const isConfirmPasswordVisible = confirmPasswordInput.type === 'password';
    confirmPasswordInput.type = isConfirmPasswordVisible ? 'text' : 'password';

    // Cambia el ícono
    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
  });
