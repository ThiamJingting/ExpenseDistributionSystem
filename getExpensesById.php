<?php

include 'dbconn.php';

$id = $_GET['exp_id'];

$queryExpense = "SELECT DISTINCT * from expense_table WHERE Exp_ID = $id";
$resultExpense = mysqli_query($link, $queryExpense) or die(mysqli_error($link));


$expense = array();
while ($row = mysqli_fetch_assoc($resultExpense)) {
    $expense[] = $row;
}
mysqli_close($link);

echo json_encode($expense);
?>
