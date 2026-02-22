<?php
session_start();
require_once "../config/database.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM berita WHERE id='$id'"));

if (isset($_POST['update'])) {

    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $status = $_POST['status'];

    mysqli_query($conn, "UPDATE berita SET 
        judul='$judul',
        isi='$isi',
        status='$status'
        WHERE id='$id'");

    header("Location: berita.php");
    exit;
}

include 'layout.php';
?>

<h4>Edit Berita</h4>

<form method="POST">
    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="judul" value="<?= $data['judul'] ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label>Isi</label>
        <textarea name="isi" id="editor"><?= $data['isi'] ?></textarea>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="publish">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <button type="submit" name="update" class="btn btn-primary">
        Update
    </button>
</form>

<script>
CKEDITOR.replace('editor');
</script>

</div>
</div>
</body>
</html>