<?php 
include("conexion.php");


$codkardex=$_POST['codkardex'];
$xasignaitem=$_POST['xasignaitem'];
$xasignacondi=$_POST['xasignacondi'];
$xasignavalor=$_POST['xasignavalor'];
$xasignaid=$_POST['xasignaid'];

mysql_query("UPDATE contratantesxacto SET porcentaje='$xasignavalor' where idcondicion='$xasignacondi' and (item='$xasignaitem' and id='$xasignaid')", $conn) or die(mysql_error());

$sqlsumap="SELECT SUM(porcentaje) as sumaporcentaje FROM contratantesxacto WHERE kardex = '$codkardex' and (idcondicion='$xasignacondi' and item='$xasignaitem')";
$rptasumap=mysql_query($sqlsumap,$conn) or die(mysql_error());
$rowsumap=mysql_fetch_array($rptasumap);	

$porcent=$rowsumap['sumaporcentaje'];
if ($porcent<100){
	echo"El porcentaje de uno de los actos es: ".$porcent.", no puede ser menor a 100%";
	}
if ($porcent>100){
	echo"El porcentaje de uno de los actos es: ".$porcent.", no puede ser mayor a 100%";
	}
?>