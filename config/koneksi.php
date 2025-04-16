<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "meliwis";

    $conn = mysqli_connect($server, $username, $password, $dbname);
    
    if(!$conn){
        die("Koneksi Gagal");
    }
?>