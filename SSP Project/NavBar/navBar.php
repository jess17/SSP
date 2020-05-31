

<div class="card bg-dark">
  <?php include $_SERVER['DOCUMENT_ROOT']."/SSP Project/Accordion/basicinfoAcc.php"?>
</div>

<div class="card bg-dark">
  <?php include $_SERVER['DOCUMENT_ROOT']."/SSP Project/Accordion/menuListAcc.php"?>
</div>

<div class="card bg-dark">
  <?php include $_SERVER['DOCUMENT_ROOT']."/SSP Project/Accordion/tableManagementAcc.php"?>
</div>

<!-- <div class="card bg-dark">
  <?php //include $_SERVER['DOCUMENT_ROOT']."/SSP Project/Accordion/reservationAcc.php"?>
</div> -->

<div class="card bg-dark">
  <?php include $_SERVER['DOCUMENT_ROOT']."/SSP Project/Accordion/orderManagementAcc.php"?>
</div>

<?php
  global $userData;

  if($userData['privilege'] == "all"):
?>
<!-- <div class="card bg-dark">
  <?php //include $_SERVER['DOCUMENT_ROOT']."/SSP Project/Accordion/employeeAcc.php"?>
</div> -->

<div class="card bg-dark">
  <?php include $_SERVER['DOCUMENT_ROOT']."/SSP Project/Accordion/statsAcc.php"?>
</div>

<div class="card bg-dark">
  <?php include $_SERVER['DOCUMENT_ROOT']."/SSP Project/Accordion/userAcc.php"?>
</div>

<?php endif ?>
