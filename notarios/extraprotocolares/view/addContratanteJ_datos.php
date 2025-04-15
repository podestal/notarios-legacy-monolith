<?php session_start();
include("../../conexion.php");


$razonsocial=$_POST['razonsocial'];
$domfiscal=$_POST['domfiscal'];
$ubigen=$_POST['ubigen'];
$contacempresa=$_POST['contacempresa'];
$fechaconstitu=$_POST['fechaconstitu'];
$numregistro=$_POST['numregistro'];
$idsedereg3=$_POST['idsedereg3'];
$numpartida=$_POST['numpartida'];
$telempresa=$_POST['telempresa'];
$actmunicipal=$_POST['actmunicipal'];
$mailempresa=$_POST['mailempresa'];

$numdoc=$_POST['numdoc'];
$tipdoc=$_POST['tipdoc'];
$tipper=$_POST['tipper'];

$consulclien=mysql_query("Select * from cliente order by idcliente DESC LIMIT 1", $conn) or die(mysql_error());

$rowclin = mysql_fetch_array($consulclien);

$numeroc=$rowclin['idcliente'];
$sumac= intval($numeroc) + 1;
$cantidadc= strlen($sumac);


 switch ($cantidadc) {
	case "1":
	$ncliente="000000000".$sumac;
	break;
	case "2":
	$ncliente="00000000".$sumac;	
	break;
	case "3":
	$ncliente="0000000".$sumac;
	break;
	case "4":
	$ncliente="000000".$sumac;	
	break;
	case "5":
	$ncliente="00000".$sumac;
	break;
	case "6":
	$ncliente="0000".$sumac;	
	break;		
	case "7":
	$ncliente="000".$sumac;	
	break;	
	case "8":
	$ncliente="00".$sumac;	
	break;	
	case "9":
	$ncliente="0".$sumac;	
	break;
	case "10":
	$ncliente=$sumac;	
	break;			
}

$sql=mysql_query("insert into cliente (idcliente,razonsocial,domfiscal,idubigeo,contacempresa,fechaconstitu,numregistro,idsedereg,numpartida,telempresa,actmunicipal,mailempresa,idtipdoc,numdoc,tipper) 
values ('".$ncliente."',
		'".$razonsocial."',
		'".$domfiscal."',
		'".$ubigen."',
		'".$contacempresa."',
		'".$fechaconstitu."',
		'".$numregistro."',
		 ".$idsedereg3.",
		".$numpartida.",
		'".$telempresa."',
		'".$actmunicipal."',
		'".$mailempresa."',
		 ".$tipdoc.",
		'".$numdoc."',
		'".$tipper."')",$conn);
		
		if($sql){

			echo "<script>alert('El cliente ha sido registrado con exito');location.href ='IngCartasVie.php?val1=".$numdoc."&val2=".$tipdoc."&val3=".$razonsocial."&val4=".$telempresa."&val5=".$domfiscal."&val6=".$tipper."';</script>";
		}else{
			echo "<script>alert('No se ha podido registrar al cliente');location.href ='javascript:history.back(1)';</script>";

		}
?>