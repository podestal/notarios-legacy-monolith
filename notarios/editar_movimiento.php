<?php 

include("conexion.php");

$codkardex=$_POST['codkardex'];
$itemcodmovreg=$_POST['itemcodmovreg'];
$codmovreg=$_POST['codmovreg'];
$fechamov2=$_POST['fechamov2'];
$vencimiento2=$_POST['vencimiento2'];
$idsedereg2=$_POST['idsedereg2'];
$idsecreg2=$_POST['idsecreg2'];
$titulorp2=$_POST['titulorp2'];
$idtiptraoges2=$_POST['idtiptraoges2'];
$idestreg2=$_POST['idestreg2'];
$importee2=$_POST['importee2'];
$encargado2=$_POST['codusuario2'];
$anotacion2=$_POST['anotacion2'];
$observa2=$_POST['observa2'];
$numeroo2=$_POST['numeroo2'];
$conestado2=$_POST['conestado2'];

$registrador = $_POST['registrador'];
$numeroPartida = $_POST['numeroPartida'];
$asiento = $_POST['asiento'];
$recibo = $_POST['recibo'];
$fechaInscripcion = $_POST['fechaInscripcion'];




$grabarmovimiento2="UPDATE detallemovimiento SET  fechamov='$fechamov2', vencimiento='$vencimiento2', titulorp='$titulorp2', idsecreg='$idsecreg2', idtiptraoges='$idtiptraoges2', idestreg='$idestreg2', encargado='$encargado2', anotacion='$anotacion2', importee='$importee2', observa='$observa2', numeroo='$numeroo2', registrador = '$registrador', numeroPartida = '$numeroPartida', asiento = '$asiento', recibo = '$recibo', fechaInscripcion = '$fechaInscripcion'  

	WHERE itemmov='$itemcodmovreg'";
	
	mysql_query($grabarmovimiento2,$conn) or die(mysql_error());
	

	if($conestado2=="P"){
	$sqlsumap="SELECT SUM(importee) as sumap FROM detallemovimiento WHERE idestreg='P' AND idmovreg='$codmovreg'";
	$rptasumap=mysql_query($sqlsumap,$conn) or die(mysql_error());	
	$rowsumap=mysql_fetch_array($rptasumap);
	
	$sqlsumam="SELECT SUM(importee) as sumam FROM detallemovimiento WHERE idestreg='M' AND idmovreg='$codmovreg'";
	$rptasumam=mysql_query($sqlsumam,$conn) or die(mysql_error());	
	$rowsumam=mysql_fetch_array($rptasumam);
	
	$totaless=floatval($rowsumap['sumap']) + floatval($rowsumam['sumam']);

	$grabarsaldo="UPDATE saldorrpp set pagadorrpp='$totaless', xcobrarclie='$totaless' where idmovreg='$codmovreg'";
	mysql_query($grabarsaldo,$conn) or die(mysql_error());
	}
	
	if($conestado2=="L"){
	$sqlsumal="SELECT SUM(importee) as sumal FROM detallemovimiento WHERE idestreg='L' AND idmovreg='$codmovreg'";
	$rptasumal=mysql_query($sqlsumal,$conn) or die(mysql_error());	
	$rowsumal=mysql_fetch_array($rptasumal);
	
	$sqlsumam="SELECT SUM(importee) as sumam FROM detallemovimiento WHERE idestreg='M' AND idmovreg='$codmovreg'";
	$rptasumam=mysql_query($sqlsumam,$conn) or die(mysql_error());	
	$rowsumam=mysql_fetch_array($rptasumam);
	
	$totales=floatval($rowsumal['sumal']) - floatval($rowsumam['sumam']);
	
	$grabarsaldo="UPDATE saldorrpp set mayorderecho='$totales' where idmovreg='$codmovreg'";
	mysql_query($grabarsaldo,$conn) or die(mysql_error());
	}
	
	if($conestado2=="M"){
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
	}

?>
