<?php
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM categories WHERE id=$id");
    $category = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $sql = "UPDATE categories SET name='$name' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        // Redirect to the categories page
        header("Location: list.php?message=success");
        exit();
    } else {
        echo "<div class='message error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="update.css"> <!-- Include your CSS file -->
</head>
<body>
    <div class="container">
        <h3>Edit Category</h3>
        <form method="post" action="">
            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
            </div>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($category['id']); ?>">
            <input type="submit" value="Update Category" class="btn-submit">
        </form>
    </div>
</body>
</html>
