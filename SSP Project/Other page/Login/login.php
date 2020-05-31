<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Log in</title>
  
  <link href = "../../Bootstrap/bootstrap.min.css" rel="stylesheet">
  <!-- <link href = "./login.css" rel="stylesheet"> -->
  <script src="../../Bootstrap/jquery.min.js"></script>
  <script src= "../../Bootstrap/bootstrap.min.js"></script>
  

</head>
<body>
<?php

  $pass = 'admin';

// echo password_hash($pass,PASSWORD_DEFAULT); 
  require_once $_SERVER['DOCUMENT_ROOT'].'/SSP PROJECT/core/init.php';

  // if(!isLogIn()){
  //   redirect();
  // }

  $rowLengthQuery = $conn -> query("SELECT COUNT(*) FROM accounts");
  $rowLength = mysqli_fetch_assoc($rowLengthQuery);
  $rowNumb = (int)$rowLength['COUNT(*)'];
  
  // $userQuery = $conn -> query("SELECT * FROM accounts");
  // $userResult = mysqli_fetch_assoc($userQuery); 
  // var_dump($userResult);
  // while($userResult){
  //   echo $userResult['username'];
  // }

  $username='';
  $password='';
  if(!empty($_POST)){
    $username = (isset($_POST['username']) && !empty($_POST['username']))?htmlspecialchars($_POST['username'], ENT_COMPAT, 'utf-8'):"";
    $password = (isset($_POST['pass']) && !empty($_POST['pass']))?htmlspecialchars($_POST['pass'], ENT_COMPAT, 'utf-8'):"";

    // foreach($userResult as $i){
    //   echo $i."<br>";
    // }

    
    
    $error = array();
    // $j=0;
    // for($i=1; $i<$rowNumb+1; $i++){
    //   $userQuery = $conn -> query("SELECT * FROM accounts WHERE id = $i");
    //   $userResult = mysqli_fetch_assoc($userQuery);
    //   $arr[$j]=$userResult['username'];
    //   $j++;
    // }

    // if($username == $userResult['username'] && password_verify($password, $userResult['password'])){
    //   header("Location: ../../index.php");
    // }else{
    //   $error[0] = 'Username or password is incorrect';
    // }
    // // var_dump($arr[1]);

    // if(in_array("employe",$arr)){
    //   echo "yes";
    // }
    
    $userQuery = $conn -> query("SELECT * FROM accounts WHERE get_all = '0'");
    
    while($userResult = mysqli_fetch_assoc($userQuery)){
      if($username == $userResult['username'] && password_verify($password, $userResult['password'])){
        // $_SESSION['userID'] = $userResult['username'];
        $userID = $userResult['id'];
        login($userID);
        // header("Location: ../../admin/index.php");
      }else{
        $error[0] = 'Username or password is incorrect';
      }
      // var_dump($userResult['username']);  
    }

    
  }
  
?>
  <div class="container-fluid align-middle">
    <div class="row" style="height:8rem;"></div>
    <div class="row">
      <div class="col-md-4"></div>
      <form class="px-4 py-3 col-md-4 needs-validation" novalidate method="post" >
        <div class="form-group">
          <div style="color:red">
            <?php
              if(isset($_SESSION['errorNotice'])){
                echo "<p>".$_SESSION['errorNotice']."</p>";
                unset($_SESSION['errorNotice']);
              }
              echo (isset($error) && !empty($error))?$error[0]:""; 
             
            ?>
          </div>
          <div class="">
            <label for="username"><b>Username</b></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
              </div>
              <input type="text" class="form-control" id="username" placeholder="Username" aria-describedby="inputGroupPrepend" required name="username">
              <div class="invalid-feedback">
                Please enter your username
              </div>
            </div>
          </div>
          <!-- <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" placeholder="email@example.com"> -->
        
        <div class="form-group">
          <label for="password"><b>Password</b></label>
          <input type="password" class="form-control" id="password" placeholder="Password" required name="pass">
          <div class="invalid-feedback">
                Please enter your password
          </div>
        </div>
        </div>
        <!-- <div class="form-check">
          <input type="checkbox" class="form-check-input" id="dropdownCheck">
          <label class="form-check-label" for="dropdownCheck">
            Remember me
          </label>
        </div> -->
        <button type="submit" class="btn btn-primary" >Sign in</button>

        <div class="dropdown-divider"></div>
        <!-- <a class="dropdown-item" href="signUp.php">New around here? Sign up</a> -->
        <a class="dropdown-item" href="forgotPass.php">Forgot password?</a>
      </form>
      </div>
      

      <div class="col-md-4"></div>
      </div>
  </div>
  <?php 
     
   
    //  $userQuery = $conn->query("SELECT * FROM accounts WHERE id = '1' ");
    //  $userResult = mysqli_fetch_assoc($userQuery);

    //  $user = $userResult['username'];
    //  $password = $userResult['password'];
    //  // var_dump($userResult['id']);
    // //  if(!empty($_POST['username']) && !empty(($_POST['pass']))){
    //    if($_POST['username'] == $user && $_POST['pass'] == $password){
    //       echo "yes";
    //   //  }
    //  }else if(empty($_POST['username']) && empty(($_POST['pass'])) ){
    //     echo "nothing";
    //  } else{
    //    echo "NO";
    //  }
  ?>
</body>

<script>
(function() {
  'use strict';
  window.addEventListener('load', function() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

</html>

<?php
  // echo "lala";
?>