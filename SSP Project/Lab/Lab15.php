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
  $month = array('January',"February","March","April", "May", "June", "July", "August", 'September','October', 'November','December');
  $numbOfdays = array('31','29 or 28','31','30','31','30','31','31','30','31','30','31');
?>

<form action="" method='post'>
  <label for="month">Month</label>
  <select id='month' name='month'>
    <?php for($i=0; $i<count($month); $i++){?>
      <option ><?=$month[$i];?></option>
    <?php }?>
  </select>
  <button>Submit</button>
</form>

<p><?php
  $key = (isset($_POST['month']))?$_POST['month']:'';
  $findDays = array_search($key, $month);?>
  <?=$numbOfdays[$findDays];
?> days</p>

<?php
  $str = "Hello";
  echo strrev($str);

?>


