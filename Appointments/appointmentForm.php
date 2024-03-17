<?php
$doctorID = $_GET['doctor_id'];
$userID = $_GET['userID'];
include('../Configure/config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM doctors WHERE ID = $doctorID";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $doctorName = $row['name'];
} else {
    $doctorName = "Unknown Doctor";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Booking Form</title>
    <link rel="stylesheet" href="formStyles.css">
</head>
<body>
    <?php include('../headerFooter/header.php'); ?>
    <h2 style="text-align: center;">Appointment Booking Form</h2>
    <form action="#" method="POST" class="appointment-form">
        <div><p style="text-align: center; font-weight:bold;">Doctor Name: <?php echo $doctorName; ?></p></div>
        <div class="form-group">
            <label for="chamber">Chamber Name</label>
            <select name="chamber" id="chamber" required>
                <option value="" disabled selected>Select Chamber</option>
                <?php
                $sql = "SELECT c.ID, c.name
                        FROM doctorinchambers cd
                        JOIN chambers c ON cd.chamberID = c.ID
                        WHERE cd.doctorID = $doctorID";

                $result = mysqli_query($conn, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['ID'] . "'>" . $row['name'] . "</option>";
                    }
                } else {
                    echo "<option value='' disabled>No Chambers Found</option>";
                }

                mysqli_close($conn);
                ?>
            </select>
        </div>

        <script>
            document.getElementById('chamber').addEventListener('change', function() {
                var selectedValue = this.value;
                var doctorID = <?php echo $doctorID; ?>; // Get the doctor ID from PHP

                // Send the selected value and doctor ID to the process.php file using AJAX
                var xhttp = new XMLHttpRequest();
                xhttp.open("GET", "process.php?value=" + encodeURIComponent(selectedValue) + "&doctor_id=" + encodeURIComponent(doctorID), true);
                xhttp.send();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var responseElement = document.getElementById("response");
                        responseElement.innerHTML = this.responseText;
                    }
                };
            });
        </script>


        <!-- Display response from PHP -->
        <div id="response">

        </div>

        <div class="form-group">
            <label for="patientName">Patient's Name:</label>
            <input type="text" id="patientName" name="patientName" required>
        </div>
        <div class="form-group">
            <label for="patientAge">Patient's Age:</label>
            <input type="number" id="patientAge" name="patientAge" required>
        </div>
        <div class="form-group">
            <label for="patientAge">Patient's Contact:</label>
            <input type="number" id="patientContact" name="patientAge" required>
        </div>
        <div class="form-group">
            <label for="patientAddress">Patient's Address:</label>
            <textarea id="patientAddress" name="patientAddress" rows="4" required></textarea>
        </div>
        <div class="form-group submitButton"><button type="submit">Submit</button></div>
    </form>
</body>
</html>
