<?php
//konfigurasi data base

$host = "localhost";
$username = "root";
$password = "";
$database = "bookshop";

$koneksi = mysqli_connect($host, $username, $password, $database);

if($koneksi) {
    echo "database terhubung";
}else {
    echo "database error";
}
?>