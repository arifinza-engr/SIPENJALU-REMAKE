<?php

session_set_cookie_params(0, '/', '', false, true);
session_start();

if (empty($_SESSION['ses_nama'])) {
  header("location: login");
  exit();
} else {
  $data_id = $_SESSION["ses_id"];
  $data_nama = $_SESSION["ses_nama"];
  $data_level = $_SESSION["ses_level"];
  $data_grup = $_SESSION["ses_grup"];
}

include "inc/koneksi.php";

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIPENJALU</title>

  <!-- Stylesheets -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- sweet alert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

  <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.0/font/bootstrap-icons.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- ... -->

  <link rel="stylesheet" href="assets/css/style1.css">
  <link rel="stylesheet" href="assets/css/bs.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-light fixed-top" id="navbar">
    <div class="container">
      <a class="navbar-brand" href="index">
        <img src="assets/img/tittle.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
        <span id="text-brand">KABUPATEN PEMALANG</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse fw-semibold" id="navbarNav">
        <ul class="navbar-nav ms-auto">

          <?php if ($data_level == "Administrator" || $data_level == "Petugas" || $data_level == "Pengadu") : ?>
            <li class="nav-item">
              <a class="nav-link" href="index">Dashboard</a>
            </li>
          <?php endif; ?>

          <?php if ($data_level == "Administrator") : ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Master Data
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="?page=pengadu_view">Data Pengadu</a></li>
                <li><a class="dropdown-item" href="?page=jenis_view">Jenis Pengaduan</a></li>
              </ul>
            </li>
          <?php endif; ?>

          <?php if ($data_level == "Administrator" || $data_level == "Petugas") :  ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="pengaduanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Pengaduan
              </a>
              <ul class="dropdown-menu" aria-labelledby="pengaduanDropdown">
                <li><a class="dropdown-item" href="?page=aduan_admin_semua">Semua Aduan</a></li>
                <li><a class="dropdown-item" href="?page=aduan_admin">Aduan Menunggu</a></li>
                <li><a class="dropdown-item" href="?page=aduan_admin_tanggap">Aduan Ditanggapi</a></li>
                <li><a class="dropdown-item" href="?page=aduan_admin_selesai">Aduan Selesai</a></li>
              </ul>
            </li>
          <?php endif; ?>

          <?php if ($data_level == "Pengadu") :  ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="pengaduanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Pengaduan
              </a>
              <ul class="dropdown-menu" aria-labelledby="pengaduanDropdown">
                <li><a class="dropdown-item" href="?page=aduan_tambah">Tambah Aduan</a></li>
                <li><a class="dropdown-item" href="?page=aduan_view">Lihat Aduan</a></li>
              </ul>
            </li>
          <?php endif; ?>

          <?php if ($data_level == "Administrator") : ?>
            <li class="nav-item">
              <a class="nav-link" href="?page=user_data">Pengguna</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?page=whatsapp">Whatsapp</a>
            </li>
          <?php endif; ?>

          <?php if ($data_level == "Administrator" || $data_level == "Petugas") : ?>
            <li class="nav-item">
              <a class="nav-link btn btn-outline-secondary fw-bold" type="button" href="?page=logout">LOGOUT</a>
            </li>
          <?php endif; ?>

        </ul>
      </div>
    </div>
  </nav>

  <div>
    <p>tes</p>
  </div>


  <!-- <div class="p-5 rounded" style="background-image: url('assets/img/galaxy.jpg'); background-size: cover; background-position: center center; opacity: 80%">
    <div class="p-4 rounded text-center">
      <h1 class="display-4" id="text-sipenjalu">SIPENJALU</h1>
      <p class="lead" id="header-text">APLIKASI PENGADUAN PENERANGAN JALAN UMUM</p>
      <p class="lead" id="header-text">BERBASIS WEB MENGGUNAKAN REALTIME NOTIFIKASI WHATSAPP.</p>
      <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
    </div>
  </div> -->

  <div class="slider_area">
    <div class="slider_active owl-carousel">
      <!-- single_carouse -->
      <div class="single_slider d-flex align-items-center jumbotron">
        <div class="container">
          <div class="row justify-content-center"> <!-- Tambahkan "justify-content-center" untuk mengatur konten ke tengah -->
            <div class="col-12">
              <div class="slider_text text-center"> <!-- Tambahkan "text-center" untuk mengatur teks ke tengah -->
                <h1 class="text-white" id="text-sipenjalu">SIPENJALU</h1>
                <h2 class="text-white" id="header-text">APLIKASI PENGADUAN PENERANGAN JALAN UMUM BERBASIS WEB MENGGUNAKAN REAL TIME NOTIFIKASI WHATSAPP</h2>
                <img src="" alt="" id="logosmp1" class="img-fluid"> <!-- Tambahkan "img-fluid" untuk responsifitas gambar -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ single_carouse -->
    </div>
  </div>


  <?php

  // Define an associative array to map page requests to file paths.
  $pageMap = [
    'admin-def' => 'default/admin.php',
    'petugas-def' => 'default/tugas.php',
    'pengadu' => 'default/pengadu.php',
    'user_data' => 'admin/pengguna/pengguna_tampil.php',
    'pengguna_tambah' => 'admin/pengguna/pengguna_tambah.php',
    'pengguna_ubah' => 'admin/pengguna/pengguna_ubah.php',
    'pedu_ubah' => 'admin/pengguna/pedu_ubah.php',
    'pengguna_hapus' => 'admin/pengguna/pengguna_hapus.php',
    'jenis_view' => 'admin/jenis/jenis_tampil.php',
    'jenis_tambah' => 'admin/jenis/jenis_tambah.php',
    'jenis_ubah' => 'admin/jenis/jenis_ubah.php',
    'jenis_hapus' => 'admin/jenis/jenis_hapus.php',
    'pengadu_view' => 'admin/pengadu/pengadu_tampil.php',
    'pengadu_tambah' => 'admin/pengadu/pengadu_tambah.php',
    'pengadu_ubah' => 'admin/pengadu/pengadu_ubah.php',
    'pengadu_hapus' => 'admin/pengadu/pengadu_hapus.php',
    'aduan_admin' => 'admin/aduan/adu_tampil.php',
    'aduan_admin_semua' => 'admin/aduan/adu_tampil_semua.php',
    'aduan_admin_tanggap' => 'admin/aduan/adu_tanggap.php',
    'aduan_admin_selesai' => 'admin/aduan/adu_selesai.php',
    'aduan_kelola' => 'admin/aduan/adu_ubah.php',
    'whatsapp' => 'admin/whatsapp/whatsapp.php',
    'laporan' => 'admin/laporan/laporan.php',
    'logout' => 'logout.php',
    'aduan_view' => 'pengadu/aduan/adu_tampil.php',
    'aduan_tambah' => 'pengadu/aduan/adu_tambah.php',
    'aduan_ubah' => 'pengadu/aduan/adu_ubah.php',
    'aduan_hapus' => 'pengadu/aduan/adu_hapus.php'
  ];

  // Define an array for default pages based on user level
  $defaultPages = [
    'Administrator' => 'default/admin.php',
    'Petugas' => 'default/tugas.php',
    'Pengadu' => 'default/pengadu.php'
  ];

  // Get the requested page from the URL query parameter.
  $hal = $_GET['page'] ?? null;

  // Include the appropriate file based on the request, or go to the default page based on user level.
  if (isset($pageMap[$hal])) {
    include $pageMap[$hal];
  } elseif (isset($defaultPages[$data_level])) {
    include $defaultPages[$data_level];
  } else {
    echo "<center><h1> ERROR !</h1></center>";
  }

  ?>

  <!-- Copyrights -->
  <footer class="bg-infooo text-center text-white mt-3">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Social media -->
      <section class="mb-4">
        <!-- Facebook -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

        <!-- Twitter -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>

        <!-- Google -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-google"></i></a>

        <!-- Instagram -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i></a>

        <!-- Linkedin -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>

        <!-- Github -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i></a>
      </section>
      <!-- Section: Social media -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2023 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/">@finzaengr</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- End -->
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#dataTables-example').DataTable();
    });
  </script>

</body>

</html>