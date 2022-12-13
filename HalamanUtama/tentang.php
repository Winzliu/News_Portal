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
      <!-- alwin -->
      <div class="card shadow-sm" style="width: 23rem;">
        <button id="imageZoom" class="btn p-0">
          <img style="object-fit: cover;" src="img/img-developer/Alwin.jpeg" height="250px" class="card-img-top"
            alt="...">
        </button>
        <div class="card-body text-center">
          <a target="_blank" href="https://www.instagram.com/winz.liu/"
            class="btn btn-light rounded-3 text-black text-decoration-none card-text fw-bolder fs-5">Alwin Liufandy</a>
          <br>
          <a target="_blank" href="https://www.instagram.com/c.ommandprompt/"
            class="text-black text-decoration-none card-text fw-bolder fs-5">COM : C</a>
          <p class="fw-bolder fs-5">NIM : 221402037</p>
        </div>
        <div id="imgDetail" style="z-index: 999999;"
          class="bg-dark bg-opacity-75 position-fixed top-0 bottom-0 start-0 end-0 d-none">
          <img width="600px" class=" m-auto rounded" src="img/img-developer/Alwin.jpeg" alt="">
          <button id="imgClose" type="button" class="btn-close fs-4 m-4 btn-close-white" aria-label="Close"></button>
        </div>
      </div>
      <!-- akhir alwin -->
      <!-- najwa -->
      <div class="card shadow-sm" style="width: 23rem;">
        <button id="imageZoom" class="btn p-0">
          <img style="object-fit: cover;" src="img/img-developer/najwa.jpg" height="250px" class="card-img-top"
            alt="...">
        </button>
        <div class="card-body text-center">
          <a target="_blank" href="https://www.instagram.com/najwaamnda/"
            class="btn btn-light rounded-3 text-black text-decoration-none card-text fw-bolder fs-5">Najwa Amanda</a>
          <br>
          <a target="_blank" href="https://www.instagram.com/c.ommandprompt/"
            class="text-black text-decoration-none card-text fw-bolder fs-5">COM : C</a>
          <p class="fw-bolder fs-5">NIM : 221402068</p>
        </div>
        <div id="imgDetail" style="z-index: 999999;"
          class="bg-dark bg-opacity-75 position-fixed top-0 bottom-0 start-0 end-0 d-none">
          <img width="600px" class=" m-auto rounded" src="img/img-developer/najwa.jpg" alt="">
          <button id="imgClose" type="button" class="btn-close fs-4 m-4 btn-close-white" aria-label="Close"></button>
        </div>
      </div>
      <!-- akhri najwa -->
      <!-- naufal -->
      <div class="card shadow-sm" style="width: 23rem;">
        <button id="imageZoom" class="btn p-0">
          <img style="object-fit: cover;" src="img/img-developer/1.jpg" height="250px" class="card-img-top" alt="...">
        </button>
        <div class="card-body text-center">
          <a target="_blank" href="https://www.instagram.com/winz.liu/"
            class="btn btn-light rounded-3 text-black text-decoration-none card-text fw-bolder fs-5">Alwin Liufandy</a>
          <br>
          <a target="_blank" href="https://www.instagram.com/c.ommandprompt/"
            class="text-black text-decoration-none card-text fw-bolder fs-5">COM : C</a>
          <p class="fw-bolder fs-5">NIM : 221402037</p>
        </div>
        <div id="imageDetail" style="z-index: 999999;"
          class="bg-dark bg-opacity-75 position-fixed top-0 bottom-0 start-0 end-0 d-none">
          <img width="600px" class=" m-auto rounded" src="img/img-developer/1.jpg" alt="">
          <button id="imageClose" type="button" class="btn-close fs-4 m-4 btn-close-white" aria-label="Close"></button>
        </div>
      </div>
      <!-- akhir naufal -->
      <!-- wahyu -->
      <div class="card shadow-sm" style="width: 23rem;">
        <button id="imageZoom" class="btn p-0">
          <img style="object-fit: cover;" src="img/img-developer/Wahyu.jpg" height="250px" class="card-img-top"
            alt="...">
        </button>
        <div class="card-body text-center">
          <a target="_blank" href="https://www.instagram.com/wahyujrs_19/"
            class="btn btn-light rounded-3 text-black text-decoration-none card-text fw-bolder fs-5">Wahyu Jhon Riadi
            Sianipar</a>
          <br>
          <a target="_blank" href="https://www.instagram.com/c.ommandprompt/"
            class="text-black text-decoration-none card-text fw-bolder fs-5">COM : C</a>
          <p class="fw-bolder fs-5">NIM : 221402135</p>
        </div>
        <div id="imgDetail" style="z-index: 999999;"
          class="bg-dark bg-opacity-75 position-fixed top-0 bottom-0 start-0 end-0 d-none">
          <img width="600px" class=" m-auto rounded" src="img/img-developer/Wahyu.jpg" alt="">
          <button id="imgClose" type="button" class="btn-close fs-4 m-4 btn-close-white" aria-label="Close"></button>
        </div>
      </div>
      <!-- akhir wahyu -->
      <!-- fenaya -->
      <div class="card shadow-sm" style="width: 23rem;">
        <button id="imageZoom" class="btn p-0">
          <img style="object-fit: cover;" src="img/img-developer/2.jpg" height="250px" class="card-img-top" alt="...">
        </button>
        <div class="card-body text-center">
          <a target="_blank" href="https://www.instagram.com/winz.liu/"
            class="btn btn-light rounded-3 text-black text-decoration-none card-text fw-bolder fs-5">Alwin Liufandy</a>
          <br>
          <a target="_blank" href="https://www.instagram.com/c.ommandprompt/"
            class="text-black text-decoration-none card-text fw-bolder fs-5">COM : C</a>
          <p class="fw-bolder fs-5">NIM : 221402037</p>
        </div>
        <div id="imageDetail" style="z-index: 999999;"
          class="bg-dark bg-opacity-75 position-fixed top-0 bottom-0 start-0 end-0 d-none">
          <img width="600px" class=" m-auto rounded" src="img/img-developer/2.jpg" alt="">
          <button id="imageClose" type="button" class="btn-close fs-4 m-4 btn-close-white" aria-label="Close"></button>
        </div>
      </div>
      <!-- akhir fenaya -->
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
  <script>
    let zoom = document.querySelectorAll('#imageZoom');
    zoom.forEach(el => {
      el.addEventListener('click', function (e) {
        e.target.parentElement.nextSibling.nextSibling.nextSibling.nextSibling.classList.add('d-flex')
        e.target.parentElement.nextSibling.nextSibling.nextSibling.nextSibling.classList.remove('d-none')
        e.target.parentElement.nextSibling.nextSibling.nextSibling.nextSibling.children.item('#imageClose').nextSibling.nextSibling.addEventListener('click', function (e) {
          e.target.parentElement.classList.remove('d-flex')
          e.target.parentElement.classList.add('d-none')
        })
        e.target.parentElement.nextSibling.nextSibling.nextSibling.nextSibling.addEventListener('click', function (e) {
          e.target.classList.remove('d-flex')
          e.target.classList.add('d-none')
        })
      })
    });
  </script>
</body>

</html>