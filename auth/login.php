<?php
session_start();
include '../db/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM useracc WHERE username='$username' AND password='$password' LIMIT 1");
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        $_SESSION['userId']   = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role']     = $user['role']; 

        // Redirect khusus untuk admin
        if ($user['role'] === 'admin') {
            header("Location: ../cms/admin.php");
        } else {
            // semua user non-admin diarahkan ke home
            $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : './index.php';
            header("Location: ../$redirect");
        }
        exit;
    } else {
        $error = "Username atau password salah.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('../assets/images/bg1.jpg') no-repeat center center fixed;
    background-size: cover;

    }
    .login-box {
      max-width: 400px;
      margin: 80px auto;
      padding: 30px;
      background: rgba(255, 255, 255, 0.50);
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>
<body>

<div class="login-box">
  <h3 class="text-center mb-4">Login</h3>

  <?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" name="username" class="form-control" required autofocus>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Login</button>
    <div class="mt-2 text-center">
      <a href="../index.php">Back to HOME</a>
    </div>
  </form>
</div>

</body>
</html>
