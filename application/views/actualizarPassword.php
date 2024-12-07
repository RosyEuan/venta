<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualizar Contraseña</title>
  <link href="https://fonts.googleapis.com/css2?family=Khmer&family=Konkhmer+Sleokchher&family=Suez+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/venta/assets/css/style_actualizarContra.css">
</head>
<body>
  <div class="password-recovery">
    <h2>Actualizar contraseña</h2>
    <p>Nueva contraseña</p>
    <div class="form-container">
      <input id="old-password" type="password" placeholder="Contraseña" required />
      <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('old-password')"></i>
    </div>
    <p>Confirmar contraseña</p>
    <div class="form-container">
      <input id="new-password" type="password" placeholder="Contraseña" required />
      <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('new-password')"></i>
    </div>
    <button type="submit">Cambiar</button>

    <div class="back">
      <a href="#" onclick="goBack()">Regresar <i>&#x21B6;</i></a>
    </div>
  </div>

  <script>
    function goBack() {
      window.history.back();
    }

    function togglePasswordVisibility(inputId) {
      const input = document.getElementById(inputId);
      const icon = input.nextElementSibling; // Get the icon next to the input
      if (input.type === "password") {
        input.type = "text"; // Show password
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        input.type = "password"; // Hide password
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }
  </script>
</body>
</html>
