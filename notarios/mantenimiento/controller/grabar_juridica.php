<?php 

include("../../conexion.php");
	
	
	$tipoper		= $_POST['tipoper'];	
	$tipodoc		=$_POST['tipodoc'];
	$codubi 		= $_POST['codubi'];
	$razonsocial 	= $_POST['razonsocial'];
	$numruc  		= $_POST['num_ruc'];
	$domfiscal	 	=  $_POST['domfiscal'];
	$contacempresa 	=  $_POST['contacempresa'];
	$fechaconstitu 	=  $_POST['fechaconstitu'];
	$numregistro 	=  $_POST['numregistro'];
	$idsedereg3 	=  $_POST['idsedereg3'];
	$numpartida 	=  $_POST['numpartida'];
	$telempresa 	=  $_POST['telempresa'];
	$actmunicipal 	=  $_POST['actmunicipal'];
	$mailempresa 	=  $_POST['mailempresa'];
	
	$ubigen 		=  $_POST['ubigen'];
	$codubi 		= $_POST['codubi'];

if ($ubigen==""){
$idubigeoos4=0;
}else{
$idubigeoos4=$codubi;
}


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


$grabarclientesc="INSERT INTO cliente 
(idcliente,tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo,residente,docpaisemi) 
VALUES ('$ncliente','$tipoper','','','','','','','$tipodoc','$numruc','','','','','',0,'','','',0,'',0,'','','$ubigen','','','$razonsocial','$domfiscal',
'$telempresa','$mailempresa','$contacempresa','$fechaconstitu','$idsedereg3','$numregistro','$numpartida','$actmunicipal','','','','','','','','','')";
mysql_query($grabarclientesc,$conn) or die(mysql_error());
?>

