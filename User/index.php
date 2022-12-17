<?php
session_start();
// koneksi ke database
include '../koneksi.php';
// user
$idUser = $_SESSION["id"];
$users = mysqli_query($conn, "SELECT * FROM user WHERE id = '$idUser'");
$user = mysqli_fetch_assoc($users);
if (!isset($_SESSION["login"]) || !isset($user["id"])) {
  header("Location: ../login");
}
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
          oninvalid="this.setCustomValidity('Email Tidak Boleh Kosong & Email Harus Diisi Sesuai Kriteria &#34; email@email.com &#34;')"
          value="<?php echo $email; ?>">
      </div>
      <!-- akhir file email -->
      <!-- file username -->
      <h4 class=" text-start fs-5 fw-bolder m-auto" style="max-width: 600px;">Ubah Username :</h4>
      <div class="input-group my-4">
        <input style="max-width: 600px;" name="username" type="text" class="form-control m-auto" required
          value="<?php echo $username; ?>" oninvalid="this.setCustomValidity('Nama Tidak Boleh Kosong')">
      </div>
      <!-- akhir file username -->
      <!-- file password -->
      <h4 class="text-start fs-5 fw-bolder m-auto" style="max-width: 600px;">Ubah Password :</h4>
      <div class="input-group my-4 position-relative m-auto" style="max-width: 600px;">
        <input minlength="8" style="max-width: 600px;" name="password" type="password"
          class="form-control m-auto rounded-end" id="password" required value="<?php echo $password; ?>"
          oninvalid="this.setCustomValidity('Password Harus Berisi Minimal 8 Karakter')"
          oninput="this.setCustomValidity('')">
        <button onclick="showPassword()" type="button"
          class="btn bg-white border border-start-0 position-absolute end-0" style="z-index: 99;"><ion-icon
            name="eye-outline" id="icon"></ion-icon></button>
      </div>
      <p class="fst-italic text-danger ">Password Panjang Dikarenakan Password Tersimpan Secara Enkripsi</p>
      <!-- akhir file password -->
      <!-- submit -->
      <a href="../HalamanUtama/" class="btn btn-secondary fs-5 me-5">Batal</a>
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
      <?php unset($_SESSION[' edit ']); ?>
  </script>
  <?php endif; ?>
  <?php endif; ?>


  <!-- showpassword -->
  <script>
      function showPassword() {
        let icon = document.getElementById('icon');
        let password = document.getElementById('password');
        if (password.getAttribute("type") === 'password') {
          password.setAttribute("type", "text")
          icon.setAttribute("name", "eye-off-outline")
        } else {
          password.setAttribute("type", "password")
          icon.setAttribute("name", "eye-outline")
        }
      }
  </script>
</body>

</html>