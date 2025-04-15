<?php
include('../../conexion.php');

$numberRecords = $_POST["num_registros"];
$numberStart  = $_POST["num_kinicial"];
$inputDate   = $_POST["fec_ingreso"];
$capacity = intval($_POST['capacidad']) == 1?'C':'I';

$start = intval($numberStart);
$end = intval($numberRecords);
$total = intval($end - $start);



$arrayDate = explode("/", $inputDate); 
$year = $arrayDate[2];

for ($x = 0; $x <=$total; $x++) {

 	$sum  = $start + $x;
	$numCrono = $year.str_repeat('0', 6-strlen($sum)).$sum;

	$sql2 = "SELECT cert_supervivencia.num_crono FROM cert_supervivencia WHERE LEFT(cert_supervivencia.num_crono,4) = '$year' AND cert_supervivencia.num_crono = '$numCrono' AND cert_supervivencia.swt_capacidad = '$capacity'";



	$resultSql2 = mysql_query($sql2,$conn);
	$totalRecords = mysql_num_rows($resultSql2); 

	if($totalRecords == 0){

		$sql3 = "INSERT INTO cert_supervivencia
				    (id_supervivencia, num_crono, fecha,  num_formu,  documento,  nombre,  tipdocu,  numdocu,  nacionalidad, ecivil, ubigeo, direccion,  observaciones,  representante,  tipdocu_rep,  numdocu_rep,  nombre_rep,  nom_testigo,  tdoc_testigo,  ndocu_testigo, swt_capacidad)VALUES(NULL, '$numCrono', STR_TO_DATE('$inputDate','%d/%m/%Y'),  '',  '',  '',  '',  '',  '', '', '', '',  '',  '',  '',  '',  '',  '',  '',  '', '$capacity')"; 
		mysql_query($sql3,$conn) or die(mysql_error());
	}
	
}



/*
require_once("../../includes/_ClsCon.php");
$_obj   = new _ClsCon()                    ;

$num_registros    = $_POST["num_registros"];
//$num_kinicial     = $_POST["num_kinicial"];
$fec_ingreso 	  = $_POST["fec_ingreso"];

				$spAsignaKardex = "CALL spAsignaNumero_supervivencia( '".$fec_ingreso."' ,  '".$num_registros."' );";	
				$_obj->_trans($spAsignaKardex);
?>
*/

