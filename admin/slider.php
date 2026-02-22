<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once "../config/database.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

/* ==============================
   PROSES TAMBAH SLIDER
============================== */
if (isset($_POST['submit'])) {

    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $urutan = (int)$_POST['urutan'];

    $nama = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if ($nama != "") {

        $ext = strtolower(pathinfo($nama, PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png'];

        if (in_array($ext, $allowed)) {

            $baru = time().'_'.$nama;
            $path = "../uploads/".$baru;

            if ($ext == 'png') {
                $source = imagecreatefrompng($tmp);
            } else {
                $source = imagecreatefromjpeg($tmp);
            }

            $width = imagesx($source);
            $height = imagesy($source);

            $new_width = 1200;
            $new_height = ($height / $width) * $new_width;

            $thumb = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($thumb, $source, 0,0,0,0,$new_width,$new_height,$width,$height);

            if ($ext == 'png') {
                imagepng($thumb, $path);
            } else {
                imagejpeg($thumb, $path, 80);
            }

            imagedestroy($source);
            imagedestroy($thumb);

            mysqli_query($conn,"INSERT INTO slider 
            (judul, deskripsi, gambar, urutan, status)
            VALUES 
            ('$judul','$deskripsi','$baru','$urutan','aktif')");

            header("Location: slider.php?pesan=Slider berhasil ditambahkan");
            exit;

        } else {
            $error = "Format gambar harus JPG atau PNG!";
        }
    }
}

/* ==============================
   AMBIL DATA SLIDER
============================== */
$data = mysqli_query($conn,"SELECT * FROM slider ORDER BY urutan ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Slider</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container-fluid mt-4 px-4">

    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-dark text-white rounded-top-4 d-flex justify-content-between align-items-center">
    
    <h4 class="mb-0">Kelola Slider</h4>

    <a href="dashboard.php" class="btn btn-light btn-sm">
    🏠 Dashboard
    </a>

</div>

        <div class="card-body">

            <?php if(isset($_GET['pesan'])) { ?>
                <div class="alert alert-success">
                    <?= $_GET['pesan']; ?>
                </div>
            <?php } ?>

            <?php if(isset($error)) { ?>
                <div class="alert alert-danger">
                    <?= $error; ?>
                </div>
            <?php } ?>

            <!-- ==============================
                 FORM TAMBAH SLIDER
            =============================== -->
            <div class="card mb-4 border-primary">
                <div class="card-header bg-primary text-white">
                    Tambah Slider
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-3">
                                <input type="text" name="judul" 
                                       class="form-control mb-2" 
                                       placeholder="Judul" required>
                            </div>

                            <div class="col-md-3">
                                <input type="text" name="deskripsi" 
                                       class="form-control mb-2" 
                                       placeholder="Deskripsi" required>
                            </div>

                            <div class="col-md-2">
                                <input type="number" name="urutan" 
                                       class="form-control mb-2" 
                                       placeholder="Urutan" required>
                            </div>

                            <div class="col-md-2">
                                <input type="file" name="gambar" 
                                       class="form-control mb-2" required>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" name="submit" 
                                        class="btn btn-success w-100">
                                    Simpan
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <!-- ==============================
                 TABEL DATA SLIDER
            =============================== -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Urutan</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php $no=1; while($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>

                            <td class="text-center"><?= $no++; ?></td>

                            <td class="text-center">
                                <img src="../uploads/<?= $row['gambar']; ?>" 
                                     width="120" 
                                     class="img-thumbnail">
                            </td>

                            <td><?= $row['judul']; ?></td>

                            <td class="text-center">
                                <?php if($row['status']=='aktif'){ ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php } else { ?>
                                    <span class="badge bg-secondary">Nonaktif</span>
                                <?php } ?>
                            </td>

                            <td class="text-center"><?= $row['urutan']; ?></td>

                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-dark btn-sm dropdown-toggle"
                                            data-bs-toggle="dropdown">
                                        Aksi
                                    </button>

                                    <ul class="dropdown-menu">

                                        <li>
                                            <a class="dropdown-item"
                                               href="../uploads/<?= $row['gambar']; ?>"
                                               target="_blank">
                                                👁 Preview
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item"
                                               href="slider_toggle.php?id=<?= $row['id']; ?>">
                                                🔄 Toggle Status
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item"
                                               href="slider_edit.php?id=<?= $row['id']; ?>">
                                                ✏ Edit
                                            </a>
                                        </li>

                                        <li><hr class="dropdown-divider"></li>

                                        <li>
                                            <a class="dropdown-item text-danger"
                                               href="slider_hapus.php?id=<?= $row['id']; ?>"
                                               onclick="return confirm('Yakin hapus data?')">
                                                🗑 Hapus
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </td>

                        </tr>
                    <?php } ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>