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
	$numCertificado = $year.str_repeat('0', 6-strlen($sum)).$sum;

	$sql2 = "SELECT cert_domiciliario.num_certificado AS num_certificado FROM cert_domiciliario WHERE  LEFT(cert_domiciliario.num_certificado,4) = '$year' AND cert_domiciliario.num_certificado = '$numCertificado'";


	$resultSql2 = mysql_query($sql2,$conn);
	$totalRecords = mysql_num_rows($resultSql2); 

	if($totalRecords == 0){
		$sql3 = "INSERT INTO cert_domiciliario
				    (id_domiciliario, num_certificado, fec_ingreso, num_formu, nombre_solic, tipdoc_solic, numdoc_solic,  domic_solic,  motivo_solic,  distrito_solic,  texto_cuerpo,  justifi_cuerpo)VALUES(NULL,$numCertificado , STR_TO_DATE('$inputDate','%d/%m/%Y'), '', '', '', '',  '',  '',  '',  '',  '')"; 



     
		mysql_query($sql3,$conn) or die(mysql_error());
	}
	
}

