<?php
include('../../conexion.php');

$num_carta       = $_POST["num_carta"];
$fec_ingreso     = $_POST["fec_ingreso"];
$id_remitente 	 = $_POST["id_remitente"];
# nuevos segun req.
$remi      = strtoupper($_POST['remitente']);
$remi1     = str_replace("'","?",$remi);
$remitente = strtoupper($remi1);

$direccion_remi=strtoupper($_POST['direccion_remi']);
$direccion_remi1=str_replace("'","?",$direccion_remi);
$direccion_remi=strtoupper($direccion_remi1);

$telefono 	     = $_POST["telefono"];
#

$nom_destinatario 	     = $_POST["nom_destinatario"];
$dir_destinatario 	     = $_POST["dir_destinatario"];
$zona_destinatario       = $_POST["zona_destinatario"];

$costo         = $_POST["costo"];
$id_encargado  = $_POST["id_encargado"];
$des_encargado = $_POST["des_encargado"];
$fec_entrega   = $_POST["fec_entrega"];
$hora_entrega  = $_POST["hora_entrega"];
$emple_entrega = $_POST["emple_entrega"];
$conte_carta   = $_POST["conte_carta"];
$nom_regogio   = $_POST["nom_regogio"];
$doc_recogio   = $_POST["doc_recogio"];
$fec_recogio   = $_POST["fec_recogio"];
$fact_recogio  = $_POST["fact_recogio"];

// verifica la existendia del numero de carta, sino edita

if($num_carta =='')
{
// se arma el numero de la carta  formato:  'año + 000001';

$busnumcarta = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(ingreso_cartas.num_carta,6) AS DECIMAL))+1))),
(MAX(CAST(RIGHT(ingreso_cartas.num_carta,6) AS DECIMAL))+1)) AS numcarta FROM ingreso_cartas";

$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$newnumcarta  = $rownum[0];
if($newnumcarta == '')
{
	$new_num_carta = date('Y').'000001';
}
else if($newnumcarta != '')
{
	$new_num_carta = $newnumcarta;
}

########
echo "<input name='numcarta' id='numcarta' readonly='readonly' type='hidden' value='".$new_num_carta."' style='font-family:Calibri; font-size:14px; color:#003366; border:none;' size='11'>";

// Muestra el ID en la forma:  000001-2013
$numkar = $new_num_carta;
$numkar2 = substr($numkar,4,6).'-'.substr($numkar,0,4);

echo "<input name='muesnumcarta' id='muesnumcarta' readonly='readonly' type='text' value='".$numkar2."' style='font-family:Calibri; font-size:16px; color:#003366; border:none;' size='11'>";
########


$grabacartas = "INSERT INTO ingreso_cartas(id_carta, num_carta, fec_ingreso, id_remitente, nom_remitente, dir_remitente, telf_remitente, nom_destinatario, dir_destinatario, zona_destinatario, costo, id_encargado,
des_encargado, fec_entrega, hora_entrega, emple_entrega, conte_carta, nom_regogio, doc_recogio, fec_recogio, fact_recogio)
VALUES (NULL, '$new_num_carta', '$fec_ingreso', '$id_remitente', '$remitente', '$direccion_remi', '$telefono', '$nom_destinatario', '$dir_destinatario', '$zona_destinatario', '$costo', '$id_encargado',
'$des_encargado', '$fec_entrega', '$hora_entrega', '$emple_entrega', '$conte_carta', '$nom_regogio', '$doc_recogio', '$fec_recogio', '$fact_recogio')";
mysql_query($grabacartas,$conn) or die(mysql_error());

}
# edicion
if($num_carta != '')
{

$updatecarta="UPDATE ingreso_cartas SET ingreso_cartas.fec_ingreso= '$fec_ingreso', ingreso_cartas.id_remitente = '$id_remitente', ingreso_cartas.nom_remitente = '$remitente',  ingreso_cartas.dir_remitente = '$direccion_remi', ingreso_cartas.telf_remitente = '$telefono', ingreso_cartas.nom_destinatario = '$nom_destinatario',ingreso_cartas.dir_destinatario = '$dir_destinatario', ingreso_cartas.zona_destinatario = '$zona_destinatario', ingreso_cartas.costo = '$costo', ingreso_cartas.id_encargado = '$id_encargado',ingreso_cartas.des_encargado = '$des_encargado', ingreso_cartas.fec_entrega = '$fec_entrega', ingreso_cartas.hora_entrega = '$hora_entrega', ingreso_cartas.emple_entrega = '$emple_entrega', ingreso_cartas.conte_carta = '$conte_carta', ingreso_cartas.nom_regogio = '$nom_regogio', ingreso_cartas.doc_recogio = '$doc_recogio', ingreso_cartas.fec_recogio = '$fec_recogio', ingreso_cartas.fec_entrega = '$fec_entrega' WHERE ingreso_cartas.num_carta = '$num_carta'";
mysql_query($updatecarta,$conn) or die(mysql_error());

################
echo "<input name='numcarta' id='numcarta' readonly='readonly' type='hidden' value='".$num_carta."' style='font-family:Calibri; font-size:20px; color:#003366; border:none;' 																																																										size='8'>";

// Muestra el ID en la forma:  000001-2013
$numkarE = $num_carta;
$numkar3 = substr($numkarE,4,6).'-'.substr($numkarE,0,4);

echo "<input name='muesnumcarta' id='muesnumcarta' readonly='readonly' type='text' value='".$numkar3."' style='font-family:Calibri; font-size:16px; color:#003366; border:none;' size='8'>";
################
	
}
mysql_close($conn);

?>


