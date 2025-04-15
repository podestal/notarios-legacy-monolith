<?php
include('conexion.php');

	$idtipacto = $_POST["idtipacto"];
	$kardex    = $_POST["kardex"];
	$itemmp    = $_POST["itemmp"];
	
	$sqlvehicular = "SELECT detallevehicular.detveh FROM detallevehicular WHERE detallevehicular.kardex = '$kardex' AND detallevehicular.idtipacto = '$idtipacto'";
	$rptavehi     = mysql_query($sqlvehicular,$conn) or die(mysql_error());	
	
	$rowvehicular = mysql_fetch_array($rptavehi);
	$evalvehiculo = $rowvehicular[0];

if($evalvehiculo=='')
{
	$elimlispatri = "DELETE FROM patrimonial WHERE patrimonial.itemmp = '$itemmp' AND patrimonial.kardex = '$kardex' AND patrimonial.idtipoacto = '$idtipacto'";
	mysql_query($elimlispatri,$conn) or die(mysql_error());
	
	$elimbienes   = "DELETE FROM detallebienes WHERE detallebienes.itemmp = '$itemmp' AND detallebienes.kardex = '$kardex' AND detallebienes.idtipacto = '$idtipacto'";
	mysql_query($elimbienes,$conn) or die(mysql_error());
	
	$elimdetpago  = "DELETE FROM detallemediopago WHERE detallemediopago.itemmp = '$itemmp' AND detallemediopago.kardex = '$kardex' AND detallemediopago.tipacto = '$idtipacto'";
	mysql_query($elimdetpago,$conn) or die(mysql_error());
	
	
	//$elimdetalle_actos_kardex  = "DELETE FROM detalle_actos_kardex WHERE detalle_actos_kardex.idtipoacto = '$idtipacto' AND detalle_actos_kardex.kardex = '$kardex'";
	//mysql_query($elimdetalle_actos_kardex,$conn) or die(mysql_error());
	
}
else if($evalvehiculo!='')
{
	$elimlispatri = "DELETE FROM patrimonial WHERE patrimonial.itemmp = '$itemmp' AND patrimonial.kardex = '$kardex' AND patrimonial.idtipoacto = '$idtipacto'";
	mysql_query($elimlispatri,$conn) or die(mysql_error());
	
	$elimvehicular = "DELETE FROM detallevehicular WHERE detallevehicular.kardex = '$kardex' AND detallevehicular.idtipacto = '$idtipacto'";
	mysql_query($elimvehicular,$conn) or die(mysql_error());
	
	$elimdetpago  = "DELETE FROM detallemediopago WHERE detallemediopago.itemmp = '$itemmp' AND detallemediopago.kardex = '$kardex' AND detallemediopago.tipacto = '$idtipacto'";
	mysql_query($elimdetpago,$conn) or die(mysql_error());
	
	//$elimdetalle_actos_kardex  = "DELETE FROM detalle_actos_kardex WHERE detalle_actos_kardex.idtipoacto = '$idtipacto' AND detalle_actos_kardex.kardex = '$kardex'";
	//mysql_query($elimdetalle_actos_kardex,$conn) or die(mysql_error());
	
}

mysql_close($conn);

?>
