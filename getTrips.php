<?php
include 'dbconn.php';

$queryTrip = "SELECT Trip from password_table";
$resultTrip = mysqli_query($link, $queryTrip) or die(mysqli_error($link));

$trips = array();
while ($row = mysqli_fetch_assoc($resultTrip)) {
    $trips[] = $row;
}
mysqli_close($link);

echo json_encode($trips);
?>