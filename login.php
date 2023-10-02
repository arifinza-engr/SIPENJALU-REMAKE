<?php
include "inc/koneksi.php";
session_start(); // Mulai sesi di awal

if (isset($_POST['btnLogin'])) {
  $username = "pengadu";
  $password = "123";

  // Menggunakan prepared statements
  $stmt = $koneksi->prepare("SELECT * FROM tb_pengguna WHERE username=? AND password=?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result = $stmt->get_result();
  $data_login = $result->fetch_assoc();

  if ($result->num_rows == 1) {
    $_SESSION["ses_id"] = $data_login["id_pengguna"];
    $_SESSION["ses_nama"] = $data_login["nama_pengguna"];
    $_SESSION["ses_level"] = $data_login["level"];
    $_SESSION["ses_grup"] = $data_login["grup"];

    session_regenerate_id(); // Regenerate session ID after login

    echo "<script>window.location = 'index';</script>";
  }
  $stmt->close();
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIPENJALU</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkyPyVxHBaWGGsJgiQDe0ttKfhE1zzDZ0&callback=initMap" async defer></script>

  <link rel="stylesheet" href="assets/css/login.css">
</head>

<body> <!-- Ganti "login" dengan class bawaan Bootstrap "bg-light" untuk background putih -->

  <div class="container my-5"> <!-- Tambahkan margin atas dan bawah dengan "my-5" -->
    <div class="row justify-content-center"> <!-- Tambahkan "justify-content-center" untuk mengatur posisi kolom ke tengah -->
      <div class="col-md-4 col-sm-6">
        <div class="card">
          <div class="card-body text-center" id="card-colour">
            <img src="assets/img/tittle.png" class="user-image img-responsive mb-4" alt="User Image" style="max-width: 180px;" />
            <h2><b>SIPENJALU</b></h2>
            <p>Aplikasi Pengaduan Penerangan Jalan Umum</p>

            <form action="" method="POST" enctype="multipart/form-data">
              <input type="hidden" class="form-control" value="pengadu" name="username" id="username" />
              <input type="hidden" class="form-control" value="123" name="password" id="password" />

              <button type="submit" class="btn btn-primary form-control mt-3" name="btnLogin">MULAI PENGADUAN</button>

              <!-- Tambahkan margin atas dengan "mt-3" untuk memberi jarak dengan tombol -->
              <p class="mt-3">SIPENJALU 2023</p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>


<?php
if (isset($_POST['btnLogin'])) {
  $sql_login = "SELECT * FROM tb_pengguna WHERE username='" . $_POST['username'] . "' AND password='" . $_POST['password'] . "'";
  $query_login = mysqli_query($koneksi, $sql_login);
  $data_login = mysqli_fetch_array($query_login, MYSQLI_BOTH);
  $jumlah_login = mysqli_num_rows($query_login);


  if ($jumlah_login == 1) {
    session_start();
    $_SESSION["ses_id"] = $data_login["id_pengguna"];
    $_SESSION["ses_nama"] = $data_login["nama_pengguna"];
    $_SESSION["ses_level"] = $data_login["level"];
    $_SESSION["ses_grup"] = $data_login["grup"];

    echo "<script>window.location = 'index';</script>";
  }
}
?>

<!-- END -->