<?php
// ambil parameter pencarian dari GET
$q             = isset($_GET['q']) ? mysqli_real_escape_string($koneksi, $_GET['q']) : '';
$kategoriId    = isset($_GET['kategoriId']) ? (int) $_GET['kategoriId'] : 0;
$subkategoriId = isset($_GET['subkategoriId']) ? (int) $_GET['subkategoriId'] : 0;

// ambil nama rak
$queryRak = "SELECT rakId, nomor_rak FROM rak";
$resultRak = mysqli_query($koneksi, $queryRak);
$rakList = [];
while ($rak = mysqli_fetch_assoc($resultRak)) {
  $rakList[$rak['rakId']] = $rak['nomor_rak'];
}

// query buku dengan filter
$query = "SELECT 
            b.bukuId,
            b.judul,
            b.penulis,
            b.jumlah_halaman,
            b.format,
            b.penerbit,
            b.tahun_terbit,
            b.eISBN,
            b.`jumlah-buku`,
            b.rakId,
            b.gambar,
            b.sinopsis,
            k.nama_kategori,
            s.nama_subkategori
          FROM buku b
          JOIN kategori k ON b.kategoriId = k.kategoriId
          JOIN subkategori s ON b.id_subkategori = s.id_subkategori
          WHERE 1=1";

if ($q !== '') {
  $query .= " AND (b.judul LIKE '%$q%' OR b.penulis LIKE '%$q%' OR b.penerbit LIKE '%$q%')";
}
if ($kategoriId > 0) {
  $query .= " AND b.kategoriId = $kategoriId";
}
if ($subkategoriId > 0) {
  $query .= " AND b.id_subkategori = $subkategoriId";
}

$result = mysqli_query($koneksi, $query);
if (!$result) {
  die("Produk error: " . mysqli_error($koneksi));
}
?>

<div class="row">
  <?php if (mysqli_num_rows($result) > 0): ?>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="card h-60 shadow-sm border-0">
          <img src="./assets/images/books/<?php echo htmlspecialchars($row['gambar']); ?>"
            class="card-img-top"
            alt="<?php echo htmlspecialchars($row['judul']); ?>"
            style="height: 300px; object-fit: cover;">
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($row['judul']); ?></h5>
            <p class="card-text text-muted">
              <?php echo htmlspecialchars($row['nama_kategori']) . ' » ' . htmlspecialchars($row['nama_subkategori']); ?>
            </p>
            <p class="card-text"><small class="text-muted">
                Jumlah-buku: <?php echo $row['jumlah-buku']; ?>
              </small></p>
            <p class="card-text"><small class="text-muted">
                Posisi-buku: <?php echo $rakList[$row['rakId']] ?? 'N/A'; ?>
              </small></p>
          </div>
          <?php include 'showdetail.php'; ?>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="text-danger">Tidak ada buku ditemukan.</p>
  <?php endif; ?>
</div>