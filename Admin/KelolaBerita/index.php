<?php
session_start();
if (!isset($_SESSION["loginAdmin"])) {
  header("Location: ../login");
}
require '../../koneksi.php';
$idAdmin = $_SESSION["idAdmin"];
$namas = mysqli_query($conn, "SELECT * FROM admin WHERE id = '$idAdmin'");
$nama = mysqli_fetch_assoc($namas);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Management Berita</title>
  <link rel="stylesheet" href="../bootstrap.css">
</head>

<body style="font-family: Playfair Display SC, serif">
  <?php include("../Inc/header.php") ?>
  <nav class="navbar navbar-expand-sm navbar-light">
    <div class="container">
      <span class="navbar-text fs-4">Kelola Berita</span>

      <ul class="breadcrumb fs-5">
        <li class="breadcrumb-item"><a href="../Dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Management Berita</li>
      </ul>
    </div>
  </nav>

  <div class="container mt-5 fs-5">
    <div class="row">
      <div class="col">
        <button type="button" class="btn btn-success mb-3 fs-5">Add +</button>
      </div>
      <div class="col">
        <input type="search" class="form-control fs-5" id="search" placeholder="search" name="search">
      </div>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Username</th>
            <th>Email</th>
            <th>Posting Date</th>
            <th>Last Updation date</th>
            <th>User Type</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>KarinaA</td>
            <td>Karina123@gmail.com</td>
            <td>2021-12-01 00:59:44</td>
            <td> </td>
            <td>
              <span class="badge text-bg-success">Admin</span>
            </td>
            <td><img src="https://cdn-icons-png.flaticon.com/512/1160/1160515.png" alt="edit"
                style="width: 20px; height: 20px" data-toggle="tooltip" title="edit" href="#">
            </td>
            <td>
              <img src="https://cdn-icons-png.flaticon.com/512/6861/6861362.png" alt="delete"
                style="height: 20px;width: 20px" data-toggle="tooltip" title="delete" href="#">
            </td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>akun1234</td>
            <td>akun1234@gmail.com</td>
            <td>2021-12-27 21:35:07</td>
            <td>2021-12-27 21:35:46</td>
            <td>
              <span class="badge text-bg-secondary">Guest</span>
            </td>
            <td><img src="https://cdn-icons-png.flaticon.com/512/1160/1160515.png" alt="edit"
                style="width: 20px; height: 20px" data-toggle="tooltip" title="edit" href="#">
            </td>
            <td>
              <img src="https://cdn-icons-png.flaticon.com/512/6861/6861362.png" alt="delete"
                style="height: 20px;width: 20px" data-toggle="tooltip" title="delete" href="#">
            </td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>haiyo</td>
            <td>haiyoyo@gmail.com</td>
            <td>2022-11-30 15:50:58</td>
            <td>2022-11-30 15:53:45</td>
            <td>
              <span class="badge text-bg-success">Admin</span>
            </td>
            <td><img src="https://cdn-icons-png.flaticon.com/512/1160/1160515.png" alt="edit"
                style="width: 20px; height: 20px" data-toggle="tooltip" title="edit" href="#">
            </td>
            <td>
              <img src="https://cdn-icons-png.flaticon.com/512/6861/6861362.png" alt="delete"
                style="height: 20px;width: 20px" data-toggle="tooltip" title="delete" href="#">
            </td>
          </tr>
          <tr>
            <th scope="row">4</th>
            <td>poopon</td>
            <td>popon@gmail.com</td>
            <td>2021-12-01 20:30:12</td>
            <td> </td>
            <td>
              <span class="badge text-bg-secondary">Guest</span>
            </td>
            <td><img src="https://cdn-icons-png.flaticon.com/512/1160/1160515.png" alt="edit"
                style="width: 20px; height: 20px" data-toggle="tooltip" title="edit" href="#">
            </td>
            <td>
              <img src="https://cdn-icons-png.flaticon.com/512/6861/6861362.png" alt="delete"
                style="height: 20px;width: 20px" data-toggle="tooltip" title="delete" href="#">
            </td>
          </tr>
        </tbody>
      </table>
      <ul class="pagination pagination-sm justify-content-end">
        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li>
      </ul>
    </div>

    <script src="../bootstrap.bundle.js"></script>
</body>

</html>