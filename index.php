<?php
require_once "config/database.php";

$query = mysqli_query($conn, "SELECT * FROM berita ORDER BY tanggal DESC LIMIT 6");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Website Resmi Disdukcapil Kabupaten Pelalawan</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    
    <style>
      </style>  

</head>

<body>

<!-- Welcome Screen -->

<div id="welcome-screen">
  <div class="welcome-content text-center">
      <img src="assets/img/logo.png" class="welcome-logo mb-4">
      <h1 class="mb-3">SELAMAT DATANG</h1>      
      <p>WEBSITE RESMI DINAS KEPENDUDUKAN DAN CATATAN SIPIL KABUPATEN PELALAWAN</p>
  </div>
</div>

<!-- Top Bar -->
<div class="top-bar text-center">
    Website Resmi Dinas Kependudukan dan Pencatatan Sipil Kabupaten Pelalawan
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
     
    <div class="container-fluid px-5">
        <a class="navbar-brand brand-title d-flex align-items-center" href="#">
    
            <img src="assets/img/logo.png" class="brand-logo me-2">

            <div class="ms-2">
                <div class="brand-main">DISDUKCAPIL</div>
                <div class="brand-sub">Kabupaten Pelalawan</div>
            </div>

        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end ms-0" id="menu">
            <ul class="navbar-nav fw-bold text-uppercased">
                <li class="nav-item"><a class="nav-link" href="#">BERANDA</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        PROFIL
                    </a>

                    <ul class="dropdown-menu shadow border-0" style="min-width: 250px;">
                        <li><a class="dropdown-item py-2" href="#">Visi dan Misi</a></li>
                        <li><a class="dropdown-item py-2" href="#">Motto</a></li>
                        <li><a class="dropdown-item py-2" href="#">Struktur Organisasi</a></li>
                        <li><a class="dropdown-item py-2" href="#">Tentang Kami</a></li>
                        <li><a class="dropdown-item py-2" href="#">Tugas dan Fungsi</a></li>
                        <li><a class="dropdown-item py-2" href="#">Prestasi</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        LAYANAN
                    </a>
                    <ul class="dropdown-menu shadow border-0" style="min-width: 250px;">
                        <li><a class="dropdown-item py-2" href="#">PEREKAMAN E-KTP</a></li>
                        <li><a class="dropdown-item py-2" href="#">KARTU KELUARGA</a></li>
                        <li><a class="dropdown-item py-2" href="#">AKTA KELAHIRAN</a></li>
                        <li><a class="dropdown-item py-2" href="#">AKTA KEMATIAN</a></li>
                        <li><a class="dropdown-item py-2" href="#">PINDAH DATANG</a></li>
                        <li><a class="dropdown-item py-2" href="#">PENGADUAN</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        ZONA INTEGRITAS
                    </a>
                    <ul class="dropdown-menu shadow border-0" style="min-width: 250px;">
                        <li><a class="dropdown-item py-2" href="#">PEREKAMAN E-KTP</a></li>
                        <li><a class="dropdown-item py-2" href="#">KARTU KELUARGA</a></li>
                        <li><a class="dropdown-item py-2" href="#">AKTA KELAHIRAN</a></li>
                        <li><a class="dropdown-item py-2" href="#">AKTA KEMATIAN</a></li>
                        <li><a class="dropdown-item py-2" href="#">PINDAH DATANG</a></li>
                        <li><a class="dropdown-item py-2" href="#">PENGADUAN</a></li>
                    </ul>
                </li>                   
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        FASILITAS
                    </a>
                    <ul class="dropdown-menu shadow border-0" style="min-width: 250px;">
                        <li><a class="dropdown-item py-2" href="#">PEREKAMAN E-KTP</a></li>
                        <li><a class="dropdown-item py-2" href="#">KARTU KELUARGA</a></li>
                        <li><a class="dropdown-item py-2" href="#">AKTA KELAHIRAN</a></li>
                        <li><a class="dropdown-item py-2" href="#">AKTA KEMATIAN</a></li>
                        <li><a class="dropdown-item py-2" href="#">PINDAH DATANG</a></li>
                        <li><a class="dropdown-item py-2" href="#">PENGADUAN</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        PRODUK HUKUM
                    </a>
                    <ul class="dropdown-menu shadow border-0" style="min-width: 250px;">
                        <li><a class="dropdown-item py-2" href="#">PEREKAMAN E-KTP</a></li>
                        <li><a class="dropdown-item py-2" href="#">KARTU KELUARGA</a></li>
                        <li><a class="dropdown-item py-2" href="#">AKTA KELAHIRAN</a></li>
                        <li><a class="dropdown-item py-2" href="#">AKTA KEMATIAN</a></li>
                        <li><a class="dropdown-item py-2" href="#">PINDAH DATANG</a></li>
                        <li><a class="dropdown-item py-2" href="#">PENGADUAN</a></li>
                    </ul>
                </li>                      
                         
                <li class="nav-item"><a class="nav-link" href="#">BERITA</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        SERBA SERBI
                    </a>
                    <ul class="dropdown-menu shadow border-0" style="min-width: 250px;">
                        <li><a class="dropdown-item py-2" href="#">PEREKAMAN E-KTP</a></li>
                        <li><a class="dropdown-item py-2" href="#">KARTU KELUARGA</a></li>
                        <li><a class="dropdown-item py-2" href="#">AKTA KELAHIRAN</a></li>
                        <li><a class="dropdown-item py-2" href="#">AKTA KEMATIAN</a></li>
                        <li><a class="dropdown-item py-2" href="#">PINDAH DATANG</a></li>
                        <li><a class="dropdown-item py-2" href="#">PENGADUAN</a></li>
                    </ul>
                </li>  
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        GALERI
                    </a>
                    <ul class="dropdown-menu shadow border-0" style="min-width: 250px;">
                        <li><a class="dropdown-item py-2" href="#">PEREKAMAN E-KTP</a></li>
                        <li><a class="dropdown-item py-2" href="#">KARTU KELUARGA</a></li>
                        <li><a class="dropdown-item py-2" href="#">AKTA KELAHIRAN</a></li>
                        <li><a class="dropdown-item py-2" href="#">AKTA KEMATIAN</a></li>
                        <li><a class="dropdown-item py-2" href="#">PINDAH DATANG</a></li>
                        <li><a class="dropdown-item py-2" href="#">PENGADUAN</a></li>
                    </ul>
                </li>  
                <li class="nav-item"><a class="nav-link" href="#">KONTAK</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Slider Banner -->
<div id="mainSlider" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-inner">
        <?php
        $data = mysqli_query($conn,"SELECT * FROM slider WHERE status='aktif' ORDER BY urutan ASC");

        $no = 1;

        while($row = mysqli_fetch_array($data)){
        ?>
            <div class="carousel-item <?= ($no == 1) ? 'active' : '' ?>">
                <img src="uploads/<?php echo $row['gambar']; ?>"
         class="d-block w-100"
         style="height:500px; object-fit:cover;">

    <div class="carousel-caption">
        <h2><?php echo $row['judul']; ?></h2>
        <p><?php echo $row['deskripsi']; ?></p>
                </div>
            </div>
        <?php
        $no++;
        }
        ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#mainSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#mainSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>

</div>

<!-- Section Layanan -->
<?php
$layanan = mysqli_query($conn, "SELECT * FROM layanan");
?>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="fw-bold">Layanan Administrasi Kependudukan</h3>
            <p class="text-muted">Pelayanan resmi Disdukcapil</p>
        </div>

        <div class="row g-4">
    <?php while($l = mysqli_fetch_array($layanan)) { ?>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="service-card h-100 text-center">
                <div class="service-icon">
                    <img src="assets/icon/<?php echo $l['icon']; ?>" class="img-fluid">
                </div>
                <h6 class="service-title mt-3">
                    <?php echo $l['nama']; ?>
                </h6>
                <p class="service-desc text-muted small">
                    <?php echo $l['deskripsi']; ?>
                </p>
            </div>
        </div>
    <?php } ?>
</div>
</section>
<section class="py-5 text-white" style="background:#0d47a1;">
    <div class="container text-center">
        <div class="row">
            <div class="col-md-3">
                <h2 class="counter" data-target="25000">0</h2>
                <p>Jumlah Penduduk</p>
            </div>
            <div class="col-md-3">
                <h2 class="counter" data-target="12000">0</h2>
                <p>e-KTP Tercetak</p>
            </div>
            <div class="col-md-3">
                <h2 class="counter" data-target="5000">0</h2>
                <p>Akta Kelahiran</p>
            </div>
            <div class="col-md-3">
                <h2 class="counter" data-target="300">0</h2>
                <p>Layanan per Hari</p>
            </div>
        </div>
    </div>
</section>

<!-- Berita Section -->
<section class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h3 class="fw-bold">Berita Terbaru</h3>
            <p class="text-muted">Informasi dan kegiatan terbaru Disdukcapil</p>
        </div>
<div class="row g-4">

<?php 
$no = 1;
while($row = mysqli_fetch_assoc($query)) { 
?>

  <?php if($no == 1) { ?>
    
    <!-- BERITA UTAMA -->
    <div class="col-lg-7">
      <div class="berita-card berita-featured">
        <div class="berita-image-wrapper">
       <img 
  src="assets/berita/<?php echo $row['gambar']; ?>" 
  class="berita-img"
  loading="lazy"
  decoding="async"
  width="600"
  height="400"
  >

          
          <span class="berita-date">
            <?php echo date('d M Y', strtotime($row['tanggal'])); ?>
          </span>
        </div>

        <div class="berita-content">
          <h5 class="berita-title">
            <?php echo $row['judul']; ?>
          </h5>

          <a href="detail.php?id=<?php echo $row['id']; ?>" class="berita-link">
            Baca Selengkapnya →
          </a>
        </div>

      </div>
    </div>

    <!-- WRAPPER BERITA KECIL -->
    <div class="col-lg-5">
      <div class="row g-4">

  <?php } else { ?>

    <!-- BERITA KECIL -->
    <div class="col-12">
      <div class="berita-card berita-small">
        
        <div class="berita-image-wrapper">
          <img src="assets/berita/<?php echo $row['gambar']; ?>" class="berita-img">
        </div>

        <div class="berita-content">
          <span class="berita-date">
            <?php echo date('d M Y', strtotime($row['tanggal'])); ?>
          </span>

          <h6 class="berita-title">
            <?php echo $row['judul']; ?>
          </h6>
        </div>

      </div>
    </div>

  <?php } ?>

<?php 
$no++;
} 
?>

      </div>
    </div>

</div>
</section>

<!-- Footer -->
<footer class="mt-5 p-4 text-center">
    <div class="container">
        <p><strong>Dinas Kependudukan dan Pencatatan Sipil</strong></p>
        <p>Komplek Perkantoran Bhati Praja</p>
        <p>Email: disdukcapil@email.go.id | Telp: (021) 12345678</p>
        <p>© <?php echo date("Y"); ?> Pemerintah Daerah</p>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
AOS.init();
</script>

<!-- Counter Script -->
<script>
document.querySelectorAll('.counter').forEach(counter => {
    counter.innerText = '0';

    const updateCounter = () => {
        const target = +counter.getAttribute('data-target');
        const c = +counter.innerText;
        const increment = target / 100;

        if (c < target) {
            counter.innerText = Math.ceil(c + increment);
            setTimeout(updateCounter, 20);
        } else {
            counter.innerText = target;
        }
    };

    updateCounter();
});
</script>

<!-- Welcome Screen Auto Hide -->
<script>
window.onload = function() {

    // Total durasi sebelum hilang
    setTimeout(function() {

        var el = document.getElementById("welcome-screen");

        if (el) {
            el.classList.add("fade-out");

            setTimeout(function() {
                el.style.display = "none";
            }, 1200);
        }

    }, 4000); // 4 detik (1.2s animasi logo + jeda)
};
</script>
<!-- FLOATING CONTACT PREMIUM -->
<div class="floating-contact" id="floatingContact">

    <a href="https://wa.me/628xxxxxxxxxx" target="_blank" class="fc-btn wa sub-btn">
        <i class="bi bi-whatsapp"></i>
    </a>

    <a href="mailto:email@domain.com" class="fc-btn email sub-btn">
        <i class="bi bi-envelope"></i>
    </a>

    <button class="fc-btn main-btn" id="mainBtn">
        <i class="bi bi-chat-dots" id="mainIcon"></i>
    </button>

</div>

<script>
const floating = document.getElementById("floatingContact");
const mainBtn = document.getElementById("mainBtn");
const mainIcon = document.getElementById("mainIcon");

let lastScroll = 0;

/* Toggle buka tutup */
mainBtn.addEventListener("click", function(e) {
    e.stopPropagation();
    floating.classList.toggle("active");

    if (floating.classList.contains("active")) {
        mainIcon.className = "bi bi-x-lg";
    } else {
        mainIcon.className = "bi bi-chat-dots";
    }
});

/* Auto close saat klik luar */
document.addEventListener("click", function(e) {
    if (!floating.contains(e.target)) {
        floating.classList.remove("active");
        mainIcon.className = "bi bi-chat-dots";
    }
});

/* Bounce tiap 6 detik */
setInterval(() => {
    if (!floating.classList.contains("active")) {
        mainBtn.classList.add("attention");
        setTimeout(() => {
            mainBtn.classList.remove("attention");
        }, 600);
    }
}, 6000);

/* Auto hide saat scroll ke atas */
window.addEventListener("scroll", function() {
    let currentScroll = window.pageYOffset;

    if (currentScroll < lastScroll) {
        floating.classList.add("hide"); // scroll ke atas
    } else {
        floating.classList.remove("hide"); // scroll ke bawah
    }

    lastScroll = currentScroll;
});
</script>
<script>
document.querySelectorAll('.dropdown-toggle').forEach(function(element) {
    element.addEventListener('click', function(e) {
        if (window.innerWidth < 992) {
            e.preventDefault();
            let nextEl = this.nextElementSibling;
            if (nextEl.style.display === "block") {
                nextEl.style.display = "none";
            } else {
                nextEl.style.display = "block";
            }
        }
    });
});
</script>
</body>
</html>