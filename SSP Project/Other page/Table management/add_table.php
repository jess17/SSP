<?php
  
  require_once $_SERVER['DOCUMENT_ROOT'].'/SSP PROJECT/core/init.php';

  if(!isLogIn()){
    redirect("../Login/login.php");
  }
  
  if($_POST){
    $tableNumb = (isset($_POST['tableNumb']))?$_POST['tableNumb']:"";
    $capacity= (isset($_POST['capacity']))?$_POST['capacity']:"";
    $notes= (isset($_POST['notes']))?$_POST['notes']:"";
    $category= (isset($_POST['category']))?$_POST['category']:"";

    $tableQuery = $conn->query('SELECT * FROM tables');
    $flag=true;
    while($tableResult= mysqli_fetch_assoc($tableQuery)){
      if($tableNumb == $tableResult['tableNumb']){
        $_SESSION['error_flash'] = 'Table number already exists';
        $flag = false;
        break;
      }
    }

    if($flag){
      $conn -> query("INSERT INTO tables (`tableNumb`,`capacity`,`status`,`notes`) VALUES ('$tableNumb', '$capacity', 'Available','$notes')");
      $_SESSION['success_flash'] = "Changes has been made successfully";
    }
    
    // header('Location: menuList.php');
    // $flag = true;
  }
  
?>
<h1>
  Add Table
</h1>
<form class="needs-validation" novalidate method="post">
<?php
  if(isset($_SESSION['success_flash'])){
    echo "<div class='bg-success text-white text-center'><p>".$_SESSION['success_flash']."</p></div>";
    unset($_SESSION['success_flash']);
  }
  if(isset($_SESSION['error_flash'])){
    echo "<div class='bg-danger text-white text-center'><p>".$_SESSION['error_flash']."</p></div>";
    unset($_SESSION['error_flash']);
  }
?>
  <div class="form-row">
    <div>
      <a href="tableManagement.php">Back</a>
    </div>
    <div class="col-md-12 mb-3">
      <label for="validationCustom01">Table Number:<span style="color:red;">*</span></label>
      <input type="text" class="form-control" id="validationCustom01" placeholder="" aria-describedby="inputGroupPrepend" required name="tableNumb" value="" >
      </select>
      <div class="invalid-feedback">
        Table Number can't be empty
      </div>
    </div>
  </div>
  
  <div class="form-row">
    <div class="col-md-12 mb-3">
      <label for="validationCustom05">Capacity:<span style="color:red;">*</span></label>
      <input type="text" class="form-control" id="validationCustom05" placeholder="" aria-describedby="inputGroupPrepend" required name="capacity" value="" >
      <div class="invalid-feedback">
        Order can't be empty
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 mb-3">
      <label for="validationCustom02">Notes:</label>
      <input type="text" class="form-control" id="validationCustom02" name="notes" >
    </div>
  </div>

  <button class="btn btn-primary" type="submit">Add</button>

</form>   