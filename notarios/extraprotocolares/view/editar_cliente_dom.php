<?php 

include("conexion.php");

$idCliente=$_POST['idCliente'];
// print_r($idCliente);return false;
$tipper=$_POST['tipoper'];
$apepat=strtoupper(str_replace("ñ","Ñ",$_POST['apepat']));
$apemat=strtoupper(str_replace("ñ","Ñ",$_POST['apemat']));
$prinom=strtoupper(str_replace("ñ","Ñ",$_POST['prinom']));
$segnom=strtoupper(str_replace("ñ","Ñ",$_POST['segnom']));
$nombre=strtoupper($apepat." ".$apemat.", ".$prinom." ".$segnom);
$direccion=strtoupper(str_replace("ñ","Ñ",$_POST['direccion']));
$idtipdoc=intval("1");
$numdoc=$_POST['numdoc'];
$email=$_POST['email'];
$telfijo=$_POST['telfijo'];
$telcel=$_POST['telcel'];
$telofi=$_POST['telofi'];
$sexo=$_POST['sexo'];
$idestcivil=intval($_POST['idestcivil']);
$natper=$_POST['natper'];
$nacionalidad=intval($_POST['nacionalidad']);
$idprofesion=intval($_POST['idprofesion']);
$idcargoo=intval($_POST['idcargoo']);
$cumpclie=$_POST['cumpclie'];
$codubisc=$_POST['codubisc'];
$nomprofesiones=$_POST['nomprofesiones'];
$profocupa=$_POST['nomcargoss'];
$cconyuge="0";
$ubigensc=$_POST['ubigensc'];
$residente=$_POST['residente'];
$docpaisemi=$_POST['docpaisemi'];

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



$queryEditarCliente = "UPDATE cliente SET
tipper = '$tipper', 
apepat = '$apepat', 
apemat = '$apemat', 
prinom = '$prinom', 
segnom = '$segnom', 
nombre = '$nombre', 
direccion = '$direccion', 
email = '$email', 
telfijo = '$telfijo', 
telcel = '$telcel', 
telofi = '$telofi', 
sexo = '$sexo', 
idestcivil = '$idestcivil', 
natper = '$natper', 
conyuge = '$cconyuge', 
nacionalidad = '$nacionalidad', 
idprofesion = '$idprofesiioon', 
detaprofesion = '$nomprofesiones', 
idcargoprofe = '$idcargoosss', 
profocupa = '$profocupa', 
dirfer = '', 
idubigeo = '$idubigeoos', 
cumpclie = '$cumpclie', 
residente = '$residente',
docpaisemi= '$docpaisemi'
where idcliente='$idCliente'";
mysql_query($queryEditarCliente,$conn) or die(mysql_error());

?>
