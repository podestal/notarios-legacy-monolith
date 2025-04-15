<?php
require_once 'conexion.php';

$codActos = $_POST['codActos'];
$data = array();
for($i = 0;$i<strlen($codActos);$i = $i+3){
	$codActo = substr($codActos, $i ,3);

	$sql  = "SELECT  * FROM tiposdeacto WHERE idtipoacto = '$codActo' LIMIT 1";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	$data[] = $row;


}

$objResponse = new stdClass();
$objResponse->error = 0;
$objResponse->data = $data;

echo json_encode($objResponse);