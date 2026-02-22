<?php
session_start();
require_once "../config/database.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM slider WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {

    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $gambarBaru = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if ($gambarBaru != "") {

        // Hapus gambar lama
        if (file_exists("../assets/slider/" . $row['gambar'])) {
            unlink("../assets/slider/" . $row['gambar']);
        }

        // Rename supaya tidak bentrok
        $namaFileBaru = time() . "_" . $gambarBaru;

        move_uploaded_file($tmp, "../assets/slider/" . $namaFileBaru);

        mysqli_query($conn, "UPDATE slider 
                             SET judul='$judul', 
                                 deskripsi='$deskripsi', 
                                 gambar='$namaFileBaru' 
                             WHERE id='$id'");
    } else {

        mysqli_query($conn, "UPDATE slider 
                             SET judul='$judul', 
                                 deskripsi='$deskripsi' 
                             WHERE id='$id'");
    }

    header("Location: slider.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Slider</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow-lg rounded-4">

        <!-- HEADER -->
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Edit Slider</h5>
            <a href="slider.php" class="btn btn-outline-light btn-sm">
                ← Kembali
            </a>
        </div>

        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" 
                           name="judul" 
                           value="<?= $row['judul']; ?>" 
                           class="form-control" 
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" 
                              class="form-control" 
                              rows="3" 
                              required><?= $row['deskripsi']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    <img src="../assets/slider/<?= $row['gambar']; ?>" 
                         class="img-fluid rounded shadow-sm mb-3" 
                         style="max-height:200px;">
                </div>

                <div class="mb-4">
                    <label class="form-label">Ganti Gambar (Opsional)</label>
                    <input type="file" name="gambar" class="form-control">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" 
                            name="update" 
                            class="btn btn-primary">
                        💾 Update Slider
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>