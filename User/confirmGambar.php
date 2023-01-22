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
$id = $_GET['id'];
$user = query("SELECT * FROM user WHERE id = $id");

if (isset($_POST["hapus"])) {
  // cek apakah data berhasil di edit atau tidak
  if (hapusGambar($_POST, $id) > 0) {
    $_SESSION['hapusGambar'] = true;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Hapus Gambar</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../HalamanUtama/bootstrap.css">
  <!-- fontstyle -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merienda+One&family=Noto+Serif&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Noto serif', serif">
  <!-- Modal -->
  <div class="d-flex bg-dark bg-opacity-50 position-absolute top-0 bottom-0 start-0 end-0">
    <div class="card m-auto" style="width: 32rem;height: 18rem;">
      <div class="card-body">
        <h2 class="card-title text-center">Hapus Gambar</h2>
        <hr>
        <h4 class="card-subtitle my-5 text-center">Yakin Ingin Menghapus Gambar?
        </h4>
        <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="gambarLama" id="gambarLama" value="<?php echo $user[0]["gambar"] ?>">
          <input type="hidden" name="email" id="email" value="<?php echo $user[0]["email"] ?>">
          <input type="hidden" name="username" id="username" value="<?php echo $user[0]["username"] ?>">
          <input type="hidden" name="password" id="password" value="<?php echo $user[0]["password"] ?>">
          <div class="text-center">
            <a href="index.php" class="btn btn-secondary me-5 fs-4">Batal</a>
            <button type="submit" name="hapus" class="btn btn-danger me-5 fs-4">Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="../HalamanUtama/bootstrap.bundle.js"></script>

  <!-- sweetalert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
    di dalam session sukses  -->
  <?php if (isset($_POST['hapus'])): ?>
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
          document.location = "../HalamanUtama/";
        }, 2500)
          <?php unset($_SESSION[' edit ']); ?>
      </script>
    <?php endif; ?>
  <?php endif; ?>

</body>

</html>