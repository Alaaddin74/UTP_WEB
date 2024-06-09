<?php
    // Menghubungkan ke database
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "car_wash";
    $conn = mysqli_connect($host, $user, $pass, $db);

    // pengkondisian jika gagal menghubungkan ke database
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . $conn->connect_error;
        exit();
    }

?> 