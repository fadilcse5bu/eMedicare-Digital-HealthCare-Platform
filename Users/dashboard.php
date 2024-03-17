<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="dashboardStyle.css"> <!-- Link to your CSS file -->
</head>
<body>
<?php include('../headerFooter/header.php'); ?>
<?php
    include('../Configure/config.php');

    $conn = new mysqli($servername, $username, $password, $dbname);
    if(!isset($_SESSION['id'])) {
        header("Location: ../Home/index.php");
        exit;
    }
    $userID = $_SESSION['id'];
    $sql = "SELECT * FROM users where id = $userID";

    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $serializedData = serialize($rows);
?>

    <div class="container">
        <div class="left-sidebar">
            <h2><?php echo $rows[0]['firstname'].' '. $rows[0]['lastname']?></h2>
            <p style="margin-top: -1.3rem;"><?php echo $rows[0]['email']?></p>
            <a href="../userAuthentication/logout.php">Logout</a>
        </div>
        <div class="right-sidebar">
            <h2>All Appointments</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>SL No.</th>
                        <th>Doctor</th>
                        <th>Patient</th>
                        <th>Chamber</th>
                        <th>Prescription</th>
                    </tr>
                </thead>
                <!--
                <tbody>
                    <tr>
                        <td>January 15, 2024</td>
                        <td>10:00 AM</td>
                        <td>1</td>
                        <td><a href="#">F.R. Khan</a></td>
                        <td><a href="#">Saidul</a></td>
                        <td><a href="#">Rahat Anwar</a></td>
                        <td>
                            <a href="#">View</a><br>
                        </td>
                    </tr>
                    <tr>
                        <td>January 15, 2024</td>
                        <td>10:00 AM</td>
                        <td>1</td>
                        <td><a href="#">Towkia</a></td>
                        <td><a href="#">Fadil</a></td>
                        <td><a href="#">Royal City</a></td>
                        <td>
                            <a href="#">View</a><br>
                        </td>
                    </tr>

                </tbody>
                -->
            </table>
        </div>
    </div>
</body>
</html>
