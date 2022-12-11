<?php
session_start();
if (!isset($_SESSION["login"]) || !isset($_SESSION["id"])) {
  header("Location: ../login");
}
require '../koneksi.php';
// kategori
$kategori = query("SELECT * FROM kategori");

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang</title>
  <link rel="stylesheet" href="bootstrap.css" />
  <!-- fontstyle -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merienda+One&family=Noto+Serif&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Noto Serif', serif">
  <!-- header -->
  <?php include('Inc/header.php'); ?>
  <!-- akhir header -->
  <div class="container mb-5">
    <!-- penyesuaian dengan navbar -->
    <div style="height: 100px;width: 40px;"></div>
    <!-- akhir penyesuaian dengan navbar -->
    <!-- Perkenalan ToSee -->
    <div class="mb-4 shadow-lg rounded-5 text-center mb-5 p-3">
      <img width="200px" src="../img/Logo-Tulisan.png" alt="">
      <h3 class="fw-bold">Sejarah ToSee News</h3>
      <hr class="mb-5 w-50 m-auto bg-black" style="height: 3px;">
      <h5 class="fw-bolder mb-5 w-75 m-auto">ToSee merupakan nama yang diambil dari pelesetan kelompok 2C yang merupakan
        nama
        kelompok
        kami dalam
        pengerjaan tugas besar. ToSee atau Two C merupakan sebuah portal berita yang berisi fakta dan opini tokoh
        besar/publik mengenai isu isu yang sedang berkembang dimasyarakat saat ini.</h5>
    </div>
    <!-- akhir perkenalan ToSee -->
    <!-- card developer -->
    <div class=" d-flex justify-content-evenly flex-wrap" style="gap: 30px;">
      <div class="card shadow-sm" style="width: 23rem;">
        <img style="object-fit: cover;" height="250px" src="img/img-developer/Alwin.jpeg" class="card-img-top"
          alt="...">
        <div class="card-body text-center">
          <a target="_blank" href="https://www.instagram.com/winz.liu/"
            class="btn btn-light rounded-3 text-black text-decoration-none card-text fw-bolder fs-5">Alwin Liufandy</a>
          <br>
          <a target="_blank" href="https://www.instagram.com/c.ommandprompt/"
            class="text-black text-decoration-none card-text fw-bolder fs-5">COM : C</a>
          <p class="fw-bolder fs-5">NIM : 221402037</p>
        </div>
      </div>
      <div class="card shadow-sm" style="width: 23rem;">
        <img src="img/img-developer/1.jpg" height="250px" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <a target="_blank" href="https://www.instagram.com/winz.liu/"
            class="btn btn-light rounded-3 text-black text-decoration-none card-text fw-bolder fs-5">Alwin Liufandy</a>
          <br>
          <a target="_blank" href="https://www.instagram.com/c.ommandprompt/"
            class="text-black text-decoration-none card-text fw-bolder fs-5">COM : C</a>
          <p class="fw-bolder fs-5">NIM : 221402037</p>
        </div>
      </div>
      <div class="card shadow-sm" style="width: 23rem;">
        <img src="img/img-developer/1.jpg" height="250px" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <a target="_blank" href="https://www.instagram.com/winz.liu/"
            class="btn btn-light rounded-3 text-black text-decoration-none card-text fw-bolder fs-5">Alwin Liufandy</a>
          <br>
          <a target="_blank" href="https://www.instagram.com/c.ommandprompt/"
            class="text-black text-decoration-none card-text fw-bolder fs-5">COM : C</a>
          <p class="fw-bolder fs-5">NIM : 221402037</p>
        </div>
      </div>
      <div class="card shadow-sm" style="width: 23rem;">
        <img src="img/img-developer/1.jpg" height="250px" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <a target="_blank" href="https://www.instagram.com/winz.liu/"
            class="btn btn-light rounded-3 text-black text-decoration-none card-text fw-bolder fs-5">Alwin Liufandy</a>
          <br>
          <a target="_blank" href="https://www.instagram.com/c.ommandprompt/"
            class="text-black text-decoration-none card-text fw-bolder fs-5">COM : C</a>
          <p class="fw-bolder fs-5">NIM : 221402037</p>
        </div>
      </div>
      <div class="card shadow-sm" style="width: 23rem;">
        <img src="img/img-developer/1.jpg" height="250px" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <a target="_blank" href="https://www.instagram.com/winz.liu/"
            class="btn btn-light rounded-3 text-black text-decoration-none card-text fw-bolder fs-5">Alwin Liufandy</a>
          <br>
          <a target="_blank" href="https://www.instagram.com/c.ommandprompt/"
            class="text-black text-decoration-none card-text fw-bolder fs-5">COM : C</a>
          <p class="fw-bolder fs-5">NIM : 221402037</p>
        </div>
      </div>
    </div>
  </div>
  <!-- akhir card developer -->
  <!-- footer -->
  <?php include('Inc/footer.php'); ?>
  <!-- akhir footer -->
  <!-- bootstrap -->
  <script src="bootstrap.bundle.js"></script>
  <!-- script-ion-icons -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <!-- jquery -->
  <script src="jquery-3.6.0.min.js"></script>
  <script src="search/script.js"></script>
  <!-- my js -->
  <script src="header.js"></script>
</body>

</html>