<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  
  <link href = "../Bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href = "./login.css" rel="stylesheet">
  <script src="../Bootstrap/jquery.min.js"></script>
  <script src= "../Bootstrap/bootstrap.min.js"></script>
  

</head>
<body>
<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/SSP PROJECT/core/init.php';
  $userQuery = $conn -> query("SELECT * FROM accounts WHERE get_all='0'");
  
  if(!empty($_POST)){

    
    $username = (isset($_POST['username']))?htmlentities($_POST['username'], ENT_COMPAT, 'utf-8'):"";
    $password = (isset($_POST['pass']))?htmlentities($_POST['pass'], ENT_COMPAT, 'utf-8'):"";
    $password = password_hash($password,PASSWORD_DEFAULT); 
    // $securityQ = (isset($_POST['securityQ']))?htmlentities($_POST['securityQ'], ENT_COMPAT, 'utf-8'):"";
    $error = array();

    $flag = true;
    while($userResult= mysqli_fetch_assoc($userQuery)){
      if($username == $userResult['username']){
        $error[0] = 'Username already exists';
        $flag = false;
        break;
      }
    }

    if($flag){
      $rowLengthQuery = $conn -> query("SELECT COUNT(*) FROM accounts");
      $rowLength = mysqli_fetch_assoc($rowLengthQuery);
      $rowNumb = (int)$rowLength['COUNT(*)'];
      $id = $rowNumb+1;

      $signUpQuery = $conn -> query("INSERT INTO accounts (`id`,`username`,`password`,`securityQ`)  VALUES ('$id','$username','$password','$securityQ') ");
      header("Location: ./success.php");
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
            <?= (isset($error) && !empty($error))?$error[0]:""; ?>
          </div>
          <div>
            <a href="./login.php">Back</a>
          </div>
          <div class="">
          <h1>Sign Up</h1>
            <label for="username">Username</label>
            <div class="input-group">
              <input type="text" class="form-control" id="username" placeholder="Username" aria-describedby="inputGroupPrepend" required name="username">
              <div class="invalid-feedback">
                Please enter your username
              </div>
            </div>
          </div>

        <div class="form-group">
          
          <label for="password">Password</label>
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
        <button type="submit" class="btn btn-primary" >Sign up</button>
      </form>
      </div>
      

      <div class="col-md-4"></div>
      </div>
  </div>
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