<?php
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: ../login");
}
// koneksi ke database
include '../koneksi.php';
$kategori = query("SELECT * FROM kategori");

$id = $_SESSION["id"];



$user = query("SELECT * FROM user WHERE id = $id");
$email = $user[0]["email"];
$username = $user[0]["username"];
$password = $user[0]["password"];
$gambar = $user[0]["gambar"];

if (isset($_POST["submit"])) {
  // cek apakah data berhasil di edit atau tidak
  if (edit($_POST, $id) > 0) {
    $_SESSION['edit'] = true;
  }
}

if (isset($_POST["hapusGambar"])) {
  // cek apakah data berhasil di edit atau tidak
  if (hapusGambar($_POST, $id) > 0) {
    $_SESSION['hapusGambar'] = true;
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
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
      <!-- gambar lama -->
      <input type="hidden" name="gambarLama" id="gambarLama" value="<?php echo $user[0]["gambar"] ?>">
      <!-- akhir gambar lama -->
      <!-- gambar -->
      <img class="rounded-4 border border-5 border-light shadow-lg" width="200px" height="200px"
        style="object-fit: cover;" src="../HalamanUtama/img/img-user/<?php echo $gambar; ?>" alt="">
      <!-- akhir gambar -->
      <!-- hapus gambar -->
      <button type="submit" name="hapusGambar" class="btn btn-primary d-block m-auto mb-3 mt-5">Hapus Gambar</button>
      <!-- akhir hapus gambar -->
      <!-- file gambar -->
      <h4 class="text-start fs-5 fw-bolder m-auto" style="max-width: 600px;">Ubah Gambar :</h4>
      <div class="input-group my-4">
        <input style="max-width: 600px;" type="file" name="gambar" class="form-control m-auto">
      </div>
      <!-- akhir file gambar -->
      <!-- file email -->
      <h4 class="text-start fs-5 fw-bolder m-auto" style="max-width: 600px;">Ubah Email :</h4>
      <div class="input-group my-4">
        <input style="max-width: 600px;" name="email" type="email" class="form-control m-auto" required
          value="<?php echo $email; ?>">
      </div>
      <!-- akhir file email -->
      <!-- file username -->
      <h4 class=" text-start fs-5 fw-bolder m-auto" style="max-width: 600px;">Ubah Username :</h4>
      <div class="input-group my-4">
        <input style="max-width: 600px;" name="username" type="text" class="form-control m-auto" required
          value="<?php echo $username; ?>">
      </div>
      <!-- akhir file username -->
      <!-- file password -->
      <h4 class="text-start fs-5 fw-bolder m-auto" style="max-width: 600px;">Ubah Password :</h4>
      <div class="input-group my-4">
        <input minlength="8" style="max-width: 600px;" name="password" type="password" class="form-control m-auto"
          id="password" required value="<?php echo $password; ?>">
      </div>
      <input onclick="showPassword()" class="mb-4" type="checkbox" name="showPass" id="showPass">
      <label for="showPass">Lihat Password</label>
      <p class="fst-italic text-danger ">Password Panjang Dikarenakan Password Tersimpan Secara Enkripsi</p>
      <!-- akhir file password -->
      <!-- submit -->
      <button type="submit" name="submit" class="btn btn-primary fs-5">Ubah</button>
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
    setTimeout(function () {
      document.location = "../HalamanUtama/";
    }, 2500)
      <?php unset($_SESSION[' edit ']); ?>
  </script>
  <?php endif; ?>
  <?php endif; ?>

  <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
    di dalam session sukses  -->
  <?php if (isset($_POST['hapusGambar'])): ?>
  <?php if (isset($_SESSION['hapusGambar'])): ?>
  <script>
      swal("Berhasil Menghapus Gambar", "", "success");
    setTimeout(function () {
      document.location = "../HalamanUtama/";
    }, 2500)
  </script>
  <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['hapusGambar']); ?>
  <?php else: ?>
  <script>
    swal("Gagal Menghapus Gambar", "", "error");
    setTimeout(function () {
      document.location = "./HalamanUtama/";
    }, 2500)
      <?php unset($_SESSION[' edit ']); ?>
  </script>
  <?php endif; ?>
  <?php endif; ?>

  <!-- show password -->
  <script>
      function showPassword() {
        let password = document.getElementById('password');
        if (password.getAttribute("type") === 'password') {
          password.setAttribute("type", "text")
        } else {
          password.setAttribute("type", "password")
        }
      }
  </script>
</body>

</html>