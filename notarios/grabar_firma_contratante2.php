<?php 
session_start();
include("conexion.php");

$codkardex=$_POST['codkardex'];


	#mysql_query("update kardex set fechaconclusion='$fecfirmaa' where kardex='$codkardex'", $conn) or die(mysql_error());
  	
	#$rowresult = mysql_fetch_array($updatek);
	#$res = $rowresult['fechaconclusion'];
	$fechaa  = mysql_query("SELECT fechaconclusion from kardex where kardex='$codkardex'", $conn) or die(mysql_error());
	$numeroa = mysql_fetch_array($fechaa);
	echo"<p>Fecha: ".$numeroa[0]."</p>";

?>