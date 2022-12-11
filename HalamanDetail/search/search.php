<?php
require '../../koneksi.php';

$keyword = mysqli_real_escape_string($conn, $_GET["keyword"]);

// pagination
$JumlahDataPerHal = 5;
$JumlahData = count(query("SELECT * FROM berita"));
$JumlahHalaman = ceil($JumlahData / $JumlahDataPerHal);

$HalSekarang = (isset($_GET["page"])) ? $_GET["page"] : 1;


$IndeksData = ($HalSekarang * $JumlahDataPerHal) - $JumlahDataPerHal;


$beritaFull = query("SELECT * FROM berita WHERE judul LIKE '%$keyword%' ORDER BY id DESC LIMIT 6");

?>

<div class="position-absolute top-100 w-100 mt-1 rounded" id="container">
  <ul class="list-group fs-6">
    <?php foreach ($beritaFull as $berita): ?>
    <a class="text-decoration-none focus" href="../HalamanDetail/index.php?id=<?php echo $berita['id']; ?>">
      <li class="list-group-item rounded btn btn-light" style="margin-top: 1px;height: 38px; overflow: hidden;">
        <?php echo $berita['judul']; ?>
      </li>
    </a>
    <?php endforeach; ?>
  </ul>
</div>