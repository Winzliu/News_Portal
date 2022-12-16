<?php
session_start();
if (!isset($_SESSION["loginAdmin"]) || !isset($_SESSION['idAdmin'])) {
  header("Location: ../login");
}
// koneksi ke database
require '../../koneksi.php';
$idAdmin = $_SESSION["idAdmin"];
$namas = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$idAdmin'");
$nama = mysqli_fetch_assoc($namas);

$id = $_GET['id'];

$user = query("SELECT * FROM user WHERE id = $id");
$username = $user[0]["username"];
$email = $user[0]["email"];

if (isset($_POST["submit"])) {
  // cek apakah data berhasil di edit atau tidak
  if (editUser($_POST, $id) > 0) {
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
  <link rel="stylesheet" href="../bootstrap.css" />
  <!-- fontstyle -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merienda+One&family=Noto+Serif&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Noto Serif', serif">
  <?php include('../Inc/header.php') ?>
  <div class="container my-5 m-auto text-center">
    <form action="" method="post">
      <!-- file nama username -->
      <h4 class="text-start fs-5 fw-bolder m-auto" style="max-width: 600px;">Ubah Username :</h4>
      <div class="input-group my-4">
        <input style="max-width: 600px;" name="username" type="text" class="form-control m-auto" required id="Username"
          value="<?php echo $username; ?>" oninvalid="kosong(Username)">
        <p class="text-danger fst-italic fs-6 my-1"></p>
      </div>
      <!-- akhir file username -->
      <!-- file nama email -->
      <h4 class="text-start fs-5 fw-bolder m-auto" style="max-width: 600px;">Ubah Email :</h4>
      <div class="input-group my-4 m-auto" style="max-width: 600px;">
        <input name="email" type="email" class="form-control m-auto w-100" required id="Email"
          value="<?php echo $email; ?>" oninvalid="kosong(Email)">
        <p class="text-danger fst-italic fs-6 my-1"></p>
      </div>
      <!-- akhir file email-->
      <!-- submit -->
      <a href="index.php" class="btn btn-secondary fs-5 me-5">Batal</a>
      <button type="submit" name="submit" class="btn btn-primary fs-5">Ubah</button>
    </form>
  </div>
  <!-- bootstrap -->
  <script src="../bootstrap.bundle.js"></script>

  <!-- form validation -->
  <script>
    let Username = document.getElementById('Username');
    let Email = document.getElementById('Email')
    function kosong(e) {
      if (e == Email) {
        e.nextSibling.nextSibling.innerHTML = e.getAttribute('id') + ' Tidak Boleh Kosong & Email Harus Diisi Sesuai Kriteria &#34 email@email.com &#34';
      } else {
        e.nextSibling.nextSibling.innerHTML = e.getAttribute('id') + ' Tidak Boleh Kosong';
      }
      e.addEventListener('input', function () {
        e.nextSibling.nextSibling.innerHTML = ' ';
      })
    }
  </script>
  <!-- akhir foem validation -->


  <!-- script-ion-icons -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <!-- jquery -->
  <script src="../jquery-3.6.0.min.js"></script>


  <!-- sweetalert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
    di dalam session sukses  -->
  <?php if (isset($_POST['submit'])): ?>
  <?php if (isset($_SESSION['edit'])): ?>
  <script>
    swal("Berhasil Mengubah User", "", "success");
    setTimeout(function () {
      document.location = "index.php";
    }, 2500)
  </script>
  <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['edit']); ?>
  <?php else: ?>
  <script>
    swal("Gagal Mengubah User", "", "error");
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