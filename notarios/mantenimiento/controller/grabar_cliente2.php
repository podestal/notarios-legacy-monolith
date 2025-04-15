<?php 

include("../../conexion.php");

$apepat= strtoupper($_POST['apepat2']);
$apemat= strtoupper($_POST['apemat2']);
$prinom= strtoupper($_POST['prinom2']);
$segnom= strtoupper($_POST['segnom2']);
$nombre=$apepat." ".$apemat.", ".$prinom." ".$segnom;
$direccion= strtoupper($_POST['direccion2']);

$numdoc=$_POST['numdoc2'];
$email= strtoupper($_POST['email2']);
$telfijo=$_POST['telfijo2'];
$telcel=$_POST['telcel2'];
$telofi=$_POST['telofi2'];
$sexo=$_POST['sexo2'];
$idestcivil=intval($_POST['idestcivil2']);
$natper= strtoupper($_POST['natper2']);
$nacionalidad=intval($_POST['nacionalidad2']);
$idprofesion=intval($_POST['idprofesion2']);
$idcargoo=intval($_POST['idcargoo2']);
$cumpclie=$_POST['cumpclie2'];
$codubisc=$_POST['codubisc2'];
$nomprofesiones=$_POST['nomprofesiones2'];
$profocupa=$_POST['nomcargoss2'];
$cconyuge=$_POST['cconyuge'];
$ubigensc=$_POST['ubigensc2'];
$residente=$_POST['residente2'];
$docpaisemi=$_POST['docpaisemi2'];

if ($nomprofesiones==""){
$idprofesiioon=0;
}else{
$idprofesiioon=$idprofesion;
}

if ($profocupa==""){
$idcargoosss=0;
}else{
$idcargoosss=$idcargoo;
}


if ($ubigensc==""){
$idubigeoos=0;
}else{
$idubigeoos=$codubisc;
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


$grabarclientesc="INSERT INTO cliente (idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo,residente,docpaisemi) VALUES ('$ncliente','N','$apepat','$apemat','$prinom','$segnom','$nombre','$direccion','1','$numdoc','$email','$telfijo','$telcel','$telofi','$sexo','$idestcivil','$natper','','$nacionalidad','$idprofesiioon','$nomprofesiones','$idcargoosss','$profocupa','',$idubigeoos,'$cumpclie','','','','','','','',1,'','','','0','','','','','','','$residente','$docpaisemi')";
mysql_query($grabarclientesc,$conn) or die(mysql_error());

echo"<input name='cconyuge6' id='cconyuge6' type='hidden' value='$ncliente' />";

?>