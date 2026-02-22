<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once "../config/database.php";

$jumlah_berita = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM berita"));
$jumlah_layanan = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM layanan"));
$jumlah_slider = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM slider"));

// Hitung total berita
$totalBerita = mysqli_query($conn, "SELECT COUNT(*) as total FROM berita");
$dataBerita = mysqli_fetch_assoc($totalBerita);

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date("Y");

$data = array_fill(1, 12, 0);

$query = mysqli_query($conn, "SELECT bulan, jumlah FROM statistik WHERE tahun='$tahun'");
while ($row = mysqli_fetch_assoc($query)) {
    $data[$row['bulan']] = $row['jumlah'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - Disdukcapil Pelalawan</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../assets/css/admin.css">

</head>
<body class="admin-page">

<div class="wrapper">

    <div class="sidebar">
        <h2><i class="fa-solid fa-building"></i> DISDUKCAPIL</h2>

        <a href="#"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
        <a href="berita.php"><i class="fa-solid fa-newspaper"></i> Kelola Berita</a>
        <a href="layanan.php"><i class="fa-solid fa-layer-group"></i> Kelola Layanan</a>
        <a href="slider.php"><i class="fa-solid fa-images"></i> Kelola Slider</a>
        <a href="#"><i class="fa-solid fa-users"></i> Data Penduduk</a>
        <a href="logout.php" class="logout">
            <i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>

    <div class="main">

        <div class="topbar">
            <h3>Dashboard Admin</h3>
            <form method="GET">
    <select name="tahun" onchange="this.form.submit()">
        <?php
        $tahunList = mysqli_query($conn, "SELECT DISTINCT tahun FROM statistik ORDER BY tahun DESC");
        while ($t = mysqli_fetch_assoc($tahunList)) {
            $selected = ($t['tahun'] == $tahun) ? "selected" : "";
            echo "<option value='{$t['tahun']}' $selected>{$t['tahun']}</option>";
        }
        ?>
    </select>
</form>

  <!-- Tombol Dark Mode -->
    <button onclick="toggleDark()" 
    style="padding:6px 12px; border:none; border-radius:6px; cursor:pointer;">
    🌙
    </button>
            <span><i class="fa-solid fa-user"></i> <?php echo $_SESSION['admin']; ?></span>
        </div>

       <div class="content">

    <div class="card berita">
        <i class="fa-solid fa-newspaper icon"></i>
        <h3>Total Berita</h3>
        <p><?php echo $dataBerita['total']; ?></p>
    </div>

    <div class="card admin">
        <i class="fa-solid fa-user-shield icon"></i>
        <h3>Total Admin</h3>
        <p>1</p>
    </div>

    <div class="card sistem">
    <i class="fa-solid fa-database icon"></i>
    <h3>Status Sistem</h3>
    <span class="status-badge aktif">● Aktif</span>
</div>

    <div class="card layanan">
        <i class="fa-solid fa-layer-group icon"></i>
        <h3>Total Layanan</h3>
        <p><?php echo $jumlah_layanan; ?></p>
    </div>

    <div class="card slider">
        <i class="fa-solid fa-images icon"></i>
        <h3>Total Slider</h3>
        <p><?php echo $jumlah_slider; ?></p>
    </div>


        </div>

        <div class="chart-container">
            <canvas id="myChart"></canvas>
        </div>
  </div>

</div>

<script>
const ctx = document.getElementById('myChart').getContext('2d');

const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, "rgba(21,101,192,0.4)");
gradient.addColorStop(1, "rgba(21,101,192,0)");

new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
            'Jan','Feb','Mar','Apr','Mei','Jun',
            'Jul','Agu','Sep','Okt','Nov','Des'
        ],
        datasets: [{
            label: 'Statistik Pelayanan Tahun <?php echo $tahun; ?>',
            data: [<?php for ($i=1;$i<=12;$i++){ echo $data[$i].",";} ?>],
            fill: true,
            backgroundColor: gradient,
            borderColor: "#1565c0",
            borderWidth: 3,
            tension: 0.4,
            pointBackgroundColor: "#1565c0",
            pointRadius: 5
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: {
                    font: { size: 14 }
                }
            }
        },
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>

<script>
function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.innerHTML = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

document.querySelectorAll(".card p").forEach(el => {
    let value = parseInt(el.innerText);
    if (!isNaN(value)) {
        animateValue(el, 0, value, 1000);
    }
</script>

<script>
function toggleDark() {
    document.body.classList.toggle("dark-mode");
}
</script>

<body class="admin-page">
</html>
