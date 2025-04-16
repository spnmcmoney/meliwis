<?php
    require_once('../config/helper.php');
    require_once('../config/koneksi.php');

    $username = $_POST['username'];
    $password = ($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    

    if(mysqli_num_rows($query) != 0) {
        $row = mysqli_fetch_assoc($query);

        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        if($row['role'] == 'admin'){
            header("location: " . BASE_URL . 'pages/dashboard.php?page=admin');
        } else if($row['role'] == 'user'){
            header("location: " . BASE_URL . 'pages/dashboard.php?page=user');
        }
    } else {
        header("location: " . BASE_URL);
    }
?> 