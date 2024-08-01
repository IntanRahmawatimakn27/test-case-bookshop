<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookshop";

// Buat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
