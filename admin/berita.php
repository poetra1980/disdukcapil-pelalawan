<?php
session_start();
require_once "../config/database.php";

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

include 'layout.php';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<div class="container-fluid mt-4">

<?php
/* ===============================
   TAMBAH BERITA
=================================*/
if ($action == 'tambah') {

    if (isset($_POST['simpan'])) {

    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $status = $_POST['status'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if (!empty($gambar)) {
        move_uploaded_file($tmp, "../assets/berita/" . $gambar);
    }

    mysqli_query($conn, "INSERT INTO berita 
        (judul, isi, gambar, status, tanggal) 
        VALUES ('$judul','$isi','$gambar','$status', NOW())");

    header("Location: berita.php");
    exit;
}
?>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <h4 class="fw-bold mb-4">Tambah Berita</h4>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi</label>
                <textarea name="isi" id="editor"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="publish">Publish</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
            <div class="mb-3">
             <label class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control">
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
            <a href="berita.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<script>
CKEDITOR.replace('editor');
</script>

<?php
/* ===============================
   EDIT BERITA
=================================*/
} elseif ($action == 'edit') {

    $id = $_GET['id'];
    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM berita WHERE id='$id'"));

    if (isset($_POST['update'])) {

    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $status = $_POST['status'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if (!empty($gambar)) {

        move_uploaded_file($tmp, "../assets/berita/" . $gambar);

        mysqli_query($conn, "UPDATE berita SET 
            judul='$judul',
            isi='$isi',
            gambar='$gambar',
            status='$status'
            WHERE id='$id'");
    } else {

        mysqli_query($conn, "UPDATE berita SET 
            judul='$judul',
            isi='$isi',
            status='$status'
            WHERE id='$id'");
    }

    header("Location: berita.php");
    exit;
}
?>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <h4 class="fw-bold mb-4">Edit Berita</h4>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" value="<?= $data['judul'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi</label>
                <textarea name="isi" id="editor"><?= $data['isi'] ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="publish" <?= ($data['status']=='publish')?'selected':''; ?>>Publish</option>
                    <option value="draft" <?= ($data['status']=='draft')?'selected':''; ?>>Draft</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Gambar</label>
                <input type="file" name="gambar" class="form-control">
                </div>
            <button type="submit" name="update" class="btn btn-warning">
                <i class="bi bi-pencil-square"></i> Update
            </button>
            <a href="berita.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<script>
CKEDITOR.replace('editor');
</script>

<?php
/* ===============================
   HAPUS BERITA
=================================*/
} elseif ($action == 'hapus') {

    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM berita WHERE id='$id'");
    header("Location: berita.php");
    exit;

/* ===============================
   LIST DATA BERITA
=================================*/
} else {

$result = mysqli_query($conn, "SELECT * FROM berita ORDER BY id DESC");
?>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 fw-bold">Kelola Berita</h4>
            <a href="berita.php?action=tambah" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Berita
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Judul</th>
                        <th width="150">Tanggal</th>
                        <th width="120">Status</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                <?php $no=1; while($row=mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['judul']; ?></td>
                        <td><?= date('d M Y', strtotime($row['tanggal'])); ?></td>
                        <td>
                            <?php if ($row['status']=='publish') { ?>
                                <span class="badge bg-success">Publish</span>
                            <?php } else { ?>
                                <span class="badge bg-secondary">Draft</span>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <a href="berita.php?action=edit&id=<?= $row['id']; ?>" 
                               class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <a href="berita.php?action=hapus&id=<?= $row['id']; ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Yakin ingin menghapus berita ini?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>

    </div>
</div>

<?php } ?>

</div>

<style>
.card {
    border-radius: 12px;
}
.table thead th {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.btn-sm {
    border-radius: 8px;
}
</style>