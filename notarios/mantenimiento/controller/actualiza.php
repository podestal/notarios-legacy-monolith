<?php 

include("../../conexion.php");

$tipper= strtoupper($_POST['tipoper']);
 $apepat= strtoupper($_POST['apepat']);
$apemat= strtoupper($_POST['apemat']);
$prinom= strtoupper($_POST['prinom']);
$segnom= strtoupper($_POST['segnom']);
$nombre=$apepat." ".$apemat.", ".$prinom." ".$segnom;
$direccion= strtoupper($_POST['direccion']);
$idtipdoc=intval($_POST['tipodoc']);
$numdoc=$_POST['numdoc'];
$email= strtoupper($_POST['email']);
$telfijo=$_POST['telfijo'];
$telcel=$_POST['telcel'];
$telofi=$_POST['telofi'];
$sexo=$_POST['sexo'];
$idestcivil=intval($_POST['idestcivil']);
$natper= strtoupper($_POST['natper']);
$nacionalidad=intval($_POST['nacionalidad']);
$idprofesion=intval($_POST['idprofesion']);
$idcargoo=intval($_POST['idcargoo']);
 $cumpclie=$_POST['cumpclie'];
$codubisc=$_POST['codubisc'];
$nomprofesiones=$_POST['nomprofesiones'];
$profocupa=$_POST['nomcargoss'];
$cconyuge=$_POST['cconyuge'];
$ubigensc=$_POST['ubigensc'];
$residente=$_POST['residente'];
$docpaisemi=$_POST['docpaisemi'];
$tipocli=$_POST['chkHabilitado'];


$ncliente=$_REQUEST['idcliente'];

 $nrooficio=$_REQUEST['nrooficio'];
 $origenoficio=$_POST['origenoficio'];
 $entidad=$_POST['entidad'];
 $remitente=$_POST['remitente'];
 $motivo=$_POST['motivo'];

//exit();



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
/*
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
*/
/* $grabarclientesc="
INSERT INTO cliente 
(idcliente, tipper, apepat, apemat, prinom, segnom, 
nombre, direccion, idtipdoc, numdoc, email, telfijo,
 telcel, telofi, sexo, idestcivil, natper, conyuge, nacionalidad, idprofesion, detaprofesion, idcargoprofe, profocupa, dirfer, idubigeo, cumpclie, fechaing, razonsocial, domfiscal, telempresa, mailempresa, contacempresa, fechaconstitu, idsedereg, numregistro, numpartida, actmunicipal, tipocli, impeingre, impnumof, impeorigen, impentidad, impremite, impmotivo,residente,docpaisemi) 
VALUES 
('$ncliente','$tipper','$apepat','$apemat','$prinom','$segnom',
'$nombre','$direccion','$idtipdoc','$numdoc','$email','$telfijo',
'$telcel','$telofi','$sexo','$idestcivil','$natper','$cconyuge','$nacionalidad','$idprofesiioon','$nomprofesiones','$idcargoosss','$profocupa','','$idubigeoos','','$cumpclie','','','','','','',1,'','','','$tipocli1','','$nrooficio','$origenoficio','$entidad','$remitente','$motivo','$residente','$docpaisemi')";*/


echo  $actualizarclientesc = "update cliente set  tipper='".$tipper."', apepat='".$apepat."',apemat='".$apemat."',prinom='".$prinom."',segnom='".$segnom."',nombre='".$nombre."',direccion='".$direccion."',idtipdoc='".$idtipdoc."',numdoc='".$numdoc."',email='".$email."',telfijo='".$telcel."',telcel='".$telcel."',telofi='".$telofi."',sexo='".$sexo."',idestcivil='".$idestcivil."',natper='".$natper."',conyuge='".$cconyuge."',nacionalidad='".$nacionalidad."',idprofesion='".$idprofesiioon."',detaprofesion='".$nomprofesiones."',idcargoprofe='".$idcargoosss."',profocupa='".$profocupa."',idubigeo='".$idubigeoos."',cumpclie='".$cumpclie."',tipocli='".$tipocli1."',impnumof='".$nrooficio."',impeorigen='".$origenoficio."',impentidad='".$entidad."',impremite='".$remitente."',impmotivo='".$motivo."',residente='".$residente."',docpaisemi='".$docpaisemi."' WHERE idcliente='".$ncliente."'";


mysql_query($actualizarclientesc ,$conn) or die(mysql_error());

?>
<script language='javascript'>alert('Se actualizo Satisfactoriamente');</script> 
 <script type="text/javascript">window.location="newimpedidoglobal.php"; </script>