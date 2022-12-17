<?php
session_start();
require '../koneksi.php';
// user
$idUser = $_SESSION["id"];
$users = mysqli_query($conn, "SELECT * FROM user WHERE id = '$idUser'");
$user = mysqli_fetch_assoc($users);
if (!isset($_SESSION["login"]) || !isset($user["id"])) {
  header("Location: ../login");
}
// kategori
$kategori = query("SELECT * FROM kategori");
// pagination berita
$JumlahDataPerHal = 5;
$JumlahData = count(query("SELECT * FROM berita"));
$JumlahHalaman = ceil($JumlahData / $JumlahDataPerHal);

$HalSekarang = (isset($_GET["page"])) ? $_GET["page"] : 1;


$IndeksData = ($HalSekarang * $JumlahDataPerHal) - $JumlahDataPerHal;

$beritaFull = query("SELECT * FROM berita");
$berita = query("SELECT * FROM berita ORDER BY id DESC LIMIT $IndeksData,$JumlahDataPerHal");
// berita pada carousel
$beritaBaru = query("SELECT * FROM berita ORDER BY id DESC LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>ToSee News</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
  <!-- carousel -->
  <div id="carouselExampleCaptions" class="carousel slide carousel-fade d-none d-md-block" data-bs-ride="carousel">
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
        <img style="object-fit: cover;" width="1900px" height="755px"
          src="img/img-berita/<?php echo $beritaBaru[0]['gambar']; ?>" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
          <h3>
            <?php echo $beritaBaru[0]['judul']; ?>
          </h3>
          <a href="../HalamanDetail/index.php?id=<?php echo $beritaBaru['0']['id']; ?>" class="btn btn-primary">Baca
            Lebih
            Lanjut</a>
        </div>
      </div>
      <?php for ($i = 1; $i <= 2; $i++): ?>
      <div class="carousel-item">
        <img style="object-fit: cover;" width="1900" height="755"
          src="img/img-berita/<?php echo $beritaBaru[$i]['gambar']; ?>" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
          <h3>
            <?php echo $beritaBaru[$i]['judul']; ?>
          </h3>
          <a href="../HalamanDetail/index.php?id=<?php echo $beritaBaru[$i]['id']; ?>" class="btn btn-primary">Baca
            Lebih
            Lanjut</a>
        </div>
      </div>
      <?php endfor; ?>
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
  <!-- cocokan dengan navbar(phone) -->
  <div class="d-md-none d-block" style="height: 80px;width: 40px;"></div>
  <!-- akhri cocokan dengan navbar(phone) -->
  <!-- profile & jam -->
  <div class="row container m-auto">
    <div class="test-start col-8 mt-5">
      <h2 class="my-auto fs-4 fw-bolder " id="tanggal"></h2>
      <h2 class="my-auto fs-4 fw-bolder " id="jam"></h2>
    </div>
    <div class="dropdown text-end mt-4 pe-5 col-4">
      <img src="img/img-user/<?php echo $user["gambar"]; ?>" width="80px" height="80px"
        class=" rounded-circle dropdown-toggle shadow-lg" style="object-fit: cover;" type="button"
        data-bs-toggle="dropdown" aria-expanded="false">
      </img>
      <ul class="dropdown-menu">
        <li>
          <h5 class="dropdown-item active bg-light text-black">Halo,<span class="fw-bold">
              <?= $user["username"]; ?>
            </span> !
          </h5>
        </li>
        <li><a class="dropdown-item fs-5" href="../User/">
            <ion-icon name="settings-outline" class="fs-6"></ion-icon> Edit Profile
          </a></li>

        <!-- Button trigger modal -->
        <a href="../logout.php" class="dropdown-item fs-5 " data-bs-toggle="modal" data-bs-target="#exampleModal">
          <ion-icon name="power" class="fs-6"></ion-icon> Logout
        </a>
      </ul>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
              Yakin Ingin Melakukan Logout?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <a href="../logout.php" type="button" class="btn btn-danger">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- akhir profile & jam -->

  <!-- Header Berita -->
  <div class="container m-auto text-center mt-3">
    <h1 class="fw-bolder">Berita Terbaru</h1>
    <hr style="height: 3px;" class="bg-primary w-25 m-auto mb-3">
  </div>
  <!-- akhir Header Berita -->
  <!-- Bagian Utama -->
  <div class="m-auto container row">
    <!-- Berita -->
    <div class="col-12 col-lg-8">
      <!-- Berita  -->
      <?php foreach ($berita as $b): ?>
      <div class="card mb-3">
        <img src="img/img-berita/<?php echo $b['gambar']; ?>" height="300px" class="card-img-top"
          style="object-fit: cover;" alt="...">
        <div class="card-body">
          <h5 class="card-title fw-bolder fs-2">
            <?php echo $b['judul']; ?>
          </h5>
          <div class="card-text fw-lighter" style="height: 50px;overflow: hidden;">
            <?php echo $b['berita']; ?>
          </div>
          <p class="card-text mt-3"><small class="text-muted">Dipublis pada
              <strong>
                <?php echo $b['tanggal']; ?>
              </strong>
            </small></p>
          <a href="../HalamanDetail/index.php?id=<?php echo $b['id']; ?>" class="btn btn-primary">Baca Lebih Lanjut</a>
        </div>
      </div>
      <?php endforeach; ?>
      <!-- akhir berita  -->
      <!-- pagination -->
      <ul class="pagination pagination-sm justify-content-center my-4">
        <?php if ($HalSekarang > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $HalSekarang - 1; ?>">Sebelumnya</a>
        </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $JumlahHalaman; $i++): ?>
        <?php if ($i == $HalSekarang): ?>
        <li class="page-item active"><a class="page-link" href="?page=<?= $i ?>">
            <?php echo $i; ?>
          </a></li>
        <?php else: ?>
        <li class="page-item"><a class="page-link" href="?page=<?= $i ?>">
            <?php echo $i; ?>
          </a></li>
        <?php endif; ?>
        <?php endfor; ?>

        <?php if ($HalSekarang < $JumlahHalaman): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $HalSekarang + 1; ?>">Selanjutnya</a>
        </li>
        <?php endif; ?>
      </ul>
      <!-- akhir pagination -->
    </div>
    <!-- Akhir Berita -->
    <!-- side bar -->
    <div class="col-12 col-lg-4">
      <!-- side bar kategori -->
      <div class="card m-auto mb-5" style="width: 100%;">
        <div class="card-header fs-3 fw-bolder text-center">
          Kategori
        </div>
        <ul class="list-group list-group-flush">
          <?php foreach ($kategori as $row): ?>
          <a href="kategori.php?kategori=<?php echo $row["namaKategori"]; ?>" style="text-decoration: none;">
            <li style="overflow: hidden; height: 45px;" class="list-group-item btn btn-light fs-5 fw-bolder">
              <?php echo $row["namaKategori"]; ?>
            </li>
          </a>
          <?php endforeach; ?>
        </ul>
      </div>
      <!-- akhir side bar katogori -->
      <!-- side bar berita terbaru -->
      <div class="card m-auto mb-5" style="width: 100%;">
        <div class="card-header fs-3 fw-bolder text-center">
          Berita Terbaru
        </div>
        <ul class="list-group list-group-flush">
          <?php foreach ($beritaBaru as $baru): ?>
          <a href="../HalamanDetail/index.php?id=<?= $baru['id'] ?>" style="text-decoration: none;">
            <li style="height: 45px;overflow: hidden;" class="list-group-item btn btn-light fw-bolder fs-5">
              <?php echo $baru['judul'] ?>
            </li>
          </a>
          <?php endforeach; ?>
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
  <script src="search/script.js"></script>

  <!-- my js -->
  <script src="header.js"></script>

  <!-- jam -->
  <script>
    let date = new Date();
    setInterval(() => {
      let tanggal = date.getDate();
      let bulan = date.toLocaleString('default', { month: 'short' });
      let tahun = date.getFullYear();

      let jam = new Date().getHours();
      let menit = new Date().getMinutes();
      let detik = new Date().getSeconds();
      document.getElementById('tanggal').innerHTML = tanggal + '-' + bulan + '-' + tahun;
      document.getElementById('jam').innerHTML = jam + ' : ' + menit + ' : ' + detik;
    }, 100);
  </script>
</body>

</html>