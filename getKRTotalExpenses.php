<?php

include 'dbconn.php';

$currency = $_POST['currency'];
$queryExpense = "SELECT SUM(Member_portion) as totalAmt, Currency FROM expense_table_kr WHERE Currency = '$currency'";
$resultExpense = mysqli_query($link, $queryExpense) or die(mysqli_error($link));

$expense = array();
while ($row = mysqli_fetch_assoc($resultExpense)) {
    $expense[] = $row;
}
mysqli_close($link);

echo json_encode($expense);

?>
