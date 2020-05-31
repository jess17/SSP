<?php 
  require_once $_SERVER['DOCUMENT_ROOT']."/SSP Project/core/init.php";
  unset($_SESSION['userID']);
  header("Location: login.php");
?>