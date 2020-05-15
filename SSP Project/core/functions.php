<?php
  function login($userID){
    $_SESSION['userID'] = $userID;
    // $_SESSION['success'] = "You have Logged in!!";
    if($userID==1){
      header("Location: ../../admin/index.php");
      return;
    }
    header("Location: ../../Employee/index.php");
    
  }

  function isLogIn(){
    if(isset($_SESSION['userID']) && $_SESSION['userID']>0){
      return true;
    }
    return false;
  }

  
  function redirect($url = "../Other page/Login/login.php"){
    $_SESSION['errorNotice'] = "You must log in to see this page";
    header("Location: ".$url);
    
  }

  function hasPrivilege($privilege = 'all'){
    global $userID;
    $currPrivilege = explode(',', $userID['privilege']);
    if(in_array($privilege, $currPrivilege , true)){
      return true;
    }
    // if($userID[privilege] == 'all'){
    //   // echo "jabkshbhjcbesw";
    //   return true;
    // }
    // echo "kagdacjhacb";
    return false;
  }



?>