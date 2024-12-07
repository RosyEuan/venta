function goBack() {
  window.history.back();
}

function togglePasswordVisibility(inputId) {
  const input = document.getElementById(inputId);
  const icon = input.nextElementSibling; // Get the icon next to the input
  if (input.type === 'password') {
    input.type = 'text'; // Show password
    icon.classList.remove('fa-eye');
    icon.classList.add('fa-eye-slash');
  } else {
    input.type = 'password'; // Hide password
    icon.classList.remove('fa-eye-slash');
    icon.classList.add('fa-eye');
  }
}
