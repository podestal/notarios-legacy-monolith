<?php 
include("conexion.php");

$consulkar=mysql_query("Select * from actocondicion where formulario='1'", $conn) or die(mysql_error());

while($rowkar = mysql_fetch_array($consulkar)){
	
	
$grabarmpagos="UPDATE contratantesxacto SET montop = '1' WHERE idcondicion = '".$rowkar['idcondicion']."'";
mysql_query($grabarmpagos,$conn) or die(mysql_error());

}

?>