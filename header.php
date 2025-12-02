<?php
session_start();
include './db/koneksi.php'; // pastikan koneksi tersedia
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan UNIGA</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS Bundle (wajib untuk dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <header>
        <div class="header-main">
            <div class="container d-flex justify-content-between align-items-center">

                <!-- Logo -->
                <div class="d-flex align-items-center">
                    <a href="index.php" class="header-logo me-2">
                        <img src="./assets/images/logo/LOGO.png" alt="logo" height="80">
                    </a>
                    <span class="fw-bold fs-4 text-dark">Perpustakaan UNIGA</span>
                </div>

                <!-- User Actions -->
                <div class="header-user-actions">
                    <div class="position-relative user-wrapper" onmouseover="showLogin()" onmouseout="hideLogin()">
                        <button class="action-btn">
                            <ion-icon name="person-outline"></ion-icon>
                        </button>
                        <div id="loginDropdown" class="position-absolute bg-white border p-2 rounded shadow-sm"
                            style="top: 45px; right: 0; display: none; z-index: 1000;">
                            <?php if (!isset($_SESSION['username'])): ?>
                                <a href="auth/login.php" class="btn btn-sm btn-primary w-100">Login</a>
                            <?php else: ?>
                                <div class="fw-bold mb-2">Hi, <?= htmlspecialchars($_SESSION['username']) ?></div>
                                <a href="cust-handler/riwayat.php" class="btn btn-sm btn-success w-100 mb-2">My Transactions</a>
                                <a href="auth/logout.php" class="btn btn-sm btn-danger w-100">Logout</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Navigation -->
        <nav class="desktop-navigation-menu">
            <div class="container d-flex justify-content-center">
                <ul class="desktop-menu-category-list">

                    <li class="menu-category">
                        <a href="index.php" class="menu-title">Home</a>
                    </li>

                    <li class="menu-category">
                        <a href="#" class="menu-title">Categories</a>

                        <div class="dropdown-panel">

                            <ul class="dropdown-panel-list">

                                <li class="menu-title">
                                    <a href="soshum.php">Ilmu Sosial dan Humaniora</a>
                                </li>

                                <li class="panel-list-item">
                                    <a href="soshum.php?kategori=Ilmu+Sosial+dan+Humaniora&subkategori=Sosiologi">Sosiologi</a>
                                </li>

                                <li class="panel-list-item">
                                    <a href="soshum.php?kategori=Ilmu+Sosial+dan+Humaniora&subkategori=Psikologi">Psikologi</a>
                                </li>

                                <li class="panel-list-item">
                                    <a href="soshum.php?kategori=Ilmu+Sosial+dan+Humaniora&subkategori=Hukum">Hukum</a>
                                </li>
                                <li class="panel-list-item">
                                    <a href="soshum.php?kategori=Ilmu+Sosial+dan+Humaniora&subkategori=Sejarah">Sejarah</a>
                                </li>
                                <li class="panel-list-item">
                                    <a href="soshum.php?kategori=Ilmu+Sosial+dan+Humaniora&subkategori=Ekonomi">Ekonomi</a>
                                </li>

                            </ul>

                            <ul class="dropdown-panel-list">

                                <li class="menu-title">
                                    <a href="saintek.php">Ilmu Sains dan Teknologi</a>
                                </li>

                                <li class="panel-list-item">
                                    <a href="saintek.php?kategori=Ilmu+Sains+dan+Teknologi&subkategori=Komputer">Komputer</a>
                                </li>

                                <li class="panel-list-item">
                                    <a href="saintek.php?kategori=Men&subkategori=Bottoms">Fisika</a>
                                </li>

                                <li class="panel-list-item">
                                    <a href="saintek.php?kategori=Men&subkategori=Shoes">Kesehatan</a>
                                </li>

                                <li class="panel-list-item">
                                    <a href="saintek.php?kategori=Men&subkategori=Jacket">Konstruksi</a>
                                </li>

                                <li class="panel-list-item">
                                    <a href="saintek.php?kategori=Men&subkategori=Sunglasses">Geologi</a>
                                </li>

                            </ul>

                        </div>
                    </li>


                    <!-- Search Bar -->
                    <li class="menu-category flex-grow-1">
                        <form action="index.php" method="GET" class="d-flex">
                            <!-- Input keyword -->
                            <input type="text" name="q" class="form-control form-control-sm me-2"
                                placeholder="Cari judul, penulis, penerbit...">

                            <!-- Tombol Filter -->
                            <div class="dropdown me-2">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Filter
                                </button>
                                <div class="dropdown-menu p-3" style="min-width: 250px;">
                                    <!-- Dropdown kategori -->
                                    <select name="kategoriId" class="form-select form-select-sm mb-2">
                                        <option value="">Semua Kategori</option>
                                        <?php
                                        $kategoriRes = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori ASC");
                                        while ($kat = mysqli_fetch_assoc($kategoriRes)) {
                                            echo '<option value="' . $kat['kategoriId'] . '">' . htmlspecialchars($kat['nama_kategori']) . '</option>';
                                        }
                                        ?>
                                    </select>

                                    <!-- Dropdown subkategori -->
                                    <select name="subkategoriId" class="form-select form-select-sm">
                                        <option value="">Semua Subkategori</option>
                                        <?php
                                        $subRes = mysqli_query($koneksi, "SELECT * FROM subkategori ORDER BY nama_subkategori ASC");
                                        while ($sub = mysqli_fetch_assoc($subRes)) {
                                            echo '<option value="' . $sub['id_subkategori'] . '">' . htmlspecialchars($sub['nama_subkategori']) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Tombol Search -->
                            <button type="submit" class="btn btn-sm btn-primary">Search</button>
                        </form>
                    </li>

                </ul>
            </div>
        </nav>
    </header>

    <script>
        function showLogin() {
            document.getElementById('loginDropdown').style.display = 'block';
        }

        function hideLogin() {
            document.getElementById('loginDropdown').style.display = 'none';
        }
    </script>

</body>

</html>