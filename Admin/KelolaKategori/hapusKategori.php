<?php
session_start();
if (!isset($_SESSION["loginAdmin"]) || !isset($_SESSION['idAdmin'])) {
  header("Location: ../login");
}
$id = $_GET["id"];

require "../../koneksi.php";
$kategoris = mysqli_query($conn, "SELECT namaKategori FROM kategori WHERE id = $id");
$kategori = mysqli_fetch_assoc($kategoris)['namaKategori'];

$beritas = query("SELECT * FROM berita WHERE kategori = '$kategori'");

if (!empty($beritas)) {
  foreach ($beritas as $berita) {
    mysqli_query($conn, "DELETE FROM balasan WHERE idBerita = $berita[id]");
    mysqli_query($conn, "DELETE FROM komentar WHERE idBerita = $berita[id]");
  }

}

mysqli_query($conn, "DELETE FROM berita WHERE kategori = '$kategori'");
$hapus = mysqli_query($conn, "DELETE FROM kategori WHERE id = $id");

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
      swal("Kategori Berhasil Dihapus", "", "success");
      setTimeout(function () {
        document.location = "index.php";
      }, 2500)
    </script>
    <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
    <?php unset($_SESSION['hapus']); ?>
    <?php else: ?>
    <script>
      swal("Kategori Gagal Dihapus", "", "error");
      setTimeout(function () {
        document.location = "index.php";
      }, 2500)
    </script>
    <?php unset($_SESSION['hapus']); ?>
    <?php endif; ?>
</body>

</html>