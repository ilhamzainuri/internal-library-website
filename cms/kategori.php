<?php
include '../db/koneksi.php';

// ================ HANDLE SIMPAN ================
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_kategori'];
    mysqli_query($koneksi, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
    header("Location: kategori.php");
    exit;
}

// ================ HANDLE EDIT MODE ================
$editMode = false;
$editData = null;

if (isset($_GET['edit'])) {
    $editMode = true;
    $id = $_GET['edit'];
    $q = mysqli_query($koneksi, "SELECT * FROM kategori WHERE kategoriId='$id'");
    $editData = mysqli_fetch_assoc($q);
}

// ================ UPDATE ================
if (isset($_POST['update'])) {
    $id = $_POST['kategoriId'];
    $nama = $_POST['nama_kategori'];

    mysqli_query($koneksi, "
        UPDATE kategori SET nama_kategori='$nama'
        WHERE kategoriId='$id'
    ");

    header("Location: kategori.php");
    exit;
}

// ================ DELETE ================
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM kategori WHERE kategoriId='$id'");
    header("Location: kategori.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Kategori</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .content {
            padding: 20px;
            font-family: Arial;
        }

        .btn {
            background: #007bff;
            padding: 8px 14px;
            border-radius: 5px;
            color: white;
            text-decoration: none;
        }

        .btn:hover {
            background: #005ad6;
        }

        .btn-red {
            background: #dc3545;
        }

        .btn-red:hover {
            background: #b92d3a;
        }

        .form-box {
            background: #fff;
            padding: 25px;
            margin-top: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            max-width: 600px;
        }

        .hidden {
            display: none;
        }

        input {
            width: 98%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #007bff;
            color: white;
            padding: 10px;
            text-align: left;
        }

        td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background: #f5f7fa;
        }

        tr:hover {
            background: #eef5ff;
        }

        .aksi-btn {
            display: flex;
            gap: 7px;
            justify-content: center;
        }

        .edit {
            background: #ffc107;
            padding: 6px 12px;
            border-radius: 4px;
        }

        .hapus {
            background: #dc3545;
            padding: 6px 12px;
            border-radius: 4px;
            color: white;
        }
    </style>
</head>

<body>

    <?php include 'sidebar.php'; ?>

    <div class="content">
        <h1 style="display:flex; align-items:center; gap:10px;">
            <i class="fa fa-tags"></i> Data Kategori
        </h1>

        <button class="btn" onclick="toggleForm()">+ Tambah Kategori</button>

        <div id="formTambah" class="form-box <?= $editMode ? '' : 'hidden' ?>">
            <h3><?= $editMode ? 'Edit Kategori' : 'Tambah Kategori' ?></h3>

            <form method="POST">

                <?php if ($editMode): ?>
                    <input type="hidden" name="kategoriId" value="<?= $editData['kategoriId'] ?>">
                <?php endif; ?>

                Nama Kategori:
                <input type="text" name="nama_kategori" required
                    value="<?= $editMode ? $editData['nama_kategori'] : '' ?>">

                <button type="submit" name="<?= $editMode ? 'update' : 'simpan' ?>" class="btn">
                    <?= $editMode ? 'Update' : 'Simpan' ?>
                </button>

                <a href="kategori.php" class="btn btn-red">Batal</a>
            </form>
        </div>

        <!-- TABEL -->
        <table>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;
            $result = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY kategoriId DESC");

            while ($r = mysqli_fetch_assoc($result)) {
                echo "
            <tr>
                <td>$no</td>
                <td>{$r['nama_kategori']}</td>

                <td class='aksi-btn'>
                    <a class='edit' href='kategori.php?edit={$r['kategoriId']}'>Edit</a>
                    <a class='hapus' href='kategori.php?hapus={$r['kategoriId']}'
                        onclick=\"return confirm('Hapus kategori ini?')\">
                        Hapus
                    </a>
                </td>
            </tr>";
                $no++;
            }
            ?>
        </table>

    </div>

    <script>
        function toggleForm() {
            document.getElementById("formTambah").classList.toggle("hidden");
        }
    </script>

</body>

</html>