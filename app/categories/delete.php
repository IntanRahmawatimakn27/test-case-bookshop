<?php
include '../db.php';

// Mendapatkan ID kategori dari parameter URL
if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    // Atur ulang category_id pada tabel books menjadi NULL atau ID kategori lain
    $update_query = "UPDATE books SET category_id = NULL WHERE category_id = $category_id";
    if ($conn->query($update_query) === TRUE) {
        // Setelah mengatur ulang category_id, hapus kategori dari tabel categories
        $delete_query = "DELETE FROM categories WHERE id = $category_id";

        if ($conn->query($delete_query) === TRUE) {
            echo "Data kategori berhasil dihapus!";
            header("Location: list.php");
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID kategori tidak diberikan!";
    exit;
}
?>
