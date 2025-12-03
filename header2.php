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
        <div class="header-main bg-primary text-white py-2">
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


                    <!-- scroll to about section -->
                    <li class="menu-category">
                        <a href="index.php#about" class="menu-title">About</a>
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