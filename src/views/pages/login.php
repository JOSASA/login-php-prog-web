<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="./css/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <!-- MAIN centrado -->
  <main>
    <div class="check-in-area">
      <div class="titulo-logo">
        <h2>Log in</h2>
      </div>
      <!-- Formulario -->
      <form action="<?= BASE_URL ?>index.php" method="post" class="check-in-form">
        <input type="hidden" name="action" value="login">
        <div class="user">
          <label for="username">
            <i class="fas fa-user"></i>
          </label>
          <input type="text" name="username" placeholder="User" id="username" required>
        </div>
        <div class="password">
          <label for="password">
            <i class="fas fa-lock"></i>
          </label>
          <input type="password" name="password" placeholder="Password" id="password" required>
          <!-- Botón de login -->
        </div>
        <button type="submit">
          <i class="fas fa-sign-in-alt"></i> Log In
        </button>
        <label>
          <input type="checkbox" name="rememberme" value="1"> Recordarme
        </label>
        <!-- Botón de registro -->
        <a href="<?= BASE_URL ?>/index.php?route=register" class="register-btn">
          <i class="fas fa-user-plus"></i> Registrarse
        </a>
      </form>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-elements">
      <p>© 2025 - Tu proyecto</p>
    </div>
  </footer>

</body>

</html>