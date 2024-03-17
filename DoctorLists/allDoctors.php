<?php
    include('../Configure/config.php');

    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM doctors";

    $result = $conn->query($sql);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    $serializedData = serialize($rows);
    header("Location: ../DoctorLists/doctorLists.php?data=" . urlencode($serializedData));
    exit;
?>