<?php
session_start();
$charList = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
$randChar = substr(str_shuffle($charList),0,11);
// $randChar = dechex($randChar);
$_SESSION['captcha'] = $randChar;

echo $_SESSION['captcha']."<hr>";

// header('Content-type:image/jpeg');
$imgScreen = imagecreate(100,300);
imagecolorallocate($imgScreen, 255, 255, 255);

$textCol = imagecolorallocate($imgScreen, 0, 0, 0);

imagettftext($imgScreen, 16, 0, 15, 30, $textCol, '../calibri.ttf', $randChar); //imagettftext(resource img, font-size, angle , coordinate-x, coordinate-y, color, font file, text)
imagejpeg($imgScreen);


?>

<form action='' method='post'>
  <img src='Lab16-2.php'/>
</form>