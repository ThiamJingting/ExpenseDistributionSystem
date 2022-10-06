<?php
include 'dbconn.php';

$queryCurrency = "SELECT DISTINCT Currency FROM expense_table";
$resultCurrency = mysqli_query($link, $queryCurrency) or die(mysqli_error($link));

$currency = array();
while ($row = mysqli_fetch_assoc($resultCurrency)) {
    $currency[] = $row;
}
mysqli_close($link);

echo json_encode($currency);
?>
