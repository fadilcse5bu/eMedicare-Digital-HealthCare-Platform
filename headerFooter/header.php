<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="UTF-8">
<title>Page Title</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .headerAll {
        z-index: 1000;
        width: 100%;
        position: sticky;
        top: 0;
    }

    .mini-header {
        background-color: #0a635f;
        color: white;
        padding: 6px;
        font-size: 12px;
    }
    .mini-header-container {
        display: flex;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
    }

    .main-header {
        background-color: white;
        border: 2px solid white;
        box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2);
        margin-bottom: 40px;
    }

    .main-header-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .main-header-container nav {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .main-header-container nav ul {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .main-header .navbar-header ul {
        list-style-type: none;
    }

    .main-header .navbar-header ul li {
        display: inline;
        padding: 0 15px;
    }

    .main-header .navbar-header ul li a {
        color: #0a635f;
        font-size: large;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .main-header .navbar-header ul li a:hover {
        border-bottom: 2px solid #0a635f;
    }
    .footer {
        width: 100%;
        background-color: gray;
        position: fixed;
        bottom: 0;
        padding: 20px;
        text-align: center;
        color: white;
        z-index: 1111;
    }
</style>
</head>
<body>

<div class="headerAll">
    <header class="mini-header">
    <div class="mini-header-container">
        <span>Email: emedicare@info</span>
        <span>Contact: 01703331096</span>
    </div>
    </header>

    <header class="main-header">
    <div class="main-header-container">
        <nav class="navbar-header">
            <ul>
                <li><a href="../Home/index.php">Home</a></li>
                <li><a href="../DoctorLists/allDoctors.php">All Doctors</a></li>
                <?php 
                    if(!isset($_SESSION['id'])) {
                        echo "<li><a href='../userAuthentication/index.php' id='loginBtn'>Login</a></li>";
                    }
                    else {
                        echo "<li><a href='../users/dashboard.php' id='loginBtn'>Dashboard</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </div>

    </header>
</div>
<div class="footer">
    All Rights Reserved to emedicare
</div>
</body>
</html>
