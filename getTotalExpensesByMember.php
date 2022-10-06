<?php

include 'dbconn.php';

$mId = $_POST['memberID'];
$currency = $_POST['currency'];


$queryExpense = "SELECT DISTINCT Member_ID, SUM(Member_paid) as mPaid ,SUM(Member_owes) as mOwes ,Currency FROM expense_table WHERE Member_ID = $mId AND Currency = '$currency'";
$resultExpense = mysqli_query($link, $queryExpense) or die(mysqli_error($link));

$expense = array();
while ($row = mysqli_fetch_assoc($resultExpense)) {
    $expense[] = $row;
}
mysqli_close($link);

echo json_encode($expense);
?>
