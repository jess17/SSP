<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/SSP PROJECT/core/init.php';

  if(!isLogIn()){
    redirect("../Login/login.php");
  }

  if($_POST){
    $name = (isset($_POST['name']))?$_POST['name']:"";
    $desc= (isset($_POST['desc']))?$_POST['desc']:"";
    $price= (isset($_POST['price']))?$_POST['price']:"";
    $category= (isset($_POST['category']))?$_POST['category']:"";

    $conn -> query("INSERT INTO menu (`name`,`description`,`price`,`category`) VALUES ('$name', '$desc', '$price', '$category')");
    $_SESSION['success_flash'] = "Changes has been made successfully";
    // header('Location: menuList.php');
    // $flag = true;
  }
  
?>
<h1>
  Add Menu
</h1>
<form class="needs-validation" novalidate method="post">
<?php
  if(isset($_SESSION['success_flash'])){
    echo "<div class='bg-success text-white text-center'><p>".$_SESSION['success_flash']."</p></div>";
    unset($_SESSION['success_flash']);
  }
?>
  <div class="form-row">
    <div>
      <a href="menuList.php">Back</a>
    </div>
    <div class="col-md-12 mb-3">
      <label for="validationCustom01">Name:<span style="color:red;">*</span></label>
      <input type="text" class="form-control" id="validationCustom01" placeholder="" required name="name" value="" >
      <div class="invalid-feedback">
        Name can't be empty
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 mb-3">
      <label for="validationCustom02">Description:</label>
      <input type="text" class="form-control" id="validationCustom02" name="desc" >
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 mb-3">
      <label for="validationCustom05">Price:<span style="color:red;">*</span></label>
      <input type="text" class="form-control" id="validationCustom05" placeholder="" aria-describedby="inputGroupPrepend" required name="price" value="" >
      <div class="invalid-feedback">
        Price can't be empty
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 mb-3">
      <label for="validationCustom03">Category:<span style="color:red;">*</span></label>
      <input type="text" class="form-control" id="validationCustom03" placeholder="" required name="category" value="" required>
      <div class="invalid-feedback">
        Category can't be empty
    </div>
    </div>
    
  </div>
  
  <button class="btn btn-primary" type="submit">Add</button>

</form>   