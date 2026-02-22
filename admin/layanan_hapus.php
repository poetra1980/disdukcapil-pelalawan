<?php
session_start();
require_once "../config/database.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM layanan WHERE id='$id'");

header("Location: layanan.php");
