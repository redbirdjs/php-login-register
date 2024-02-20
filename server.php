<?php 
  session_start();
  $host = "localhost:3306";
  $dbname = "login_register_php";
  $uname = "root";
  $passwd = "Admin1234";

  $conn = new PDO("mysql:host=$host;dbname=$dbname", $uname, $passwd);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if (isset($_POST['login'])) {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

    if (!$email || !$password) return $_SESSION['error'] = "Hibás / hiányzó adatok!";

    $c_stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
    $c_stmt->execute([
      ':email' => $email
    ]);
    $res = $c_stmt->fetchAll();

    if (!$res[0]) return $_SESSION['error'] = "A felhasználó nem létezik.";
    $check = password_verify($password, $res[0]['password']);

    if (!$check) return $_SESSION['error'] = 'Hibás email cím / jelszó!';

    unset($_SESSION['error']);
    $_SESSION['username'] = $res[0]['username'];
    $_SESSION['success'] = "Sikeres bejelentkezés!";
  }

  if (isset($_POST['register'])) {
    $username = $_POST['reg-username'];
    $email = $_POST['reg-email'];
    $pass1 = $_POST['reg-pass1'];
    $pass2 = $_POST['reg-pass2'];

    if (!$username || !$email || !$pass1 || !$pass2) return $_SESSION['error'] = "Hibás / hiányzó adatok!";
    if ($pass1 != $pass2) return $_SESSION['error'] = "A két jelszó nem egyezik!";

    $hash = password_hash($pass1, PASSWORD_BCRYPT);

    $stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
    $stmt->execute([
      ':username' => $username,
      ':email' => $email,
      ':password' => $hash
    ]);

    unset($_SESSION['error']);
    $_SESSION['success'] = "Sikeres regisztráció!";
  }

  if (isset($_POST['logout'])) {
    unset($_SESSION['success']);
    unset($_SESSION['error']);
    unset($_SESSION['username']);
    session_destroy();
  }
?>