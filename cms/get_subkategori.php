<?php
include '../db/koneksi.php';

if (isset($_POST['kategoriId'])) {
    $kategoriId = intval($_POST['kategoriId']);
    $sub = mysqli_query($koneksi, "SELECT * FROM subkategori WHERE kategoriId = $kategoriId");

    while ($s = mysqli_fetch_assoc($sub)) {
        echo "<option value='{$s['id_subkategori']}'>{$s['nama_subkategori']}</option>";
    }
}
?>