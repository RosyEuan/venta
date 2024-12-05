<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar Contraseña</title>
  <link href="https://fonts.googleapis.com/css2?family=Khmer&family=Konkhmer+Sleokchher&family=Suez+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Maname&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #0F0D26;
    }

    .password-recovery {
      background: linear-gradient(90deg, #00076C 0%, #07006C 46.89%, #0D014E 100%);
      color: white;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      text-align: center;
      position: relative;
      width: 550px;
      height: 380px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .password-recovery h2 {
      margin: 0 0 20px 0;
      font-size: 32px;
      font-family: "Merriweather";
    }

    .password-recovery p {
      margin: 0 0 20px 0;
      text-align: left;
      font-size: 20px;
      font-family: "Merriweather";
      width: 100%;
      margin-left: 24%;
    }

    .form-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
      width: 100%;
    }

    .password-recovery input {
      width: 70%;
      padding: 20px;
      margin-bottom: 15px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-family: "Merriweather";
    }

    .password-recovery button {
      background-color: #E8EC07;
      color: #16225a;
      border: none;
      padding: 15px 50px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      font-family: "Merriweather";
    }

    .password-recovery button:hover {
      background-color: #e0c200;
    }

    .password-recovery .back {
      position: absolute;
      bottom: 20px;
      right: 20px;
      display: flex;
      align-items: center;
      color: white;
      font-size: 16px;
      font-weight: bold;
      font-family: "Merriweather";
    }

    .password-recovery .back i {
      margin-left: 5px;
      font-size: 1.2em;
    }

    .password-recovery .back a {
      text-decoration: none;
      color: white;
    }

    .password-recovery .back a:hover {
      color: #E8EC07;
    }

    .eye-icon {
      position: absolute;
      right: 80px;
      top: 45%;
      transform: translateY(-50%);
      cursor: pointer;
      color:#696969;
    }
  </style>
</head>
<body>
  <div class="password-recovery">
    <h2>Cambiar contraseña</h2>
    <p>Contraseña anterior</p>
    <div class="form-container">
      <input id="old-password" type="password" placeholder="Contraseña" required />
      <i class="fas fa-eye eye-icon" onclick="togglePasswordVisibility('old-password')"></i>
    </div>
    <p>Nueva contraseña</p>
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
