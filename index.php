<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

  <!-- My CSS -->
  <link rel="stylesheet" href="templates/css/style.css">

  <title>JeWePe Website</title>
</head>

<body>
  <?php
  include "user/header.php";
  ?>

  <div class="search-container">
    <form action="#">
      <input type="text" placeholder="Cari Artikel" name="search">
    </form>
  </div>

  <div class="container" style="text-decoration-line: underline; text-decoration-skip-ink: none; text-underline-offset: 15px;">
    <h1>Terpopuler</h1>
  </div>

  <div class="container" style="margin-top: 100px; display: flex; flex-basis: 33.33%">
    <?php

    for ($i = 1; $i <= 3; $i++) {
      include "user/content.php";
    }
    ?>
  </div>

  <div class="container" style="margin-top: 30px; text-decoration-line: underline; text-decoration-skip-ink: none; text-underline-offset: 15px;">
    <h2>Arikel Lainnya</h2>
  </div>

  <div class="container" style="margin-top: 30px; margin-bottom: 50px">
    <?php
    for ($i = 1; $i <= 3; $i++) {
      include "user/content_next.php";
    }
    ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>