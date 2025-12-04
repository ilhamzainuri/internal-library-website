<?php
include '../db/koneksi.php';

// Pastikan koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal.");
}

// Hitung data
$totalBuku        = mysqli_num_rows(mysqli_query($koneksi, "SELECT bukuId FROM buku"));
$totalKategori    = mysqli_num_rows(mysqli_query($koneksi, "SELECT kategoriId FROM kategori"));
$totalSubkategori = mysqli_num_rows(mysqli_query($koneksi, "SELECT id_subkategori FROM subkategori"));
$totalRak         = mysqli_num_rows(mysqli_query($koneksi, "SELECT rakId FROM rak"));
$totalAdmin       = mysqli_num_rows(mysqli_query($koneksi, "SELECT userId FROM useracc WHERE role='admin'"));
$totalGuest       = mysqli_num_rows(mysqli_query($koneksi, "SELECT userId FROM useracc WHERE role='guest'"));
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
        background: #eef1f5;
    }

    /* Sidebar */
    .sidebar {
        width: 260px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background: linear-gradient(135deg, #4db8ff, #1a8cff);
        color: white;
        padding: 20px;
        z-index: 100;
        box-shadow: 3px 0 15px rgba(0,0,0,0.15);
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 12px 10px;
        margin-bottom: 8px;
        border-radius: 8px;
        transition: 0.3s;
    }

    .sidebar a:hover {
        background: rgba(255,255,255,0.25);
        transform: translateX(6px);
    }

    /* Konten */
    .content-wrapper {
        margin-left: 260px;
        padding: 25px;
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    /* Dashboard Cards */
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }

    .card-stats {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 8px 18px rgba(0,0,0,0.12);
        transition: all 0.35s ease;
        position: relative;
        overflow: hidden;
        animation: slideUp 0.7s forwards;
        opacity: 0;
        cursor: pointer;
    }

    .card-stats:hover {
        transform: translateY(-10px) scale(1.03);
        background: linear-gradient(135deg, #ffffff, #e6f4ff);
        box-shadow: 0 20px 35px rgba(0,0,0,0.25);
    }

    .card-stats:hover::after {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 16px;
        box-shadow: 0 0 25px rgba(0,140,255,0.5);
        pointer-events: none;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(40px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .card-stats p {
        margin: 0;
        font-weight: 600;
        color: #555;
    }

    .card-stats h3 {
        margin-top: 8px;
        font-size: 2rem;
        font-weight: 800;
        color: #1a8cff;
    }

    /* Welcome Banner */
    .welcome-box {
        border-left: 6px solid #1a8cff;
    }
  </style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <?php include 'sidebar.php'; ?>
</div>

<!-- Konten -->
<div class="content-wrapper">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="bi bi-house"></i> Home</li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>

    <!-- Welcome Card -->
    <div class="welcome-box p-4 mb-4 rounded-4 shadow-sm bg-white d-flex align-items-center">
        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" 
             width="70" class="me-3" />
        <div>
            <h4 class="fw-bold mb-1">Halo Admin!</h4>
            <p class="text-muted mb-0">Semoga harimu menyenangkan, berikut ringkasan statistik sistem.</p>
        </div>
    </div>


    <!-- Cards -->
    <div class="dashboard-cards">

        <div class="card-stats">
            <p><i class="bi bi-book"></i> Total Buku</p>
            <h3><?= $totalBuku ?></h3>
        </div>

        <div class="card-stats">
            <p><i class="bi bi-person-badge"></i> Total Admin</p>
            <h3><?= $totalAdmin ?></h3>
        </div>

        <div class="card-stats">
            <p><i class="bi bi-people"></i> Total User</p>
            <h3><?= $totalGuest ?></h3>
        </div>

        <div class="card-stats">
            <p><i class="bi bi-tags"></i> Total Kategori</p>
            <h3><?= $totalKategori ?></h3>
        </div>

        <div class="card-stats">
            <p><i class="bi bi-tag"></i> Total Subkategori</p>
            <h3><?= $totalSubkategori ?></h3>
        </div>

        <div class="card-stats">
            <p><i class="bi bi-box"></i> Total Rak</p>
            <h3><?= $totalRak ?></h3>
        </div>

    </div>

    <!-- Grafik Statistik -->
    <div class="card p-4 mt-5 shadow-sm rounded-4">
        <h5 class="fw-bold mb-3"><i class="bi bi-graph-up"></i> Grafik Statistik Data</h5>
        <canvas id="chartData" height="150"></canvas>
    </div>

    <!-- Info Sistem -->
    <div class="alert alert-info mt-4 shadow-sm rounded-4">
        <h5 class="fw-bold"><i class="bi bi-info-circle"></i> Informasi Sistem</h5>
        <p class="mb-0">Pastikan data perpustakaan selalu diperbarui secara berkala untuk menjaga keakuratan sistem.</p>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartData');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Buku', 'Admin', 'User', 'Kategori', 'Subkategori', 'Rak'],
        datasets: [{
            label: 'Jumlah Data',
            data: [
                <?= $totalBuku ?>,
                <?= $totalAdmin ?>,
                <?= $totalGuest ?>,
                <?= $totalKategori ?>,
                <?= $totalSubkategori ?>,
                <?= $totalRak ?>
            ],
            borderWidth: 2
        }]
    }
});
</script>

</body>
</html>