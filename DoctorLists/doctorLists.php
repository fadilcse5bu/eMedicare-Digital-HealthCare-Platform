<?php
  $serializedData = urldecode($_GET['data']);
  $rows = unserialize($serializedData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="doctorListsStyles.css">
<title>Search Results</title>
</head>
<body>

<?php include('../headerFooter/header.php'); ?>
<div class="container">
  <h1 style="text-align: center">Search Results</h1>
  
  <?php
  foreach ($rows as $row) {
    echo '<div class="list">';
    echo '<a href="details.php?doctor_id=' . $row["ID"] . '" class="detailsLink">';
    echo '<div style="display: flex; align-items: center;">';
    if($row["gender"] == "M") {echo '<div style="flex-shrink: 0"><img src="../images/male.svg"></div>';}
    else {echo '<div style="flex-shrink: 0"><img src="../images/female.svg"></div>';}
    echo '<div style="margin-left: 10px">';
    echo '<h2>' . $row["name"] . '</h2>';
    echo '<p class="speciality">' . $row["speciality"] .'</p>';
    echo '<p> ' . $row["degree"] . '</p>';
    echo '</div>';
    echo '</div></a>';
    echo '</div>';
  }
  ?>
</div>

</body>
</html>
