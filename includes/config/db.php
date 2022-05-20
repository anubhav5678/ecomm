<?php ob_start(); ?>
<?php session_start(); ?>
<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_database = "e-commerce";

$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_database);
?>