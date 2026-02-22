<?php
session_start();
require_once "../config/database.php";

$id = $_GET['id'];

$data = mysqli_query($conn, "SELECT status FROM slider WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

$status = ($row['status'] == 'aktif') ? 'nonaktif' : 'aktif';

mysqli_query($conn, "UPDATE slider SET status='$status' WHERE id='$id'");

header("Location: slider.php?pesan=Status berhasil diubah");
exit;