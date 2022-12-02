<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lobster+Two:ital@1&family=Playfair+Display+SC&display=swap">
</head>

<body style="font-family: Playfair Display SC, serif">
  <!-- header -->
  <?php include('Inc/header.php'); ?>
  <!-- akhir header -->
  <!-- carousel -->
  <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/1.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>First slide label</h5>
          <p>Some representative placeholder content for the first slide.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/2.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Second slide label</h5>
          <p>Some representative placeholder content for the second slide.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/3.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Third slide label</h5>
          <p>Some representative placeholder content for the third slide.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- akhir carousel -->

  <!-- Kategori Berita -->
  <div class="container m-auto text-center mt-3">
    <h1>Berita Terbaru</h1>
    <hr style="height: 3px;" class="bg-primary w-25 m-auto mb-3">
  </div>
  <!-- akhir kategori -->
  <!-- Bagian Utama -->
  <div class="m-auto container row">
    <!-- Berita -->
    <div class="col-12 col-lg-8">
      <!-- Berita 1 -->
      <div class="card mb-3">
        <img src="img/1.jpg" height="300px" class="card-img-top" style="object-fit: cover;" alt="...">
        <div class="card-body">
          <h5 class="card-title fw-bolder fs-2">Card title</h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
            content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
      <!-- akhir berita 1 -->
      <!-- berita 2 -->
      <div class="card mb-3">
        <img src="img/2.jpg" height="300px" class="card-img-top" style="object-fit: cover;" alt="...">
        <div class="card-body">
          <h5 class="card-title fw-bolder fs-2">Card title</h5>
          <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional
            content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
      <!-- akhir berita 2 -->
    </div>
    <!-- Akhir Berita -->
    <!-- side bar -->
    <div class="col-12 col-lg-4">
      <!-- side bar kategori -->
      <div class="card m-auto mb-5" style="width: 100%;">
        <div class="card-header fs-4 text-center">
          Kategori
        </div>
        <ul class="list-group list-group-flush">
          <a href="" style="text-decoration: none;">
            <li class="list-group-item btn btn-light">An item</li>
          </a>
          <a href="" style="text-decoration: none;">
            <li class="list-group-item btn btn-light">An item</li>
          </a>
          <a href="" style="text-decoration: none;">
            <li class="list-group-item btn btn-light">An item</li>
          </a>
        </ul>
      </div>
      <!-- akhir side bar katogori -->
      <!-- side bar berita terbaru -->
      <div class="card m-auto mb-5" style="width: 100%;">
        <div class="card-header fs-4 text-center">
          Berita Terbaru
        </div>
        <ul class="list-group list-group-flush">
          <a href="" style="text-decoration: none;">
            <li class="list-group-item btn btn-light">An item</li>
          </a>
          <a href="" style="text-decoration: none;">
            <li class="list-group-item btn btn-light">An item</li>
          </a>
          <a href="" style="text-decoration: none;">
            <li class="list-group-item btn btn-light">An item</li>
          </a>
        </ul>
      </div>
      <!-- akhir side bar berita terbaru -->
    </div>
    <!-- akhir side bar -->
  </div>
  <!-- akhir bagian utama -->
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

  <!-- my js -->
  <script src="header.js"></script>
</body>

</html>