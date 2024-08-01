<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publication_date = $_POST['publication_date'];
    $publisher = $_POST['publisher'];
    $pages = $_POST['pages'];
    $category_id = $_POST['category_id'];

    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_file;
        }
    }

    $sql = "INSERT INTO books (title, author, publication_date, publisher, pages, category_id, image) 
            VALUES ('$title', '$author', '$publication_date', '$publisher', $pages, $category_id, '$image')";

    if ($conn->query($sql) === TRUE) {
        header('Location: list.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="add.css">
    
</head>
<body>
    <h3>Add Book</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <br>
        <label for="author">Author:</label>
        <input type="text" name="author" id="author" required>
        <br>
        <label for="publication_date">Publication Date:</label>
        <input type="date" name="publication_date" id="publication_date" required>
        <br>
        <label for="publisher">Publisher:</label>
        <input type="text" name="publisher" id="publisher" required>
        <br>
        <label for="pages">Pages:</label>
        <input type="number" name="pages" id="pages" required>
        <br>
        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id" required>
            <?php
            $category_result = $conn->query("SELECT id, name FROM categories");
            while ($category = $category_result->fetch_assoc()) {
                echo "<option value='" . $category['id'] . "'>" . $category['name'] . "</option>";
            }
            ?>
        </select>
        <br>
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
        <?php if (!empty($image)): ?>
            <p>Current Image: <img src="<?php echo htmlspecialchars($image); ?>" alt="Current Image" style="max-width: 200px; height: auto;"></p>
        <?php endif; ?>
        <br>
        <input type="submit" value="Add Book">
    </form>
</body>
</html>
