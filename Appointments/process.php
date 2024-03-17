<?php
  include('../Configure/config.php');

$conn = new mysqli($servername, $username, $password, $dbname);
if(isset($_GET['value']) && isset($_GET['doctor_id'])) {
    $selectedChamberID = $_GET['value'];
    $doctorID = $_GET['doctor_id'];

    $sql = "SELECT schedules FROM doctorinchambers WHERE doctorID = $doctorID AND chamberID = $selectedChamberID";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $visitingDaysString = $row['schedules'];
        $visitingDaysArray = explode(", ", $visitingDaysString);
        $currentDayOfWeek = date("w");
        $nextDay = "";
        for ($i = $currentDayOfWeek + 2; $i <= 6; $i++) {
            list($day, $timeRange) = explode(" => ", $visitingDaysArray[$i]);
            if($timeRange !== "Closed") {
                $nextDay = $day;
                break;
            }
        }
        if($nextDay == "") {
            $i = 0;
            if($currentDayOfWeek == 6) $i = 0;
            for ($i = 1; $i <= $currentDayOfWeek; $i++) {
                list($day, $timeRange) = explode(" => ", $visitingDaysArray[$i]);
                if($timeRange !== "Closed") {
                    $nextDay = $day;
                    break;
                }
            }
        }   
        echo "<div>";
        echo "<label>Visiting Day</label>";
        echo "<p style='border:2px solid black; border-radius:4px; padding:7px; margin-top:5px'>$nextDay</p>";
        echo "</div>";

        $currentDate = date('d-m-Y');
        $nextDate = date('d-m-Y', strtotime("next $nextDay", strtotime($currentDate)));

        echo "<div>";
        echo "<label>Visiting Date</label>";
        echo "<p style='border:2px solid black; border-radius:4px; padding:7px; margin-top:5px'>$nextDate</p>";
        echo "</div>";

        
    } else {
        echo "<option value='' disabled>No available days</option>";
    }
} else {
    echo "Error: Required parameters are missing.";
}
?>
