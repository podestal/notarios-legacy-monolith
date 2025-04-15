<?php
include('../../conexion.php');

$num_carta = $_POST["num_carta"];
$fec_ingreso  = $_POST["fec_ingreso"];
$id_remitente 	 = $_POST["id_remitente"];
# nuevos segun req.

$remite=strtoupper($_POST['remitente']);
$remite1=str_replace("'","?",$remite);
$remite2=str_replace("&","*",$remite1);
$remitente=strtoupper($remite2);

$direccion_remit=strtoupper($_POST['direccion_remi']);
$direccion_remit1=str_replace("'","?",$direccion_remit);
$direccion_remit2=str_replace("&","*",$direccion_remit1);
$direccion_remi=strtoupper($direccion_remit2);


$telefono 	     = $_POST["telefono"];
#

$dni_destinatario 	     = $_POST["dni_destinatario"];
$nom_destinatario 	     = $_POST["nom_destinatario"];
$dir_destinatario 	     = $_POST["dir_destinatario"];
$zona_destinatario  = $_POST["zona_destinatario"];

$costo  = $_POST["costo"];
$id_encargado  = $_POST["id_encargado"];
$des_encargado  = $_POST["des_encargado"];
$fec_entrega  = $_POST["fec_entrega"];
$hora_entrega  = $_POST["hora_entrega"];
$emple_entrega  = $_POST["emple_entrega"];
$conte_carta  = $_POST["conte_carta"];
$nom_regogio  = $_POST["nom_regogio"];
$doc_recogio  = $_POST["doc_recogio"];
$fec_recogio  = $_POST["fec_recogio"];
$fact_recogio  = $_POST["fact_recogio"];
$recepcion  = $_POST["recepcion"];
$firmo  = $_POST["firmo"];

$updatecarta="UPDATE ingreso_cartas SET ingreso_cartas.fec_ingreso= '$fec_ingreso', ingreso_cartas.id_remitente = '$id_remitente', ingreso_cartas.nom_remitente = '$remitente',  ingreso_cartas.dir_remitente = '$direccion_remi', ingreso_cartas.telf_remitente = '$telefono', ingreso_cartas.nom_destinatario = '$nom_destinatario',ingreso_cartas.dir_destinatario = '$dir_destinatario', ingreso_cartas.zona_destinatario = '$zona_destinatario', ingreso_cartas.costo = '$costo', ingreso_cartas.id_encargado = '$id_encargado',ingreso_cartas.des_encargado = '$des_encargado', ingreso_cartas.fec_entrega = '$fec_entrega', ingreso_cartas.hora_entrega = '$hora_entrega', ingreso_cartas.emple_entrega = '$emple_entrega', ingreso_cartas.conte_carta = '$conte_carta', ingreso_cartas.nom_regogio = '$nom_regogio', ingreso_cartas.doc_recogio = '$doc_recogio', ingreso_cartas.fec_recogio = '$fec_recogio', ingreso_cartas.fec_entrega = '$fec_entrega', ingreso_cartas.fact_recogio = '$fact_recogio',ingreso_cartas.dni_destinatario='$dni_destinatario',ingreso_cartas.recepcion= '$recepcion',ingreso_cartas.firmo = '$firmo'  WHERE ingreso_cartas.num_carta = '$num_carta'";
mysql_query($updatecarta,$conn) or die(mysql_error());
mysql_close($conn);
?>


