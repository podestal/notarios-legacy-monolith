<?php 
include("conexion.php");

$itemmp       = $_POST['itemmp'];
$tipob        = $_POST['tipob'];
$tipobien     = $_POST['tipobien'];
$codubis      = $_POST['codubis'];
$fechaconst   = $_POST['fechaconst'];
$oespecific   = $_POST['oespecific'];
$smaquiequipo = $_POST['smaquiequipo'];
$tpsm         = $_POST['tpsm'];
$npsm         = $_POST['npsm'];
$pregis       = $_POST['pregis'];
$idsedereg    = $_POST['idsedereg'];

############################

mysql_query("UPDATE detallebienes SET tipob = '$tipob', idtipbien = '$tipobien', coddis = '$codubis', fechaconst = '$fechaconst', oespecific = '$oespecific', smaquiequipo = '$smaquiequipo', tpsm = '$tpsm', npsm = '$npsm' , pregistral = '$pregis' , idsedereg = '$idsedereg'  WHERE itemmp = '$itemmp'  ", $conn) or die(mysql_error());

?>