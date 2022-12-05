<header class="fw-bolder fs-4">
  <!-- navbar -->
  <nav style="transition: .5s;" class="fixed-top navbar navbar-expand-lg bg-opacity-50 bg-light pb-3">
    <div class="container-xl">
      <a class="navbar-brand fs-2" style="font-family: 'Merienda One', cursive;" href="./"><img width="50px"
          src="../img/Logo.png" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0  mx-0 w-50">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="./">Utama</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Tentang</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Kategori
            </a>
            <ul class="dropdown-menu">
              <?php foreach ($kategori as $row): ?>
              <li><a class="dropdown-item" href="kategori.php?kategori=<?php echo $row["namaKategori"]; ?>">
                  <?php echo $row["namaKategori"]; ?>
                </a></li>
              <?php endforeach; ?>
            </ul>
          </li>
        </ul>
        <form class="d-flex me-3 me-xl-5" role="search">
          <input class="form-control me-2  border-dark" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-dark " type="submit">Search</button>
        </form>
        <a href="../Registrasi" class="btn btn-dark mb-1 me-3 mt-3 mt-lg-1">Registrasi</a>
        <a href="../logout.php" class="btn btn-danger mb-1  mt-3 mt-lg-1">LogOut</a>
      </div>
    </div>
  </nav>
  <!-- ahir navbar -->
</header>