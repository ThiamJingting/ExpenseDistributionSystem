<?php

include 'dbconn.php';

$queryExpense = "SELECT DISTINCT e.Exp_ID, e.Description,e.Date,e.Type,e.Amt, e.Currency, e.Exchange_rate, "
        . "e.SGD, e.Member_ID, e.Member_portion, e.Member_paid, e.Member_owes, e.Member_paid_SGD, e.Remark, m.Members from expense_table_kr e, group_member_kr m "
        . "WHERE e.Member_ID = m.Member_ID ORDER BY Exp_ID ASC";
$resultExpense = mysqli_query($link, $queryExpense) or die(mysqli_error($link));


$expense = array();
while ($row = mysqli_fetch_assoc($resultExpense)) {
    $expense[] = $row;
}
mysqli_close($link);

echo json_encode($expense);
?>
