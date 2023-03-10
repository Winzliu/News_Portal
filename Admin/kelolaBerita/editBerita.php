<?php
session_start();
if (!isset($_SESSION["loginAdmin"]) || !isset($_SESSION['idAdmin'])) {
  header("Location: ../login");
}
// koneksi ke database
require '../../koneksi.php';
$idAdmin = $_SESSION["idAdmin"];
$namas = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$idAdmin'");
$nama = mysqli_fetch_assoc($namas);

$id = $_GET['id'];
$kategori = query("SELECT * FROM kategori");

$berita = query("SELECT * FROM berita WHERE id = $id");
$judul = $berita[0]["judul"];
$kategoriLama = $berita[0]["kategori"];
$isiBerita = $berita[0]['berita'];
$gambar = $berita[0]['gambar'];


if (isset($_POST["submit"])) {
  // cek apakah data berhasil di edit atau tidak
  if (editBerita($_POST, $id) > 0) {
    $_SESSION['edit'] = true;
  }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap.css" />
  <!-- fontstyle -->
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
  <?php include('../Inc/header.php') ?>
  <div class="container my-5 m-auto text-center">
    <form action="" method="post" enctype="multipart/form-data" class="ms-2 mb-5">
      <section class="fs-5">
        <ul class="list-group container">
          <li class="list-group-item bg-light fw-bolder fs-3  text-center" aria-current="true">Edit Berita</li>
          <li class="list-group-item">
            <div class="my-3 ms-4" style="max-width: 800px;">
              <label for="Judul" class="form-label">Judul</label>
              <input value="<?php echo $judul; ?>" name="judul" autocomplete="off" type="text" class="form-control fs-6"
                id="Judul" required oninvalid="kosong(Judul)">
              <p class="text-danger fst-italic fs-6 my-1"></p>
            </div>
            <div class="my-3 ms-4" style="max-width: 800px;">
              <label for="kategori" class="form-label">Kategori</label>
              <select name="kategori" id="kategori" class="form-select" aria-label="Default select example" required>
                <option selected>
                  <?php echo $kategoriLama; ?>
                </option>
                <?php foreach ($kategori as $k): ?>
                  <option value="<?php echo $k['namaKategori']; ?>">
                    <?php echo $k['namaKategori']; ?>
                  </option>
                  <?php endforeach; ?>
              </select>
            </div>
            <div class="my-3 ms-4" style="max-width: 800px;">
              <label for="Berita" class="form-label">Berita</label>
              <textarea name="berita" class="form-control fs-6" id="Beritas"><?php echo $isiBerita; ?></textarea>
              <p class="text-danger fst-italic fs-6 my-1"></p>
            </div>
            <div class="my-4 ms-4" style="max-width: 800px;">
              <label for="gambar" class="form-label">gambar <span class="fst-italic">(Saran Resolusi : 1900px x
                  755px)</span></label>
              <div class="input-group" style="max-width: 800px;">
                <input type="file" name="gambar-edit-berita" id="gambar" class="form-control">
              </div>
            </div>
            <input type="hidden" name="gambarLama" id="gambarLama" value="<?php echo $gambar; ?>">
            <!-- submit -->
            <a href="index.php" class="btn btn-secondary fs-5 me-5">Batal</a>
            <button type="submit" name="submit" class="btn btn-primary fs-5">Ubah</button>
          </li>
        </ul>
      </section>
    </form>
  </div>
  <!-- bootstrap -->
  <script src="../bootstrap.bundle.js"></script>
  <!-- script-ion-icons -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <!-- form validation -->
  <script>
    let Judul = document.getElementById('Judul');
    function kosong(e) {
      e.nextSibling.nextSibling.innerHTML = e.getAttribute('id') + ' Tidak Boleh Kosong';
      e.addEventListener('input', function () {
        e.nextSibling.nextSibling.innerHTML = ' ';
      })
    }
  </script>
  <!-- akhir foem validation -->


  <!-- sweetalert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- jika ada session sukses maka tampilkan sweet alert dengan pesan yang telah di set
    di dalam session sukses  -->
  <?php if (isset($_POST['submit'])): ?>
    <?php if (isset($_SESSION['edit'])): ?>
      <script>
        swal("Berhasil Mengubah Berita", "", "success");
        setTimeout(function () {
          document.location = "index.php";
        }, 2500)
      </script>
      <!-- jangan lupa untuk menambahkan unset agar sweet alert tidak muncul lagi saat di refresh -->
      <?php unset($_SESSION['edit']); ?>
      <?php else: ?>
      <script>
        swal("Gagal Mengubah Berita", "", "error");
          <?php unset($_SESSION[' edit ']); ?>
      </script>
      <?php endif; ?>
    <?php endif; ?>


  <!-- showpassword -->
  <script>
      function showPassword() {
        let icon = document.getElementById('icon');
        let password = document.getElementById('password');
        if (password.getAttribute("type") === 'password') {
          password.setAttribute("type", "text")
          icon.setAttribute("name", "eye-off-outline")
        } else {
          password.setAttribute("type", "password")
          icon.setAttribute("name", "eye-outline")
        }
      }
  </script>

  <!-- tinyMCE -->
  <script script
    src="https://cdn.tiny.cloud/1/fkny8lakkibesvbv59ae3w2w8d3d9vn18j36acymyng6i795/tinymce/6/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script>
    const upload_image = (blobInfo, progress) => new Promise((resolve, reject) => {
      const xhr = new XMLHttpRequest();
      xhr.withCredentials = false;
      xhr.open('POST', 'upload.php');

      xhr.upload.onprogress = (e) => {
        progress(e.loaded / e.total * 100);
      };

      xhr.onload = () => {
        if (xhr.status === 403) {
          reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
          return;
        }

        if (xhr.status < 200 || xhr.status >= 300) {
          reject('HTTP Error: ' + xhr.status);
          return;
        }

        const json = JSON.parse(xhr.responseText);

        if (!json || typeof json.location != 'string') {
          reject('Invalid JSON: ' + xhr.responseText);
          return;
        }

        resolve(json.location);
      };

      xhr.onerror = () => {
        reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
      };

      const formData = new FormData();
      formData.append('file', blobInfo.blob(), blobInfo.filename());

      xhr.send(formData);
    });


    tinymce.init({
      selector: 'textarea#Beritas',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount ',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat | link | code | ',
      /* enable title field in the Image dialog*/
      image_title: true,
      images_upload_url: 'upload.php',
      images_upload_handler: upload_image
    });
  </script>
</body>

</html>