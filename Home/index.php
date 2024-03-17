<?php
  include('../Configure/config.php');
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $location = $_POST["location"];
      $specialist = $_POST["specialist"];
      $gender = $_POST["gender"];

      $sql = "SELECT DISTINCT d.* FROM doctors d";

        if (!empty($location) || !empty($specialist) || !empty($gender)) {
            $sql .= " INNER JOIN doctorInChambers dic ON d.ID = dic.doctorID
                    INNER JOIN chambers c ON dic.chamberID = c.ID
                    WHERE 1=1";
        }

        if (!empty($location)) {
            $location = mysqli_real_escape_string($conn, $location);
            $sql .= " AND c.name = '$location'";
        }
        if (!empty($specialist)) {
            $specialist = mysqli_real_escape_string($conn, $specialist);
            $sql .= " AND d.speciality LIKE '%$specialist%'";
        }
        if (!empty($gender)) {
            $sql .= " 3AND d.gender = '$gender'";
        }
   

      $result = $conn->query($sql);
      $rows = $result->fetch_all(MYSQLI_ASSOC);
      $serializedData = serialize($rows);
      header("Location: ../DoctorLists/doctorLists.php?data=" . urlencode($serializedData));
      exit;
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<title>Find Doctor</title>
</style>
</head>
<body>
<?php include('../headerFooter/header.php'); ?>

<div class="container">
  <h1>Find Doctor</h1>
  <form class="search-form" id="searchForm" method="post">
    <div class="filter-container">
      <label for="locationSelect">Select Location</label>
      <select class="filter-select" id="locationSelect" name="location">
        <option value="" <?php if(isset($_POST['location']) && $_POST['location'] === '') echo 'selected'; ?>>Any Location</option>
        <?php
            $sql2 = "SELECT DISTINCT name FROM chambers ORDER BY name";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $name = $row2['name'];
                    echo "<option value='$name'";
                    if (isset($_POST['location']) && $_POST['location'] === $name) {
                        echo ' selected';
                    }
                    echo ">$name</option>";
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        ?>
      </select>
    </div>

    <div class="filter-container">
        <label for="specialistSelect">Select Specialist</label>
        <select class="filter-select" id="specialistSelect" name="specialist">
            <option value="" <?php if(isset($_POST['specialist']) && $_POST['specialist'] === '') echo 'selected'; ?>>Any Specialist</option>
            <?php
            $sql = "SELECT DISTINCT speciality FROM doctors";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $uniqueSpecialties = [];
                while ($row = mysqli_fetch_assoc($result)) {
                    $specialties = explode(',', $row['speciality']);
                    foreach ($specialties as $specialty) {
                        $specialty = trim($specialty);
                        if (!in_array($specialty, $uniqueSpecialties)) {
                            $uniqueSpecialties[] = $specialty;
                        }
                    }
                }
                sort($uniqueSpecialties);
                foreach ($uniqueSpecialties as $specialty) {
                    echo "<option value='$specialty'";
                    if (isset($_POST['specialist']) && $_POST['specialist'] === $specialty) {
                        echo ' selected';
                    }
                    echo ">$specialty</option>";
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            mysqli_close($conn);
            ?>
        </select>
    </div>

    <div class="filter-container">
      <label for="gender">Select Gender</label>
      <select class="filter-select" id="gender" name="gender">
        <option value="" <?php if(isset($_POST['gender']) && $_POST['gender'] === '') echo 'selected'; ?>>Any</option>
        <option value="M" <?php if(isset($_POST['gender']) && $_POST['gender'] === 'M') echo 'selected'; ?>>Male</option>
        <option value="F" <?php if(isset($_POST['gender']) && $_POST['gender'] === 'F') echo 'selected'; ?>>Female</option>
      </select>
    </div>

    <div class="filter-container">
      <button type="submit" class="search-btn" id="search">Search</button>
    </div>
  </form>
</div>
<div class="footer">
        All Rights Reserved to emedicare
    </div>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Get login form container
    var loginForm = document.getElementById("loginForm");
  });

</script>

</body>
</html>
