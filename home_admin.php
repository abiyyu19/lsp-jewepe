<?php

include "config.php";

// Halaman yang memerlukan pengecekan status login
session_start();
// Memeriksa status login
if (!$_SESSION['status_login']) {
    echo '<script>window.location="login.php"</script>';
}

$username = $_SESSION['username'];
// echo $username;

$query1 = "SELECT COUNT(id_artikel) AS jml_artikel FROM artikel";
$result1 = mysqli_query($conn, $query1);
$row1 = mysqli_fetch_assoc($result1);
$jumlahArtikel = $row1['jml_artikel'];

$query2 = "SELECT COUNT(id_komentar) AS jml_komentar FROM komentar";
$result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_assoc($result2);
$jumlahKomentar = $row2['jml_komentar'];

$query3 = "SELECT COUNT(id_laporan) AS jml_laporan FROM laporan";
$result3 = mysqli_query($conn, $query3);
$row3 = mysqli_fetch_assoc($result3);
$jumlahLaporan = $row3['jml_laporan'];

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

    <title>Dashbord Admin</title>
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
                    <div class="col pt-4">
                        <div class="row mt-4 justify-content-center">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Jumlah Mading</h5>
                                        <p class="card-text">Total Artikel: <?php echo $jumlahArtikel ?></p></br>
                                        <a href="article.php" class="btn btn-primary d-grid">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Jumlah Komentar</h5>
                                        <p class="card-text">Total Komentar: <?php echo $jumlahKomentar ?></p></br>
                                        <a href="comment.php" class="btn btn-primary d-grid">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Jumlah Laporan</h5>
                                        <p class="card-text">Total Laporan: <?php echo $jumlahLaporan ?></p></br>
                                        <a href="report.php" class="btn btn-primary d-grid">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>