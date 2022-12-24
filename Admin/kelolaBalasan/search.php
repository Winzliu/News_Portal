<?php
require '../../koneksi.php';

$keyword = mysqli_real_escape_string($conn, $_GET["keyword"]);

// pagination
$JumlahDataPerHal = 5;
$JumlahData = count(query("SELECT * FROM balasan"));
$JumlahHalaman = ceil($JumlahData / $JumlahDataPerHal);

$HalSekarang = (isset($_GET["page"])) ? $_GET["page"] : 1;


$IndeksData = ($HalSekarang * $JumlahDataPerHal) - $JumlahDataPerHal;


$balasan = query("SELECT * FROM balasan WHERE balasan LIKE '%$keyword%' or username LIKE '%$keyword%' LIMIT $IndeksData,$JumlahDataPerHal");

?>

<table id="container" class="table table-striped table-bordered">
  <thead>
    <tr class="text-center">
      <th class="text-center">#</th>
      <th class="d-none d-md-table-cell">Username</th>
      <th class="d-none d-md-table-cell">Komentar</th>
      <th>Balasan</th>
      <th class="d-none d-md-table-cell">Tanggal</th>
      <th>status</th>
      <th>Hapus</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1 ?>
    <?php foreach ($balasan as $b): ?>
    <tr class="fs-6">
      <th scope="row" class="text-center">
        <?php echo $i + ($HalSekarang - 1) * $JumlahDataPerHal; ?>
      </th>
      <!-- username -->
      <td class="d-none d-md-table-cell">
        <?php echo $b["username"]; ?>
      </td>
      <!-- kahir username -->
      <!-- komentar -->
      <td class="text-center d-none d-md-table-cell">
        <?php $idKomentar = $b['idKomentar']; ?>
        <?php $judulKomentar = query("SELECT komentar FROM komentar WHERE id = '$idKomentar'"); ?>
        <?php echo $judulKomentar[0]['komentar']; ?>
      </td>
      <!-- akhir komentar -->
      <!-- balasan -->
      <td>
        <?php echo $b["balasan"]; ?>
      </td>
      <!-- akhir balasan -->
      <!-- tanggal post -->
      <td class="d-none d-md-table-cell">
        <?php echo $b["tanggal"]; ?>
      </td>
      <!-- akhir tanggal post -->
      <!-- status -->
      <?php if ($b['status'] == 1): ?>
      <td class="text-center">
        <a href="tidakSetuju.php?id=<?php echo $b["id"]; ?>" class="btn btn-success py-1 ps-2 pe-2 opacity-75">
          <ion-icon name="checkmark-circle" class="fs-5"></ion-icon>
        </a>
      </td>
      <?php else: ?>
      <td class="text-center">
        <a href="setuju.php?id=<?php echo $b["id"]; ?>" class="btn btn-danger py-1 ps-2 pe-2 opacity-75">
          <ion-icon name="close-circle" class="fs-5"></ion-icon>
        </a>
      </td>
      <?php endif; ?>
      <!-- akhir status -->
      <!-- hapus balasan -->
      <td class="text-center">
        <a href="confirmBalasan.php?id=<?php echo $b["id"]; ?>" class="btn btn-danger py-1 px-2 opacity-75">
          <ion-icon name="trash" class="fs-5"></ion-icon>
        </a>
      </td>
      <!-- akhir hapus balasan -->
    </tr>
    <?php $i++ ?>
    <?php endforeach; ?>
  </tbody>
</table>