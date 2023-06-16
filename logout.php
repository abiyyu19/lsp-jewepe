<?php
session_start(); // Mulai session

// Cek apakah tombol logout ditekan
if (isset($_GET['logout'])) {
  // Hapus semua session
  session_unset();
  // Hancurkan session
  session_destroy();
  // Redirect ke halaman login atau halaman lain yang diinginkan
  header("Location: login.php");
  exit();
}
