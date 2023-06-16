<?php
include "config.php";

// Halaman yang memerlukan pengecekan status login
session_start();
// Memeriksa status login
if (!$_SESSION['status_login']) {
  echo '<script>window.location="login.php"</script>';
}

// echo $_SESSION["id_admin"];

$username = $_SESSION['username'];

if (isset($_POST['submit'])) {
  // Mendapatkan data dari form
  $judul = $_POST['judul'];
  $deskripsi = $_POST['deskripsi'];
  $penulis = $_POST['penulis'];
  $gambar = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));
  $created_at = date('Y-m-d H:i:s');
  $id_admin = $_SESSION['id_admin'];

  // Query untuk menyimpan data ke dalam database
  $query = "INSERT INTO artikel (judul, deskripsi, penulis, gambar, created_at, id_admin) VALUES ('$judul', '$deskripsi', '$penulis', '$gambar', '$created_at', '$id_admin')";

  // Eksekusi query
  if (mysqli_query($conn, $query)) {
    echo "Artikel berhasil ditambahkan.";
    echo '<script>alert("Artikel berhasil ditambahkan.")</script>';
    echo '<script>window.location="article.php"</script>';
  } else {
    echo '<script>alert("Artikel Gagal ditambahkan")</script>';
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
  }

  // Menutup koneksi ke database
  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Artikel</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- My CSS -->
  <link rel="stylesheet" href="templates/css/style.css">
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
          <div class="container mt-4">
            <h1 class="text-center">Tambah Artikel</h1>
            <form action="add_article.php" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="judul" class="form-label h4">Judul</label>
                <input type="text" class="form-control border rounded border-dark" id="judul" name="judul" required>
              </div>
              <div class="mb-3">
                <label for="deskripsi" class="form-label h4">Deskripsi</label>
                <textarea class="form-control form-control-lg border rounded border-dark" id="deskripsi" name="deskripsi" required></textarea>
              </div>
              <div class="mb-3">
                <label for="penulis" class="form-label h4">Penulis</label>
                <input type="text" class="form-control border rounded border-dark" id="penulis" name="penulis" required>
              </div>
              <div class="mb-3">
                <label for="gambar" class="form-label h4">Gambar</label>
                <input type="file" class="form-control border rounded border-dark" id="gambar" name="gambar" required>
              </div>
              <button type="submit" class="btn btn-primary" name="submit">Tambah Artikel</button>
            </form>
          </div>
        </main>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>