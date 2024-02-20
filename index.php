<?php 
  require('server.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login / Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen">
  <div class="flex items-center justify-center mb-10 p-10">
    <?php 
      if ($_SESSION['error']) {
        echo '<p class="bg-red-300 px-5 py-2 rounded-full">' . $_SESSION['error'] . '</p>';
        unset($_SESSION['error']);
      }

      if ($_SESSION['success']) {
        echo '<p class="bg-green-300 px-5 py-2 rounded-full">' . $_SESSION['success'] . '</p>';
        unset($_SESSION['success']);
      }
    ?>
  </div>
  <div class="flex justify-center mb-10">
    <h1 class="text-4xl">PHP Bejelentkezés / Regisztráció</h1>
  </div>
  <?php
    if (!$_SESSION['username']) {
      echo '
      <div class="flex flex-row justify-evenly items-center">
        <div class="flex flex-col">
          <h1 class="text-3xl">Bejelentkezés</h1>
          <form method="POST" class="flex flex-col">
            <label for="login-email">Email cím</label>
            <input type="email" name="login-email" id="login-email" class="px-4 py-2 text-lg border border-stone-200 rounded-lg mb-3">
            <label for="login-password">Jelszó</label>
            <input type="password" name="login-password" id="login-password" class="px-4 py-2 text-lg border border-stone-200 rounded-lg mb-3">
            <button type="submit" name="login" class="px-4 py-2 bg-blue-400 text-white rounded-lg self-center">Bejelentkezés</button>
          </form>
        </div>
    
        <div class="flex flex-col">
          <h1 class="text-3xl">Regisztráció</h1>
          <form method="POST" class="flex flex-col">
            <label for="reg-username">Felhasználónév</label>
            <input type="text" id="reg-username" name="reg-username" class="px-4 py-2 text-lg border border-stone-200 rounded-lg mb-3">
            <label for="reg-email">Email cím</label>
            <input type="email" name="reg-email" id="reg-email" class="px-4 py-2 text-lg border border-stone-200 rounded-lg mb-3">
            <label for="reg-pass1">Jelszó</label>
            <input type="password" name="reg-pass1" id="reg-pass1" class="px-4 py-2 text-lg border border-stone-200 rounded-lg mb-3">
            <label for="reg-pass2">Jelszó ismét</label>
            <input type="password" name="reg-pass2" id="reg-pass2" class="px-4 py-2 text-lg border border-stone-200 rounded-lg mb-3">
            <button type="submit" name="register" class="px-4 py-2 bg-blue-400 text-white rounded-lg self-center">Regisztráció</button>
          </form>
        </div>
      </div>
      ';
    } else {
      echo "
        <div class='flex flex-col items-center justify-center justify-between px-4 py-2 text-lg py-32'>
          <h1 class='text-4xl mb-20'>Be vagy jelentkezve mint <span class='text-green-400'>". $_SESSION['username'] ."</span>.</h1>
          <form method='POST'>
            <button type='submit' name='logout' class='px-4 py-2 bg-red-400 rounded-lg'>Kijelentkezés</button>
          </form>
        </div>
      ";
    }
  ?>
</body>
</html>