<?php
session_start();
if (!isset($_SESSION["loginAdmin"]) || !isset($_SESSION['idAdmin'])) {
  header("Location: ../login");
}
require '../../koneksi.php';
$idAdmin = $_SESSION["idAdmin"];
$namas = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$idAdmin'");
$nama = mysqli_fetch_assoc($namas);


// pagination
$JumlahDataPerHal = 5;
$JumlahData = count(query("SELECT * FROM user"));
$JumlahHalaman = ceil($JumlahData / $JumlahDataPerHal);

$HalSekarang = (isset($_GET["page"])) ? $_GET["page"] : 1;


$IndeksData = ($HalSekarang * $JumlahDataPerHal) - $JumlahDataPerHal;


$user = query("SELECT * FROM user LIMIT $IndeksData,$JumlahDataPerHal");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola User</title>
  <link rel="stylesheet" href="../bootstrap.css">
  <!-- fontstyle -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merienda+One&family=Noto+Serif&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Noto serif', serif">
  <?php include("../Inc/header.php") ?>
  <nav class="navbar navbar-expand-sm navbar-light">
    <div class="container">
      <span class="navbar-text fs-4">Kelola User</span>

      <ul class="breadcrumb fs-5 d-none d-md-flex">
        <li class="breadcrumb-item"><a href="../Dashboard">Beranda</a></li>
        <li class="breadcrumb-item active">Kelola User</li>
      </ul>
    </div>
  </nav>

  <div class="container mt-5 fs-5">
    <div class="row">
      <div class="col">
        <a href="tambahUser.php" type="button" class="btn btn-success mb-3 fs-5">Tambah +</a>
      </div>
      <div class="col">
        <input autocomplete="off" type="search" class="form-control fs-5" id="search" placeholder="search"
          name="search">
      </div>
      <table id="container" class="table table-striped table-bordered">
        <thead>
          <tr class="text-center">
            <th class="text-center">#</th>
            <th class="text-center">Username</th>
            <th class="d-none d-md-table-cell text-center">Email</th>
            <th colspan="2" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1 ?>
          <?php foreach ($user as $u): ?>
          <tr>
            <th scope="row" class="text-center">
              <?php echo $i + ($HalSekarang - 1) * $JumlahDataPerHal; ?>
            </th>
            <td>
              <?php echo $u["username"]; ?>
            </td>
            <td class="d-none d-md-table-cell">
              <?php echo $u["email"]; ?>
            </td>
            <td class="text-center">
              <a href="editUser.php?id=<?php echo $u["id"]; ?>" class="btn btn-success py-1 ps-2 pe-1 opacity-75">
                <ion-icon name="create" class="fs-5"></ion-icon>
              </a>
            </td>
            <td class="text-center">
              <a href="confirmUser.php?id=<?php echo $u["id"]; ?>" class="btn btn-danger py-1 px-2 opacity-75">
                <ion-icon name="trash" class="fs-5"></ion-icon>
              </a>
            </td>
          </tr>
          <?php $i++ ?>
          <?php endforeach; ?>
        </tbody>
      </table>
      <ul class="pagination pagination-sm justify-content-end">
        <?php if ($HalSekarang > 1): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $HalSekarang - 1; ?>">Sebelumnya</a>
        </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $JumlahHalaman; $i++): ?>
        <?php if ($i == $HalSekarang): ?>
        <li class="page-item active"><a class="page-link" href="?page=<?= $i ?>">
            <?php echo $i; ?>
          </a></li>
        <?php else: ?>
        <li class="page-item"><a class="page-link" href="?page=<?= $i ?>">
            <?php echo $i; ?>
          </a></li>
        <?php endif; ?>
        <?php endfor; ?>

        <?php if ($HalSekarang < $JumlahHalaman): ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $HalSekarang + 1; ?>">Selanjutnya</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>

    <script src="../bootstrap.bundle.js"></script>
    <!-- script-ion-icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- jquery -->
    <script src="../jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>

</html>