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
$busnumcarta = "SELECT num_carta  FROM ingreso_cartas  ORDER BY num_carta DESC LIMIT 0,1";

$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$newnumcarta  = $rownum[0];
$ano_ult_carta= intval(substr($newnumcarta,0,4));
$ano_actual=intval(date('Y'));

if($newnumcarta == '')
{	
	$new_num_carta = date('Y').'000001';
}

if($newnumcarta != '')
{		
	if($ano_actual > $ano_ult_carta){
		$new_num_carta=$ano_actual.'000001';
		}else{
	   $new_num_carta = intval($newnumcarta)+1;}
}
$grabacartas = "INSERT INTO ingreso_cartas(id_carta, num_carta, fec_ingreso, id_remitente, nom_remitente, dir_remitente, telf_remitente, nom_destinatario, dir_destinatario, zona_destinatario, costo, id_encargado,
des_encargado, fec_entrega, hora_entrega, emple_entrega, conte_carta, nom_regogio, doc_recogio, fec_recogio, fact_recogio)
VALUES (NULL, '$new_num_carta', '$fec_ingreso', '$id_remitente','$remitente', '', '', '', '', '', '', '','', '', '', '', '', '', '', '', '')";
mysql_query($grabacartas,$conn) or die(mysql_error());
}
mysql_close($conn);
?>
