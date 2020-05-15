<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/SSP PROJECT/core/init.php';

  if(!isLogIn()){
    redirect("../Login/login.php");
  }
?>

<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">Summary</h3>
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
            <th class="text-center">Date</th>
            <th class="text-center">Total Orders</th>
            <!-- <th class="text-center">Total Table Served</th> -->
            <!-- <th class="text-center">Total Income</th> -->
            <!-- <th class="text-center"></th> -->
          </tr>
        </thead>
        <tbody>
        <?php 
          $statQuery = $conn -> query("SELECT SUM(quantity) AS totalOrder FROM finishedorder");
          $statTotalOrder = mysqli_fetch_assoc($statQuery);

          $orderQuery = $conn -> query("SELECT DATE(`date`) AS `date`, SUM(quantity) AS totalOrder, orders FROM finishedorder GROUP BY `date`");

          // $orderQuery = $conn -> query("SELECT DATE(`date`) AS `date`, SUM(quantity) AS totalOrder,  orders FROM finishedorder WHERE `quantity` = (SELECT MAX(quantity) FROM finishedorder) AND `date`='2019-11-14'");

          $maxQuery = $conn -> query("SELECT `name` AS `name` FROM finishedorder WHERE `quantity` = (SELECT MAX(quantity) FROM finishedorder)");

          $maxQuantityQuery = $conn -> query("SELECT DATE(`date`) AS `date`, MAX(quantity) AS maxOrder, orders  FROM finishedorder WHERE quantity = (SELECT MAX(quantity) FROM finishedorder) GROUP BY `date` ");
          $mostOrdered =  mysqli_fetch_assoc($maxQuantityQuery);
          // var_dump($mostOrdered);
          // $order = mysqli_fetch_assoc($orderQuery);
          while($order = mysqli_fetch_assoc($orderQuery)):
        ?>
          <tr>
            <td class="pt-3-half"><?=$order['date']?></td>
            <td class="pt-3-half"><?=$order['totalOrder']?></td>
            <!-- <td class="pt-3-half"><?=$order['orders']?></td> -->
            <!-- <td class="pt-3-half"><?=$order['status']?></td>
            <td class="pt-3-half"><?=$order['date']?></td> -->
 
          </tr>
          
        <?php endwhile; 
          // mysql_data_seek($orderQuery, 0);
        ?>
        
        </tbody>
      </table>

    </div>
  </div>
  <div>
  <h3 class='text-info ml-2'>Most Ordered Food: <?= (isset($mostOrdered['orders']))?$mostOrdered['orders']:'' ?> (<?= (isset($mostOrdered['maxOrder']))?$mostOrdered['maxOrder']:''?> portion has been ordered )</h3>
  
  </div>
</div>

<!-- <div>
  <?php //$v=0; while ($line = mysqli_fetch_assoc($orderQuery)) { $v = $line['totalOrder']; ?> <?php //} ?>
  <?php //if ($v>0) echo $v ?>
</div> -->
