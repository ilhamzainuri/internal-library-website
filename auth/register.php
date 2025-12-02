<?php
include '../db/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = mysqli_real_escape_string($koneksi, $_POST['username']);
  $password = mysqli_real_escape_string($koneksi, $_POST['password']);
  $nama = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
  $ttl = $_POST['ttl'];
  $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

  // Cek apakah username sudah ada
  $cek = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
  if (mysqli_num_rows($cek) > 0) {
    $error = "Username sudah digunakan.";
  } else {
    // Simpan ke DB
    mysqli_query($koneksi, "INSERT INTO user (username, password, nama_lengkap, ttl, alamat) 
                            VALUES ('$username', '$password', '$nama', '$ttl', '$alamat')");
    header("Location: login.php?success=1");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
          <h4 class="mb-0">Register</h4>
        </div>
        <div class="card-body">
          <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
          <?php endif; ?>
          <form method="post">
            <div class="mb-3">
              <label>Full Name</label>
              <input type="text" name="nama_lengkap" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Date of Birth</label>
              <input type="date" name="ttl" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Address</label>
              <textarea name="alamat" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
              <label>Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-success w-100">Register</button>
          </form>
          <div class="mt-3 text-center">
            Already have an account? <a href="login.php">Login</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
