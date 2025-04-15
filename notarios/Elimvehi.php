<?php 
include("conexion.php");
$detveh=$_POST['detveh'];

mysql_query("delete from detallevehicular where detveh='$detveh'", $conn) or die(mysql_error());

mysql_close($conn);
?>