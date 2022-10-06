<?php

include 'dbconn.php';

if (isset($_POST['exp_id']) && isset($_POST['description']) && isset($_POST['date']) && isset($_POST['type']) && isset($_POST['amt']) && isset($_POST['currency']) && isset($_POST['exchange_rate']) && isset($_POST['sgd']) && isset($_POST['memberId']) && isset($_POST['memberPort']) && isset($_POST['memberPaid']) && isset($_POST['memberOwes']) && isset($_POST['memberPaidSGD']) && isset($_POST['remark']) && isset($_POST['memberOwes']) && isset($_POST['memberPaidSGD'])) {
    $expId = $_POST['exp_id'];
    $desc = $_POST['description'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $amt = $_POST['amt'];
    $currency = $_POST['currency'];
    $exchange_rate = $_POST['exchange_rate'];
    $sgd = $_POST['sgd'];
    $memberId = $_POST['memberId'];
    $memberPort = $_POST['memberPort'];
    $memberPaid = $_POST['memberPaid'];
    $memberOwe = $_POST['memberOwes'];
    $memberPaidSGD = $_POST['memberPaidSGD'];
    $remark = $_POST['remark'];

    $checkIfExistQuery = "SELECT * FROM expense_table WHERE Exp_ID = '$expId' and Member_ID = '$memberId'";
    $result = mysqli_query($link, $checkIfExistQuery);
    if ($result) {
        $rowcount = mysqli_num_rows($result);
        if ($rowcount == 0) {
            $query = "INSERT INTO expense_table(Exp_ID, Description, Date, Type, Amt, Currency, Exchange_rate, SGD, Member_ID, Member_portion, Member_paid, Member_owes, Member_paid_SGD , Remark) VALUES ('$expId', '$desc', '$date', '$type', '$amt', '$currency', '$exchange_rate', '$sgd', '$memberId', '$memberPort', '$memberPaid', '$memberOwe', '$memberPaidSGD' ,'$remark');";
            $response['insert'] = true;
            $result = mysqli_query($link, $query);
        } else {
            $query = "UPDATE expense_table SET Exp_ID = '$expId', Member_ID = '$memberId' ,Description = '$desc', Date = '$date', Type = '$type', Amt = '$amt', Currency = '$currency', Exchange_rate = '$exchange_rate', SGD = '$sgd', Member_portion = '$memberPort', Member_paid = '$memberPaid', Member_owes = '$memberOwe', Member_paid_SGD = '$memberPaidSGD' ,Remark = '$remark' WHERE Exp_ID = '$expId' and Member_ID = '$memberId'";
            $response['update'] = true;
            $result = mysqli_query($link, $query);
        }
        $response['status'] = 1;
    }
    echo json_encode($response);
} else {
    $response['status'] = 0;
    $response['error'] = "Missing parameters";
    echo json_encode($response);
}
?>
