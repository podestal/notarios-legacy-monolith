<?php 

include("conexion.php");

$apepatexto=strtoupper($_POST['apepat3']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$aaaa=str_replace("ñ","Ñ",$cabioapostroa);
$apepat3=strtoupper($aaaa);

$apemattexto=strtoupper($_POST['apemat3']);
$cabioapostrom=str_replace("'","?",$apemattexto);
$bbbb=str_replace("ñ","Ñ",$cabioapostrom);
$apemat3=strtoupper($bbbb);

$prinomp=strtoupper($_POST['prinom3']);
$cabioapostrop=str_replace("'","?",$prinomp);
$cccc=str_replace("ñ","Ñ",$cabioapostrop);
$prinom3=strtoupper($cccc);

$segnomp=strtoupper($_POST['segnom3']);
$cabioapostromm=str_replace("'","?",$segnomp);
$dddd=str_replace("ñ","Ñ",$cabioapostromm);
$segnom3=strtoupper($dddd);


$direccionpp=strtoupper($_POST['direccion3']);
$cabioapostropp=str_replace("'","?",$direccionpp);
$eeeee=str_replace("ñ","Ñ",$cabioapostropp);
$direccion3=strtoupper($eeeee);

$nombre3=strtoupper($apepat3." ".$apemat3.", ".$prinom3." ".$segnom3);

$numdoc3=$_POST['numdoc3'];
$email3=$_POST['email3'];
$telfijo3=$_POST['telfijo3'];
$telcel3=$_POST['telcel3'];
$telofi3=$_POST['telofi3'];
$sexo3=$_POST['sexo3'];
$idestcivil3=intval($_POST['idestcivil3']);
$natper3=$_POST['natper3'];
$nacionalidad3=intval($_POST['nacionalidad3']);
$idprofesion3=intval($_POST['idprofesion3']);
$idcargoo3=intval($_POST['idcargoo3']);
$cumpclie3=$_POST['cumpclie3'];
$codubisc3=$_POST['codubisc3'];
$nomprofesiones3=$_POST['nomprofesiones3'];
$profocupa3=$_POST['nomcargoss3'];
$ubigensc3=$_POST['ubigensc3'];
$residente3=$_POST['residente3'];
$docpaisemi3=$_POST['docpaisemi3'];
$codclie3=$_POST['codclie3'];
$cconyuge6=$_POST['cconyuge6'];

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


if ($ubigensc3==""){
$idubigeoos3=0;
}else{
$idubigeoos3=$codubisc3;
}


$grabarclientesc2="UPDATE cliente SET apepat='$apepat3',apemat='$apemat3',prinom='$prinom3',segnom='$segnom3',nombre='$nombre3',direccion='$direccion3',email='$email3',telfijo='$telfijo3',telcel='$telcel3',telofi='$telofi3',sexo='$sexo3',idestcivil='$idestcivil3',natper='$natper3',nacionalidad='$nacionalidad3',idprofesion='$idprofesiioon3',detaprofesion='$nomprofesiones3',idcargoprofe='$idcargoosss3',profocupa='$profocupa3',idubigeo='$idubigeoos3',cumpclie='$cumpclie3',residente='$residente3',docpaisemi='$docpaisemi3',ubigeo_plantilla='$ubigensc3' WHERE numdoc='$numdoc3'";
mysql_query($grabarclientesc2,$conn) or die(mysql_error());

if ($cconyuge6!=""){

$grabarconyugee="update cliente set conyuge='$codclie3' where idcliente='$cconyuge6'";
mysql_query($grabarconyugee,$conn) or die(mysql_error());

}

//echo"<input name='cconyuge' type='hidden' value='$codclie3' /><img src='iconos/conyugeadd.png' />";

?>