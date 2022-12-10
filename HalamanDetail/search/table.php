<?php
require '../../koneksi.php';

// pagination
$JumlahDataPerHal = 5;
$JumlahData = count(query("SELECT * FROM berita"));
$JumlahHalaman = ceil($JumlahData / $JumlahDataPerHal);

$HalSekarang = (isset($_GET["page"])) ? $_GET["page"] : 1;


$IndeksData = ($HalSekarang * $JumlahDataPerHal) - $JumlahDataPerHal;


$beritaFull = query("SELECT * FROM berita LIMIT $IndeksData,$JumlahDataPerHal");

?>

<?php foreach ($beritaFull as $berita): ?>

<?php endforeach; ?>