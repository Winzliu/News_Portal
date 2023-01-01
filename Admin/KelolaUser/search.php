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

<table id="container" class="table table-striped table-bordered rounded-3 overflow-hidden"
  style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
  <thead>
    <tr class="text-center bg-dark text-white">
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