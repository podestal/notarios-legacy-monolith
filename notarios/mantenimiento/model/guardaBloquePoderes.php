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

/*
$sql1 = "SELECT CAST(MAX(cert_domiciliario.num_certificado) AS SIGNED  INTEGER)  AS num_certificado FROM cert_domiciliario WHERE  LEFT(cert_domiciliario.num_certificado,4) = '$year'";

$resultSql1 = mysql_query($sql1, $conn) or die(mysql_error());
$rowSql1 = mysql_fetch_array($resultSql1);
$numCertificado = intval($rowSql1["num_certificado"]);
*/

for ($x = 0; $x <=$total; $x++) {

 	$sum  = $start + $x;
	$numKardex = $year.str_repeat('0', 6-strlen($sum)).$sum;

	$sql2 = "SELECT ingreso_poderes.num_kardex AS numkar FROM ingreso_poderes WHERE LEFT(ingreso_poderes.num_kardex,4) = '$year' AND ingreso_poderes.num_kardex = '$numKardex'";


	$resultSql2 = mysql_query($sql2,$conn);
	$totalRecords = mysql_num_rows($resultSql2); 

	if($totalRecords == 0){
		$sql3 = "INSERT INTO ingreso_poderes
				    (id_poder,  num_kardex,  nom_recep,  hora_recep,  id_asunto,  fec_ingreso,  referencia,  nom_comuni,  telf_comuni,  email_comuni,  documento,  id_respon,  des_respon,  doc_presen,  fec_ofre,  hora_ofre,  num_formu,  fec_crono, swt_est)VALUES 	    (NULL,  '$numKardex',  '',  '',  '002',  STR_TO_DATE('$inputDate','%d/%m/%Y'),  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '', '')"; 
				 



     
		mysql_query($sql3,$conn) or die(mysql_error());
	}
	
}



/*
require_once("../../includes/_ClsCon.php");


$_obj   = new _ClsCon()                    ;

$num_registros    = $_POST["num_registros"];
//$num_kinicial     = $_POST["num_kinicial"];
$fec_ingreso 	  = $_POST["fec_ingreso"];

				$spAsignaKardex = "CALL spAsignaNumero_poder( '".$fec_ingreso."' ,  '".$num_registros."' );";	
				$_obj->_trans($spAsignaKardex);
**/





