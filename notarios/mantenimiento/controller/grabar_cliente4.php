
<?php 

include("conexion.php");

$tipper=$_POST['tipoper'];
$apepat4=strtoupper($_POST['apepat4']);
$apemat4=strtoupper($_POST['apemat4']);
$prinom4=strtoupper($_POST['prinom4']);
$segnom4=strtoupper($_POST['segnom4']);
$nombre4=strtoupper($apepat4." ".$apemat4.", ".$prinom4." ".$segnom4);
$direccion4=strtoupper($_POST['direccion4']);
$idtipdoc=intval($_POST['tipodoc']);
$numdoc2=$_POST['numdoc2'];
$email4=$_POST['email4'];
$telfijo4=$_POST['telfijo4'];
$telcel4=$_POST['telcel4'];
$telofi4=$_POST['telofi4'];
$sexo4=$_POST['sexo4'];
$idestcivil4=intval($_POST['idestcivil4']);
$natper4=$_POST['natper4'];
$nacionalidad4=intval($_POST['nacionalidad4']);
$idprofesion4=intval($_POST['idprofesion4']);
$idcargoo4=intval($_POST['idcargoo4']);
$cumpclie4=$_POST['cumpclie4'];
$codubisc4=$_POST['codubisc4'];
$nomprofesiones4=$_POST['nomprofesiones4'];
$profocupa4=$_POST['nomcargoss4'];
$ubigensc4=$_POST['ubigensc4'];
$residente4=$_POST['residente4'];
$docpaisemi4=$_POST['docpaisemi4'];
$codclie4=$_POST['codclie4'];

if ($nomprofesiones4==""){
$idprofesiioon4=0;
}else{
$idprofesiioon4=$idprofesion4;
}

if ($profocupa4==""){
$idcargoosss4=0;
}else{
$idcargoosss4=$idcargoo4;
}


if ($ubigensc4==""){
$idubigeoos4=0;
}else{
$idubigeoos4=$codubisc4;
}


$grabarclientesc2="UPDATE cliente SET apepat='$apepat4',apemat='$apemat4',prinom='$prinom4',segnom='$segnom4',nombre='$nombre4',direccion='$direccion4',email='$email4',telfijo='$telfijo4',telcel='$telcel4',telofi='$telofi4',sexo='$sexo4',idestcivil='$idestcivil4',natper='$natper4',nacionalidad='$nacionalidad4',idprofesion='$idprofesiioon4',detaprofesion='$nomprofesiones4',idcargoprofe='$idcargoosss4',profocupa='$profocupa4',idubigeo='$idubigeoos4',cumpclie='$cumpclie4',residente='$residente4',docpaisemi='$docpaisemi4' WHERE numdoc='$numdoc2'";
mysql_query($grabarclientesc2,$conn) or die(mysql_error());

echo"<input name='cconyuge' type='hidden' value='$codclie4' /><img src='iconos/conyugeadd.png' />";

?>