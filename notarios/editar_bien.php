<?php 
include("conexion.php");

$detbien   = $_POST['detbien'];
$detbienx  = $_POST['detbienx'];
$codkardex = $_POST['codkardex'];

$tipob     = $_POST['tipob2'];
$tipobien  = $_POST['tipobien2'];
$codubis   = $_POST['codubis2'];
$fechaconst   = $_POST['fechaconst2'];
$oespecific   = $_POST['oespecific2'];
$smaquiequipo = $_POST['smaquiequipo2'];

$tpsm         = $_POST['tpsm2'];
$npsm         = $_POST['npsm2'];

$pregis        = $_POST['pregis5'];
$idsederegbien = $_POST['idsederegGG'];
$fecha_modificacion = date("d/m/Y");

mysql_query("UPDATE detallebienes SET tipob = '$tipob', idtipbien = '$tipobien', coddis = '$codubis', fechaconst = '$fechaconst', oespecific = '$oespecific', smaquiequipo = '$smaquiequipo', tpsm = '$tpsm', npsm = '$npsm', pregistral = '$pregis', idsedereg = '$idsederegbien'  WHERE detbien = '$detbienx'  ", $conn) or die(mysql_error());

$sqlmodificacion="UPDATE KARDEX SET  fecha_modificacion ='$fecha_modificacion', estado_sisgen='0' WHERE KARDEX ='$codkardex'"; 
mysql_query($sqlmodificacion,$conn) or die(mysql_error());


?>