<?php
session_start();
if (!isset($_SESSION["loginAdmin"])) {
  header("Location: ../login");
}
require '../../koneksi.php';
$idAdmin = $_SESSION["idAdmin"];
$namas = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$idAdmin'");
$nama = mysqli_fetch_assoc($namas);

if (isset($_POST["tambahkategori"])) {
  if (tambahkategori($_POST) > 0) {
    $_SESSION["tambahkategori"] = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Kategori</title>
  <!-- bootstrap -->
  <link rel="stylesheet" href="../bootstrap.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merienda+One&family=Noto+Serif&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Noto Serif', serif">
  <?php include("../Inc/header.php") ?>
  <nav class="navbar navbar-expand-sm navbar-light">
    <div class="container">
      <span class="navbar-text fs-4">Tambah Kategori</span>

      <ul class="breadcrumb fs-5 d-none d-md-flex">
        <li class="breadcrumb-item"><a href="../Dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="../KelolaKategori">Kelola Kategori</a></li>
        <li class="breadcrumb-item active">Tambah Kategori</li>
      </ul>
    </div>
  </nav>
  <!-- Form -->
  <form action="" method="post" class="ms-2">
    <section class="fs-5">
      <ul class="list-group container">
        <li class="list-group-item bg-light fw-bolder fs-3  text-center" aria-current="true">Tambah kategori</li>
        <li class="list-group-item">
          <div class="my-3 ms-4" style="max-width: 800px;">
            <label for="namaKategori" class="form-label">Nama Kategori</label>
            <input name="namaKategori" autocomplete="off" type="text" class="form-control fs-6" id="namaKategori"
              required>
          </div>
          <button name="tambahkategori" class="btn btn-primary ms-5 my-4" type="submit">Tambah</button>
        </li>
      </ul>
    </section>
  </form>
  <!-- bootstrap -->
  <script src="../bootstrap.bundle.js"></script>

  <!-- sweetalert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
  di dalam session sukses  -->
  <?php if (isset($_POST['tambahkategori'])): ?>
  <?php if (isset($_SESSION['tambahkategori'])): ?>
  <script>
    swal("Berhasil Menambahkan Kategori", "", "success");
    setTimeout(function () {
      document.location = "./";
    }, 2500)
  </script>
  <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['tambahkategori']); ?>
  <?php else: ?>
  <script>
    swal("Gagal Menambahkan Kategori", "", "error");
    setTimeout(function () {
      document.location = "./";
    }, 2500)
  </script>
  <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['tambahkategori']); ?>
  <?php endif; ?>
  <?php endif; ?>
</body>

</html>