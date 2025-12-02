<?php
include './db/koneksi.php';

$kategori = isset($_GET['kategori']) ? mysqli_real_escape_string($koneksi, $_GET['kategori']) : 'Ilmu Sains dan Teknologi';
$subkategori = isset($_GET['subkategori']) ? mysqli_real_escape_string($koneksi, $_GET['subkategori']) : '';

// Ambil ID kategori
$getKategoriId = mysqli_query($koneksi, "SELECT kategoriId FROM kategori WHERE nama_kategori = '$kategori'");
if (!$getKategoriId) {
    die("Kategori error: " . mysqli_error($koneksi));
}
$dataKategori = mysqli_fetch_assoc($getKategoriId);
$kategoriId = $dataKategori['kategoriId'] ?? 0;

// Ambil produk
$query = "SELECT 
  buku.*, 
  subkategori.nama_subkategori, 
  kategori.nama_kategori 
FROM buku
JOIN subkategori ON buku.id_subkategori = subkategori.id_subkategori
JOIN kategori ON subkategori.kategoriId = kategori.kategoriId
WHERE kategori.kategoriId = $kategoriId";

if (!empty($subkategori)) {
    $query .= " AND subkategori.nama_subkategori = '$subkategori'";
}

$result = mysqli_query($koneksi, $query);
if (!$result) {
    die("Produk error: " . mysqli_error($koneksi)); // ❗ ini akan menampilkan pesan jika error
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoid - Outdoor Gear</title>

    <!--
    - favicon
  -->
    <link rel="shortcut icon" href="./assets/images/logo/favicon.ico" type="image/x-icon">

    <!--
    - custom css link
  -->
    <link rel="stylesheet" href="./assets/css/style-prefix.css">
    <link rel="stylesheet" href="./assets/css/style.css">

    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!--
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@6.0.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@6.0.0/dist/ionicons/ionicons.js"></script>

    <!--
    - custom js link
  -->
    <script defer src="./assets/js/script.js"></script>

    <style>
        #sidebar {
            min-height: 100vh;
            background-color: #fff;
        }

        #sidebar .nav-link {
            padding: 12px 20px;
            border-bottom: 1px solid #f0f0f0;
            transition: background-color 0.2s ease;
        }

        #sidebar .nav-link:hover {
            background-color: #f8f9fa;
            color: #000;
        }

        #sidebar .nav-link.active {
            background-color: #000;
            color: #fff;
        }
    </style>

</head>

<body>
    <?php include 'header.php'; ?>

    <div class="container-fluid mt-3">
        <div class="row">

            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-white border-end">
                <div class="position-sticky pt-3">
                    <h5 class="px-3 mb-3 text-dark fw-bold">Subcategories</h5>

                    <?php
                    include './db/koneksi.php';

                    $kategori = isset($_GET['kategori']) ? mysqli_real_escape_string($koneksi, $_GET['kategori']) : 'Ilmu Sains dan Teknologi';

                    // Ambil kategoriId
                    $queryKategori = mysqli_query($koneksi, "SELECT kategoriId FROM kategori WHERE nama_kategori = '$kategori'");

                    if (!$queryKategori) {
                        die("Kategori Query Error: " . mysqli_error($koneksi));
                    }

                    $dataKategori = mysqli_fetch_assoc($queryKategori);
                    $kategoriId = $dataKategori['kategoriId'] ?? 0;

                    // Ambil subkategori berdasarkan kategoriId
                    $querySub = "SELECT * FROM subkategori WHERE kategoriId = $kategoriId";
                    $resultSub = mysqli_query($koneksi, $querySub);

                    if (!$resultSub) {
                        die("Subkategori Query Error: " . mysqli_error($koneksi));
                    }

                    // ambil nama rak berdasarkan rakId
                    $queryRak = "SELECT rakId, nomor_rak FROM rak";
                    $resultRak = mysqli_query($koneksi, $queryRak);

                    if (!$resultRak) {
                        die("Rak Query Error: " . mysqli_error($koneksi));
                    }

                    $rakList = [];
                    while ($rak = mysqli_fetch_assoc($resultRak)) {
                        $rakList[$rak['rakId']] = $rak['nomor_rak'];
                    }
                    ?>

                    <ul class="nav flex-column px-3">
                        <?php if (mysqli_num_rows($resultSub) > 0): ?>
                            <li class="nav-item">
                                <a class="nav-link text-dark fw-bold" href="saintek.php">Ilmu Sains dan Teknologi</a>
                            </li>
                            <?php while ($sub = mysqli_fetch_assoc($resultSub)) : ?>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="saintek.php?kategori=<?php echo urlencode($kategori); ?>&subkategori=<?php echo urlencode($sub['nama_subkategori']); ?>">
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


            <!-- KONTEN PRODUK -->
            <main class="col-md-9 col-lg-10">
                <h2 class="fw-semibold mb-4">Book List</h2>

                <div class="row">
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card h-60 shadow-sm border-0">
                                <img src="./assets/images/books/<?php echo $row['gambar']; ?>" class="card-img-top" alt="<?php echo $row['judul']; ?>" style="height: 300px ; width: auto ; scale: 100%; object-fit: fill;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['judul']; ?></h5>
                                    <p class="card-text text-muted"><?php echo $row['nama_kategori'] . ' » ' . $row['nama_subkategori']; ?></p>
                                    <p class="card-text"><small class="text-muted">Jumlah-buku: <?php echo $row['jumlah-buku']; ?></small></p>
                                    <p class="card-text"><small class="text-muted">Posisi-buku: <?php echo $rakList[$row['rakId']] ?? 'N/A'; ?></small></p>
                                    <?php include 'showdetail.php' ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </main>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = new bootstrap.Modal(document.getElementById("detailModal"));
            const detailContent = document.getElementById("detailContent");

            document.querySelectorAll(".viewDetail").forEach(button => {
                button.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");

                    // Tampilkan spinner dulu
                    detailContent.innerHTML = `
        <div class="text-center py-5">
          <div class="spinner-border text-primary" role="status"></div>
          <p class="mt-3">Memuat detail buku...</p>
        </div>
      `;

                    // Ambil konten detail.php via AJAX
                    fetch("detail.php?id=" + id)
                        .then(response => response.text())
                        .then(html => {
                            detailContent.innerHTML = html;
                            modal.show();
                        })
                        .catch(err => {
                            detailContent.innerHTML = "<p class='text-danger'>Gagal memuat detail buku.</p>";
                            modal.show();
                        });
                });
            });
        });
    </script>

    <?php include 'footer.html'; ?>
</body>

</html>