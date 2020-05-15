<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/SSP PROJECT/core/init.php';

  if(!isLogIn()){
    redirect("../Login/login.php");
  }
?>

<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Ongoing Order List</h3>
  <div class="card-body">
    <div class='col-md-12 text-right'>
      <a href="addOrder.php" class="btn btn-primary btn-rounded btn-sm my-0" data-target="#editPopUp">Add</a>
    </div>
    <div id="table" class="table-editable">
      <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success"><i
            class="fas fa-plus fa-2x" aria-hidden="true"></i></a></span>
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Table Number</th>
            <th class="text-center">Orders</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Status</th>
            <th class="text-center">Notes</th>
            <th class="text-center">Finish</th>
          </tr>
        </thead>
        <tbody>
        <?php 

          if(isset($_GET['delete'])){
            $orderID = (int)$_GET['delete'];
            $orderMoveQuery = $conn -> query("SELECT * FROM orders WHERE id=$orderID");
            $orderMoveRes = mysqli_fetch_assoc($orderMoveQuery);

            $order1 = isset($orderMoveRes['orders'])?$orderMoveRes['orders']:'';
            $quantity1 = $orderMoveRes['quantity'];
            $tableNumb1 = $orderMoveRes['tableNumb'];
            $status = 'Finished';
            $date1 = $orderMoveRes['date'];

            // echo $order1.$quantity1.$tableNumb1.$status;
            $conn->query("INSERT INTO finishedorder (`orders`,`quantity`,`tableNumb`, `status`,`date`) VALUES ('$order1','$quantity1','$tableNumb1','$status', '$date1')");
            $conn->query("DELETE FROM orders WHERE id = $orderID");
            // header("Location: menuList.php");
          }
        
          $orderQuery = $conn -> query("SELECT * FROM orders ORDER BY `date`");
          while($order = mysqli_fetch_assoc($orderQuery)):
        ?>
          <tr>
            
            <td class="pt-3-half"><?=$order['tableNumb']?></td>
            <td class="pt-3-half"><?=$order['orders']?></td>
            <td class="pt-3-half"><?=$order['quantity']?></td>
            <td class="pt-3-half"><?=$order['status']?></td>
            <td class="pt-3-half"><?=$order['Notes']?></td>
            <td>
              <a href="orderManagement.php?delete=<?= $order['id'] ?>" class="btn btn-success btn-rounded btn-sm my-0">Finished</a>
            </td>
          </tr>
          
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
