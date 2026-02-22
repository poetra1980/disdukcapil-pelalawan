<?php
session_start();
require_once "../config/database.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM layanan WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {

    $nama = $_POST['nama'];
    $iconBaru = $_FILES['icon']['name'];
    $tmp = $_FILES['icon']['tmp_name'];

    if ($iconBaru != "") {

        // Hapus icon lama
        if (file_exists("../assets/icon/" . $row['icon'])) {
            unlink("../assets/icon/" . $row['icon']);
        }

        // Upload icon baru
        move_uploaded_file($tmp, "../assets/icon/" . $iconBaru);

        mysqli_query($conn, "UPDATE layanan 
                             SET nama='$nama', icon='$iconBaru' 
                             WHERE id='$id'");
    } else {

        // Jika tidak upload icon baru
        mysqli_query($conn, "UPDATE layanan 
                             SET nama='$nama' 
                             WHERE id='$id'");
    }

    header("Location: layanan.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Layanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow rounded-4">
        <div class="card-header bg-dark text-white">
            Edit Layanan
        </div>

        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Nama Layanan</label>
                    <input type="text" name="nama" 
                           value="<?= $row['nama']; ?>" 
                           class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Icon Saat Ini</label><br>
                    <img src="../assets/icon/<?= $row['icon']; ?>" 
                         width="60" 
                         class="mb-2 img-thumbnail">
                </div>

                <div class="mb-3">
                    <label class="form-label">Ganti Icon (Opsional)</label>
                    <input type="file" name="icon" class="form-control">
                </div>

                <button type="submit" name="update" 
                        class="btn btn-primary">
                    Update
                </button>
                  <a href="layanan.php" class="btn btn-secondary">
                    Kembali
                    </a>
            </form>
             
        </div>
    </div>

</div>

</body>
</html>