<?php
include_once '../../conexion.php';
$listErrors = $_POST['listError'];
$data = json_decode($listErrors);


$totalCorrectErrors = count($data);
$totalCorrectErrorOk = 0;
foreach ($data as $row) {
	# code...
	$kardex = $row->kardex;
	$tipoActo = $row->tipoActo;
	$itemMp = $row->itemMp;
	$typeOfCorrection = $row->typeOfCorrection;
	$categoryCorrect = $row->categoryCorrect;
	$idContractor = $row->idContractor;
	#EMPRESAS EN CONSTITUCION
	if($categoryCorrect == 1){
		
		$sql = "UPDATE cliente2 SET idtipdoc = '10',numdoc = '' WHERE idcontratante = '$idContractor'";
		//die($sql);
		$result = mysql_query($sql);
		if(mysql_affected_rows() != 0){
			$totalCorrectErrorOk = $totalCorrectErrorOk +1;
		}
	}
	#PROFESION
	if($categoryCorrect == 2){
		
		$sql = "UPDATE cliente2 SET idprofesion = '53',detaprofesion = 'OTROS' WHERE idcontratante = '$idContractor'";
		//die($sql);
		$result = mysql_query($sql);
		if(mysql_affected_rows() != 0){
			$totalCorrectErrorOk = $totalCorrectErrorOk +1;
		}
	}
	#CARGO
	if($categoryCorrect == 3){
		
		$sql = "UPDATE cliente2 SET idcargoprofe = '36',profocupa = 'OTROS' WHERE idcontratante = '$idContractor'";
		//die($sql);
		$result = mysql_query($sql);
		if(mysql_affected_rows() != 0){
			$totalCorrectErrorOk = $totalCorrectErrorOk +1;
		}
	}
	
}


$objStdClass = new stdClass();
$objStdClass->error = 0;
$objStdClass->errorDescription = 'Se afectaron '.$totalCorrectErrorOk.' registros.';
echo json_encode($objStdClass);	