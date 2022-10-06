<?php
include 'dbconn.php';

$queryExpense = "SELECT * FROM group_member_kr ";
$resultExpense = mysqli_query($link, $queryExpense) or die(mysqli_error($link));

$expense = array();
while ($row = mysqli_fetch_assoc($resultExpense)) {
    $expense[] = $row;
}
mysqli_close($link);

echo json_encode($expense);

?>
