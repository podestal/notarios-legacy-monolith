<?php 

include("conexion.php");

$tipdocu = $_POST['tipdocu'];
$apepatexto=strtoupper($_POST['apepatcnt']);
$cabioapostroa=str_replace("'","?",$apepatexto);
$aaaa=str_replace("ñ","Ñ",$cabioapostroa);
$apepat3=strtoupper($aaaa);

$apemattexto=strtoupper($_POST['apematcnt']);
$cabioapostrom=str_replace("'","?",$apemattexto);
$bbbb=str_replace("ñ","Ñ",$cabioapostrom);
$apemat3=strtoupper($bbbb);

$prinomp=strtoupper($_POST['prinomcnt']);
$cabioapostrop=str_replace("'","?",$prinomp);
$cccc=str_replace("ñ","Ñ",$cabioapostrop);
$prinom3=strtoupper($cccc);

$segnomp=strtoupper($_POST['segnomcnt']);
$cabioapostromm=str_replace("'","?",$segnomp);
$dddd=str_replace("ñ","Ñ",$cabioapostromm);
$segnom3=strtoupper($dddd);


$direccionpp=strtoupper($_POST['direccioncnt']);
$cabioapostropp=str_replace("'","?",$direccionpp);
$eeeeee=str_replace("ñ","Ñ",$cabioapostropp);
$direccion3=strtoupper($eeeeee);

$nombre3=strtoupper($apepat3." ".$apemat3.", ".$prinom3." ".$segnom3);
$numdoc3=$_POST['numdoccnt'];
//echo $numdoc3.$tipdocu;
$email3=$_POST['emailcnt'];
$telfijo3=$_POST['telfijocnt'];
$telcel3=$_POST['telcelcnt'];
$telofi3=$_POST['teloficnt'];
$sexo3=$_POST['sexocnt'];
$idestcivil3=intval($_POST['idestcivilcnt']);
$natper3=$_POST['natpercnt'];
$nacionalidad3=intval($_POST['nacionalidadcnt']);
$idprofesion3=intval($_POST['idprofesioncnt']);
$idcargoo3=intval($_POST['idcargoocnt']);
$cumpclie3=$_POST['cumpcliecnt'];
$codubisc3=$_POST['codubisccnt'];
$nomprofesiones3=$_POST['nomprofesionescnt'];
$profocupa3=$_POST['nomcargosscnt'];
$ubigensc3=$_POST['ubigensccnt'];
$residente3=$_POST['residentecnt'];
$docpaisemi3=$_POST['docpaisemicnt'];
$codclie3=$_POST['codcliecnt'];
$cconyuge6=$_POST['cconyugecnt'];
$idcontra=$_POST['idcontra'];
$idconyucli = $_POST['idconyucli'];


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


$grabarclientesc2="UPDATE cliente2 SET apepat='$apepat3',apemat='$apemat3',prinom='$prinom3',segnom='$segnom3',nombre='$nombre3',direccion='$direccion3',email='$email3',telfijo='$telfijo3',telcel='$telcel3',telofi='$telofi3',sexo='$sexo3',idestcivil='$idestcivil3',natper='$natper3',conyuge= '$cconyuge6',nacionalidad='$nacionalidad3',idprofesion='$idprofesiioon3',detaprofesion='$nomprofesiones3',idcargoprofe='$idcargoosss3',profocupa='$profocupa3',idubigeo='$idubigeoos3',cumpclie='$cumpclie3',residente='$residente3',docpaisemi='$docpaisemi3' ,idtipdoc = '$tipdocu', numdoc='$numdoc3',ubigeo_plantilla='$ubigensc3' WHERE idcontratante='$idcontra'";
mysql_query($grabarclientesc2,$conn) or die(mysql_error());



$grabarclientesc1="UPDATE cliente SET apepat='$apepat3',apemat='$apemat3',prinom='$prinom3',segnom='$segnom3',nombre='$nombre3',direccion='$direccion3',email='$email3',telfijo='$telfijo3',telcel='$telcel3',telofi='$telofi3',sexo='$sexo3',idestcivil='$idestcivil3',natper='$natper3',conyuge='$cconyuge6',nacionalidad='$nacionalidad3',idprofesion='$idprofesiioon3',detaprofesion='$nomprofesiones3',idcargoprofe='$idcargoosss3',profocupa='$profocupa3',idubigeo='$idubigeoos3',cumpclie='$cumpclie3',residente='$residente3',docpaisemi='$docpaisemi3' , numdoc='$numdoc3', ubigeo_plantilla='$ubigensc3' WHERE idcliente='$codclie3'";
mysql_query($grabarclientesc1,$conn) or die(mysql_error());


$grabarConyugeDelConyuge1 = "UPDATE cliente SET conyuge='$codclie3' WHERE idcliente='$cconyuge6'";
mysql_query($grabarConyugeDelConyuge1,$conn) or die(mysql_error());

$grabarConyugeDelConyuge2 = "UPDATE cliente2 SET conyuge='$codclie3' WHERE idcliente='$cconyuge6'";
mysql_query($grabarConyugeDelConyuge2,$conn) or die(mysql_error());


// if ($cconyuge6!=""){

// $grabarconyugee="update cliente2 set conyuge='$idconyucli' where idcontratante='$cconyuge6'";
// mysql_query($grabarconyugee,$conn) or die(mysql_error());

// }

//echo"<input name='cconyuge' type='hidden' value='$codclie3' /><img src='iconos/conyugeadd.png' />";

?>