<?php

include 'dbconn.php';

$date = $_POST['date'];
$mId = $_POST['memberID'];

$queryExpense = "SELECT SUM(Member_paid) as Amount, Currency FROM expense_table WHERE Date = '$date' AND Member_ID = '$mId' ";
$resultExpense = mysqli_query($link, $queryExpense) or die(mysqli_error($link));

$expense = array();
while ($row = mysqli_fetch_assoc($resultExpense)) {
    $expense[] = $row;
}
mysqli_close($link);

echo json_encode($expense);
?>
