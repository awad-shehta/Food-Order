<?php
    session_start();
    define("SITEURL", "http://localhost/projects/test/");
    define("LOCALHOST", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DB_NAME", "food_order");
    $conn = mysqli_connect(LOCALHOST, USERNAME, PASSWORD) or die(mysqli_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
?>