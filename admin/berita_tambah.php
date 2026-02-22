<?php
session_start();
require_once "../config/database.php";
include "layout.php";

if (isset($_POST['simpan'])) {

    $judul = $_POST['judul'];
    $isi   = $_POST['isi'];
    $status = $_POST['status'];

    mysqli_query($conn, "INSERT INTO berita 
    (judul, isi, gambar, tanggal, status)
    VALUES 
    ('$judul','$isi','$namaFileBaru', NOW(), '$status')");

    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    $namaFileBaru = time() . "_" . $gambar;
    move_uploaded_file($tmp, "../assets/berita/" . $namaFileBaru);

    mysqli_query($conn, "INSERT INTO berita 
                         (judul, isi, gambar, tanggal) 
                         VALUES 
                         ('$judul','$isi','$namaFileBaru', NOW())");

    header("Location: berita.php");
    exit;
}
?>

<h4 class="mb-4">Tambah Berita</h4>

<div class="card shadow">
<div class="card-body">

<form method="POST" enctype="multipart/form-data">

    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Isi Berita</label>
        <textarea name="isi" id="editor" class="form-control" rows="5"></textarea>
    </div>

    <div class="mb-3">
        <label>Upload Gambar</label>
        <input type="file" name="gambar" class="form-control" required>
    </div>

    <div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="draft">Draft</option>
        <option value="publish">Publish</option>
    </select>
    </div>

    <button type="submit" name="simpan" class="btn btn-primary">
        Simpan
    </button>

</form>

</div>
</div>

<script>
    CKEDITOR.replace('editor');
</script>

</div>
</div>
</body>
</html>