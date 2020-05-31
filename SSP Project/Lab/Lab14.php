<style>
  /* td{
    width:75px;
    height:40px;
    text-align:center;
    border:solid 1px;
    
  } */
  table{
    border-collapse: collapse;
  }
  td{
    width:200px;
    height:40px;
    text-align:center;
    border:solid 1.5px blue;
  }
  tr:first-child{
    font-weight:bold;
    /* background: rgb(193, 231, 253); */
    background: rgb(23,230,230);
  }
</style>
<?php 
  echo "<table border='1'>";
  for($i=1; $i<=255; $i++){
    echo "<tr>";
    echo "<td>".$i."</td>";
    echo "<td>".chr($i)."</td>";

  }
    echo "</tr>";      
  echo "</table>";
  echo "<hr>";
?>

<?php
  $t = 8;
  $day = array('Time',"Monday","Tuesday","Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $task = array(
  1=> array(8=>"DS", 16=>"Lab"),
  4=> array(15=>"SSP")
  );

  echo "<table border='1'>";
  for($i=0; $i<=9; $i++){
    echo "<tr>";
    if($i==0){
      // echo "<td></td>";
      for($j=0; $j<count($day); $j++){
        echo "<td>";
        echo $day[$j];
        echo "</td>";
      }
    }else{
      for($j=0; $j<count($day); $j++){
        echo "<td>";
        if($j==0){
          echo ($t+$i-1).":00";
        }else{
          echo @$task[$j][$t+$i-1];
        }
        
        echo "</td>";
      }
    }
    echo "</tr>";      
  }
  echo "</table>";

  echo "<hr>";
?>



<?php 
  $cost=50;
  $allowance=0;

  if($cost<33.64){
    $allowance=0;
  }elseif($cost>=33.64 && $cost<=252){
    $allowance=$cost*0.8;
  }else{
    $allowance=201.6;
  }

  echo "Cost: ".$cost."<br> Allowance: ". $allowance;
?>
