<?php
$ip      = 'localhost';
$user    = 'root';
$contra  = '12345';
$db_name = 'notarios';
$conn    = mysql_connect($ip,$user,$contra);   
mysql_select_db($db_name,$conn);
?>
