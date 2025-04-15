<?php
include('conexion1.php');


$apepat=$_REQUEST['apepat'];
$apemat=$_REQUEST['apemat'];
$prinom=$_REQUEST['prinom'];
$segnom=$_REQUEST['segnom'];
$concatenar=$apepat.$apemat." ".$prinom.$segnom;
$direccion=$_REQUEST['direccion'];

$tipopersona=$_REQUEST['tipopersona'];
$numerodocumento=$_REQUEST['numerodocumento'];
$tipodocumento=$_REQUEST['tipodocumento'];

$ubigensc=$_REQUEST['ubigensc'];
$buscaubisc3=$_REQUEST['buscaubisc3'];
$buscaprofes=$_REQUEST['buscaprofes'];
$buscacargooss=$_REQUEST['buscacargooss'];
$idestcivil=$_REQUEST['idestcivil'];
$sexo=$_REQUEST['sexo'];
$nacionalidad=$_REQUEST['nacionalidad'];
$residente=$_REQUEST['residente'];
$natper=$_REQUEST['natper'];
$cumpclie=$_REQUEST['cumpclie'];
$docpaisemi=$_REQUEST['docpaisemi'];
$nomprofesiones=$_REQUEST['nomprofesiones'];
$nomcargoss=$_REQUEST['nomcargoss'];
$telcel=$_REQUEST['telcel'];
$telofi=$_REQUEST['telofi'];
$telfijo=$_REQUEST['telfijo'];
$email=$_REQUEST['email'];


 echo $sql="INSERT INTO cliente
 (idcliente,
tipper,
apepat,
apemat,
prinom,
segnom,
nombre,
direccion,
idtipdoc,
numdoc,
email,
telfijo,
telcel,
telofi,
sexo,
idestcivil,
natper,
detaprofesion,
profocupa,
idubigeo,
tipocli,
impeingre
)
VALUES('','$tipopersona','$apepat','$apemat','$prinom','$segnom','$concatenar','$direccion','$tipodocumento','$numerodocumento','$email','$telfijo','$telcel','$telofi','$sexo','$idestcivil','$natper','$buscaprofes','$nomprofesiones','$ubigensc','1','$cumpclie')";
  mysql_query($sql, $conn) or die(mysql_error());




?>
<script language='javascript'>alert('Datos grabado correctamente');</script> 
<script type="text/javascript">window.location="grabarnewimpedidoglobal.php"; </script> 

