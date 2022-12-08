<?php
session_start();
if (!isset($_SESSION["loginAdmin"]) || !isset($_SESSION['idAdmin'])) {
  header("Location: ../login");
}
require '../../koneksi.php';
$idAdmin = $_SESSION["idAdmin"];
$namas = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$idAdmin'");
$nama = mysqli_fetch_assoc($namas);

if (isset($_POST["tambahberita"])) {
  if (tambahberita($_POST) > 0) {
    $_SESSION["tambahberita"] = true;
  }
}

$kategori = query("SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Berita</title>
  <!-- bootstrap -->
  <link rel="stylesheet" href="../bootstrap.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merienda+One&family=Noto+Serif&display=swap" rel="stylesheet">
  <!-- summernote -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
</head>

<body style="font-family: 'Noto Serif', serif">
  <?php include("../Inc/header.php") ?>
  <nav class="navbar navbar-expand-sm navbar-light">
    <div class="container">
      <span class="navbar-text fs-4">Tambah Berita</span>

      <ul class="breadcrumb fs-5 d-none d-md-flex">
        <li class="breadcrumb-item"><a href="../Dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="../KelolaBerita">Kelola Berita</a></li>
        <li class="breadcrumb-item active">Tambah Berita</li>
      </ul>
    </div>
  </nav>
  <!-- Form -->
  <form action="" method="post" enctype="multipart/form-data" class="ms-2 mb-5">
    <section class="fs-5">
      <ul class="list-group container">
        <li class="list-group-item bg-light fw-bolder fs-3  text-center" aria-current="true">Tambah Berita</li>
        <li class="list-group-item">
          <div class="my-3 ms-4" style="max-width: 800px;">
            <label for="judul" class="form-label">Judul</label>
            <input name="judul" autocomplete="off" type="text" class="form-control fs-6" id="judul" required>
          </div>
          <div class="my-3 ms-4" style="max-width: 800px;">
            <label for="kategori" class="form-label">Kategori</label>
            <select name="kategori" id="kategori" class="form-select" aria-label="Default select example" required>
              <option selected>
                << Pilih Kategori>>
              </option>
              <?php foreach ($kategori as $k): ?>
              <option value="<?php echo $k['namaKategori']; ?>">
                <?php echo $k['namaKategori']; ?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="my-3 ms-4" style="max-width: 800px;">
            <label for="isiBerita" class="form-label">Isi Berita</label>
            <textarea id="summernote" name="editordata" required></textarea>
          </div>
          <div class="my-4 ms-4" style="max-width: 800px;">
            <label for="gambar-berita" class="form-label">gambar <span class="fst-italic">(Saran Resolusi : 1900px x
                755px)</span></label>
            <div class="input-group" style="max-width: 800px;">
              <input type="file" name="gambar-berita" id="gambar-berita" class="form-control" required>
            </div>
          </div>
          <button name="tambahberita" class="btn btn-primary ms-5 my-4" type="submit">Tambah</button>
        </li>
      </ul>
    </section>
  </form>
  <!-- bootstrap -->
  <script src="../bootstrap.bundle.js"></script>



  <!-- sweetalert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
  di dalam session sukses  -->
  <?php if (isset($_POST['tambahberita'])): ?>
  <?php if (isset($_SESSION['tambahberita'])): ?>
  <script>
    swal("Berhasil Menambahkan Berita", "", "success");
    setTimeout(function () {
      document.location = "./";
    }, 2500)
  </script>
  <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['tambahberita']); ?>
  <?php else: ?>
  <script>
    swal("Gagal Menambahkan Berita", "", "error");
    setTimeout(function () {
      document.location = "./";
    }, 2500)
  </script>
  <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
  <?php unset($_SESSION['tambahberita']); ?>
  <?php endif; ?>
  <?php endif; ?>
  <!-- summernote -->
  <script>
    $('#summernote').summernote({
      placeholder: 'Isi Berita Disini',
      tabsize: 2,
      height: 120,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  </script>
</body>

</html>