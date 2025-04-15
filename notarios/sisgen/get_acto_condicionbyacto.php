<?php
require_once 'conexion.php';
$codActo = $_POST['codActos'];

$data = array();
$sql  = "SELECT  * FROM tiposdeacto WHERE idtipoacto = '$codActo' LIMIT 1";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
$data[] = $row;

$sql = "SELECT *FROM actocondicion WHERE idtipoacto = '$codActo'";
$result1 = mysqli_query($conn,$sql);
$dataCondiciones = array();

while($row1 = mysqli_fetch_array($result1)){
	$parte = $row1['parte'];
	$uif = $row1['uif'];
	$montoP = $row1['montop'];
	if($parte == ''){
		$parte = '-1';
	}
	if($uif == ''){
		$uif = '-1';
	}
	if($montoP == ''){
		$montoP = '-1';
	}
	
	$row1['parte'] = $parte;
	$row1['uif'] = $uif;
	$row1['montop'] = $montoP;


	$dataCondiciones[] = $row1;
}

$objResponse = new stdClass();
$objResponse->error = 0;
$objResponse->dataActo = $data;
$objResponse->dataCondicion = $dataCondiciones;
echo json_encode($objResponse);

