<?php
session_start();
if (!isset($_SESSION["loginAdmin"]) || !isset($_SESSION['idAdmin'])) {
  header("Location: ../login");
}
require '../../koneksi.php';
$idAdmin = $_SESSION["idAdmin"];
$namas = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$idAdmin'");
$nama = mysqli_fetch_assoc($namas);

if (isset($_POST["tambahuser"])) {
  if (registrasi($_POST) > 0) {
    $_SESSION["tambahuser"] = true;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah User</title>
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
      <span class="navbar-text fs-4">Tambah User</span>

      <ul class="breadcrumb fs-5 d-none d-md-flex">
        <li class="breadcrumb-item"><a href="../Dashboard">Beranda</a></li>
        <li class="breadcrumb-item"><a href="../KelolaUser">Kelola User</a></li>
        <li class="breadcrumb-item active">Tambah User</li>
      </ul>
    </div>
  </nav>
  <!-- Form -->
  <form action="" method="post" class="ms-2">
    <section class="fs-5">
      <ul class="list-group container">
        <li class="list-group-item bg-light fw-bolder fs-3 text-center" aria-current="true">Tambah User</li>
        <li class="list-group-item">
          <div class="my-3 ms-4" style="max-width: 800px;">
            <label for="email" class="form-label">Email</label>
            <input name="email" autocomplete="off" type="email" class="form-control fs-6" id="email" required>
          </div>
          <div class="my-3 ms-4" style="max-width: 800px;">
            <label for="username" class="form-label">Username</label>
            <input name="username" autocomplete="off" type="text" class="form-control fs-6" id="username" required>
          </div>
          <div class="my-3 ms-4" style="max-width: 800px;">
            <label for="password" class="form-label">Password</label>
            <div class=" position-relative m-auto" style="max-width: 800px;">
              <input minlength="8" style="max-width: 800px;" name="password" type="password"
                class="form-control m-auto rounded-end" id="password" required>
              <button onclick="showPassword()" type="button"
                class="btn bg-white border border-start-0 position-absolute top-0 rounded-0 rounded-end end-0"><ion-icon
                  name="eye-outline" id="icon"></ion-icon></button>
            </div>
          </div>
          <div class="my-3 ms-4" style="max-width: 800px;">
            <label for="password2" class="form-label">Konfirmasi Password</label>
            <div class=" position-relative m-auto" style="max-width: 800px;">
              <input minlength="8" style="max-width: 800px;" name="password2" type="password"
                class="form-control m-auto rounded-end" id="password2" required>
              <button onclick="showPassword2()" type="button"
                class="btn bg-white border border-start-0 position-absolute top-0 rounded-0 rounded-end end-0"><ion-icon
                  name="eye-outline" id="icon2"></ion-icon></button>
            </div>
          </div>
          <button name="tambahuser" class="btn btn-primary ms-5 my-4" type="submit">Tambah</button>
        </li>
      </ul>
    </section>
  </form>
  <!-- bootstrap -->
  <script src="../bootstrap.bundle.js"></script>

  <!-- sweetalert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- script-ion-icons -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

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
  <!-- show konfirmasi password -->
  <script>
    function showPassword2() {
      let icon = document.getElementById('icon2');
      let password = document.getElementById('password2');
      if (password.getAttribute("type") === 'password') {
        password.setAttribute("type", "text")
        icon.setAttribute("name", "eye-off-outline")
      } else {
        password.setAttribute("type", "password")
        icon.setAttribute("name", "eye-outline")
      }
    }
  </script>

  <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
  di dalam session sukses  -->
  <?php if (isset($_POST['tambahuser'])): ?>
  <?php if (isset($_SESSION['tambahuser'])): ?>
  <script>
    swal("Berhasil Menambahkan User", "", "success");
    setTimeout(function () {
      document.location = "./";
    }, 2500)
  </script>
  <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['tambahuser']); ?>
  <?php else: ?>
  <script>
    swal("Gagal Menambahkan User", "", "error");
  </script>
  <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['tambahuser']); ?>
  <?php endif; ?>
  <?php endif; ?>
</body>

</html>