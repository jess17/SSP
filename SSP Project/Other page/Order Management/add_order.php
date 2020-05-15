<?php
  

  require_once $_SERVER['DOCUMENT_ROOT'].'/SSP PROJECT/core/init.php';

  if(!isLogIn()){
    redirect("../Login/login.php");
  }
  
  if($_POST){
    $tableNumb = (isset($_POST['tableNumb']))?$_POST['tableNumb']:"";
    $quantity= (isset($_POST['quantity']))?$_POST['quantity']:"";
    $orders= (isset($_POST['orders']))?$_POST['orders']:"";
    $date = date("Y-m-d");
    // echo $date;
    $notes = (isset($_POST['notes']))?$_POST['notes']:"";
    // echo $notes;
    $conn -> query("INSERT INTO orders (`tableNumb`,`quantity`,`orders`,`status`,`date`,`notes`) VALUES ('$tableNumb', '$quantity', '$orders', 'Ongoing', '$date', '$notes')");
    $_SESSION['success_flash'] = "Changes has been made successfully";
    // header('Location: menuList.php');
    // $flag = true;
  }
  
?>
<h1>
  Add Order
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
      <a href="orderManagement.php">Back</a>
    </div>
    <div class="col-md-12 mb-3">
      <label for="validationCustom01">Table Number:<span style="color:red;">*</span></label>
      <select class="form-control" id="validationCustom01" placeholder="" required name="tableNumb" value="" >
        <?php
          $itemsQuery = $conn -> query("SELECT * FROM tables ORDER BY tableNumb");
          while($items = mysqli_fetch_assoc($itemsQuery)):?>
          <?php if($items['status'] == "Occupied"):?>
            <option value="<?=$items['tableNumb'] ?>"><?= $items['tableNumb']?>
            </option>
          <?php endif?>
        <?php endwhile?>
      </select>
      <div class="invalid-feedback">
        Table Number can't be empty
      </div>
    </div>
  </div>
  
  <div class="form-row">
    <div class="col-md-12 mb-3">
      <label for="validationCustom05">Order:<span style="color:red;">*</span></label>
      <select class="form-control" id="validationCustom01" placeholder="" required name="orders" value="" >
        <?php
          $menuQuery = $conn -> query("SELECT * FROM menu ORDER BY `name` ");
          while($menu = mysqli_fetch_assoc($menuQuery)):?>
        <option value="<?= $menu['name']?>"><?= $menu['name']?>
        </option>
        <?php endwhile?>
      </select>
      <div class="invalid-feedback">
        Order can't be empty
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 mb-3">
      <label for="validationCustom03">Quantity:<span style="color:red;">*</span></label>
      <input type="text" class="form-control" id="validationCustom03" placeholder="" required name="quantity" value="1" required>
      <div class="invalid-feedback">
        Quantity can't be empty
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