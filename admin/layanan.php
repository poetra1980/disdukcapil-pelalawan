<?php
session_start();
require_once "../config/database.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

/* =========================
   PROSES TAMBAH DATA
========================= */
if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $icon = $_FILES['icon']['name'];
    $tmp  = $_FILES['icon']['tmp_name'];

    if ($icon != "") {
        move_uploaded_file($tmp, "../assets/icon/" . $icon);
    }

    mysqli_query($conn, "INSERT INTO layanan (nama, icon) 
                         VALUES ('$nama', '$icon')");

    header("Location: layanan.php");
    exit;
}

/* =========================
   AMBIL DATA
========================= */
$data = mysqli_query($conn, "SELECT * FROM layanan ORDER BY id DESC");
$total = mysqli_num_rows($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Layanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container-fluid mt-4 px-4">

<div class="card shadow-lg rounded-4">

    <!-- HEADER -->
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0">Kelola Layanan</h4>
            <small>Manajemen data layanan Disdukcapil</small>
        </div>

        <a href="dashboard.php" class="btn btn-outline-light btn-sm">
            🏠 Dashboard
        </a>
    </div>

    <div class="card-body">

        <!-- ================= FORM TAMBAH ================= -->
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">

                <h5 class="mb-3">+ Tambah Layanan Baru</h5>

                <form method="POST" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-md-5 mb-3">
                            <label class="form-label">Nama Layanan</label>
                            <input type="text" name="nama" 
                                   class="form-control" required>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label class="form-label">Upload Icon</label>
                            <input type="file" name="icon" 
                                   class="form-control" required>
                        </div>

                        <div class="col-md-2 d-flex align-items-end mb-3">
                            <button type="submit" 
                                    name="simpan" 
                                    class="btn btn-primary w-100">
                                Simpan
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>
        <!-- ================= TABEL ================= -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle shadow-sm">

                <thead class="table-dark text-center">
                    <tr>
                        <th width="60">No</th>
                        <th width="100">Icon</th>
                        <th>Nama Layanan</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php $no=1; while($row = mysqli_fetch_array($data)) { ?>
                    <tr>

                        <td class="text-center"><?= $no++; ?></td>

                        <td class="text-center">
                            <img src="../assets/icon/<?= $row['icon']; ?>" 
                                 width="45" 
                                 class="img-thumbnail shadow-sm">
                        </td>

                        <td class="fw-semibold">
                            <?= $row['nama']; ?>
                        </td>

                        <td class="text-center">

                            <a href="layanan_edit.php?id=<?= $row['id']; ?>" 
                               class="btn btn-warning btn-sm me-1">
                               ✏ Edit
                            </a>

                            <a href="layanan_hapus.php?id=<?= $row['id']; ?>" 
                               onclick="return confirm('Yakin hapus data?')" 
                               class="btn btn-danger btn-sm">
                               🗑 Hapus
                            </a>

                        </td>

                    </tr>
                <?php } ?>
                </tbody>

            </table>
        </div>

    </div>
</div>

</div>

</body>
</html>