<?php
require '../../koneksi.php';

$keyword = mysqli_real_escape_string($conn, $_GET["keyword"]);

// pagination
$JumlahDataPerHal = 5;
$JumlahData = count(query("SELECT * FROM komentar"));
$JumlahHalaman = ceil($JumlahData / $JumlahDataPerHal);

$HalSekarang = (isset($_GET["page"])) ? $_GET["page"] : 1;


$IndeksData = ($HalSekarang * $JumlahDataPerHal) - $JumlahDataPerHal;


$komentar = query("SELECT * FROM komentar WHERE komentar LIKE '%$keyword%' or username LIKE '%$keyword%' LIMIT $IndeksData,$JumlahDataPerHal");

?>

<table id="container" class="table table-striped table-bordered rounded-3 overflow-hidden"
  style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
  <thead>
    <tr class="text-center bg-dark text-white">
      <th class="text-center">#</th>
      <th class="d-none d-md-table-cell text-center">Username</th>
      <th class="text-center">Komentar</th>
      <th class="text-center">Judul</th>
      <th class="d-none d-md-table-cell text-center">Tanggal</th>
      <th class="text-center">Status</th>
      <th class="text-center">Hapus</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1 ?>
    <?php foreach ($komentar as $k): ?>
      <tr class="fs-6">
        <th scope="row" class="text-center">
          <?php echo $i + ($HalSekarang - 1) * $JumlahDataPerHal; ?>
        </th>
        <!-- username -->
        <td class="d-none d-md-table-cell">
          <?php echo $k["username"]; ?>
        </td>
        <!-- kahir username -->
        <!-- komentar -->
        <td>
          <?php echo $k["komentar"]; ?>
        </td>
        <td class="text-center">
          <?php $idBerita = $k['idBerita']; ?>
          <?php $judulBerita = query("SELECT judul FROM berita WHERE id = '$idBerita'"); ?>
          <?php echo $judulBerita[0]['judul']; ?>
        </td>
        <!-- akhir komentar -->
        <!-- tanggal post -->
        <td class="d-none d-md-table-cell">
          <?php echo $k["tanggalPost"]; ?>
        </td>
        <!-- akhir tanggal post -->
        <!-- status -->
        <?php if ($k['status'] == 1): ?>
          <td class="text-center">
            <a href="tidakSetuju.php?id=<?php echo $k["id"]; ?>" class="btn btn-success py-1 ps-2 pe-2 opacity-75">
              <ion-icon name="checkmark-circle" class="fs-5"></ion-icon>
            </a>
          </td>
          <?php else: ?>
          <td class="text-center">
            <a href="setuju.php?id=<?php echo $k["id"]; ?>" class="btn btn-danger py-1 ps-2 pe-2 opacity-75">
              <ion-icon name="close-circle" class="fs-5"></ion-icon>
            </a>
          </td>
          <?php endif; ?>
        <!-- akhir status -->
        <!-- hapus komentar -->
        <td class="text-center">
          <a href="confirmKomentar.php?id=<?php echo $k["id"]; ?>" class="btn btn-danger py-1 px-2 opacity-75">
            <ion-icon name="trash" class="fs-5"></ion-icon>
          </a>
        </td>
        <!-- akhir hapus komentar -->
      </tr>
      <?php $i++ ?>
      <?php endforeach; ?>
  </tbody>
</table>