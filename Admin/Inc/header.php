<header class="fw-bolder fs-5">
  <!-- navbar -->
  <nav class="navbar bg-light">
    <div class="container">
      <a class="navbar-brand" href="../Dashboard" style="font-family: 'Merienda One', cursive;"><img width="50px"
          style="margin-top: -17px;" src="../../img/Logo.png" alt=""> <span class="fs-2 p-2">ToSee News</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title fw-bolder fs-4" id="offcanvasNavbarLabel"
            style="font-family: 'Merienda One', cursive;">
            <img style="margin-top: -12px;" width="50px" src="../../img/Logo.png" alt=""> ToSee
            News
          </h5>

          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item mt-2">
              <a class="nav-link" aria-current="page" href="../Dashboard">Beranda</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" href="../KelolaKategori">Kelola Kategori Berita</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" href="../KelolaBerita">Kelola Berita</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" href="../KelolaKomentar">Kelola Komentar</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" href="../KelolaUser">Kelola User</a>
            </li>
          </ul>
        </div>
        <h5 class="text-center my-5">
          Halo <span class="fw-bolder ">
            <?php echo $nama["username"]; ?>
          </span> (Admin)
        </h5>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger w-75 m-auto mb-5" data-bs-toggle="modal"
          data-bs-target="#exampleModal">
          Logout
        </button>

        <!-- Modal -->
      </div>
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Logout</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Yakin Ingin Logout?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <a href="../logout.php" class="btn btn-danger">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!-- ahir navbar -->
</header>