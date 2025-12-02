<a href="javascript:void(0);"
  class="btn btn-sm btn-primary mt-2"
  data-bs-toggle="modal"
  data-bs-target="#detailModal_<?php echo $row['bukuId']; ?>">
  More Info
</a>

<!-- Modal unik per buku -->
<div class="modal fade" id="detailModal_<?php echo $row['bukuId']; ?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" style="max-width: 900px;">
    <div class="modal-content border-0 shadow-sm">
      <div class="modal-header">
        <h5 class="modal-title">Detail Buku</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4 text-center">
            <img src="./assets/images/books/<?php echo $row['gambar']; ?>"
              alt="<?php echo $row['judul']; ?>"
              class="img-fluid mb-3">
          </div>
          <div class="col-md-12">
            <h5><?php echo $row['judul']; ?></h5>
            <p><strong>Penulis:</strong> <?php echo $row['penulis']; ?></p>
            <p><strong>Penerbit:</strong> <?php echo $row['penerbit']; ?></p>
            <p><strong>Tahun Terbit:</strong> <?php echo $row['tahun_terbit']; ?></p>
            <p><strong>Format:</strong> <?php echo $row['format']; ?></p>
            <p><strong>Jumlah Halaman:</strong> <?php echo $row['jumlah_halaman']; ?></p>
            <p><strong>ISBN:</strong> <?php echo $row['eISBN']; ?></p>
            <p><strong>Jumlah Buku:</strong> <?php echo $row['jumlah-buku']; ?></p>
            <p><strong>Posisi Rak:</strong> <?php echo $rakList[$row['rakId']] ?? 'N/A'; ?></p>
            <p align="justify"><strong>Sinopsis:</strong><br><?php echo nl2br(htmlspecialchars($row['sinopsis'])); ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>