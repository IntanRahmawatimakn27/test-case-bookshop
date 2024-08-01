<?php
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = $_POST['name'];
    $sql = "INSERT INTO categories (name) VALUES ('$category')";

    if ($conn->query($sql) === TRUE) {
        header("Location: list.php");
        exit();
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
    <title>Add Data</title>
    <link rel="stylesheet" href="add_categories.css">
</head>
<body>
    <div class="container">
        <h3>Add Category</h3>
        <form action="add.php" method="post" class="form">
            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-add">Add Category</button>
            <a href="list.php" class="btn btn-secondary">Back to List</a>
        </form>
    </div>
</body>
</html>
