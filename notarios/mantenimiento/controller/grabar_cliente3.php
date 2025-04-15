<?php 

include("../../conexion.php");

$codclie3		= $_POST['codclie'];
$apepat3 		= $_POST['apepat'];
$apemat3		= $_POST['apemat'];
$prinom3		= $_POST['prinom'];
$segnom3		= $_POST['segnom'];
$nombre3		=$apepat3." ".$apemat3.", ".$prinom3." ".$segnom3;
$direccion3		=$_POST['direccion'];
$numdoc3 		=$_POST['numdoc'];
$email3 	 	=$_POST['email'];
$telfijo3 	 	=$_POST['telfijo'];
$telcel3		=$_POST['telcel'];
$telofi3		=$_POST['telofi'];
$sexo3			=$_POST['sexo'];
$idestcivil3	=intval($_POST['idestcivil']);
$natper3		=$_POST['natper'];
$nacionalidad3	=intval($_POST['nacionalidad']);
$idprofesion3	=intval($_POST['idprofesion']);
$idcargoo3		=intval($_POST['idcargoo']);
$cumpclie3		=$_POST['cumpclie'];
$nomprofesiones3=$_POST['nomprofesiones'];
$profocupa3		=$_POST['nomcargoss'];
$residente3		=$_POST['residente'];
$docpaisemi3	=$_POST['docpaisemi'];
$codclie3		=$_POST['codclie'];


$ubigensc3		=$_POST['ubigensc'];
$codubisc3		=$_POST['codubisc'];

$tipodoc		= intval($_POST['tipodoc']);
//echo $tipodoc; exit();
//$cconyuge6=$_POST['cconyuge6'];
if ($ubigensc3==""){
$idubigeoos3=0;
}else{
$idubigeoos3=$codubisc3;
}


if ($nomprofesiones3==""){
$idprofesiioon3=0;
}else{
$idprofesiioon3=$idprofesion3;
}

if ($profocupa3==""){
$idcargoosss3=0;
}else{
$idcargoosss3=$idcargoo3;
}


$grabarclientesc2="UPDATE cliente SET apepat='$apepat3',apemat='$apemat3',prinom='$prinom3',segnom='$segnom3',nombre='$nombre3',direccion='$direccion3',numdoc='$numdoc3',email='$email3',telfijo='$telfijo3',telcel='$telcel3',telofi='$telofi3',sexo='$sexo3',idestcivil='$idestcivil3',natper='$natper3',nacionalidad='$nacionalidad3',idprofesion='$idprofesiioon3',detaprofesion='$nomprofesiones3',idcargoprofe='$idcargoosss3',profocupa='$profocupa3',idubigeo='$idubigeoos3',cumpclie='$cumpclie3',residente='$residente3',docpaisemi='$docpaisemi3' , idtipdoc='$tipodoc' WHERE idcliente='$codclie3'";

mysql_query($grabarclientesc2,$conn) or die(mysql_error());

/*if ($cconyuge6!=""){

$grabarconyugee="update cliente set conyuge='$codclie3' where idcliente='$cconyuge6'";
mysql_query($grabarconyugee,$conn) or die(mysql_error());

}*/

//echo"<input name='cconyuge' type='hidden' value='$codclie3' /><img src='iconos/conyugeadd.png' />";

?>