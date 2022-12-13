<?php
session_start();
if (!isset($_SESSION["login"]) || !isset($_SESSION["id"])) {
  header("Location: ../login");
}
require '../koneksi.php';
// kategori
$kategori = query("SELECT * FROM kategori");
// user
$idUser = $_SESSION["id"];
$users = mysqli_query($conn, "SELECT * FROM user WHERE id = '$idUser'");
$user = mysqli_fetch_assoc($users);
// berita
$idBerita = $_GET['id'];
$berita = mysqli_query($conn, "SELECT * FROM berita WHERE id = '$idBerita'");
$b = mysqli_fetch_assoc($berita);
// berita pada carousel
$beritaBaru = query("SELECT * FROM berita ORDER BY id DESC LIMIT 6");
// komentar
$komens = mysqli_query($conn, "SELECT * FROM komentar WHERE idBerita = '$idBerita'");

if (isset($_POST['submitKomentar'])) {
  if (komentar($_POST) > 0) {
    $_SESSION['submitKomentar'] = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>ToSee News</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../HalamanUtama/bootstrap.css" />
  <!-- fontstyle -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merienda+One&family=Noto+Serif&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Noto Serif', serif">
  <!-- header -->
  <?php include('../HalamanUtama/Inc/header.php'); ?>
  <!-- akhir header -->

  <!-- cocokan dengan navbar(phone) -->
  <div class="d-block" style="height: 100px;width: 40px;"></div>
  <!-- akhri cocokan dengan navbar(phone) -->
  <!-- bagian utama -->
  <div class="m-auto container row">
    <!-- card berita -->
    <div class="card col-12 col-lg-8 mb-5">
      <!-- judul -->
      <div class="ms-3 mt-3">
        <h2>
          <?php echo $b['judul']; ?>
        </h2>
        <!-- badge -->
        <a style="text-decoration: none;" href="../HalamanUtama/kategori.php?kategori=<?php echo $b['kategori']; ?>"
          class="badge p-2 text-bg-dark my-3">
          <?php echo $b['kategori']; ?>
        </a>
        <!-- Tanggal & Posted by -->
        <h6>Dipublikasi oleh <strong>
            <?php echo $b['oleh']; ?>
          </strong> pada <strong>
            <?php echo $b['tanggal']; ?>
          </strong></h6>
      </div>
      <hr style="background-color: black;height: 2px;">
      <!-- akhir judul -->
      <!-- gambar -->
      <img width="100%" height="450px" style="object-fit: cover;"
        src="../HalamanUtama/img/img-berita/<?php echo $b['gambar']; ?>" class="card-img-top card-img-bottom "
        alt="...">
      <!-- akhir gambar -->
      <!-- isi berita -->
      <div class="card-body mb-5">
        <div class="card-text">
          <?php echo $b['berita']; ?>
        </div>
      </div>
      <!-- akhir isi berita -->
      <!-- rekaman komentar -->
      <div class="card">
        <div class="card-header mb-2">
          Komentar
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">
            <div class="row">
              <?php foreach ($komens as $komen): ?>
              <?php if ($komen['status'] == 1): ?>
              <div class="col-12 col-lg-1">
                <!-- gambar -->
                <img height="50px" width="50px" style="object-fit: cover;" class="rounded-circle"
                  src="../HalamanUtama/img/img-user/<?php echo $komen['gambar'] ?>" alt="">
              </div>
              <div class="col-12 col-lg-10 ms-0 ms-lg-2">
                <!-- username -->
                <h5 class="fw-bolder">
                  <?php echo $komen['username']; ?>
                </h5>
                <!-- tanggal -->
                <strong>
                  <p>
                    <?= $komen['tanggalPost'] ?>
                  </p>
                </strong>
                <!-- komentar -->
                <p>
                  <?php echo $komen['komentar']; ?>
                </p>
              </div>
              <?php else: ?>
              <div></div>
              <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </li>
        </ul>
      </div>
      <!-- akhir rekaman komentar -->
      <!-- komentar -->
      <p class="mt-4 ms-2 fs-5 fw-bolder ms-3">Isi Komentar : </p>
      <form action="" method="post">
        <input type="hidden" name="username" id="username" value="<?= $user['username'] ?>">
        <input type="hidden" name="idUser" id="idUser" value="<?= $idUser ?>">
        <input type="hidden" name="gambar" id="gambar" value="<?= $user['gambar'] ?>">
        <input type="hidden" name="idBerita" id="idBerita" value="<?= $idBerita ?>">
        <div class="form-floating mb-3">
          <textarea name="komentar" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
            style="height: 200px"></textarea>
          <label for="floatingTextarea2">Masukkan Komentar Anda : </label>
          <button type="submit" name="submitKomentar" class="btn btn-primary mt-3 mb-4 px-5 py-2 ms-3">Kirim</button>
        </div>
      </form>
      <!-- akhir komentar -->
    </div>
    <!-- akhir card berita -->

    <!-- side bar -->
    <div class="col-12 col-lg-4">
      <!-- side bar kategori -->
      <div class="card m-auto mb-5" style="width: 100%;">
        <div class="card-header fs-3 fw-bolder text-center">
          Kategori
        </div>
        <ul class="list-group list-group-flush">
          <?php foreach ($kategori as $row): ?>
          <a href="../HalamanUtama/kategori.php?kategori=<?php echo $row["namaKategori"]; ?>"
            style="text-decoration: none;">
            <li style="height: 45px; overflow: hidden;" class="list-group-item btn btn-light fs-5 fw-bolder">
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
  <?php include('../HalamanUtama/Inc/footer.php'); ?>
  <!-- akhir footer -->

  <!-- bootstrap -->
  <script src="../HalamanUtama/bootstrap.bundle.js"></script>
  <!-- script-ion-icons -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <!-- jquery -->
  <script src="../HalamanUtama/jquery-3.6.0.min.js"></script>
  <script src="search/script.js"></script>

  <!-- my js -->
  <script src="../HalamanUtama/header.js"></script>

  <!-- sweetalert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
    di dalam session sukses  -->
  <?php if (isset($_SESSION['submitKomentar'])): ?>
  <?php if ($_SESSION['submitKomentar'] == true): ?>
  <script>
    swal("Komentar Berhasil Ditambahkan", "Silahkan Menunggu Admin Menyetujui", "success");
  </script>
  <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['submitKomentar']); ?>
  <?php else: ?>
  <script>
    swal("Komentar Gagal Ditambahkan", "", "error");
  </script>
  <?php unset($_SESSION['submitKomentar']); ?>
  <?php endif; ?>
  <?php endif; ?>
</body>

</html>