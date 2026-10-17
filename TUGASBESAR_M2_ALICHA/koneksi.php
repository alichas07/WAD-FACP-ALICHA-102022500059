<?php
$host     = "127.0.0.1";
$port     = 3308;
$user     = "root";
$password = "";
$database = "db_lapangan";

// Tambahkan $port pada parameter ke-5
$koneksi = mysqli_connect($host, $user, $password, $database, $port);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>