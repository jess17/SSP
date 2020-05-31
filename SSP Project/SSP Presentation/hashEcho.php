<?php 
  $pass = "qwerty123";
  $hash = password_hash($pass,PASSWORD_DEFAULT); 
  echo "Before: ".$pass."<br>";
  echo "After: ".$hash."<br>";
  echo "<hr>";

  $hashedPass = '$2y$10$Ow51jXO.zCqgAqVbF7D/s.2p.9/8.yJI5RlKSRlQs9nOS0XB2B7OG2';
  $x = password_verify($pass,$hashedPass);
  echo $x?"True":"False";
  echo "<hr>";

  // $hash2 = password_hash($pass, 3);
  // echo $hash2;
  // $x = password_verify($pass,$hash2);
  // echo "<br>";
  // echo $x?"True":"False";
?>