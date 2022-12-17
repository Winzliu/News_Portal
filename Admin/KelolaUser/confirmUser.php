<?php
session_start();
if (!isset($_SESSION["loginAdmin"]) || !isset($_SESSION['idAdmin'])) {
  header("Location: ../login");
}
require '../../koneksi.php';
$id = $_GET['id'];
$namaUser = query("SELECT * FROM user WHERE id = $id")[0];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Hapus User</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap.css">
  <!-- fontstyle -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merienda+One&family=Noto+Serif&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Noto serif', serif">
  <!-- Modal -->
  <div class="d-flex bg-dark bg-opacity-50 position-absolute top-0 bottom-0 start-0 end-0">
    <div class="card m-auto" style="width: 32rem;">
      <div class="card-body">
        <h2 class="card-title text-center">Hapus User</h2>
        <hr>
        <h4 class="card-subtitle my-5 text-center">Yakin Ingin Menghapus User "<?= $namaUser['username'] ?>" ?
        </h4>
        <div class="text-center">
          <a href="index.php" class="btn btn-secondary me-5 fs-4">Batal</a>
          <a href="hapusUser.php?id=<?php echo $id; ?>" class="btn btn-danger fs-4">Hapus</a>
        </div>
      </div>
    </div>
  </div>
  <script src="../bootstrap.bundle.js"></script>

  <!-- jquery -->
  <script src="../jquery-3.6.0.min.js"></script>
  <script src="script.js"></script>
</body>

</html>