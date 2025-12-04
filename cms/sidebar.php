<!-- ==== Bootstrap Icons CDN ==== -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f4f4;
  }

  /* ==== SIDEBAR ==== */
  .sidebar {
    width: 230px;
    background: #1e88e5; /* Biru cerah */
    color: #ffffff;
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    padding: 25px 20px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
  }

  .sidebar h2 {
    text-align: center;
    margin: 0 0 35px 0;
    font-size: 22px;
    letter-spacing: 1px;
    font-weight: bold;
    color: #bbdefb; /* biru muda lembut */
  }

  .sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
    flex: 1;
  }

  .sidebar ul li {
    margin: 12px 0;
  }

  .sidebar ul li a {
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: #2196f3; /* Biru normal */
    border-radius: 8px;
    transition: 0.25s;
    font-size: 15px;
  }

  .sidebar ul li a:hover {
    background: #42a5f5; /* Biru terang hover */
    padding-left: 16px;
  }

  .sidebar ul li a i {
    font-size: 18px;
  }

  /* ==== LOGOUT BUTTON ==== */
  .logout a {
    background: #e53935; /* merah default */
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    border-radius: 8px;
    text-decoration: none;
    color: white;
    transition: 0.25s;
  }

  .logout a:hover {
    background: #ef5350; /* merah terang saat hover */
    padding-left: 16px;
  }

  /* ==== CONTENT ==== */
  .content {
    margin-left: 250px;
    padding: 25px;
    min-height: 100vh;
    box-sizing: border-box;
  }

  /* ==== RESPONSIVE ==== */
  @media (max-width: 768px) {
    .sidebar {
      width: 190px;
      padding: 20px;
    }
    .content {
      margin-left: 210px;
    }
    .sidebar h2 {
      font-size: 18px;
    }
  }

  @media (max-width: 600px) {
    .sidebar {
      width: 100%;
      height: auto;
      position: relative;
    }
    .content {
      margin-left: 0;
    }
    .sidebar ul li a {
      padding: 10px;
      font-size: 14px;
    }
  }
</style>

<div class="sidebar">
  <h2><i class="bi bi-speedometer2"></i> Admin Panel</h2>

  <ul>
    <li><a href="admin.php"><i class="bi bi-house-door"></i> Dashboard</a></li>
    <li><a href="buku.php"><i class="bi bi-journal-bookmark"></i> Data Buku</a></li>
    <li><a href="kategori.php"><i class="bi bi-tags"></i> Kategori</a></li>
    <li><a href="subkategori.php"><i class="bi bi-diagram-2"></i> Subkategori</a></li>
    <li><a href="rak.php"><i class="bi bi-archive"></i> Rak</a></li>
    <li><a href="user.php"><i class="bi bi-people"></i> User</a></li>
  </ul>

  <div class="logout">
    <a href="../auth/logout.php">
      <i class="bi bi-box-arrow-right"></i> Log Out
    </a>
  </div>
</div>
