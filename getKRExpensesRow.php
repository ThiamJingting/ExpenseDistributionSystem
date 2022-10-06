<?php
include 'dbconn.php';

$queryTrip = "SELECT DISTINCT Exp_ID,Type, Currency, Date, Amt, Description FROM expense_table_kr ORDER BY Exp_ID ASC";
$resultTrip = mysqli_query($link, $queryTrip) or die(mysqli_error($link));

$trips = array();
while ($row = mysqli_fetch_assoc($resultTrip)) {
    $trips[] = $row;
}
mysqli_close($link);

echo json_encode($trips);

?>