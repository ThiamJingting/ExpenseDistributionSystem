<?php

include 'dbconn.php';

if (isset($_POST['trip']) && isset($_POST['password'])) {
    $trip = $_POST['trip'];
    $password = $_POST['password'];

    $query = "SELECT Trip, Password FROM password_table WHERE Trip='$trip' and password='$password'";
    $result = mysqli_query($link, $query) or die(mysqli_error($link));

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $row["authenticated"] = true;
    } else {
        $row["authenticated"] = false;
    }

    echo json_encode($row);
}
?>