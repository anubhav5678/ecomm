<?php 
ob_start();
session_start();
session_destroy();

header("Location: " . $_SERVER['HTTP_REFERER']);
?>