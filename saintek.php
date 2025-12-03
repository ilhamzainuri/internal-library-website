<?php
include './db/koneksi.php';

// --- AMBIL INPUT SEARCH ---
$search = isset($_GET['q']) ? mysqli_real_escape_string($koneksi, trim($_GET['q'])) : '';

$kategoriId = isset($_GET['kategoriId']) ? intval($_GET['kategoriId']) : 0;
$subkategoriId = isset($_GET['subkategoriId']) ? intval($_GET['subkategoriId']) : 0;

// --- AMBIL KATEGORI DEFAULT JIKA TIDAK ADA SEARCH / FILTER ---
$kategori = isset($_GET['kategori']) ? mysqli_real_escape_string($koneksi, $_GET['kategori']) : 'Ilmu Sains dan Teknologi';
$subkategori = isset($_GET['subkategori']) ? mysqli_real_escape_string($koneksi, $_GET['subkategori']) : '';

if ($kategoriId == 0) {
    $getKategoriId = mysqli_query($koneksi, "SELECT kategoriId FROM kategori WHERE nama_kategori = '$kategori'");
    $dataKategori = mysqli_fetch_assoc($getKategoriId);
    $kategoriId = $dataKategori['kategoriId'] ?? 0;
}

// --- QUERY BUKU ---
$query = "SELECT 
    buku.*, 
    subkategori.nama_subkategori, 
    kategori.nama_kategori 
FROM buku
JOIN subkategori ON buku.id_subkategori = subkategori.id_subkategori
JOIN kategori ON subkategori.kategoriId = kategori.kategoriId
WHERE 1=1";

// FILTER SEARCH
if (!empty($search)) {
    $query .= " AND (
        buku.judul LIKE '%$search%' OR
        buku.penulis LIKE '%$search%' OR
        buku.penerbit LIKE '%$search%'
    )";
}

// FILTER KATEGORI
if ($kategoriId > 0) {
    $query .= " AND kategori.kategoriId = $kategoriId";
}

// FILTER SUBKATEGORI DROPDOWN
if ($subkategoriId > 0) {
    $query .= " AND buku.id_subkategori = $subkategoriId";
}

// FILTER SUBKATEGORI VIA LINK
if (!empty($subkategori)) {
    $query .= " AND subkategori.nama_subkategori = '$subkategori'";
}

$result = mysqli_query($koneksi, $query);

// --- DATA RAK ---
$queryRak = "SELECT rakId, nomor_rak FROM rak";
$resultRak = mysqli_query($koneksi, $queryRak);
$rakList = [];
while ($rak = mysqli_fetch_assoc($resultRak)) {
    $rakList[$rak['rakId']] = $rak['nomor_rak'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Perpustakaan UNIGA - SainTek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="./assets/images/logo/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
          <link rel="stylesheet" href="./assets/css/style-prefix.css">
  <link rel="stylesheet" href="./assets/css/style.css">


    <style>
        body {
            background-color: #f8f9fa;
        }

        #sidebar {
            min-height: 100vh;
        }

        #sidebar .nav-link {
            padding: 10px 15px;
            border-radius: 4px;
        }

        #sidebar .nav-link:hover {
            background-color: #f1f1f1;
        }

        .card {
            transition: transform .2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <?php include 'header2.php'; ?>

    <!-- Navigation khusus search -->
<nav>
    <ul>
      <li class="menu-category flex-grow-1">
        <form action="SainTek.php" method="GET" class="d-flex">
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
  </nav>


    <div class="container-fluid mt-3">
        <div class="row">

            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-white border-end" id="sidebar">
                <div class="position-sticky pt-3">
                    <h5 class="px-3 mb-3 text-dark fw-bold">Subcategories</h5>
                    <ul class="nav flex-column px-3">
                        <?php
                        $querySub = "SELECT * FROM subkategori WHERE kategoriId = $kategoriId";
                        $resultSub = mysqli_query($koneksi, $querySub);
                        if (mysqli_num_rows($resultSub) > 0): ?>
                            <li class="nav-item mb-1">
                                <a class="nav-link fw-bold text-dark" href="SainTek.php">Ilmu Sains dan Teknologi</a>
                            </li>
                            <?php while ($sub = mysqli_fetch_assoc($resultSub)) : ?>
                                <li class="nav-item mb-1">
                                    <a class="nav-link text-dark" href="SainTek.php?kategori=<?php echo urlencode($kategori); ?>&subkategori=<?php echo urlencode($sub['nama_subkategori']); ?>">
                                        <?php echo $sub['nama_subkategori']; ?>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <li class="nav-item text-muted">No subcategories</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>

            <!-- Konten Buku -->
            <main class="col-md-9 col-lg-10">
                <h2 class="fw-semibold mb-4">Book List</h2>
                <?php if (mysqli_num_rows($result) == 0): ?>
        <div class="alert alert-warning">
            <strong>Buku tidak ditemukan.</strong> Coba kata kunci lain.
        </div>
    <?php endif; ?>
                <div class="row">
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <img src="./assets/images/books/<?php echo $row['gambar']; ?>"
                                    class="card-img-top"
                                    alt="<?php echo $row['judul']; ?>"
                                    style="height: 250px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['judul']; ?></h5>
                                    <p class="card-text text-muted mb-1">
                                        <small><?php echo $row['nama_kategori'] . ' » ' . $row['nama_subkategori']; ?></small>
                                    </p>
                                    <p class="card-text mb-1"><small class="text-muted">Jumlah Buku: <?php echo $row['jumlah_buku']; ?></small></p>
                                    <p class="card-text mb-3"><small class="text-muted">Posisi Rak: <?php echo $rakList[$row['rakId']] ?? 'N/A'; ?></small></p>
                                    <!-- Tombol Detail -->
                                    <a href="javascript:void(0);"
                                        class="btn btn-outline-primary btn-sm viewDetail"
                                        data-id="<?php echo $row['bukuId']; ?>">
                                        More Info
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal Global -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-sm">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Detail Buku</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="detailContent">
                    <!-- konten detail akan dimuat via AJAX -->
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.html'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll(".viewDetail");
            buttons.forEach(btn => {
                btn.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");
                    document.getElementById("detailContent").innerHTML = `
        <div class="d-flex justify-content-center align-items-center" style="height:200px;">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      `;
                    fetch("showdetail.php?bukuId=" + id)
                        .then(response => response.text())
                        .then(data => {
                            document.getElementById("detailContent").innerHTML = data;
                            const modal = new bootstrap.Modal(document.getElementById("detailModal"));
                            modal.show();
                        })
                        .catch(err => {
                            document.getElementById("detailContent").innerHTML = "<p class='text-danger'>Gagal memuat detail.</p>";
                        });
                });
            });
        });
    </script>
</body>

</html>