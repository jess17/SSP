<?php
  $date1 = new DateTime("1999-02-11");
  $date2 = new DateTime("2019-12-09");
  $diff = $date1->diff($date2);

  echo "Date1: ".$date1->format("Y-m-d")."<br>";
  echo "Date2: ".$date2->format("Y-m-d")."<br><br>";

  echo "Difference : <br>" . $diff->y . " years <br>" . $diff->m." months <br>".$diff->d." days ";
  echo "<hr>";
?>

<?php
  class Calculator {
  public $val1, $val2;
  public function __construct( $val1, $val2 ) {
  $this->val1 = $val1;
  $this->val2 = $val2;
  }
  public function add() {
  return $this->val1 + $this->val2;
  }
  public function subt() {
  return $this->val1 - $this->val2;
  }
  public function mult() {
  return $this->val1 * $this->val2;
  }
  public function div() {
  return $this->val1 / $this->val2;
  }
  }

  ?>

<form action="" method='post'>
  <span>Value 1: </span><input type="text" name="val1" id="" >
  <span>Value 2: </span><input type="text" name="val2" id="" >
  <button>Calculate</button>
</form>

<?php
  $val1 = (isset($_POST['val1'])?$_POST['val1']:0);
  $val2 = (isset($_POST['val2'])?$_POST['val2']:0);
  $mycalc = new Calculator($val1, $val2); 
  echo $val1." + ".$val2." = ".$mycalc-> add()."<br>"; 
  echo $val1." * ".$val2." = ".$mycalc-> mult()."<br>"; 
  echo $val1." - ".$val2." = ".$mycalc-> subt()."<br>"; 
  echo $val1." / ".$val2." = ".$mycalc-> div()."<br>";
?>