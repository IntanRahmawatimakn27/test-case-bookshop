<?php
include '../db.php';

// Create the uploads directory if it doesn't exist
$uploads_dir = '../uploads';
if (!is_dir($uploads_dir)) {
    mkdir($uploads_dir, 0777, true);
}

// Mendapatkan ID buku dari parameter URL
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Mendapatkan data buku dari database
    $book_result = $conn->query("SELECT * FROM books WHERE id = $book_id");
    $book = $book_result->fetch_assoc();

    if (!$book) {
        echo "Buku tidak ditemukan!";
        exit;
    }
} else {
    echo "ID buku tidak diberikan!";
    exit;
}

// Mengupdate data buku saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $author = $conn->real_escape_string($_POST['author']);
    $publication_date = $conn->real_escape_string($_POST['publication_date']);
    $publisher = $conn->real_escape_string($_POST['publisher']);
    $pages = (int)$_POST['pages'];
    $category_id = (int)$_POST['category_id'];
    
    // Default image to current image if not uploaded
    $image = $book['image'];

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_name = basename($_FILES['image']['name']);
        $image_path = $uploads_dir . '/' . $image_name;

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($image_tmp_name, $image_path)) {
            $image = $image_name;
        } else {
            echo "Gagal mengunggah gambar!";
            exit;
        }
    }

    $update_query = "UPDATE books SET 
                        title = '$title', 
                        author = '$author', 
                        publication_date = '$publication_date', 
                        publisher = '$publisher', 
                        pages = $pages, 
                        category_id = $category_id, 
                        image = '$image'
                     WHERE id = $book_id";

    if ($conn->query($update_query) === TRUE) {
        header("Location: list.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="edit_book.css">
</head>
<body>
    <h3>Edit Book</h3>
    <form method="post" action="edit_book.php?id=<?php echo $book_id; ?>" enctype="multipart/form-data" class="edit-form">
        <label for="title">Judul:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
        
        <label for="author">Penulis:</label>
        <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
        
        <label for="publication_date">Tanggal Publikasi:</label>
        <input type="date" id="publication_date" name="publication_date" value="<?php echo htmlspecialchars($book['publication_date']); ?>" required>
        
        <label for="publisher">Penerbit:</label>
        <input type="text" id="publisher" name="publisher" value="<?php echo htmlspecialchars($book['publisher']); ?>" required>
        
        <label for="pages">Jumlah Halaman:</label>
        <input type="number" id="pages" name="pages" value="<?php echo htmlspecialchars($book['pages']); ?>" required>
        
        <label for="category_id">Kategori:</label>
        <select id="category_id" name="category_id" required>
            <?php
            $category_result = $conn->query("SELECT id, name FROM categories");
            while ($category = $category_result->fetch_assoc()) {
                $selected = $book['category_id'] == $category['id'] ? 'selected' : '';
                echo "<option value='" . $category['id'] . "' $selected>" . htmlspecialchars($category['name']) . "</option>";
            }
            ?>
        </select>
        
        <label for="image">Gambar:</label>
        <input type="file" id="image" name="image">
        <?php if (!empty($book['image'])): ?>
            <p>Gambar saat ini: <img src="../uploads/<?php echo htmlspecialchars($book['image']); ?>" alt="Current Image" style="max-width: 200px; height: auto;"></p>
        <?php endif; ?>
        
        <input type="submit" value="Update">
    </form>
</body>
</html>
