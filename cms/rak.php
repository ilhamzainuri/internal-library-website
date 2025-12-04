<?php
include '../db/koneksi.php';

// Tambah
if (isset($_POST['simpan'])) {
    $nomor = $_POST['nomor_rak'];

    mysqli_query($koneksi, "INSERT INTO rak (nomor_rak) VALUES ('$nomor')");
    header("Location: rak.php");
    exit;
}

// Mode Edit
$editMode = false;
$editData = null;

if (isset($_GET['edit'])) {
    $editMode = true;
    $id = $_GET['edit'];
    $q = mysqli_query($koneksi, "SELECT * FROM rak WHERE rakId='$id'");
    $editData = mysqli_fetch_assoc($q);
}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['rakId'];
    $nomor = $_POST['nomor_rak'];

    mysqli_query($koneksi, "
        UPDATE rak SET nomor_rak='$nomor'
        WHERE rakId='$id'
    ");
    header("Location: rak.php");
    exit;
}

// Hapus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM rak WHERE rakId='$id'");
    header("Location: rak.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Data Rak</title>
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

        .btn-red {
            background: #dc3545;
            color: white;
        }

        .form-box {
            background: #fff;
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-top: 10px;
            max-width: 600px;
        }

        .hidden {
            display: none;
        }

        input {
            width: 98%;
            padding: 10px;
            margin: 6px 0 18px;
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
        }

        td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background: #f5f7fa;
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
            <i class="fa fa-box"></i> Data Rak
        </h1>

        <button class="btn" onclick="toggleForm()">+ Tambah Rak</button>

        <div id="formTambah" class="form-box <?= $editMode ? '' : 'hidden' ?>">
            <h3><?= $editMode ? 'Edit Rak' : 'Tambah Rak' ?></h3>

            <form method="POST">
                <?php if ($editMode): ?>
                    <input type="hidden" name="rakId" value="<?= $editData['rakId'] ?>">
                <?php endif; ?>

                Nomor Rak:
                <input type="text" name="nomor_rak" required
                    value="<?= $editMode ? $editData['nomor_rak'] : '' ?>">

                <button type="submit" name="<?= $editMode ? 'update' : 'simpan' ?>" class="btn">
                    <?= $editMode ? 'Update' : 'Simpan' ?>
                </button>

                <a href="rak.php" class="btn-red btn">Batal</a>
            </form>
        </div>

        <table>
            <tr>
                <th>No</th>
                <th>Nomor Rak</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;
            $q = mysqli_query($koneksi, "SELECT * FROM rak ORDER BY rakId DESC");

            while ($r = mysqli_fetch_assoc($q)) {
                echo "
                <tr>
                    <td>$no</td>
                    <td>{$r['nomor_rak']}</td>
                    <td class='aksi-btn'>
                        <a class='edit' href='rak.php?edit={$r['rakId']}'>Edit</a>
                        <a class='hapus' href='rak.php?hapus={$r['rakId']}'
                           onclick=\"return confirm('Hapus rak ini?')\">Hapus</a>
                    </td>
                </tr>
            ";
                $no++;
            }
            ?>
        </table>

    </div>

    <script>
        function toggleForm() {
            document.getElementById('formTambah').classList.toggle('hidden');
        }
    </script>

</body>

</html>