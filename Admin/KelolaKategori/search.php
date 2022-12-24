<?php
require '../../koneksi.php';

$keyword = mysqli_real_escape_string($conn, $_GET["keyword"]);

// pagination
$JumlahDataPerHal = 5;
$JumlahData = count(query("SELECT * FROM kategori"));
$JumlahHalaman = ceil($JumlahData / $JumlahDataPerHal);

$HalSekarang = (isset($_GET["page"])) ? $_GET["page"] : 1;


$IndeksData = ($HalSekarang * $JumlahDataPerHal) - $JumlahDataPerHal;


$kategori = query("SELECT * FROM kategori WHERE namaKategori LIKE '%$keyword%' LIMIT $IndeksData,$JumlahDataPerHal");

?>

<table id="container" class="table table-striped table-bordered">
  <thead>
    <tr class="text-center">
      <th class="text-center">#</th>
      <th>Kategori</th>
      <th class="d-none d-md-table-cell text-center">Tanggal Pembuatan</th>
      <th colspan="2" class="text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1 ?>
    <?php foreach ($kategori as $k): ?>
    <tr>
      <th scope="row" class="text-center">
        <?php echo $i + ($HalSekarang - 1) * $JumlahDataPerHal; ?>
      </th>
      <td>
        <?php echo $k["namaKategori"]; ?>
      </td>
      <td class="d-none d-md-table-cell">
        <?php echo $k["tanggalPosting"]; ?>
      </td>
      <td class="text-center">
        <a href="editKategori.php?id=<?php echo $k["id"]; ?>" class="btn btn-success py-1 ps-2 pe-1 opacity-75">
          <ion-icon name="create" class="fs-5"></ion-icon>
        </a>
      </td>
      <td class="text-center">
        <a href="confirmKategori.php?id=<?php echo $k["id"]; ?>" class="btn btn-danger py-1 px-2 opacity-75">
          <ion-icon name="trash" class="fs-5"></ion-icon>
        </a>
      </td>
    </tr>
    <?php $i++ ?>
    <?php endforeach; ?>
  </tbody>
</table>