<?php
session_start();
if (!isset($_SESSION["loginAdmin"]) || !isset($_SESSION['idAdmin'])) {
  header("Location: ../login");
}
require '../../koneksi.php';
$idAdmin = $_SESSION["idAdmin"];
$namas = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$idAdmin'");
$nama = mysqli_fetch_assoc($namas);

// kategori
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
// berita
$berita = mysqli_query($conn, "SELECT * FROM berita");
// komentar
$komentar = mysqli_query($conn, "SELECT * FROM komentar");
// user
$user = mysqli_query($conn, "SELECT * FROM user");
// balasan
$balasan = mysqli_query($conn, "SELECT * FROM balasan");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Beranda</title>
  <link rel="stylesheet" href="../bootstrap.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Merienda+One&family=Noto+Serif&display=swap" rel="stylesheet" />
</head>

<body style="font-family: 'Noto serif', serif" class="bg-light">
  <?php include('../Inc/header.php') ?>
  <h1 class="mt-5 fw-bolder text-center" style="font-size: 60px; font-family: 'Merienda One', cursive">
    Beranda
  </h1>
  <hr class="w-50 m-auto bg-dark" style="height: 3px" />
  <div class="container d-flex flex-wrap mt-5">
    <!-- kategori -->
    <button class="mt-5 rounded-3 border-0 m-auto bg-light"
      style="min-width: 250px; height: 150px;box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 8px;">
      <a href="../KelolaKategori/" class="row text-decoration-none text-dark">
        <div class="card-body col-7 m-auto">
          <h3 class="card-title fw-bolder mb-2">Kategori</h3>
          <p class="card-text fw-bolder fs-1">
            <?php echo $kategori->num_rows; ?>
          </p>
        </div>
        <div class="card-body col-5 m-auto">
          <h1 class="card-title" style="font-size: 60px; color: rgb(255, 208, 121)">
            <ion-icon name="folder"></ion-icon>
          </h1>
        </div>
      </a>
    </button>
    <!-- akhir kategori -->
    <!-- berita -->
    <button class="mt-5 rounded-3 border-0 m-auto bg-light"
      style="min-width: 250px; height: 150px;box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 8px;">
      <a href="../kelolaBerita/" class="row text-decoration-none text-dark">
        <div class="card-body col-7 m-auto">
          <h3 class="card-title fw-bolder mb-2">Berita</h3>
          <p class="card-text fw-bolder fs-1">
            <?php echo $berita->num_rows; ?>
          </p>
        </div>
        <div class="card-body col-5 m-auto">
          <h1 class="card-title" style="font-size: 60px; color: rgb(112, 211, 117)">
            <ion-icon name="newspaper"></ion-icon>
          </h1>
        </div>
      </a>
    </button>
    <!-- akhri berita -->
    <!-- komentar -->
    <button class="mt-5 rounded-3 border-0 m-auto bg-light"
      style="min-width: 250px; height: 150px;box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 8px;">
      <a href="../kelolaKomentar/" class="row ms-1 text-decoration-none text-dark">
        <div class="card-body col-7 m-auto">
          <h3 class="card-title fw-bolder mb-2">Komentar</h3>
          <p class="card-text fw-bolder fs-1">
            <?php echo $komentar->num_rows; ?>
          </p>
        </div>
        <div class="card-body col-5 m-auto">
          <h1 class="card-title" style="font-size: 60px; color: rgb(255, 154, 136)">
            <ion-icon name="chatbox-ellipses"></ion-icon>
          </h1>
        </div>
      </a>
    </button>
    <!-- akhir komentar -->
    <!-- user -->
    <button class="my-5 rounded-3 border-0 m-auto bg-light"
      style="min-width: 250px; height: 150px;box-shadow: rgba(0, 0, 0, 0.15) 0px 2px 8px;">
      <a href="../KelolaUser/" class="row text-decoration-none text-dark">
        <div class="card-body col-7 m-auto">
          <h3 class="card-title fw-bolder mb-2">User</h3>
          <p class="card-text fw-bolder fs-1">
            <?php echo $user->num_rows; ?>
          </p>
        </div>
        <div class="card-body col-5 m-auto">
          <h1 class="card-title" style="font-size: 60px; color: rgb(58, 77, 255)">
            <ion-icon name="people"></ion-icon>
          </h1>
        </div>
      </a>
    </button>
    <!-- akhir user -->
  </div>

  <!-- script-ion-icons -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <!-- bootstrap -->
  <script src="../bootstrap.bundle.js"></script>
</body>

</html>