<?php
require '../../koneksi.php';

$keyword = mysqli_real_escape_string($conn, $_GET["keyword"]);

// pagination
$JumlahDataPerHal = 5;
$JumlahData = count(query("SELECT * FROM user"));
$JumlahHalaman = ceil($JumlahData / $JumlahDataPerHal);

$HalSekarang = (isset($_GET["page"])) ? $_GET["page"] : 1;


$IndeksData = ($HalSekarang * $JumlahDataPerHal) - $JumlahDataPerHal;


$user = query("SELECT * FROM user WHERE username LIKE '%$keyword%' LIMIT $IndeksData,$JumlahDataPerHal");

?>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th class="text-center">#</th>
      <th>Username</th>
      <th class="d-none d-md-table-cell">Email</th>
      <th colspan="2" class="text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1 ?>
    <?php foreach ($user as $u): ?>
    <tr>
      <th scope="row" class="text-center">
        <?php echo $i + ($HalSekarang - 1) * 5; ?>
      </th>
      <td>
        <?php echo $u["username"]; ?>
      </td>
      <td>
        <?php echo $u["email"]; ?>
      </td>
      <td class="text-center">
        <a class="btn btn-success py-1 ps-2 pe-1 opacity-75">
          <ion-icon name="create" class="fs-5"></ion-icon>
        </a>
      </td>
      <td class="text-center">
        <a href="hapusUser.php?id=<?php echo $u["id"]; ?>" class="btn btn-danger py-1 px-2 opacity-75">
          <ion-icon name="trash" class="fs-5"></ion-icon>
        </a>
      </td>
    </tr>
    <?php $i++ ?>
    <?php endforeach; ?>
  </tbody>
</table>