<?php
session_start();

$_SESSION['authenticated'] = $_POST['authenticate'];

?>
