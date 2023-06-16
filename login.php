<?php
if (isset($_POST['login'])) {
  session_start();
  include 'config.php';

  // Agar tidak muncul error pada saat masuk injection
  $user = mysqli_real_escape_string($conn, $_POST['user']);
  $pass = mysqli_real_escape_string($conn, $_POST['pass']);

  $cek = mysqli_query($conn, "SELECT * FROM admin WHERE username = '" . $user . "' AND password = '" . $pass . "'");
  if (mysqli_num_rows($cek) > 0) {
    $d = mysqli_fetch_object($cek);
    $_SESSION['status_login'] = true;
    $_SESSION['a_global'] = $d;
    $_SESSION['id_admin'] = $d->id_admin;
    $_SESSION['username'] = $d->username;
    echo '<script>window.location="home_admin.php"</script>';
  } else {
    echo '<script>alert("Username atau Password Salah !")</script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin</title>

  <link rel="stylesheet" type="text/css" href="templates/css/style.css">

  <!-- <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            border: 5px;
            border-color: #000000;
        }
    </style> -->
</head>

<body>

  <h1 style="text-align: center; margin-top: 100px; text-decoration-line: underline; text-decoration-skip-ink: none; text-underline-offset: 15px;">JeWePe Admin</h1>
  <div class="body-form">
    <div class="login-form">
      <form action="login.php" method="POST">
        <label style="font-family: sans-serif" for="username">Username</label>
        <input type="text" id="username" name="user" required>

        <label style="font-family: sans-serif" for="password">Password</label>
        <input type="password" id="password" name="pass" required>

        <input type="submit" value="Login" class="login-button" name="login">
      </form>
    </div>
  </div>
</body>

</html>