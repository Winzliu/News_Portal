<?php
session_start();
// koneksi ke database
include '../koneksi.php';
// user
$idUser = $_SESSION["id"];
$users = mysqli_query($conn, "SELECT * FROM user WHERE id = '$idUser'");
$user = mysqli_fetch_assoc($users);
if (!isset($_SESSION["login"]) || !isset($user["id"])) {
  header("Location: ../logout.php");
}
$kategori = query("SELECT * FROM kategori");

$id = $_SESSION["id"];



$user = query("SELECT * FROM user WHERE id = $id");
$email = $user[0]["email"];
$username = $user[0]["username"];
$gambar = $user[0]["gambar"];

if (isset($_POST["submit"])) {
  // cek apakah data berhasil di edit atau tidak
  if (edit($_POST, $id) > 0) {
    $_SESSION['edit'] = true;
  }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Edit User</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../HalamanUtama/bootstrap.css" />
  <!-- fontstyle -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merienda+One&family=Noto+Serif&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Noto Serif', serif">
  <?php include('Inc/header.php') ?>
  <div class="container my-5 m-auto text-center">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="row">
        <!-- gambar lama -->
        <div class="col-5 mt-3">
          <input type="hidden" name="gambarLama" id="gambarLama" value="<?php echo $gambar ?>">
          <!-- akhir gambar lama -->
          <!-- gambar -->
          <img class="rounded-4 border border-5 border-light shadow-lg" width="200px" height="200px"
            style="object-fit: cover;" src="../HalamanUtama/img/img-user/<?php echo $gambar; ?>" alt="">
          <!-- akhir gambar -->
          <!-- hapus gambar -->
          <a style="width: 200px;" href="confirmGambar.php?id=<?= $id ?>"
            class="btn btn-danger d-block m-auto mb-5 mt-5">Hapus Gambar</a>
          <!-- akhir hapus gambar -->
        </div>
        <!-- file input -->
        <div class="col-7">
          <!-- file username -->
          <h4 class=" text-start fs-5 fw-bolder m-auto" style="max-width: 600px;">Ubah Username :</h4>
          <div class="input-group my-4">
            <input style="max-width: 600px;" name="username" type="text" class="form-control m-auto" required
              value="<?php echo $username; ?>" oninvalid="this.setCustomValidity('Nama Tidak Boleh Kosong')">
          </div>
          <!-- akhir file username -->
          <!-- file email -->
          <h4 class="text-start fs-5 fw-bolder m-auto" style="max-width: 600px;">Ubah Email :</h4>
          <div class="input-group my-4">
            <input style="max-width: 600px;" name="email" type="email" class="form-control m-auto" required
              oninvalid="this.setCustomValidity('Email Tidak Boleh Kosong & Email Harus Diisi Sesuai Kriteria &#34; email@email.com &#34;')"
              value="<?php echo $email; ?>">
          </div>
          <!-- akhir file email -->
          <!-- file gambar -->
          <h4 class="text-start fs-5 fw-bolder m-auto" style="max-width: 600px;">Ubah Gambar :</h4>
          <div class="input-group my-4">
            <input style="max-width: 600px;" type="file" name="gambar" class="form-control m-auto">
          </div>
          <!-- akhir file gambar -->
        </div>
      </div>
      <!-- submit -->
      <a href="../HalamanUtama/" class="btn btn-secondary fs-5 me-5">Batal</a>
      <button type="submit" name="submit" class="btn btn-primary fs-5">Ubah</button>
      <!-- akhir submit -->
    </form>
  </div>
  <?php include('Inc/footer.php') ?>
  <!-- bootstrap -->
  <script src="../HalamanUtama/bootstrap.bundle.js"></script>
  <!-- script-ion-icons -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <!-- jquery -->
  <script src="../HalamanUtama/jquery-3.6.0.min.js"></script>

  <!-- my js -->
  <script src="../HalamanUtama/header.js"></script>
  <script src="search/script.js"></script>

  <!-- sweetalert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
    di dalam session sukses  -->
  <?php if (isset($_POST['submit'])): ?>
    <?php if (isset($_SESSION['edit'])): ?>
      <script>
        swal("Berhasil Mengubah Data", "", "success");
        setTimeout(function () {
          document.location = "../HalamanUtama/";
        }, 2500)
      </script>
      <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
      <?php unset($_SESSION['edit']); ?>
      <?php else: ?>
      <script>
        swal("Gagal Mengubah Data", "", "error");
      </script>
      <?php unset($_SESSION[' edit ']); ?>
      <?php endif; ?>
    <?php endif; ?>
</body>

</html>