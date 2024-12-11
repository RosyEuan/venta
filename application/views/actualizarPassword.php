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
  <form class="password-recovery" method="POST" id="formulario_recuperar"
    data-controller="<?= base_url('modificacion/contrasena'); ?>" data-redirect="<?= base_url(); ?>">
    <h2>Actualizar contraseña</h2>
    <p>Nueva contraseña</p>
    <div class="form-container">
      <input id="old-password" type="password" name="contraseña1" placeholder="Contraseña" required />
      <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('old-password')"></i>
    </div>
    <p>Confirmar contraseña</p>
    <div class="form-container">
      <input id="new-password" type="password" name="contraseña2" placeholder="Contraseña" required />
      <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('new-password')"></i>
    </div>
    <button type="submit">Cambiar</button>

    <div class="back">
      <a href="#" onclick="goBack()">Regresar <i>&#x21B6;</i></a>
    </div>
  </form>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="/venta/assets/js/actualizarPassword.js"></script>
  <script src="/venta/assets/js/modificarContraseña.js"></script>
</body>

</html>