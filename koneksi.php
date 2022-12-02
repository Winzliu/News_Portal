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
  mysqli_query($conn, "INSERT INTO user VALUES('','$email','$username','$password')");

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
      header("Location: ../HalamanUtama/index.php");
      exit;
    }
  }
  return false;
}
// akhir fungsi login


?>