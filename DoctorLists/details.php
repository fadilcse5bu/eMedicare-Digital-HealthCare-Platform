<?php
if(isset($_GET['doctor_id'])) {
  $doctorID = $_GET['doctor_id'];

  include('../Configure/config.php');

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM doctors WHERE ID = $doctorID";
  $result = $conn->query($sql);
  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $name = $row['name'];
    $degree = $row['degree'];
    $designation = $row['designation'];
    $speciality = $row['speciality'];
    $newCost = $row['newCost'];
    $oldCost = $row['oldCost'];
    $email = $row['email'];
  } 
  else {
    echo "Doctor ID not provided in the URL.";
  }

  $sql2 = "SELECT schedules FROM doctorInChambers WHERE doctorID = $doctorID";
  $result2 = $conn->query($sql2);
  $sql22 = "SELECT helpline FROM doctorInChambers WHERE doctorID = $doctorID";
  $contacts = $conn->query($sql22);
  if ($result2) {
    if ($result2->num_rows > 0) {
        $schedules = array();
        while ($row2 = $result2->fetch_assoc()) {
          $schedules[] = $row2['schedules'];
        }
    } 
    else {
        $schedules = "No schedules found";
    }
  } 
  else {
    $schedules = "Error executing query: " . $conn->error;
  }

  $sql3 = "SELECT name, location FROM chambers WHERE chambers.ID IN 
  (SELECT chamberID FROM doctorInChambers WHERE doctorID = $doctorID)";
  $result3 = $conn->query($sql3);

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Doctor Details</title>
<style>
  .container {
    max-width: 1000px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 100px;
  }
  .doctor-header {
    position: relative;
    height: 200px;
    background-image: url('../images/doctorProfileBackground.jpg');
    background-size: cover;
    background-position: center;
    border-radius: 8px;
  }
  .doctor-image {
    position: absolute;
    top: 70%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background-image: url('../images/male.svg');
    background-image: url('<?php echo ($row['gender'] == "M") ? "../images/male.svg" : "../images/female.svg"; ?>');
    background-size: cover;
    z-index: 1;
  }
  .doctor-details {
    text-align: center;
    background-color: #0a635f;
    margin-top: -2.5%;
    padding: 2%;
    color: white;
    font-size: 110%;
    padding: 0.5%;
    line-height: 140%;
  }
  .doctor-details h2 {
    margin: 0;
    margin-top: 5%;
  }
  .doctor-details p {
    margin: 5px 0;
    
  }
  .details-section {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
  }
  .details-section .left-section,
  .details-section .right-section {
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 8px;
  }
  .details-section .left-section h3,
  .details-section .right-section h3 {
    margin-top: 0;
  }
  .heading {
    text-align: center;
    background-color: #0a635f;
    margin: auto;
    color: white;
    padding: 10px;
  }
  .left-section {
    width: 60%;
  }
  .right-section {
    width: 40%;
  }
  .appointment-section {
    text-align: center;
  }
  .appointment-section p {
    line-height: 30%;
  }
  .appointment-section a{
    text-align: center;
    background-color: #009877;
    margin: auto;
    color: white;
    padding: 10px;
    display: block;
    font-size: 150%;
    text-decoration: none;
  }
  .appointment-section a:hover{
    background-color: white;
    color: black;
    border: 1px solid #0a635f;
  }
  .schedule-container {
    display: flex;
  }
  .left-schedule {
    flex: 1;
  }
  .right-schedule {
    flex: 1;
    padding-left: 10px;
  }
  .address {
    margin-top: 3.5%;
    font-weight: bold;
    margin-bottom: -1%;
    font-size: 110%;
  }
  .schedule-container p {
    line-height: 40%;
  }
</style>
</head>

<body>
<?php include('../headerFooter/header.php'); ?>
<div class="container">
  <div class="doctor-header">
    <div class="doctor-image"></div>
  </div>
  <div class="doctor-details">
    <?php
      echo '<h2>' . $name . '</h2>';
      echo '<p>' . $degree . ' ' . $row['designation'] . '</p>';
      echo '<p>' . $designation . '</p>';
      echo '<hr>';
      echo '<p>' . $speciality . '</p>';
    ?>
  </div>
  <div class="details-section">
    <div class="left-section" style="padding-left: 0px;">
      <h3 class="heading">Chamber Schedule</h3>
      <div>
        <?php
          if (!empty($schedules)) {
            foreach ($schedules as $schedule) {
              $row3 = $result3->fetch_assoc();
              $contact = $contacts->fetch_assoc();
              $scheduleParts = explode(',', $schedule);
              echo '<div class="address">Location: ' . $row3['name'] . ', ' .$row3['location'] . '</div>';
              echo '<div class="schedule-container">';
                echo '<div class="left-schedule">';
                  echo '<p>' . $scheduleParts[0] . '</p>';
                  echo '<p>' . $scheduleParts[1] . '</p>';
                  echo '<p>' . $scheduleParts[2] . '</p>';
                  echo '<p>' . $scheduleParts[3] . '</p>';
                echo '</div>';
                echo '<div class="right-schedule">';
                  echo '<p>' . $scheduleParts[4] . '</p>';
                  echo '<p>' . $scheduleParts[5] . '</p>';
                  echo '<p>' . $scheduleParts[6] . '</p>';
                  echo '<p style="font-size:130%"> Contact: ' . $contact['helpline'] . '</p>';
                echo '</div>';
                echo '<br>';
              echo '</div>';
            }
          } 
          else {
            echo "<p>No schedules found</p>";
          }
        ?>
      </div>
    </div>

    <div class="right-section" style="padding-right:0px">
      <h3 class="heading">Doctor Consultation Fee</h3>
      <?php
        echo '<p style="display: flex; justify-content: space-around; margin-bottom:20%;">';
        echo "<span style='font-weight:bold'>New Patient: " . $newCost . "Tk </span>";
        echo "<span style='font-weight:bold'>Old Patient: " . $oldCost . "Tk </span>";
        echo '</p>';     
      ?>
      <div class="appointment-section">

      <a href="#" onclick="checkLogin(<?php echo $doctorID ?>)">Book Appointment</a>
        <script>
            function checkLogin(doctorID) {
                if (isLoggedIn()) {
                    var userID = <?php echo isset($_SESSION['id']) ? $_SESSION['id'] : 'null'; ?>;
                    window.location.href = '../Appointments/appointmentForm.php?doctor_id=' + doctorID + '&userID=' + userID;
                } else {
                    window.location.href = '../userAuthentication/index.php';
                }
            }
            function isLoggedIn() {
                return <?php echo isset($_SESSION['id']) ? 'true' : 'false'; ?>;
            }
        </script>

      </div>
    </div>
  </div>
</div>
</body>
</html>
