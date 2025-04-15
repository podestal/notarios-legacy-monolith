<?php
include('../../conexion.php');

$numberRecords = $_POST["num_registros"];
$numberStart  = $_POST["num_kinicial"];
$inputDate   = $_POST["fec_ingreso"];

$start = intval($numberStart);
$end = intval($numberRecords);
$total = intval($end - $start);

$arrayDate = explode("/", $inputDate); 
$year = $arrayDate[2];

for ($x = 0; $x <=$total; $x++) {

 	$sum  = $start + $x;
	$numCarta = $year.str_repeat('0', 6-strlen($sum)).$sum;

	$sql2 = "SELECT num_carta FROM ingreso_cartas WHERE LEFT(ingreso_cartas.num_carta,4) = '$year' AND ingreso_cartas.num_carta = '$numCarta'";


	$resultSql2 = mysql_query($sql2,$conn);
	$totalRecords = mysql_num_rows($resultSql2); 

	if($totalRecords == 0){

		$sql3 = "INSERT INTO ingreso_cartas(num_carta,fec_ingreso,id_remitente,nom_remitente,dir_remitente,telf_remitente,nom_destinatario,dir_destinatario,zona_destinatario,costo,id_encargado,des_encargado,fec_entrega,hora_entrega,emple_entrega,conte_carta,nom_regogio,doc_recogio,fec_recogio,fact_recogio) VALUES('$numCarta',STR_TO_DATE('$inputDate','%d/%m/%Y'),'','','','','','','','','','','','','','','','','','')"; 
		mysql_query($sql3,$conn) or die(mysql_error());
	}
	
}



/*
$num_registros = $_POST["num_registros"];
$fec_ingreso = $_POST["fec_ingreso"];



for($i=1;$i <= $num_registros ; $i++) 
{	
    
    $sqlNumCarta = "SELECT num_carta FROM ingreso_cartas order by id_carta DESC LIMIT 1";
     
     $resultNumCarta = mysql_query($sqlNumCarta,$conn) or die(mysql_error());
	 $row = mysql_fetch_array($resultNumCarta);
	 $numCarta = intval($row['num_carta']) + 1;


	$sqlIngresoCartas = "INSERT INTO ingreso_cartas(num_carta,fec_ingreso,id_remitente,nom_remitente,dir_remitente,telf_remitente,nom_destinatario,dir_destinatario,zona_destinatario,costo,id_encargado,des_encargado,fec_entrega,
hora_entrega,emple_entrega,conte_carta,nom_regogio,doc_recogio,fec_recogio,fact_recogio) 
	     VALUES('$numCarta','$fec_ingreso','','','','','','','','','','','','','','','','','','')";

 	$numkarbus = mysql_query($sqlIngresoCartas,$conn) or die(mysql_error());

}
*/


