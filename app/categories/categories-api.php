<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi ke database
include '../db.php'; // Pastikan path ke file db.php benar

// Fetch categories
$result = $conn->query("SELECT * FROM categories");

$categories = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    echo json_encode($categories);
} else {
    echo json_encode(['error' => 'Error fetching categories: ' . $conn->error]);
}

// Tutup koneksi database
$conn->close();
?>
