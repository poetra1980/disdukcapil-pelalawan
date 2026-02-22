<?php
require_once "../config/database.php";
$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT gambar FROM slider WHERE id=$id"));

unlink("../uploads/".$data['gambar']);

mysqli_query($conn,"DELETE FROM slider WHERE id=$id");

header("Location: slider.php?pesan=Data berhasil dihapus");
exit;
?>
