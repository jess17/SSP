<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/SSP PROJECT/core/init.php';

  if(!isLogIn()){
    redirect("../Login/login.php");
  }
?>
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Finished Order List</h3>
  <div class="card-body">
    <!-- <div class='col-md-12 text-right'>
      <?php
        if($userData['privilege'] == "all"):
      ?>
      <a href="addOrder.php" class="btn btn-primary btn-rounded btn-sm my-0" data-target="#editPopUp">Add</a>
      <?php endif?>
    </div> -->
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
            <th class="text-center">Date</th>
          </tr>
        </thead>
        <tbody>
        <?php 

          if(isset($_GET['delete'])){
            $orderID = (int)$_GET['delete'];
            $conn->query("DELETE FROM orders WHERE id = $orderID");
            // header("Location: menuList.php");
          }
        
          $orderQuery = $conn -> query("SELECT * FROM finishedorder ORDER BY `date`");
          while($order = mysqli_fetch_assoc($orderQuery)):
        ?>
          <tr>
            <td class="pt-3-half"><?=$order['tableNumb']?></td>
            <td class="pt-3-half"><?=$order['orders']?></td>
            <td class="pt-3-half"><?=$order['quantity']?></td>
            <td class="pt-3-half"><?=$order['status']?></td>
            <td class="pt-3-half"><?=$order['date']?></td>
            <!-- <td class="pt-3-half">
              <span class="table-up"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-up"
                    aria-hidden="true"></i></a></span>
              <span class="table-down"><a href="#!" class="indigo-text"><i class="fas fa-long-arrow-alt-down"
                    aria-hidden="true"></i></a></span>
            </td>
            <td>
              <a href="orderManagement.php?delete=<?= $order['id'] ?>" class="btn btn-success btn-rounded btn-sm my-0">Finished</a>
            </td> -->
          </tr>
          
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
