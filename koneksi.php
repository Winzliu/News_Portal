<?php
$conn = mysqli_connect("localhost", "root", "", "tubes_kelompok2c");

// fungsi query
function query($query)
{
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}


// fungsi registrasi
function registrasi($data)
{
  global $conn;

  $email = strtolower(stripslashes($data["email"]));
  $username = strtolower(stripslashes($data["username"]));
  $password = mysqli_real_escape_string($conn, $data["password"]);
  $konfirmasiPass = mysqli_real_escape_string($conn, $data["password2"]);
  $gambar = "Logo-User.png";

  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

  if (mysqli_fetch_assoc($result)) {
    echo "<script>
    alert('username telah dipakai');
    </script>";
    return false;
  }

  // konfirmasi password
  if ($password !== $konfirmasiPass) {
    echo "<script>
    alert('konfirmasi password salah');
    </script>";
    return false;
  }

  // enkripsi password hash
  $password = password_hash($password, PASSWORD_DEFAULT);

  // tambah password ke database
  mysqli_query($conn, "INSERT INTO user VALUES('','$email','$username','$password','$gambar')");

  return mysqli_affected_rows($conn);
}
// akhir fungsi registrasi


// fungsi login
function login($dataUser)
{
  global $conn;
  $username = strtolower($dataUser["username"]);
  $password = $dataUser["password"];
  $user = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

  // ada gk username yang sama
  if (mysqli_num_rows($user) === 1) {
    // cek password
    $pass = mysqli_fetch_assoc($user);
    // ada gk password yang sama
    if (password_verify($password, $pass["password"])) {
      // set session
      $_SESSION["login"] = true;
      $_SESSION["id"] = $pass["id"];
      header("Location: ../HalamanUtama/index.php");
      exit;
    }
  }
  return false;
}
// akhir fungsi login 

// login admin

function loginAdmin($dataUser)
{
  global $conn;
  $username = strtolower($dataUser["username"]);
  $password = $dataUser["password"];
  $user = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");

  // ada gk username yang sama
  if (mysqli_num_rows($user) === 1) {
    // cek password
    $pass = mysqli_fetch_assoc($user);
    // ada gk password yang sama
    if ($password == $pass["password"]) {
      // set session
      $_SESSION["loginAdmin"] = true;
      $_SESSION["idAdmin"] = $pass["id"];
      header("Location: ../");
      exit;
    }
  }
  return false;
}
// akhir fungsi login admin

// fungsi cek gambar
function cekGambar($gambar)
{
  $gambarLama = $gambar;
  $namaFile = $_FILES["gambar"]["name"];
  $ukuranFile = $_FILES["gambar"]["size"];
  $error = $_FILES["gambar"]["error"];
  $tmpName = $_FILES["gambar"]["tmp_name"];

  /* user tidak memasukkan gamabar */
  if ($error === 4) {
    echo "<script>
    alert('Upload Gambar Terlebih Dahulu');
    </script>";
    return $gambarLama;
  }

  // user menupload file bukan gambar
  $extValid = ['jpg', 'jpeg', 'png'];
  $extName = explode('.', $namaFile);
  $extName = strtolower(end($extName));

  if (!in_array($extName, $extValid)) {
    echo "<script>
    alert('Extensi file yang di upload salah');
    </script>";
    return $gambarLama;
  }

  // besar file
  if ($ukuranFile > 1024 * 1024 * 3) {
    echo "<script>
    alert('Ukuran File Yang di Upload Terlalu Besar (<3MB)');
    </script>";
    return $gambarLama;
  }

  // jika ada nama yang sama tetapi gambar beda generate nama gambar baru
  $namaFileBaru = uniqid() . "." . $extName;

  // jika valid
  move_uploaded_file($tmpName, '../HalamanUtama/img/img-user/' . $namaFileBaru);
  return $namaFileBaru;
}
// akhir fungsi cek gambar

// fungsi post gambar
function postGambar()
{
  $namaFile = $_FILES["gambar-berita"]["name"];
  $ukuranFile = $_FILES["gambar-berita"]["size"];
  $error = $_FILES["gambar-berita"]["error"];
  $tmpName = $_FILES["gambar-berita"]["tmp_name"];

  /* user tidak memasukkan gamabar */
  if ($error === 4) {
    echo "<script>
    alert('Upload Gambar Terlebih Dahulu');
    </script>";
    return false;
  }

  // user menupload file bukan gambar
  $extValid = ['jpg', 'jpeg', 'png'];
  $extName = explode('.', $namaFile);
  $extName = strtolower(end($extName));

  if (!in_array($extName, $extValid)) {
    echo "<script>
    alert('Extensi file yang di upload salah');
    </script>";
    return false;
  }

  // besar file
  if ($ukuranFile > (1024 * 1024) || $error == 1) {
    echo "<script>
    alert('Ukuran File Yang di Upload Terlalu Besar Harus (<1MB)');
    </script>";
    return false;
  }

  // jika ada nama yang sama tetapi gambar beda generate nama gambar baru
  $namaFileBaru = uniqid() . "." . $extName;

  // jika valid
  move_uploaded_file($tmpName, '../../HalamanUtama/img/img-berita/' . $namaFileBaru);
  return $namaFileBaru;
}
// akhir fungsi post gambar


// fungsi edit user
function edit($edit, $idUser)
{
  global $conn;
  $user = query("SELECT * FROM user WHERE id = $idUser");
  $passwordLama = $user[0]["password"];
  $email = htmlspecialchars($edit["email"]);
  $username = htmlspecialchars($edit["username"]);
  $password = htmlspecialchars($edit["password"]);
  $gambarLama = $edit["gambarLama"];

  if ($password == $passwordLama) {
    $password = $passwordLama;
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);
  }

  if ($_FILES["gambar"]['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = cekGambar($gambarLama);
  }

  $id = $idUser;

  mysqli_query($conn, "UPDATE user SET  username = '$username', email = '$email', password = '$password',gambar = '$gambar' WHERE id = $id");

  return mysqli_affected_rows($conn);
}
// akhir fungsi edit user

// fungsi hapus gambar
function hapusGambar($edit, $idUser)
{
  global $conn;
  $user = query("SELECT * FROM user WHERE id = $idUser");
  $passwordLama = $user[0]["password"];
  $email = htmlspecialchars($edit["email"]);
  $username = htmlspecialchars($edit["username"]);
  $password = htmlspecialchars($edit["password"]);

  if ($password == $passwordLama) {
    $password = $passwordLama;
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);
  }

  $gambar = 'Logo-User.png';

  $id = $idUser;

  mysqli_query($conn, "UPDATE user SET  username = '$username', email = '$email', password = '$password',gambar = '$gambar' WHERE id = $id");

  return mysqli_affected_rows($conn);
}
// akhir fungsi hapus gambar

// fungsi tambah kategori
function tambahkategori($data)
{
  global $conn;

  $namaKategori = strtolower(stripslashes($data["namaKategori"]));


  $result = mysqli_query($conn, "SELECT * FROM kategori WHERE namaKategori = '$namaKategori'");

  if (mysqli_fetch_assoc($result)) {
    echo "<script>
    alert('Kategori Telah Ada');
    </script>";
    return false;
  }

  // tambah password ke database
  mysqli_query($conn, "INSERT INTO kategori VALUES('','$namaKategori', current_timestamp()	)");

  return mysqli_affected_rows($conn);
}
// akhir fungsi tambah kategori

// fungsi tambah berita
function tambahberita($data)
{
  global $conn;
  $id = $_SESSION['idAdmin'];
  $admins = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$id'");
  $admin = mysqli_fetch_assoc($admins)['username'];
  $judul = strtolower(stripslashes($data["judul"]));
  $kategori = strtolower(stripslashes($data["kategori"]));
  $isiBerita = $data["editordata"];
  $gambar = postGambar();

  if ($gambar == false) {
    return false;
  }

  $result = mysqli_query($conn, "SELECT * FROM berita WHERE judul = '$judul'");

  if (mysqli_fetch_assoc($result)) {
    echo "<script>
    alert('Judul Telah Ada');
    </script>";
    return false;
  }

  // tambah password ke database
  mysqli_query($conn, "INSERT INTO berita VALUES('','$judul', '$kategori', '$isiBerita', current_timestamp(), '$gambar', '$admin')");

  return mysqli_affected_rows($conn);
}
// akhir fungsi tambah berita

?>