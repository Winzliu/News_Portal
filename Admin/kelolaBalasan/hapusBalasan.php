<?php
session_start();
if (!isset($_SESSION["loginAdmin"]) || !isset($_SESSION['idAdmin'])) {
  header("Location: ../login");
}
$id = $_GET["id"];

require "../../koneksi.php";

$hapus = mysqli_query($conn, "DELETE FROM balasan WHERE id = $id");

if (mysqli_affected_rows($conn) > 0) {
  $_SESSION["hapus"] = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <!-- sweetalert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
    di dalam session sukses  -->
  <?php if (isset($_SESSION['hapus'])): ?>
  <script>
    swal("Balasan Berhasil Dihapus", "", "success");
    setTimeout(function () {
      document.location = "index.php";
    }, 2500)
  </script>
  <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['hapus']); ?>
  <?php else: ?>
  <script>
    swal("Balasan Gagal Dihapus", "", "error");
    setTimeout(function () {
      document.location = "index.php";
    }, 2500)
  </script>
  <?php unset($_SESSION['hapus']); ?>
  <?php endif; ?>
</body>

</html>