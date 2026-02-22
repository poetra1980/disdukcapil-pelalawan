<?php
session_start();
require_once "../config/database.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM berita WHERE id='$id'");

header("Location: berita.php");