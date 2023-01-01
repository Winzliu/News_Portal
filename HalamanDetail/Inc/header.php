<header class="fw-bolder fs-4 mt-0">
  <!-- navbar -->
  <nav style="transition: .5s;" class="fixed-top navbar navbar-expand-lg bg-opacity-50 bg-light pb-3">
    <div class="container">
      <a class="navbar-brand" href="../../HalamanUtama"><img width="50px" src="../../img/Logo.png" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse ms-5" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0  mx-0 w-50">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="../../HalamanUtama">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../HalamanUtama/tentang.php">Tentang</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Kategori
            </a>
            <ul class="dropdown-menu">
              <?php foreach ($kategori as $row): ?>
                <li><a class="dropdown-item"
                    href="../../HalamanUtama/kategori.php?kategori=<?php echo $row["namaKategori"]; ?>">
                    <?php echo $row["namaKategori"]; ?>
                  </a></li>
                <?php endforeach; ?>
            </ul>
          </li>
        </ul>
        <div class="d-flex me-3 me-xl-5 position-relative">
          <input autocomplete="off" class="form-control me-2 border-dark" type="input" placeholder="Search"
            aria-label="Search" name="search" id="search" />
          <div class="position-absolute top-100 w-100 mt-1 rounded" id="container">
            <ul class="list-group fs-6">

            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!-- ahir navbar -->
</header>