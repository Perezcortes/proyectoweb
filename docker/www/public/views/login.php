<!DOCTYPE html>
<html lang="es" data-bs-theme="auto">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="../css/login_dark.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Blacksword&display=swap" rel="stylesheet">
</head>

<body>
  <nav class="navbar">
    <ul>
      <li><a href="../index.php">Inicio</a></li>
      <li><a href="#">Servicios</a></li>
      <li><a href="#">Contacto</a></li>
    </ul>
  </nav>
  <header>
    <h1>Bienvenido</h1>
  </header>
  <div class="container" id="container">
    <!-- Registro -->
    <div class="form-container register-container">
      <form action="../register.php" method="POST">
        <h1>Regístrate aquí</h1>
        <div class="form-control">
          <input type="text" id="username" name="username" placeholder="Nombre" />
          <small id="username-error"></small>
        </div>
        <div class="form-control">
          <input type="email" id="email" name="email" placeholder="Correo electrónico" />
          <small id="email-error"></small>
        </div>
        <div class="form-control">
          <input type="password" id="password" name="password" placeholder="Contraseña" />
          <small id="password-error"></small>
        </div>
        <button type="submit" id="reload-button">Registrar</button>
        <span>O usa tu cuenta:</span>
        <div class="social-container">
          <a href="#" class="social"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="social"><i class="fa-brands fa-google"></i></a>
          <a href="#" class="social"><i class="fa-brands fa-tiktok"></i></a>
        </div>
      </form>
    </div>

    <!-- Inicio de sesión -->
    <div class="form-container login-container">
      <form id="loginForm">
        <h1>Inicia sesión aquí</h1>
        <div class="form-control">
          <input type="email" class="email-2" name="email" placeholder="Correo electrónico" required />
          <small class="email-error-2"></small>
        </div>
        <div class="form-control">
          <input type="password" class="password-2" name="password" placeholder="Contraseña" required />
          <small class="password-error-2"></small>
        </div>
        <div class="content">
          <label class="checkbox">
            <input type="checkbox" id="checkbox" /> Recuérdame
          </label>
          <a href="#" class="pass-link">¿Olvidaste la contraseña?</a>
        </div>
        <button type="button" id="loginButton">Iniciar sesión</button>
        <span>O usa tu cuenta:</span>
        <div class="social-container">
          <a href="#" class="social"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#" class="social"><i class="fa-brands fa-google"></i></a>
          <a href="#" class="social"><i class="fa-brands fa-instagram"></i></a>
        </div>
      </form>
    </div>

    <!-- Paneles de la superposición -->
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1 class="title">Hola amigos</h1>
          <p>Si tienes una cuenta, inicia sesión aquí y diviértete</p>
          <button class="ghost" id="login">
            Iniciar sesión <i class="fa-solid fa-arrow-left"></i>
          </button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1 class="title">Deja un recuerdo ahora</h1>
          <p>Si aún no tienes una cuenta, únete a nosotros</p>
          <button class="ghost" id="register">
            Registrarse <i class="fa-solid fa-arrow-right"></i>
          </button>
        </div>
      </div>
    </div>

  </div>
  <div class="whatsapp-chat">
    <span>Chat</span>
    <a href="https://wa.me/529531447499" target="_blank">
      <i class="fa-brands fa-whatsapp"></i>
    </a>
  </div>
  <!-- Incluir el Footer -->
  <?php include './footer.php'; ?>
  <script src="../js/login.js"></script>
</body>

</html>