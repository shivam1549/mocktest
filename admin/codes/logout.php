<?php
session_start();
unset($_SESSION['adminloggedin']);
$_SESSION['status'] = "logged out";
header('location: ../login.php');
?>