<?php
session_start();
// koneksi ke database
include '../koneksi.php';
if (!isset($_SESSION["login"]) || !isset($_SESSION["id"])) {
  header("Location: ../logout.php");
}
// user
$idUser = $_SESSION["id"];
$users = mysqli_query($conn, "SELECT * FROM user WHERE id = '$idUser'");
$user = mysqli_fetch_assoc($users);
$kategori = query("SELECT * FROM kategori");

$id = $_SESSION["id"];

$user = query("SELECT * FROM user WHERE id = $id");
$password = $user[0]["password"];

if (isset($_POST["submit"])) {
  // cek apakah data berhasil di edit atau tidak
  if (editPass($_POST, $id) > 0) {
    $_SESSION['editPass'] = true;
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Ubah Password</title>
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
    <form action="" method="post">
      <!-- konfirmasi password lama -->
      <h4 class="text-start fs-5 fw-bolder m-auto" style="max-width: 600px;">Password Lama :</h4>
      <div class="input-group my-4 position-relative m-auto" style="max-width: 600px;">
        <input minlength="8" style="max-width: 600px;" name="passwordLama" type="password"
          class="form-control m-auto rounded-end" id="passwordLama" required placeholder="Masukkan Password"
          oninvalid="this.setCustomValidity('Password Harus Berisi Minimal 8 Karakter')"
          oninput="this.setCustomValidity('')">
        <button onclick="showPasswordLama()" type="button"
          class="btn bg-white border border-start-0 position-absolute end-0 top-0 bottom-0"
          style="z-index: 99;"><ion-icon name="eye-outline" id="iconLama"></ion-icon></button>
      </div>
      <!-- akhir konfirmasi password lama -->

      <!-- password baru -->
      <h4 class="text-start fs-5 fw-bolder m-auto" style="max-width: 600px;">Password baru :</h4>
      <div class="input-group my-4 position-relative m-auto" style="max-width: 600px;">
        <input minlength="8" style="max-width: 600px;" name="passwordBaru" type="password"
          placeholder="Masukkan Password Baru" class="form-control m-auto rounded-end" id="passwordBaru" required
          oninvalid="this.setCustomValidity('Password Harus Berisi Minimal 8 Karakter')"
          oninput="this.setCustomValidity('')">
        <button onclick="showPasswordBaru()" type="button"
          class="btn bg-white border border-start-0 position-absolute end-0 top-0 bottom-0"
          style="z-index: 99;"><ion-icon name="eye-outline" id="iconBaru"></ion-icon></button>
      </div>
      <!-- akhir password baru -->

      <!-- konfirmasi password baru -->
      <h4 class="text-start fs-5 fw-bolder m-auto" style="max-width: 600px;">Konfirmasi Password Baru :</h4>
      <div class="input-group my-4 position-relative m-auto" style="max-width: 600px;">
        <input minlength="8" style="max-width: 600px;" name="passwordKonfirmasi" type="password"
          placeholder="Konfirmasi Password Baru" class="form-control m-auto rounded-end" id="passwordKonfirmasi"
          required oninvalid="this.setCustomValidity('Password Harus Berisi Minimal 8 Karakter')"
          oninput="this.setCustomValidity('')">
        <button onclick="showPasswordKonfirmasi()" type="button"
          class="btn bg-white border border-start-0 position-absolute end-0 top-0 bottom-0"
          style="z-index: 99;"><ion-icon name="eye-outline" id="iconKonfirmasi"></ion-icon></button>
      </div>
      <!-- akhir konfirmasi pasword baru -->
      <!-- submit -->
      <a href="../HalamanUtama/" class="btn btn-secondary fs-5 me-5">Batal</a>
      <button type="submit" name="submit" class="btn btn-primary fs-5">Ubah Password</button>
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
    <?php if (isset($_SESSION['editPass'])): ?>
      <script>
        swal("Berhasil Mengubah Password", "", "success");
        setTimeout(function () {
          document.location = "../HalamanUtama/";
        }, 2500)
      </script>
      <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
      <?php unset($_SESSION['editPass']); ?>
    <?php else: ?>
      <script>
        swal("Gagal Mengubah Password", "", "error");
      </script>
      <?php unset($_SESSION['editPass']); ?>
    <?php endif; ?>
  <?php endif; ?>


  <!-- showpassword -->
  <script>
    function showPasswordLama() {
      let icon = document.getElementById('iconLama');
      let password = document.getElementById('passwordLama');
      if (password.getAttribute("type") === 'password') {
        password.setAttribute("type", "text")
        icon.setAttribute("name", "eye-off-outline")
      } else {
        password.setAttribute("type", "password")
        icon.setAttribute("name", "eye-outline")
      }
    }
  </script>
  <script>
    function showPasswordBaru() {
      let icon = document.getElementById('iconBaru');
      let password = document.getElementById('passwordBaru');
      if (password.getAttribute("type") === 'password') {
        password.setAttribute("type", "text")
        icon.setAttribute("name", "eye-off-outline")
      } else {
        password.setAttribute("type", "password")
        icon.setAttribute("name", "eye-outline")
      }
    }
  </script>
  <script>
    function showPasswordKonfirmasi() {
      let icon = document.getElementById('iconKonfirmasi');
      let password = document.getElementById('passwordKonfirmasi');
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