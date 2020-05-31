<?php
  $array = array(4, 5, 1, 2, 3, 1, 2, 1);
	$ac = array_count_values($array);
  print_r($ac);

  mysqli_connect('localhost','root','','test');

  $a = preg_match("/[A-Za-z]/","hi")?"True":"False";
  echo "<br>".$a;
  echo "<hr>";

  $gen = '0123456789';
  $res = '';
  for($i=1; $i<=4;$i++){
    $res.=substr($gen, rand()%strlen($gen), 1);
  }
  print($res);

  $n = 20; 
  $result = bin2hex(random_bytes($n)); 
  echo "<hr>".$result."<hr>"; 



  $a=2;
  $b=&$a;
  echo $a."<br>".$b."<br>";
  $a=6;
  echo $a."  ".$b."<hr>";

  function isPrime($n){
    $flag=true;
    if($n==1){
      return false;
    }
    for($i=2; $i<$n; $i++){
      if($n%$i==0){
        $flag=false;
        break;
      }
    }
    return $flag;
  }

  function output($is){
    echo $is?"True":"False";
    echo "<br>";
  }

  output(isPrime(5));
  output(isPrime(1));
  output(isPrime(2));
  output(isPrime(3));
  output(isPrime(4));
  // $z = isPrime(5)?"True":"False";
  // echo isPrime(5)."<br>";
  // echo isPrime(5)."<br>";
  // print(isPrime(1)."<br>");
  // print(isPrime(2)."<br>");
  // print(isPrime(4)."<br>");

  function fact($n){
    $factorial=1;
    for($i=$n; $i>0; $i--){
      $factorial *=$i;
    }
    return $factorial;
  }

  print(fact(4));

  echo "<br>";
  $captcha = substr(str_shuffle($gen),0,6);
  echo $captcha;
?>