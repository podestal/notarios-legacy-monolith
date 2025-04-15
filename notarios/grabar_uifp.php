<?php 
include("conexion.php");

$codkardex=$_POST['codkardex'];
$pregis=$_POST['pregis'];
$nregis=$_POST['nregis'];
$idsedereg2=$_POST['idsedereg2'];
$fpago=$_POST['fpago'];
$oporpago=$_POST['oporpago'];
$ofpago=$_POST['ofpago'];
$itemmpp=$_POST['itemmpp'];


mysql_query("UPDATE patrimonial SET presgistral='$pregis',nregistral='$nregis',idsedereg='$idsedereg2',fpago='$fpago',idoppago='$oporpago',ofondos='$ofpago' WHERE itemmp='$itemmpp'", $conn) or die(mysql_error());

?>

