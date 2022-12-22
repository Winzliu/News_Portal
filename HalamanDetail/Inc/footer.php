<footer class="bg-dark text-white pb-2 pt-4 fs-5">
  <div class="container row m-auto">
    <!-- Tema Berita -->
    <div class="col-lg-4 text-center mb-5">
      <h3 class="">Tema Berita :</h3>
      <hr />
      <div class="list-group">
        <?php foreach ($kategori as $row): ?>
        <a href="../../HalamanUtama/kategori.php?kategori=<?php echo $row["namaKategori"]; ?>"
          class="border-start-0 border-end-0 rounded-0 border-light bg-dark text-white list-group-item list-group-item-action">
          <?php echo $row["namaKategori"]; ?>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
    <!-- Alamat -->
    <div class="col-lg-4 text-center mb-5">
      <img width="100px" src="../../img/Logo-Putih.png" alt="">
      <div class="list-group">
        <p style="font-family: 'Merienda One', cursive;">ToSee News</p>
        <p>ToSee (2C) adalah sebuah website berita yang menyediakan berbagai berita terbaru dan terpopuler.</p>
      </div>
    </div>
    <!-- Contact -->
    <div class="col-lg-4 text-center">
      <h3 class="">Kontak Kami :</h3>
      <hr />
      <div class="list-group">
        <h6>
          Hubungi Kami Di Hari Kerja (sen-jum) Pada Jam Kerja (10.00-18.00)
        </h6>
        <a href="#"
          class="border-start-0 border-end-0 rounded-0 border-light bg-dark text-white list-group-item list-group-item-action fs-4">
          <ion-icon class="fs-5" name="logo-instagram"></ion-icon>INSTAGRAM
        </a>
        <a href="#"
          class="border-start-0 border-end-0 rounded-0 border-light bg-dark text-white list-group-item list-group-item-action fs-4">
          <ion-icon class="fs-5" name="logo-facebook"></ion-icon>FACEBOOK
        </a>
      </div>
    </div>
  </div>
  <!-- copyright -->
  <div class="col-lg-12 text-center">
    <h5 class="">Copyright &copy; 2022 | Kelompok 2C </h5>
    <hr />
  </div>
  </div>
</footer>