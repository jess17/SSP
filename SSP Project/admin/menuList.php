
<?php 
  include $_SERVER['DOCUMENT_ROOT']."/SSP Project/core/init.php";
  if(!isLogIn()){
    redirect();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Menu List</title>
  
  <link href = "../Bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href = "./main.css" rel="stylesheet">
  <script src="../Bootstrap/jquery.min.js"></script>
  <script src= "../Bootstrap/bootstrap.min.js"></script>
  

</head>
<body>
<div class="">
  <div class="pos-f-t">
    <nav class="navbar navbar-dark bg-dark " style="justify-content:start;">
      <?php include $_SERVER['DOCUMENT_ROOT']."/SSP Project/Accordion/navBarAcc.php"?>
    </nav>
    <!-- <div class="collapse" id="navbarToggleExternalContent">
      <div class="bg-dark p-4">
        <h5 class="text-white h4">Collapsed content</h5>
        <span class="text-muted">Toggleable via the navbar brand.</span>
      </div>
    </div> -->
  </div>

  <div class="row collapse show" id="navigationBar">
    <div class="col-2 bg-dark">
      <div class="accordion leftNav" id="navBar" >
        <?php include $_SERVER['DOCUMENT_ROOT']."/SSP Project/NavBar/navBar.php"?>

      </div>
    </div>


      
    <div class="col-10 p-5">

      <?php 
        // ob_start();
        include $_SERVER['DOCUMENT_ROOT']."/SSP Project/Other page/Menu list/menu_list.php";
        // echo ob_get_clean();
      ?>
    </div>
      
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