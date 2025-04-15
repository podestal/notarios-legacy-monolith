<?php
require_once 'conexion.php';

$idTipoKardex = $_POST['idTipoKardex'];

$data = array();
$sql  = "SELECT idtipoacto,desacto, actouif,actosunat  FROM tiposdeacto WHERE idtipkar = '$idTipoKardex' ORDER BY desacto";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
	$data[] = $row;
}


$objResponse = new stdClass();
$objResponse->error = 0;
$objResponse->data = $data;

echo json_encode($objResponse);