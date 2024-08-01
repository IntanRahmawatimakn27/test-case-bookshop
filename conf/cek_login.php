<?php

include 'konfirmasi.php';

if (isset($_POST['login'])) {
    $user = mysqli_real_escape_string($koneksi, $_POST['username']);
    $pass = mysqli_real_escape_string($koneksi, $_POST['password']);
    $pass = md5($pass);

    $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");

    $data = mysqli_fetch_array($query);
    $username = $data['username'];
    $password = $data['password'];
    $level = $data['level'];

    if ($user==$username && $pass==$password) {
        session_start();
        $_SESSION['nama'] = $username;
        $_SESSION['level'] = $level;

        if ($level == 'admin') {
            header('Location: ../app/index.php');
            exit();
        } else {
            header('Location: /app/guest/home.php');
            exit();
        }
    } else {
        header('Location: ../app/index.php');
        exit();
    }
}

?>