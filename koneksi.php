<?php
$conn = mysqli_connect("localhost", "root", "", "tubes_kelompok2c");

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


?>