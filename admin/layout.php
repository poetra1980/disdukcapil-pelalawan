<?php
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
</head>

<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">Kelola Berita</span>
    <a href="dashboard.php" class="btn btn-outline-light btn-sm">Dashboard</a>
</nav>

    <div class="p-4 w-100">