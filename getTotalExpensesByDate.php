<?php

include 'dbconn.php';

$date = $_GET['date'];

$queryExpense = "SELECT DISTINCT Amt, Exp_ID ,Currency FROM expense_table WHERE Date = '$date'";
$resultExpense = mysqli_query($link, $queryExpense) or die(mysqli_error($link));

$expense = array();
while ($row = mysqli_fetch_assoc($resultExpense)) {
    $expense[] = $row;
}
mysqli_close($link);

echo json_encode($expense);
?>
