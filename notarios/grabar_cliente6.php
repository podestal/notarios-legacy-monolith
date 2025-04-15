<?php 

include("conexion.php");

$apepat6=strtoupper(str_replace("ñ","Ñ",$_POST['apepat6']));
$apemat6=strtoupper(str_replace("ñ","Ñ",$_POST['apemat6']));
$prinom6=strtoupper(str_replace("ñ","Ñ",$_POST['prinom6']));
$segnom6=strtoupper(str_replace("ñ","Ñ",$_POST['segnom6']));
$nombre6=strtoupper($apepat6." ".$apemat6.", ".$prinom6." ".$segnom6);
$direccion6=strtoupper($_POST['direccion6']);
$numdoc6=$_POST['numdoc6'];
$email6=$_POST['email6'];
$telfijo6=$_POST['telfijo6'];
$telcel6=$_POST['telcel6'];
$telofi6=$_POST['telofi6'];
$sexo6=$_POST['sexo6'];
$idestcivil6=intval($_POST['idestcivil6']);
$natper6=$_POST['natper6'];
$nacionalidad6=intval($_POST['nacionalidad6']);
$idprofesion6=intval($_POST['idprofesion6']);
$idcargoo6=intval($_POST['idcargoo6']);
$cumpclie6=$_POST['cumpclie6'];
$codubisc6=$_POST['codubisc6'];
$nomprofesiones6=$_POST['nomprofesiones6'];
$profocupa6=$_POST['nomcargoss6'];
$ubigensc6=$_POST['ubigensc6'];
$residente6=$_POST['residente6'];
$docpaisemi6=$_POST['docpaisemi6'];
$codclie6=$_POST['codclie6'];

if ($nomprofesiones6==""){
$idprofesiioon6=0;
}else{
$idprofesiioon6=$idprofesion6;
}

if ($profocupa6==""){
$idcargoosss6=0;
}else{
$idcargoosss6=$idcargoo6;
}


if ($ubigensc6==""){
$idubigeoos6=0;
}else{
$idubigeoos6=$codubisc6;
}


$grabarclientesc2="UPDATE cliente SET apepat='$apepat6',apemat='$apemat6',prinom='$prinom6',segnom='$segnom6',nombre='$nombre6',direccion='$direccion6',email='$email6',telfijo='$telfijo6',telcel='$telcel6',telofi='$telofi6',sexo='$sexo6',idestcivil='$idestcivil6',natper='$natper6',nacionalidad='$nacionalidad6',idprofesion='$idprofesiioon6',detaprofesion='$nomprofesiones6',idcargoprofe='$idcargoosss6',profocupa='$profocupa6',idubigeo='$idubigeoos6',cumpclie='$cumpclie6',residente='$residente6',docpaisemi='$docpaisemi6' WHERE numdoc='$numdoc6'";
mysql_query($grabarclientesc2,$conn) or die(mysql_error());


echo"<input name='cconyuge3' id='cconyuge3' type='hidden' value='".$codclie6."' /><img src='iconos/conyugeadd.png' />";

?>