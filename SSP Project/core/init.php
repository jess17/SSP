<?php
  $servername = '127.0.0.1';
  $username = 'root';
  $password = "";
  $dbname = "ssp_project";
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if(mysqli_connect_errno()){
    echo "Failed to connect to database, Error: ".mysqli_connect_error();
    die();
  }
 
  session_start();
  require_once $_SERVER['DOCUMENT_ROOT'].'/SSP Project/core/functions.php';
  if(isset($_SESSION['userID'])){
    $id = $_SESSION['userID'];
    $query = $conn -> query("SELECT * FROM accounts WHERE id='$id'");
    $userData= mysqli_fetch_assoc($query);
  }

  // session_destroy();
?>

