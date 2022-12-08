<?php
require '../../koneksi.php';

// pagination
$JumlahDataPerHal = 5;
$JumlahData = count(query("SELECT * FROM berita"));
$JumlahHalaman = ceil($JumlahData / $JumlahDataPerHal);

$HalSekarang = (isset($_GET["page"])) ? $_GET["page"] : 1;


$IndeksData = ($HalSekarang * $JumlahDataPerHal) - $JumlahDataPerHal;


$berita = query("SELECT * FROM berita LIMIT $IndeksData,$JumlahDataPerHal");

?>

<table id="container" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th class="text-center">#</th>
      <th>Judul</th>
      <th colspan="2" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1 ?>
    <?php foreach ($berita as $u): ?>
    <tr>
      <th scope="row" class="text-center">
        <?php echo $i + ($HalSekarang - 1) * $JumlahDataPerHal; ?>
      </th>
      <td style=" max-width: calc(100vw - 500px);">
        <?php echo $u["judul"]; ?>
      </td>
      <td class="text-center">
        <a class="btn btn-success py-1 ps-2 pe-1 opacity-75">
          <ion-icon name="create" class="fs-5"></ion-icon>
        </a>
      </td>
      <td class="text-center">
        <a href="hapusBerita.php?id=<?php echo $u["id"]; ?>" class="btn btn-danger py-1 px-2 opacity-75">
          <ion-icon name="trash" class="fs-5"></ion-icon>
        </a>
      </td>
    </tr>
    <?php $i++ ?>
    <?php endforeach; ?>
  </tbody>
</table>