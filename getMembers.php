<?php


include 'dbconn.php';

$group = $_GET['group'];
$queryMembers = "SELECT * from group_member WHERE Group_name = '$group'";
$resultMembers = mysqli_query($link, $queryMembers) or die(mysqli_error($link));

$members = array();
while ($row = mysqli_fetch_assoc($resultMembers)) {
    $members[] = $row;
}
mysqli_close($link);

echo json_encode($members);

?>