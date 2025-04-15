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
	$numCrono = $year.str_repeat('0', 6-strlen($sum)).$sum;

	$sql2 = "SELECT num_crono FROM cambio_caracter WHERE LEFT(cambio_caracter.num_crono,4) = '$year' AND cambio_caracter.num_crono = '$numCrono'";

	//echo $numCrono;
	$resultSql2 = mysql_query($sql2,$conn);
	$totalRecords = mysql_num_rows($resultSql2); 

	if($totalRecords == 0){

		$sql3 = "INSERT INTO cambio_caracter
				    (id_cambio,  num_crono,  fec_ingreso, num_formu,  nombre, tipdoc,  num_docu,  direccion,  ecivil,  c_nombre, c_tipdoc, c_numdoc,  representacion,  poder_inscrito,  int_legitimo)
			VALUES 	    (NULL,$numCrono,STR_TO_DATE('$inputDate','%d/%m/%Y'), '',  '', '',  '',  '',  '',  '', '', '',  '',  '',  '')"; 
		mysql_query($sql3,$conn) or die(mysql_error());
	}
	
}
