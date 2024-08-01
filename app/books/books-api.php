<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi ke database
include '../db.php'; // Pastikan path ke file db.php benar

// Handle filtering logic
$filter_query = "";
if (isset($_GET['category_id']) && $_GET['category_id'] !== '') {
    $category_id = intval($_GET['category_id']);
    $filter_query = " WHERE category_id=$category_id";
} elseif (isset($_GET['search_text']) && !empty($_GET['search_text'])) {
    $search_text = $conn->real_escape_string($_GET['search_text']);
    $filter_query = " WHERE title LIKE '%$search_text%' OR author LIKE '%$search_text%' OR publisher LIKE '%$search_text%'";
}

// Fetch books based on filter
$result = $conn->query("SELECT * FROM books" . $filter_query);

$books = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
    echo json_encode($books);
} else {
    echo json_encode(['error' => 'Error fetching books: ' . $conn->error]);
}

// Tutup koneksi database
$conn->close();
?>
