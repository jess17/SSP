<?php 
  require_once $_SERVER['DOCUMENT_ROOT'].'/SSP PROJECT/core/init.php';

  if(!isLogIn()){
    redirect("../Login/login.php");
  }

  $infoQuery = $conn -> query("SELECT * FROM basic_info");
  $infoResult = mysqli_fetch_assoc($infoQuery);
  // var_dump($infoResult);
  $restName = (isset($_POST['restName']))?$_POST['restName']:"";
  $restWeb= (isset($_POST['restWeb']))?$_POST['restWeb']:"";
  $phone= (isset($_POST['phone']))?$_POST['phone']:"";
  $loc= (isset($_POST['loc']))?$_POST['loc']:"";
  $time= (isset($_POST['time']))?$_POST['time']:"";

  
  if($_POST && empty($infoResult)){
    // $infoQuery = $conn -> query("INSERT INTO basic_info (id,rest_name, rest_web, phone, loc, work_hour) VALUES (1, '$restName', '$restWeb', '$phone', '$loc', '$time')");
    $infoQuery = $conn -> query("INSERT INTO basic_info VALUES (1, '$restName', '$restWeb', '$phone', '$loc', '$time')");
  } else if ($_POST && !empty($infoResult)){
    $infoQuery = $conn -> query("UPDATE basic_info SET `rest_name` = '$restName', rest_web = '$restWeb', phone = '$phone', loc = '$loc', work_hour = '$time' WHERE id='1'");
  }
  
  if(!empty($infoResult)){
    $infoQuery = $conn -> query("SELECT * FROM basic_info WHERE id = '1';");
    $infoResult = mysqli_fetch_assoc($infoQuery);
    $restName = $infoResult['rest_name'];
    $restWeb = $infoResult['rest_web'];
    $phone = $infoResult['phone'];
    $loc = $infoResult['loc'];
    $time = $infoResult['work_hour'];
  }


?>

<form class="needs-validation" novalidate method="post" action="#">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">Restaurant name<span style="color:red;">*</span></label>
      <input type="text" class="form-control" id="validationCustom01" placeholder="" required name="restName" value="<?= $restName?>" <?php if($userData['privilege']!='all'){ echo "readonly";}?>>
      <div class="invalid-feedback">
        Restaurant name can't be empty
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Restaurant's website</label>
      <input type="text" class="form-control" id="validationCustom02" placeholder="websiteexample.com" required name="restWeb" value="<?=$restWeb?>"  <?php if($userData['privilege']!='all'){ echo "readonly";}?>>
      <div class="invalid-feedback">
        
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustomUsername">Phone number</label>
      <div class="inp ut-group">
        <input type="text" class="form-control" id="validationCustomUsername" placeholder="+821234567788" aria-describedby="inputGroupPrepend" required name="phone" value="<?=$phone?>"  <?php if($userData['privilege']!='all'){ echo "readonly";}?>>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom03">Location</label>
      <input type="text" class="form-control" id="validationCustom03" placeholder="" required name="loc" value="<?=$loc;?>"  <?php if($userData['privilege']!='all'){ echo "readonly";}?>>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom04">Opening hours</label>
      <input type="text" class="form-control" id="validationCustom04" placeholder="10am-10pm" required name="time" value="<?=$time?>"  <?php if($userData['privilege']!='all'){ echo "readonly";}?>>
    </div>
    <!-- <div class="col-md-3 mb-3">
      <label for="validationCustom05">Zip</label>
      <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div> -->
  </div>
  <?php 
    if($userData['privilege']=='all'):
  ?>
    <button class="btn btn-primary" type="submit">Save</button>
  <?php endif?>
</form>