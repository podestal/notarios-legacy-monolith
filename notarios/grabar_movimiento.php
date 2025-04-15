<?php 

include("conexion.php");

$codkardex=$_POST['codkardex'];

$codmovreg=$_POST['codmovreg'];

$fechamov=$_POST['fechamov'];

$vencimiento=$_POST['vencimiento'];

$idsedereg=$_POST['idsedereg'];

$idsecreg=$_POST['idsecreg'];

$titulorp = strtoupper($_POST['titulorp']);

$idtiptraoges=$_POST['idtiptraoges'];

$idestreg=$_POST['idestreg'];

$importee=$_POST['importee'];

$encargado=$_POST['codusuario'];

$anotacion = strtoupper($_POST['anotacion']);

$observa = strtoupper($_POST['observa']);

//$numeroo = $_POST['numeroo'];

$conestado = $_POST['conestado'];

//$mayorderecho=$_POST['mayorderecho'];

# CAMPOS ADICONALES
$registrador = $_POST['registrador'];
$numeroPartida = $_POST['numeroPartida'];
$asiento = $_POST['asiento'];
$recibo = $_POST['recibo'];
$fechaInscripcion = $_POST['fechaInscripcion'];



if($codmovreg==""){
  
$consulmove=mysql_query("Select * from movirrpp order by idmovreg DESC LIMIT 1", $conn) or die(mysql_error());

$rowmove = mysql_fetch_array($consulmove);

$numeroc=$rowmove['idmovreg'];
$sumac= intval($numeroc) + 1;
$cantidadc= strlen($sumac);
switch ($cantidadc) {
case "1":
$codmove="000000000".$sumac;
break;
case "2":
$codmove="00000000".$sumac; 
break;
case "3":
$codmove="0000000".$sumac;
break;
case "4":
$codmove="000000".$sumac; 
break;
case "5":
$codmove="00000".$sumac;
break;
case "6":
$codmove="0000".$sumac; 
break; 
case "7":
$codmove="000".$sumac; 
break; 
case "8":
$codmove="00".$sumac; 
break; 
case "9":
$codmove="0".$sumac; 
break;
case "10":
$codmove=$sumac; 
break; 
}
$grabarmov="INSERT INTO movirrpp(idmovreg, kardex) VALUES ('$codmove','$codkardex')";
mysql_query($grabarmov,$conn) or die(mysql_error());

$grabarmovie="INSERT INTO detallemovimiento(itemmov, idmovreg, fechamov, vencimiento, titulorp, idsedereg, idsecreg, idtiptraoges, idestreg, encargado, anotacion, importee, observa,registrador,numeroPartida,asiento,recibo,fechaInscripcion) 
VALUES (NULL,'$codmove','$fechamov','$vencimiento','$titulorp','$idsedereg','$idsecreg','$idtiptraoges','$idestreg','$encargado','$anotacion','$importee','$observa','$registrador','$numeroPartida','$asiento','$recibo','$fechaInscripcion')";


mysql_query($grabarmovie,$conn) or die(mysql_error());

$cobrado=0;
$md=0;

$grabarsaldo="INSERT INTO saldorrpp(idmovreg, cobrado, pagadorrpp, mayorderecho, xcobrarclie) VALUES ('$codmove','$cobrado','$importee','$md','$importee')";
mysql_query($grabarsaldo,$conn) or die(mysql_error()); 

}else{

	$grabarmovimiento="INSERT INTO detallemovimiento(itemmov, idmovreg, fechamov, vencimiento, titulorp, idsedereg, idsecreg, idtiptraoges, idestreg, encargado, anotacion, importee, observa,registrador,numeroPartida,asiento,recibo,fechaInscripcion) VALUES (NULL,'$codmovreg','$fechamov','$vencimiento','$titulorp','$idsedereg','$idsecreg','$idtiptraoges','$idestreg','$encargado','$anotacion','$importee','$observa','$registrador','$numeroPartida','$asiento','$recibo','$fechaInscripcion')";
		mysql_query($grabarmovimiento,$conn) or die(mysql_error());
		
	$sqlsaldito="select * from saldorrpp where idmovreg='$codmovreg'";
	$rptasaldito=mysql_query($sqlsaldito,$conn) or die(mysql_error());	
	$rowsaldito=mysql_fetch_array($rptasaldito);
	
	$cobrado=0;
	
	if($conestado=="P"){
	$totalpagado=floatval($rowsaldito['pagadorrpp'])+floatval($importee);
	$xcobrarrrr=floatval($rowsaldito['cobrado']) - floatval($totalpagado);
	  if(floatval($xcobrarrrr)<0){$xcobr= floatval($xcobrarrrr) * -1;}
	$grabarsaldo="UPDATE saldorrpp set pagadorrpp='$totalpagado', xcobrarclie='$xcobr' where idmovreg='$codmovreg'";
	mysql_query($grabarsaldo,$conn) or die(mysql_error());
	}
	
	if($conestado=="L"){
	$grabarsaldo="UPDATE saldorrpp set mayorderecho='$importee' where idmovreg='$codmovreg'";
	mysql_query($grabarsaldo,$conn) or die(mysql_error());
	}
	
	if($conestado=="M"){
	$totalpagadom=floatval($rowsaldito['pagadorrpp'])+floatval($importee);
	$xcobrarrr=floatval($rowsaldito['cobrado']) - floatval($totalpagadom);
	$mayordere=floatval($rowsaldito['mayorderecho'])-floatval($importee);
	 if(floatval($xcobrarrr)<0){$xcobrrar=floatval($xcobrarrr) * -1;}
	$grabarsaldo="UPDATE saldorrpp set mayorderecho='$mayordere', pagadorrpp='$totalpagadom', xcobrarclie='$xcobrrar' where idmovreg='$codmovreg'";
	mysql_query($grabarsaldo,$conn) or die(mysql_error());
	}
}
?>
