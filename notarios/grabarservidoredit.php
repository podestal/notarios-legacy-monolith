<?php 

include("conexion.php");


$nombre=strtoupper($_POST['nombre']);


$sql="select * from servidor where idservidor='1'";
$rpta=mysql_query($sql,$conn) or die(mysql_error());


$grabarclientesc="UPDATE servidor SET nombre = '$nombre'";

mysql_query($grabarclientesc,$conn) or die(mysql_error());

?>
<script language='javascript'>alert('editado satisfactoriamente');</script> 

