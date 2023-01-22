<?php
session_start();
require '../koneksi.php';
if (!isset($_SESSION["login"]) || !isset($_SESSION["id"])) {
  header("Location: ../login");
}
// user
$idUser = $_SESSION["id"];
$users = mysqli_query($conn, "SELECT * FROM user WHERE id = '$idUser'");
$user = mysqli_fetch_assoc($users);
// kategori
$kategoriHal = $_GET["kategori"];
$kategori = query("SELECT * FROM kategori");
// pagination berita
$JumlahDataPerHal = 5;
$JumlahData = count(query("SELECT * FROM berita WHERE kategori='$kategoriHal'"));
$JumlahHalaman = ceil($JumlahData / $JumlahDataPerHal);

$HalSekarang = (isset($_GET["page"])) ? $_GET["page"] : 1;


$IndeksData = ($HalSekarang * $JumlahDataPerHal) - $JumlahDataPerHal;


$berita = query("SELECT * FROM berita WHERE kategori='$kategoriHal' LIMIT $IndeksData,$JumlahDataPerHal");
// berita
$beritaBaru = query("SELECT * FROM berita ORDER BY id DESC LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merienda+One&family=Noto+Serif&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Noto Serif', serif">
  <!-- Header -->
  <?php include('Inc/header.php'); ?>
  <!-- akhir header -->
  <!-- bagian utama -->
  <!-- Kategori Berita -->
  <div style="height: 40px;width: 40px;"></div>
  <div class="container m-auto text-center mt-5">
    <h1 class="fw-bolder">
      <?php echo $kategoriHal ?>
    </h1>
    <hr style="height: 3px;" class="bg-primary w-25 m-auto mb-3">
  </div>
  <!-- akhir kategori -->
  <!-- Bagian Utama -->
  <div class="m-auto container row">
    <!-- Berita -->
    <div class="col-12 col-lg-8">
      <!-- Berita 1 -->
      <?php foreach ($berita as $b): ?>
        <div class="card mb-3 bg-light"
          style="box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;">
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
            <a href="../HalamanDetail/Berita/index.php?id=<?php echo $b['id']; ?>" class="btn btn-primary">Baca Lebih
              Lanjut</a>
          </div>
        </div>
      <?php endforeach; ?>
      <!-- akhir berita 1 -->
      <!-- pagination -->
      <ul class="pagination pagination-sm justify-content-center my-4">
        <?php if ($HalSekarang > 1): ?>
          <li class="page-item">
            <a class="page-link" href="?page=<?= $HalSekarang - 1; ?>&kategori=<?php echo $kategoriHal ?>">Sebelumnya</a>
          </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $JumlahHalaman; $i++): ?>
          <?php if ($i == $HalSekarang): ?>
            <li class="page-item active"><a class="page-link" href="?page=<?= $i ?>&kategori=<?php echo $kategoriHal ?>">
                <?php echo $i; ?>
              </a></li>
          <?php else: ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $i ?>&kategori=<?php echo $kategoriHal ?>">
                <?php echo $i; ?>
              </a></li>
          <?php endif; ?>
        <?php endfor; ?>

        <?php if ($HalSekarang < $JumlahHalaman): ?>
          <li class="page-item">
            <a class="page-link" href="?page=<?= $HalSekarang + 1; ?>&kategori=<?php echo $kategoriHal ?>">Selanjutnya</a>
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
              <li class="list-group-item btn btn-light fs-5 fw-bolder">
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
            <a href="../HalamanDetail/Berita/index.php?id=<?= $baru['id'] ?>" style="text-decoration: none;">
              <li style="height: 45px; overflow: hidden;" class="list-group-item btn btn-light fw-bolder fs-5">
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
</body>

</html>