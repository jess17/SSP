<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/SSP PROJECT/core/init.php';

  if(!isLogIn()){
    redirect("../Login/login.php");
  }
?>
<div class="card">
  <h3 class="card-header text-center font-weight-bold text-uppercase py-4">User List</h3>
  <div class="card-body">
    <div class='col-md-12 text-right'>
      <?php
        if($userData['privilege'] == "all"):
      ?>
      <a href="../Other page/Login/signUp.php" class="btn btn-primary btn-rounded btn-sm my-0 mb-3" data-target="#editPopUp">Add user</a>
      <?php endif?>
    </div>
    <div id="table" class="table-editable">
      <table class="table table-bordered table-responsive-md table-striped text-center">
        <thead>
          <tr>
            <th class="text-center">Users</th>
            <th class="text-center">Date made</th>
            <th class="text-center">Remove</th>
          </tr>
        </thead>
        <tbody>
        <?php 
          if(isset($_GET['delete'])){
            $userIDDel = (int)$_GET['delete'];
            $conn->query("DELETE FROM accounts WHERE id = $userIDDel");
            // header("Location: menuList.php");
          }
          $accQuery = $conn -> query("SELECT * FROM accounts");
          while($acc = mysqli_fetch_assoc($accQuery)):
        ?>
          <tr>
            <td class="pt-3-half"><?=$acc['username']?></td>
            <td class="pt-3-half"><?=$acc['dateMade']?></td>
            <td>
            <?php if($acc['username']!='admin'&& $acc['username']!='employee'):?>
              <a href="userList.php?delete=<?= $acc['id'] ?>" class="btn btn-danger btn-rounded btn-sm my-0">Remove</a>
            <?php endif?>
            </td>
          </tr>
          
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>