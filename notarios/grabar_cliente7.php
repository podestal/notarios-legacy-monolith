<?php 

include("conexion.php");

$tipper="N";
$apepat7=strtoupper(str_replace("ñ","Ñ",$_POST['apepat7']));
$apemat7=strtoupper(str_replace("ñ","Ñ",$_POST['apemat7']));
$prinom7=strtoupper(str_replace("ñ","Ñ",$_POST['prinom7']));
$segnom7=strtoupper(str_replace("ñ","Ñ",$_POST['segnom7']));
$nombre7=strtoupper($apepat7." ".$apemat7.", ".$prinom7." ".$segnom7);
$direccion7=strtoupper(str_replace("ñ","Ñ",$_POST['direccion7']));
$idtipdoc=$_POST['tidocu2'];
$numdoc6=$_POST['numdoc6'];
$email7=$_POST['email7'];
$telfijo7=$_POST['telfijo7'];
$telcel7=$_POST['telcel7'];
$telofi7=$_POST['telofi7'];
$sexo7=$_POST['sexo7'];
$idestcivil7=intval($_POST['idestcivil7']);
$natper7=$_POST['natper7'];
$nacionalidad7=intval($_POST['nacionalidad7']);
$idprofesion7=intval($_POST['idprofesion7']);
$idcargoo7=intval($_POST['idcargoo7']);
$cumpclie7=$_POST['cumpclie7'];
$codubisc7=$_POST['codubisc7'];
$nomprofesiones7=$_POST['nomprofesiones7'];
$profocupa7=$_POST['nomcargoss7'];
$ubigensc7=$_POST['ubigensc7'];
$residente7=$_POST['residente7'];
$docpaisemi7=$_POST['docpaisemi7'];

if ($nomprofesiones7==""){
$idprofesiioon7=0;
}else{
$idprofesiioon7=$idprofesion7;
}

if ($profocupa7==""){
$idcargoosss7=0;
}else{
$idcargoosss7=$idcargoo7;
}


if ($ubigensc7==""){
$idubigeoos7=0;
}else{
$idubigeoos7=$codubisc7;
}


$consulclien=mysql_query("Select * from cliente order by idcliente DESC LIMIT 1", $conn) or die(mysql_error());

$rowclin = mysql_fetch_array($consulclien);

$numeroc=$rowclin['idcliente'];
$sumac= intval($numeroc) + 1;
$cantidadc= strlen($sumac);


 switch ($cantidadc) {
	case "1":
	$ncliente7="000000000".$sumac;
	break;
	case "2":
	$ncliente7="00000000".$sumac;	
	break;
	case "3":
	$ncliente7="0000000".$sumac;
	break;
	case "4":
	$ncliente7="000000".$sumac;	
	break;
	case "5":
	$ncliente7="00000".$sumac;
	break;
	case "6":
	$ncliente7="0000".$sumac;	
	break;		
	case "7":
	$ncliente7="000".$sumac;	
	break;	
	case "8":
	$ncliente7="00".$sumac;	
	break;	
	case "9":
	$ncliente7="0".$sumac;	
	break;
	case "10":
	$ncliente7=$sumac;	
	break;			
}


$grabarclientesc7="INSERT INTO cliente (idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo,residente,docpaisemi) VALUES ('$ncliente7','$tipper','$apepat7','$apemat7','$prinom7','$segnom7','$nombre7','$direccion7','$idtipdoc','$numdoc6','$email7','$telfijo7','$telcel7','$telofi7','$sexo7','$idestcivil7','$natper7','','$nacionalidad7','$idprofesiioon7','$nomprofesiones7','$idcargoosss7','$profocupa7','',$idubigeoos7,'$cumpclie7','','','','','','','',1,'','','','0','','','','','','','$residente7','$docpaisemi7')";
mysql_query($grabarclientesc7,$conn) or die(mysql_error());

echo"<input name='cconyuge3' id='cconyuge3' type='hidden' value='$ncliente7' /><img src='iconos/conyugeadd.png' />";

?>