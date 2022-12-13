<?php
require '../../koneksi.php';

// pagination
$JumlahDataPerHal = 5;
$JumlahData = count(query("SELECT * FROM komentar"));
$JumlahHalaman = ceil($JumlahData / $JumlahDataPerHal);

$HalSekarang = (isset($_GET["page"])) ? $_GET["page"] : 1;


$IndeksData = ($HalSekarang * $JumlahDataPerHal) - $JumlahDataPerHal;


$komentar = query("SELECT * FROM komentar LIMIT $IndeksData,$JumlahDataPerHal");

?>

<table id="container" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th class="text-center">#</th>
      <th class="d-none d-md-table-cell">Username</th>
      <th>Komentar</th>
      <th class="d-none d-md-table-cell">Tanggal</th>
      <th>status</th>
      <th>Hapus</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1 ?>
    <?php foreach ($komentar as $k): ?>
    <tr>
      <th scope="row" class="text-center">
        <?php echo $i + ($HalSekarang - 1) * $JumlahDataPerHal; ?>
      </th>
      <td class="d-none d-md-table-cell">
        <?php echo $k["username"]; ?>
      </td>
      <td>
        <?php echo $k["komentar"]; ?>
      </td>
      <td class="d-none d-md-table-cell">
        <?php echo $k["tanggalPost"]; ?>
      </td>
      <?php if ($k['status'] == 1): ?>
      <td class="text-center">
        <a href="tidakSetuju.php?id=<?php echo $k["id"]; ?>" class="btn btn-success py-1 ps-2 pe-2 opacity-75">
          <ion-icon name="checkmark-circle" class="fs-5"></ion-icon>
        </a>
      </td>
      <?php else: ?>
      <td class="text-center">
        <a href="setuju.php?id=<?php echo $k["id"]; ?>" class="btn btn-success py-1 ps-2 pe-2 opacity-75">
          <ion-icon name="close-circle" class="fs-5"></ion-icon>
        </a>
      </td>
      <?php endif; ?>
      <td class="text-center">
        <a href="confirmKomentar.php?id=<?php echo $k["id"]; ?>" class="btn btn-danger py-1 px-2 opacity-75">
          <ion-icon name="trash" class="fs-5"></ion-icon>
        </a>
      </td>
    </tr>
    <?php $i++ ?>
    <?php endforeach; ?>
  </tbody>
</table>