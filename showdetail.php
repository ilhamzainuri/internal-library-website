<?php
include 'db/koneksi.php';

$bukuId = isset($_GET['bukuId']) ? (int)$_GET['bukuId'] : 0;

if ($bukuId <= 0) {
  echo "<p class='text-danger'>ID buku tidak valid.</p>";
  exit;
}

// prepared statement
$stmt = $koneksi->prepare("SELECT b.judul, b.penulis, b.penerbit, b.tahun_terbit, b.format,
                                  b.jumlah_halaman, b.eISBN, b.jumlah_buku, b.sinopsis,
                                  r.nomor_rak, k.nama_kategori, s.nama_subkategori, b.gambar
                           FROM buku b
                           LEFT JOIN rak r ON b.rakId = r.rakId
                           JOIN kategori k ON b.kategoriId = k.kategoriId
                           JOIN subkategori s ON b.id_subkategori = s.id_subkategori
                           WHERE b.bukuId = ?
                           LIMIT 1");

$stmt->bind_param("i", $bukuId);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
?>
  <div class="card border-0">
    <div class="row g-0">
      <!-- Gambar buku -->
      <div class="col-md-4 text-center p-3">
        <img src="./assets/images/books/<?php echo htmlspecialchars($row['gambar']); ?>"
             alt="<?php echo htmlspecialchars($row['judul']); ?>"
             class="img-fluid rounded shadow-sm">
      </div>

      <!-- Detail buku -->
      <div class="col-md-8">
        <div class="card-body">
          <h4 class="card-title mb-3"><?php echo htmlspecialchars($row['judul']); ?></h4>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Penulis:</strong> <?php echo htmlspecialchars($row['penulis']); ?></li>
            <li class="list-group-item"><strong>Penerbit:</strong> <?php echo htmlspecialchars($row['penerbit']); ?></li>
            <li class="list-group-item"><strong>Tahun Terbit:</strong> <?php echo htmlspecialchars($row['tahun_terbit']); ?></li>
            <li class="list-group-item"><strong>Format:</strong> <?php echo htmlspecialchars($row['format']); ?></li>
            <li class="list-group-item"><strong>Jumlah Halaman:</strong> <?php echo htmlspecialchars($row['jumlah_halaman']); ?></li>
            <li class="list-group-item"><strong>ISBN:</strong> <?php echo htmlspecialchars($row['eISBN']); ?></li>
            <li class="list-group-item"><strong>Jumlah Buku:</strong> <?php echo htmlspecialchars($row['jumlah_buku']); ?></li>
            <li class="list-group-item"><strong>Posisi Rak:</strong> <?php echo htmlspecialchars($row['nomor_rak'] ?? 'N/A'); ?></li>
            <li class="list-group-item"><strong>Kategori:</strong> <?php echo htmlspecialchars($row['nama_kategori']); ?> » <?php echo htmlspecialchars($row['nama_subkategori']); ?></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Sinopsis -->
    <div class="card-footer bg-white mt-3">
      <h5 class="mb-2">Sinopsis</h5>
      <p class="text-justify"><?php echo nl2br(htmlspecialchars($row['sinopsis'])); ?></p>
    </div>
  </div>
<?php
} else {
  echo "<p class='text-danger'>Detail buku tidak ditemukan.</p>";
}
$stmt->close();
?>