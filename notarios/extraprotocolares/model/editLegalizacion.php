<?php
include('../../conexion.php');

$num_carta = $_POST["num_carta"];
$fec_ingreso  = $_POST["fec_ingreso"];
$id_remitente 	 = $_POST["id_remitente"];
# nuevos segun req.

$remite=strtoupper($_POST['remitente']);
$remite1=str_replace("'","?",$remite);
$remite2=str_replace("&","*",$remite1);
$remite2=str_replace(",","",$remite2);
$remitente=strtoupper($remite2);

$direccion_remit=strtoupper($_POST['direccion_remi']);
$direccion_remit1=str_replace("'","?",$direccion_remit);
$direccion_remit2=str_replace("&","*",$direccion_remit1);
$direccion_remi=strtoupper($direccion_remit2);

$telefono 	     = $_POST["telefono"];
#




$updatecarta="UPDATE legalizaciones as l SET l.fec_ingreso= '$fec_ingreso', l.id_parte = '$id_remitente', l.nombre = '$remitente',  l.direccion = '$direccion_remi', l.telefono = '$telefono'  WHERE l.num_firma = '$num_carta'";
mysql_query($updatecarta,$conn) or die(mysql_error());
mysql_close($conn);
?>


