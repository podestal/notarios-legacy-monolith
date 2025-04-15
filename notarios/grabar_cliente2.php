<?php 

include("conexion.php");

$tipper=$_POST['tipoper'];
$apepat2=strtoupper(str_replace("ñ","Ñ",$_POST['apepat2']));
$apemat2=strtoupper(str_replace("ñ","Ñ",$_POST['apemat2']));
$prinom2=strtoupper(str_replace("ñ","Ñ",$_POST['prinom2']));
$segnom2=strtoupper(str_replace("ñ","Ñ",$_POST['segnom2']));
$nombre2=strtoupper($apepat2." ".$apemat2.", ".$prinom2." ".$segnom2);
$direccion2=strtoupper(str_replace("ñ","Ñ",$_POST['direccion2']));
$idtipdoc=intval($_POST['tipodoc']);
$numdoc2=$_POST['numdoc2'];
$email2=$_POST['email2'];
$telfijo2=$_POST['telfijo2'];
$telcel2=$_POST['telcel2'];
$telofi2=$_POST['telofi2'];
$sexo2=$_POST['sexo2'];
$idestcivil2=intval($_POST['idestcivil2']);
$natper2=$_POST['natper2'];
$nacionalidad2=intval($_POST['nacionalidad2']);
$idprofesion2=intval($_POST['idprofesion2']);
$idcargoo2=intval($_POST['idcargoo2']);
$cumpclie2=$_POST['cumpclie2'];
$codubisc2=$_POST['codubisc2'];
$nomprofesiones2=strtoupper(str_replace("ñ","Ñ",$_POST['nomprofesiones2']));
$profocupa2=$_POST['nomcargoss2'];
$ubigensc2=$_POST['ubigensc2'];
$residente2=$_POST['residente2'];
$docpaisemi2=$_POST['docpaisemi2'];

if ($nomprofesiones2==""){
$idprofesiioon2=0;
}else{
$idprofesiioon2=$idprofesion2;
}

if ($profocupa2==""){
$idcargoosss2=0;
}else{
$idcargoosss2=$idcargoo2;
}


if ($ubigensc2==""){
$idubigeoos2=0;
}else{
$idubigeoos2=$codubisc2;
}


$consulclien=mysql_query("Select * from cliente order by idcliente DESC LIMIT 1", $conn) or die(mysql_error());

$rowclin = mysql_fetch_array($consulclien);

$numeroc=$rowclin['idcliente'];
$sumac= intval($numeroc) + 1;
$cantidadc= strlen($sumac);


 switch ($cantidadc) {
	case "1":
	$ncliente2="000000000".$sumac;
	break;
	case "2":
	$ncliente2="00000000".$sumac;	
	break;
	case "3":
	$ncliente2="0000000".$sumac;
	break;
	case "4":
	$ncliente2="000000".$sumac;	
	break;
	case "5":
	$ncliente2="00000".$sumac;
	break;
	case "6":
	$ncliente2="0000".$sumac;	
	break;		
	case "7":
	$ncliente2="000".$sumac;	
	break;	
	case "8":
	$ncliente2="00".$sumac;	
	break;	
	case "9":
	$ncliente2="0".$sumac;	
	break;
	case "10":
	$ncliente2=$sumac;	
	break;			
}


$grabarclientesc2="INSERT INTO cliente (idcliente, tipper, apepat, apemat, prinom, segnom, nombre, direccion, idtipdoc, numdoc, email, telfijo, telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo,residente,docpaisemi) VALUES ('$ncliente2','$tipper','$apepat2','$apemat2','$prinom2','$segnom2','$nombre2','$direccion2','$idtipdoc','$numdoc2','$email2','$telfijo2','$telcel2','$telofi2','$sexo2','$idestcivil2','$natper2','','$nacionalidad2','$idprofesiioon2','$nomprofesiones2','$idcargoosss2','$profocupa2','',$idubigeoos2,'$cumpclie2','','','','','','','',1,'','','','0','','','','','','','$residente2','$docpaisemi2')";
mysql_query($grabarclientesc2,$conn) or die(mysql_error());

echo"<input name='cconyuge' type='hidden' value='$ncliente2' /><img src='iconos/conyugeadd.png' />";

?>