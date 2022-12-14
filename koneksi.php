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

  $email = mysqli_real_escape_string($conn, strtolower($data["email"]));
  $username = mysqli_real_escape_string($conn, strtolower(htmlspecialchars($data["username"])));
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
  $username = htmlspecialchars(strtolower($dataUser["username"]));
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
  $username = mysqli_real_escape_string($conn, strtolower($dataUser["username"]));
  $password = mysqli_real_escape_string($conn, $dataUser["password"]);
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
  if ($ukuranFile > 1024 * 1024 * 2 || $error == 1) {
    echo "<script>
    alert('Ukuran File Yang di Upload Terlalu Besar (<2MB)');
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




// fungsi edit user
function edit($edit, $idUser)
{
  global $conn;
  $user = query("SELECT * FROM user WHERE id = $idUser");
  $usernameLama = $user[0]['username'];
  $passwordLama = $user[0]["password"];
  $email = mysqli_real_escape_string($conn, $edit["email"]);
  $username = mysqli_real_escape_string($conn, htmlspecialchars($edit["username"]));
  $password = mysqli_real_escape_string($conn, $edit["password"]);
  $gambarLama = $edit["gambarLama"];
  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

  if (mysqli_fetch_assoc($result) && $username != $usernameLama) {
    echo "<script>
    alert('username telah dipakai');
    </script>";
    return false;
  }

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

  mysqli_query($conn, "UPDATE komentar SET username = '$username', gambar = '$gambar' WHERE idUser = '$id'");

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
  $email = mysqli_real_escape_string($conn, $edit["email"]);
  $username = mysqli_real_escape_string($conn, htmlspecialchars($edit["username"]));
  $password = mysqli_real_escape_string($conn, $edit["password"]);

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

  $namaKategori = mysqli_real_escape_string($conn, $data["namaKategori"]);


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
  $judul = mysqli_real_escape_string($conn, htmlspecialchars($data["judul"]));
  $kategori = mysqli_real_escape_string($conn, strtolower($data["kategori"]));
  $isiBerita = mysqli_real_escape_string($conn, $data["isiBerita"]);
  $gambar = mysqli_real_escape_string($conn, htmlspecialchars(postGambar()));

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

// // fungsi post gambar
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
  if ($ukuranFile > 1024 * 1024 * 2 || $error == 1) {
    echo "<script>
    alert('Ukuran File Yang di Upload Terlalu Besar Harus (<2MB)');
    </script>";
    return false;
  }

  // jika ada nama yang sama tetapi gambar beda generate nama gambar baru
  $namaFileBaru = uniqid() . "." . $extName;

  // jika valid
  move_uploaded_file($tmpName, '../../HalamanUtama/img/img-berita/' . $namaFileBaru);
  return $namaFileBaru;
}
// // akhir fungsi post gambar

// fungsi lupapassword
function lupaPassword($dataUser)
{
  global $conn;
  $username = htmlspecialchars($dataUser["username"]);
  $password = mysqli_real_escape_string($conn, $dataUser["passwordBaru"]);
  $konfirmasiPass = mysqli_real_escape_string($conn, $dataUser["kpasswordBaru"]);
  $Users = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");


  // ada gk username yang sama
  if (mysqli_num_rows($Users) === 0) {
    echo "<script>
  alert('konfirmasi Username salah');
  </script>";
    return 0;
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
  mysqli_query($conn, "UPDATE user SET password ='$password' WHERE 
  username ='$username'");

  return mysqli_affected_rows($conn);
}
// akhir fungsi lupa password

// fungsi edit kategori
function editKategori($edit, $idUser)
{
  global $conn;
  $kategori = query("SELECT * FROM kategori WHERE id = $idUser");
  $namaKategoriLama = $kategori[0]['namaKategori'];
  $namaKategori = mysqli_real_escape_string($conn, $edit["namaKategori"]);
  $result = mysqli_query($conn, "SELECT namaKategori FROM kategori WHERE namaKategori = '$namaKategori'");

  if (mysqli_fetch_assoc($result) && $namaKategori != $namaKategoriLama) {
    echo "<script>
    alert('kategori telah ada');
    </script>";
    return false;
  }

  $id = $idUser;

  mysqli_query($conn, "UPDATE kategori SET  namaKategori = '$namaKategori', tanggalPosting = current_timestamp() WHERE id = $id");

  return mysqli_affected_rows($conn);
}
// akhir fungsi edit kategori

// fungsi edit user from admin
function editUser($edit, $idUser)
{
  global $conn;
  $user = query("SELECT * FROM user WHERE id = $idUser");
  $usernameLama = $user[0]['username'];
  $password = $user[0]['password'];
  $gambar = $user[0]['gambar'];
  $username = mysqli_real_escape_string($conn, $edit["username"]);
  $email = mysqli_real_escape_string($conn, $edit["email"]);
  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

  if (mysqli_fetch_assoc($result) && $username != $usernameLama) {
    echo "<script>
    alert('username telah dipakai');
    </script>";
    return false;
  }

  $id = $idUser;

  mysqli_query($conn, "UPDATE user SET  username = '$username', email = '$email', password = '$password', gambar = '$gambar' WHERE id = $id");

  return mysqli_affected_rows($conn);
}
// akhir fungsi edit user from admin

// fungsi edit berita
function editBerita($edit, $idUser)
{
  global $conn;
  $berita = query("SELECT * FROM berita WHERE id = $idUser");
  $judulLama = $berita[0]['judul'];
  $idAdmin = $_SESSION['idAdmin'];
  $namas = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$idAdmin'");
  $admin = mysqli_fetch_assoc($namas)['username'];
  $judul = mysqli_real_escape_string($conn, $edit["judul"]);
  $kategori = mysqli_real_escape_string($conn, htmlspecialchars($edit["kategori"]));
  $gambarLama = $edit["gambarLama"];
  $result = mysqli_query($conn, "SELECT judul FROM berita WHERE judul = '$judul'");

  if (mysqli_fetch_assoc($result) && $judul != $judulLama) {
    echo "<script>
    alert('judul telah dipakai');
    </script>";
    return false;
  }


  if ($_FILES["gambar-edit-berita"]['error'] === 4) {
    $gambar = $gambarLama;
  } else {
    $gambar = cekGambarBerita($gambarLama);
  }

  $id = $idUser;

  mysqli_query($conn, "UPDATE berita SET  judul = '$judul', kategori = '$kategori',gambar = '$gambar',oleh = '$admin' WHERE id = $id");

  return mysqli_affected_rows($conn);
}
// akhir fungsi edit berita

// fungsi cek gambar berita
function cekGambarBerita($gambar)
{
  $gambarLama = $gambar;
  $namaFile = $_FILES["gambar-edit-berita"]["name"];
  $ukuranFile = $_FILES["gambar-edit-berita"]["size"];
  $error = $_FILES["gambar-edit-berita"]["error"];
  $tmpName = $_FILES["gambar-edit-berita"]["tmp_name"];

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
  if ($ukuranFile > 1024 * 1024 * 2 || $error == 1) {
    echo "<script>
    alert('Ukuran File Yang di Upload Terlalu Besar (<2MB)');
    </script>";
    return $gambarLama;
  }

  // jika ada nama yang sama tetapi gambar beda generate nama gambar baru
  $namaFileBaru = uniqid() . "." . $extName;

  // jika valid
  move_uploaded_file($tmpName, '../../HalamanUtama/img/img-berita/' . $namaFileBaru);
  return $namaFileBaru;
}
// akhir fungsi cek gambar berita

// fungsi komentar
function komentar($data)
{
  global $conn;

  $username = mysqli_real_escape_string($conn, $data["username"]);
  $gambar = mysqli_real_escape_string($conn, htmlspecialchars($data["gambar"]));
  $idBerita = mysqli_real_escape_string($conn, $data["idBerita"]);
  $komentar = mysqli_real_escape_string($conn, $data["komentar"]);
  $idUser = $data["idUser"];

  // tambah password ke database
  mysqli_query($conn, "INSERT INTO komentar VALUES('','$idBerita','$idUser','$username','$gambar','$komentar', current_timestamp(), 0 )");

  return mysqli_affected_rows($conn);
}
// akhir fungsi komentar

// fungsi balasan
function balasan($data)
{
  global $conn;

  $username = mysqli_real_escape_string($conn, $data["username"]);
  $idKomentar = mysqli_real_escape_string($conn, htmlspecialchars($data["idKomentar"]));
  $idBerita = mysqli_real_escape_string($conn, $data["idBerita"]);
  $balasan = mysqli_real_escape_string($conn, $data["isiBalasan"]);
  $idUser = $data["idUser"];

  // tambah password ke database
  mysqli_query($conn, "INSERT INTO balasan VALUES('','$idBerita','$idKomentar','$idUser','$username','$balasan', current_timestamp(), 0 )");

  return mysqli_affected_rows($conn);
}
// akhir fungsi balasan

?>