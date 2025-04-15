<?php 
include('conexion.php');

$itemcodmovreg=$_POST['itemcodmovreg'];
$codmovreg=$_POST['codmovreg'];

$sqldelemrp="DELETE FROM detallemovimiento WHERE itemmov='$itemcodmovreg'"; 
mysql_query($sqldelemrp,$conn) or die(mysql_error());


	$sqlsumam="SELECT SUM(importee) as sumam FROM detallemovimiento WHERE idestreg='M' AND idmovreg='$codmovreg'";
	$rptasumam=mysql_query($sqlsumam,$conn) or die(mysql_error());	
	$rowsumam=mysql_fetch_array($rptasumam);
	
	$sqlsumap="SELECT SUM(importee) as sumap FROM detallemovimiento WHERE idestreg='P' AND idmovreg='$codmovreg'";
	$rptasumap=mysql_query($sqlsumap,$conn) or die(mysql_error());	
	$rowsumap=mysql_fetch_array($rptasumap);
	
	$sqlsumal="SELECT SUM(importee) as sumal FROM detallemovimiento WHERE idestreg='L' AND idmovreg='$codmovreg'";
	$rptasumal=mysql_query($sqlsumal,$conn) or die(mysql_error());	
	$rowsumal=mysql_fetch_array($rptasumal);
	
	$totaless=floatval($rowsumap['sumap']) + floatval($rowsumam['sumam']);
	$totales=floatval($rowsumal['sumal']) - floatval($rowsumam['sumam']);
	
	$grabarsaldo="UPDATE saldorrpp set mayorderecho='$totales', pagadorrpp='$totaless', xcobrarclie='$totaless' where idmovreg='$codmovreg'";
	mysql_query($grabarsaldo,$conn) or die(mysql_error());


?>