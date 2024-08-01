<?php
session_start();
include 'db.php'; // Replace with your actual database connection file

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Check the database for username and password
    $sql = "SELECT * FROM bookshop WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Assuming passwords are hashed, use password_verify
        if ($row && password_verify($password, $row['password'])) {
            // Password is correct
            $_SESSION['username'] = $username;
            header("Location: app/index.php"); // Redirect to the dashboard or another page
        } else {
            // Password is incorrect
            $_SESSION['error'] = "Invalid username or password";
            header("Location: app/index.php"); // Redirect back to the login page
        }
    } else {
        // Query failed
        $_SESSION['error'] = "Database query failed";
        header("Location: ../index.php"); // Redirect back to the login page
    }
} else {
    header("Location: ../index.php"); // Redirect if the form was not submitted
}
?>
