<?php 

    // Enable us to use Headers
    ob_start();

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "emedicare";
    
    $connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.")

?>