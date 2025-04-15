<?php 
include("conexion.php");

$codkardex = $_POST['codkardex'];
$si = $_POST['si'];
mysql_query("UPDATE rouif SET uni='$si' WHERE kardex='".$codkardex ."'",$conn) or die(mysql_error());

?>