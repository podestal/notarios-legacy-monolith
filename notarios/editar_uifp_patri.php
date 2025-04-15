<?php 
include("conexion.php");

$itemmp    = $_POST['itemmp'];

$pregis     = $_POST['pregis'];
$nregis     = $_POST['nregis'];
$idsedereg = $_POST['idsedereg'];
$fpago      = $_POST['fpago'];
$oporpago   = $_POST['oporpago'];
$ofpago     = $_POST['ofpago'];



mysql_query("UPDATE patrimonial SET presgistral='$pregis',nregistral='$nregis',idsedereg='$idsedereg',fpago='$fpago',idoppago='$oporpago',ofondos='$ofpago' WHERE itemmp='$itemmp'", $conn) or die(mysql_error());

?>