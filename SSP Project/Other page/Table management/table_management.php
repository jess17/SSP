
<!-- Table management edit Page -->
<?php 
  require_once $_SERVER['DOCUMENT_ROOT'].'/SSP PROJECT/core/init.php';

  if(!isLogIn()){
    redirect("../Login/login.php");
  }
  
  if(isset($_GET['edit'])){
    $tableIDEdit = (int)$_GET['edit']; 
    $tableQuery = $conn -> query("SELECT * FROM `tables` WHERE id = $tableIDEdit ");
    $tableResult = mysqli_fetch_assoc($tableQuery);

    $tableNumb = (isset($_POST['tableNumb']))?$_POST['tableNumb']:$tableResult['tableNumb'];
    $capacity= (isset($_POST['capacity']))?$_POST['capacity']:$tableResult['capacity'];
    $notes= (isset($_POST['notes']))?$_POST['notes']:$tableResult['notes'];

    if($_POST){
      $conn->query("UPDATE `tables` SET `tableNumb` = '$tableNumb',`capacity` = '$capacity', `notes` = '$notes' WHERE `id` = '$tableIDEdit' ");
      $_SESSION['success_flash']='Changes has been made';
    
    }

?>

<div class="modal-header">                        
    <h5 class="modal-title">Edit</h5>
      <a href="tableManagement.php" class="close">X</a>
      </div>
      
      <div class="modal-body">
        <form method='post'>
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
          
          <div class="form-group">
            <label for="name" class="col-form-label">Table Number:</label>
            <input type="text" class="form-control" id="name" name="tableNumb" value='<?=$tableNumb;?>'>
          </div>
          <div class="form-group">
            <label for="desc" class="col-form-label">Capacity:</label>
            <textarea class="form-control" id="desc" value='<?=$description?>' name='capacity'><?=$capacity?></textarea>
          </div>
          <div class="form-group">
            <label for="price" class="col-form-label">Notes:</label>
            <input type="text" class="form-control" id="price" name="notes" value='<?=$notes?>'>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Save Changes">
          </div>
        </form>
      </div>
      
      
    </div>
  </div>
<!-- End of Table management edit Page -->

<!-- Table Management View Order Page -->
<?php }elseif(isset($_GET['view'])){
  $viewID = (int)$_GET['view']; 
  $viewQuery = $conn -> query("SELECT * FROM `tables` WHERE id = $viewID ");
  $viewResult = mysqli_fetch_assoc($viewQuery);

  // $tableNumb = (isset($_POST['tableNumb']))?$_POST['tableNumb']:$tableResult['tableNumb'];
  // $capacity= (isset($_POST['capacity']))?$_POST['capacity']:$tableResult['capacity'];
  // $notes= (isset($_POST['notes']))?$_POST['notes']:$tableResult['notes'];

  if($_POST){
    // $conn->query("UPDATE `tables` SET `tableNumb` = '$tableNumb',`capacity` = '$capacity', `notes` = '$notes' WHERE `id` = '$tableIDEdit' ");
  
  }

?>

<div class="modal-header">                        
    <a href="tableManagement.php">Back</a>
    </div>
    
    <div class="modal-body">
      <form method='post'>
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
        
        <div class="card">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Table <?= (int)$_GET['view']?></h3>
        <div class="card-body">
          <!-- <div class='col-md-12 text-right'>
            <?php
              if($userData['privilege'] == "all"):
            ?>
            <a href="orderManagement.php" class="btn btn-success btn-rounded btn-sm my-0" data-target="#editPopUp">Add</a>
            <?php endif?>
          </div> -->
          <div id="table" class="table-editable">
            <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i
                  class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
            <table class="table table-bordered table-responsive-md table-striped text-center">
              <thead>
                <tr>
                  <th class="text-center">Orders</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Notes</th>
                  <th class="text-center">Price</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                if(isset($_GET['view'])){
                  $tableID = (int)$_GET['view'];
                  // $conn->query("DELETE FROM tables WHERE id = $tableID");
                }
                if(isset($_GET['checkOut'])){
                  $tableID = (int)$_GET['view'];
                  $conn->query("UPDATE tables SET `status`='Available' WHERE tableNumb = $tableID");
                  $orderMoveQuery = $conn -> query("SELECT * FROM orders WHERE tableNumb=$tableID");
                  
                  while($orderMoveRes = mysqli_fetch_assoc($orderMoveQuery)){
                    $order1 = isset($orderMoveRes['orders'])?$orderMoveRes['orders']:'';
                    $quantity1 = $orderMoveRes['quantity'];
                    $tableNumb1 = $orderMoveRes['tableNumb'];
                    $status = 'Finished';
                    $date1 = $orderMoveRes['date'];

                    // echo $order1.$quantity1.$tableNumb1.$status;
                    $conn->query("INSERT INTO finishedorder (`orders`,`quantity`,`tableNumb`, `status`,`date`) VALUES ('$order1','$quantity1','$tableNumb1','$status', '$date1')");
                    
                  }
                  $conn->query("DELETE FROM orders WHERE tableNumb = $tableID");
                }
                
                $orderQuery = $conn -> query("SELECT * FROM orders WHERE tableNumb = $tableID");

                $totalPrice = 0;
                while($orders = mysqli_fetch_assoc($orderQuery)):
                  $tableNo = $orders['tableNumb'];
                  $name =  $orders['orders'];
                  $priceQ = $conn -> query("SELECT `price` FROM `menu` WHERE `name` =  '$name' ");
                  $price = mysqli_fetch_assoc($priceQ);
                  $price = (int)$price['price'];
                  $quant = (int)$orders['quantity'];
                  $totPrice = $price * $quant;
              ?>
                <tr>
                  <td class="pt-3-half"><?=$orders['orders']?></td>
                  <td class="pt-3-half"><?=$orders['quantity']?></td>
                  <td class="pt-3-half"><?=$orders['status']?></td>
                  <td class="pt-3-half"><?=(isset($orders['notes'])?$orders['notes']:"")?></td>
                  <td class="pt-3-half">$<?=$totPrice?></td>
                </tr>
                
              <?php 
                $totalPrice += $totPrice;
                endwhile; ?>
              </tbody>
            </table>
          </div>
          <div class='col-md-12 text-right'>
            <h3>Total Price: $<?= $totalPrice?></h3> 
            <div><a href="tableManagement.php?view=<?= $tableNo ?>&checkOut=<?= $tableNo ?>" class="btn btn-info btn-rounded btn-sm my-0">Check Out</a></div>
            
          </div>
        </div>
      </div>
    </div>
    
    
  </div>
</div>
<!-- End of Table Management View Order Page -->

<!-- Table Management Main Page -->
<?php
  }else{?>

<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Table Management</h3>
  <div class="card-body">
    <div class='col-md-12 text-right'>
      <?php
        if($userData['privilege'] == "all"):
      ?>
      <a href="addTable.php" class="btn btn-success btn-rounded btn-sm my-0" data-target="#editPopUp">Add</a>
      <?php endif?>
    </div>
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i
            class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Table Number</th>
            <th class="text-center">Max Capacity</th>
            <th class="text-center">Status</th>
            <th class="text-center">Notes</th>
            <?php
              if($userData['privilege'] == "all"):
            ?>
            <th class="text-center">Edit</th>
            <?php endif?>
            <?php
              if($userData['privilege'] == "all"):
            ?>
            <th class="text-center">Remove</th>
            <?php endif?>
            <th class="text-center">View Orders</th>
          </tr>
        </thead>
        <tbody>
        <?php 

          if(isset($_GET['delete'])){
            $tableID = (int)$_GET['delete'];
            $conn->query("DELETE FROM tables WHERE id = $tableID");
            // header("Location: menuList.php");
          }
          if(isset($_GET['editStat'])){
            $statID = (int)$_GET['editStat'];
            $statQ = $conn->query("SELECT * FROM tables WHERE id = $statID");
            $stat = mysqli_fetch_assoc($statQ);
            if($stat['status']=="Available"){
              $conn->query("UPDATE tables SET `status`='Occupied' WHERE id = $statID");
            }
            if($stat['status']=="Occupied"){
              $conn->query("UPDATE tables SET `status`='Available' WHERE id = $statID");
            }
            // header("Location: menuList.php");
          }
          $tablesQuery = $conn -> query("SELECT * FROM tables ORDER BY tableNumb");
          while($tables = mysqli_fetch_assoc($tablesQuery)):
        ?>
          <tr>
            <td class="pt-3-half"><?=$tables['tableNumb']?></td>
            <td class="pt-3-half"><?=$tables['capacity']?> people</td>
            <td class="pt-3-half">
            <?php if($tables['status']=="Occupied"):?>
              <a href="tableManagement.php?editStat=<?= $tables['id'] ?>" class="btn btn-danger btn-rounded btn-sm my-0">-</a>
            
            <?php endif ?>
            <?php if($tables['status']=="Available"):?>
              <a href="tableManagement.php?editStat=<?= $tables['id'] ?>" class="btn btn-success btn-rounded btn-sm my-0">+</a>
            <?php endif ?>
            <?=$tables['status']?>
            
            </td>
            <td class="pt-3-half"><?=$tables['notes']?></td>

            <?php if($userData['privilege'] == "all"):?>
            <td>
              <a href="tableManagement.php?edit=<?= $tables['id'] ?>" class="btn btn-primary btn-rounded btn-sm my-0">Edit</a>
            </td>
            <?php endif?>

            <?php if($userData['privilege'] == "all"):?>
            <td>
              <a href="tableManagement.php?delete=<?= $tables['id'] ?>" class="btn btn-danger btn-rounded btn-sm my-0">Remove</a>
            </td>
            <?php endif?>

            <td>
              <a href="tableManagement.php?view=<?= $tables['tableNumb'] ?>" class="btn btn-info btn-rounded btn-sm my-0">View Orders</a>
            </td>
          </tr>
          
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php }?>