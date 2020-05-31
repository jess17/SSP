<?php
  $str = '12-08-2004';
  $date = date_create_from_format('m-d-Y',$str);
  // var_dump($date);
  // echo "String: ".$str;
  echo $date->format("m/d/Y")."<br>";
  echo $date->format("m-d-Y")."<br>";

  echo "<br>";

  $factorial=1;
  $numb = 3;
  class Factorial{
    var $factorial=1;
    var $numb = 1;
    function __Factorial($numb){
      $this->numb = $numb;
    }

    function getFactorial($numb){
      for($i=1; $i<=$numb; $i++){
        $this->factorial *=$i;
      }
      return $this->factorial;
    }
    
  }
  
  // echo "Factorial of ". $numb. " is ".$factorial;
?>

<form action="" method='post'>
  <span>Integer: </span><input type="text" name="numb" id="" >
  <button>Calculate</button>
</form>
<?php
  $numb = (isset($_POST['numb']))?$_POST['numb']:1;
  $fact = new Factorial($numb);
  $facto = $fact->getFactorial($numb);
?>

<p>Factorial of <?=$numb?> is <?=$facto?></p>