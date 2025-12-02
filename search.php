<?php
include './db/koneksi.php';

$q             = isset($_GET['q']) ? mysqli_real_escape_string($koneksi, $_GET['q']) : '';
$kategoriId    = isset($_GET['kategoriId']) ? (int) $_GET['kategoriId'] : 0;
$subkategoriId = isset($_GET['subkategoriId']) ? (int) $_GET['subkategoriId'] : 0;

$query = "SELECT b.*, k.nama_kategori, s.nama_subkategori, r.nomor_rak
          FROM buku b
          JOIN kategori k ON b.kategoriId = k.kategoriId
          JOIN subkategori s ON b.id_subkategori = s.id_subkategori
          JOIN rak r ON b.rakId = r.rakId
          WHERE (b.judul LIKE '%$q%' 
                 OR b.penulis LIKE '%$q%' 
                 OR b.penerbit LIKE '%$q%')";

if ($kategoriId > 0) {
  $query .= " AND b.kategoriId = $kategoriId";
}
if ($subkategoriId > 0) {
  $query .= " AND b.id_subkategori = $subkategoriId";
}

$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Hasil Pencarian Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-4">
    <h3>Hasil Pencarian: <?= htmlspecialchars($q) ?></h3>
    <div class="row mt-3">
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
              <img src="./assets/images/books/<?= htmlspecialchars($row['gambar']) ?>"
                class="card-img-top"
                alt="<?= htmlspecialchars($row['judul']) ?>"
                style="height: 250px; object-fit: cover;">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($row['judul']) ?></h5>
                <p class="card-text text-muted"><?= htmlspecialchars($row['penulis']) ?></p>
                <p class="card-text"><small class="text-muted">
                    <?= htmlspecialchars($row['nama_kategori']) ?> » <?= htmlspecialchars($row['nama_subkategori']) ?>
                  </small></p>
                <a href="detail.php?id=<?= $row['bukuId'] ?>" class="btn btn-sm btn-primary">Detail</a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-danger">Tidak ada buku ditemukan.</p>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>