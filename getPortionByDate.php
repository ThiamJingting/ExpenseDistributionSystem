<?php

include 'dbconn.php';

$date = $_POST['date'];
$mId = $_POST['memberID'];

$queryPortion = "SELECT Currency, Member_ID ,Member_portion, Exp_ID, Member_paid, Member_owes, Member_paid_SGD FROM expense_table WHERE Date = '$date' AND Member_ID = '$mId'";
$resultPortion = mysqli_query($link, $queryPortion) or die(mysqli_error($link));

$portion = array();
while ($row = mysqli_fetch_assoc($resultPortion)) {
    $portion[] = $row;
}
mysqli_close($link);

echo json_encode($portion);

?>
