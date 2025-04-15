<?php
include('../../conexion.php');

$num_cartas         = $_POST["num_cartas"];
$remitente          = $_POST["remitente"];

$fec_ingreso 	    = $_POST["fec_ingreso"];
$id_remitente 	    = $_POST["idremitente"];

//SE CREA EL BLOQUE DE CARTAS
for($i=1;$i <= $num_cartas ; $i++) 
{	
// se arma el numero de la carta  formato:  'año + 000001';
$busnumcarta = "SELECT CONCAT(YEAR(NOW()),REPEAT('0',6-LENGTH((MAX(CAST(RIGHT(ingreso_cartas.num_carta,6) AS DECIMAL))+1))),
(MAX(CAST(RIGHT(ingreso_cartas.num_carta,6) AS DECIMAL))+1)) AS numcarta FROM ingreso_cartas";

$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$newnumcarta  = $rownum[0];

if($newnumcarta == '')
{
	$new_num_carta = '2014000001';
}
else if($newnumcarta != '')
{
	$new_num_carta = $newnumcarta;
}
$grabacartas = "INSERT INTO ingreso_cartas(id_carta, num_carta, fec_ingreso, id_remitente, nom_remitente, dir_remitente, telf_remitente, nom_destinatario, dir_destinatario, zona_destinatario, costo, id_encargado,
des_encargado, fec_entrega, hora_entrega, emple_entrega, conte_carta, nom_regogio, doc_recogio, fec_recogio, fact_recogio)
VALUES (NULL, '$new_num_carta', '$fec_ingreso', '$id_remitente','$remitente', '', '', '', '', '', '', '','', '', '', '', '', '', '', '', '')";
mysql_query($grabacartas,$conn) or die(mysql_error());
}
mysql_close($conn);
?>
