<header class="fw-bolder fs-5">
  <!-- navbar -->
  <nav class="navbar bg-light">
    <div class="container">
      <a class="navbar-brand fs-3" href="../Dashboard" style="font-family: 'Merienda One', cursive;"><img width="50px"
          src="../../img/Logo.png" alt=""> ToSee News</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title fw-bolder fs-4" id="offcanvasNavbarLabel"
            style="font-family: 'Merienda One', cursive;">
            <img width="50px" src="../../img/Logo.png" alt=""> ToSee
            News
          </h5>

          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item mt-2">
              <a class="nav-link" aria-current="page" href="../Dashboard">Home</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" href="#">Kelola Topik Berita</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" href="../KelolaBerita">Kelola Berita</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link" href="#">Kelola Komentar</a>
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
        <a href="../logout.php" class="btn btn-danger end w-50 m-auto mb-5"> Logout </a>
      </div>
    </div>
  </nav>
  <!-- ahir navbar -->
</header>