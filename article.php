<?php

include "config.php";

// Halaman yang memerlukan pengecekan status login
session_start();
// Memeriksa status login
if (!$_SESSION['status_login']) {
  echo '<script>window.location="login.php"</script>';
}
// echo $_SESSION["id_admin"];

// echo $_POST['id_artikel'];

$username = $_SESSION['username'];


if (isset($_POST['delete'])) {
  $id_admin = $_SESSION['id_admin'];
  $id_artikel = $_GET['id_artikel'];
  // echo $id_admin;
  // echo $row['id_artikel'];
  // echo $_GET['id_artikel'];
  // echo $id_artikel;


  // Query untuk menyimpan data ke dalam database
  $query = "DELETE FROM artikel WHERE id_artikel = '$id_artikel'";

  // Eksekusi query
  if (mysqli_query($conn, $query)) {
    // echo '<script>alert("Artikel berhasil dihapus.")</script>';
    // echo "artikel yg dihapus memiliki id" . $id_artikel;
    // echo '<script>window.location="article.php"</script>';
  } else {
    echo '<script>alert("Artikel Gagal dihapus")</script>';
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }

  // Menutup koneksi ke database
  // mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- My CSS -->
  <link rel="stylesheet" href="templates/css/style.css">

  <title>Artikel</title>
</head>

<body>
  <div class="container-fluid">
    <div class="row flex-nowrap">
      <div class="col-auto col-md-3 col-xl-2 px-sm-5 bg-dark">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-2 pt-2 text-white min-vh-100">
          <a href="/jewepe/home_admin.php" class="d-flex align-items-center mt-4 mb-md-4 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline" style="font-size: 250px">JeWePe</span>
          </a>
          <ul class="nav nav-pills flex-column mb-sm-auto align-items-center align-items-sm-start border-top" id="menu">
            <li class="nav-item">
              <a href="/jewepe/article.php" class="nav-link align-middle px-0 text-white">
                <i class="fs-4 bi-file-text"></i> <span class="ms-1 d-none d-sm-inline">Artikel</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="/jewepe/comment.php" class="nav-link align-middle px-0 text-white">
                <i class="fs-4 bi-chat-left-text"></i> <span class="ms-1 d-none d-sm-inline">Komentar</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="/jewepe/report.php" class="nav-link align-middle px-0 text-white">
                <i class="fs-4 bi-file-earmark-bar-graph"></i> <span class="ms-1 d-none d-sm-inline">Laporan</span>
              </a>
            </li>
            <li class="nav-item">
              <a onclick="return confirm('Anda Ingin Keluar?')" href="logout.php?logout=true" class="nav-link align-middle px-0 text-white">
                <i class="fs-4 bi-box-arrow-right"></i> <span class="ms-1 d-none d-sm-inline">Logout</span>
              </a>
            </li>
          </ul>
          <hr>
        </div>
      </div>
      <div class="col py-3 px-4">
        <header class="row bg-dark py-3">
          <div class="col d-flex text-white h2"> Hello, <?php echo $username ?></div>
          <div class="col-1">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
              <span class="d-none d-sm-inline mx-1"><?php echo $username ?></span>
            </a>
          </div>
        </header>

        <main class="row overflow-auto">
          <div class="col-12 mb-4">
            <a class="btn btn-success btn-lg float-end mt-4 me-4" href="/jewepe/add_article.php" role="button">Tambah + </a>
          </div>
          <?php
          // Query untuk mendapatkan data artikel dari database
          $query = "SELECT * FROM artikel";
          $result = mysqli_query($conn, $query);

          // Perulangan untuk menampilkan data artikel
          while ($row = mysqli_fetch_assoc($result)) {
            $id_artikel = $row['id_artikel'];
            $judul = $row['judul'];
            $deskripsi = $row['deskripsi'];
            $gambar = base64_encode($row['gambar']);
          ?>
            <div class="col-12">
              <div class="card border rounded border-dark">
                <div class="row g-0">
                  <div class="col-md-2 xl-1">
                    <img src="data:image/jpeg;base64,<?php echo $gambar; ?>" class="img-thumbnail" style="width: 200px; height: 200px;" alt=" Gambar Artikel">
                  </div>
                  <div class=" col-md-9 xl-8">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $judul; ?></h5>
                      <p class="card-text"><?php echo $deskripsi; ?></p>
                    </div>
                  </div>
                  <div class="col-md-1 xl-1 position-absolute top-50 end-0 translate-middle-y">
                    <form method="post" action="article.php?id_artikel=<?php echo $id_artikel; ?>">
                      <button onclick="return confirm('Apakah anda yakin?')" type="submit" class="btn btn-danger" name="delete">Hapus</button>
                    </form>
                  </div>
                  <?php
                  ?>
                </div>
              </div>
            </div>
          <?php
          }
          // Menutup koneksi ke database
          mysqli_close($conn);
          ?>
        </main>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>