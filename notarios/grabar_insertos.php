<?php 
include("conexion.php");

$num_kardex			= $_POST['num_kardex'];
$num_insertos		= $_POST['num_insertos'];

$sql="UPDATE kardex SET insertos='$num_insertos'
WHERE kardex = '$num_kardex'"; 

mysql_query($sql,$conn) or die(mysql_error());
?>
