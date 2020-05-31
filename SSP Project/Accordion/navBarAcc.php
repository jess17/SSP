<!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigationBar" aria-controls="navigationBar" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button> -->
<?php 
  // $url = $_SERVER['DOCUMENT_ROOT']."/SSP Project/Other page/Login/login.php";
?>


<div class="navRight" style="display:flex; width: 95%; justify-content: space-between;" >
  <a class="navbar-brand" href="index.php" style="margin-left:1rem;"><b>Restaurant Management System</b></a>
  <div>
    <!-- <a class="nav-link text-light navbar-brand" href="../Other page/Login/login.php" style="margin-left:1rem; font-size:16px">Log in</a>
    <a class="nav-link text-light navbar-brand" href="../Other page/Login/signUp.php" style="margin-left:1rem; font-size:16px">Sign up</a> -->
    <?php if($userData['privilege']=='all'):?>
    <a class="nav-link text-light navbar-brand" href="../Other page/Login/signUp.php" style="margin-left:1rem; font-size:16px">Add new user</a>
    <?php endif?>
    <a class="nav-link text-light navbar-brand" href="../Other page/Login/logout.php" style="margin-left:1rem; font-size:16px">Sign out</a>
    <!-- <form action="../admin/index.php" method="post">
      <input type="submit" name="signOut" value="Sign out" ></input>
    </form> -->
    
    <?php 
      // if(isset($_POST['signOut'])){
        
      // }
      
    ?>
  </div>
  
</div>