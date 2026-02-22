<?php
require_once "../config/database.php";

if(isset($_POST['submit'])){

    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $urutan = $_POST['urutan'];

    $nama = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    $baru = time().'_'.$nama;
    $path = "../uploads/".$baru;

    // Resize image (JPEG only)
    $source = imagecreatefromjpeg($tmp);
    $width = imagesx($source);
    $height = imagesy($source);

    $new_width = 1200;
    $new_height = ($height / $width) * $new_width;

    $thumb = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($thumb, $source, 0,0,0,0,$new_width,$new_height,$width,$height);

    imagejpeg($thumb, $path, 80);

    imagedestroy($source);
    imagedestroy($thumb);

    mysqli_query($conn,"INSERT INTO slider (judul, deskripsi, gambar, urutan, status)
    VALUES ('$judul','$deskripsi','$baru','$urutan','aktif')");

    header("Location: slider.php?pesan=Data berhasil disimpan");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Slider</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <!-- Tombol Navigasi -->
    <div class="d-flex justify-content-between mb-3">
        <a href="dashboard.php" class="btn btn-outline-dark">
            ← Dashboard
        </a>

        <a href="slider.php" class="btn btn-outline-primary">
            Daftar Slider
        </a>
    </div>

    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="mb-0">Tambah Slider</h4>
        </div>

        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Urutan</label>
                    <input type="number" name="urutan" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" name="gambar" class="form-control" required>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">
                    Simpan
                </button>
              
            </form>

        </div>
    </div>
</div>

</body>
</html>