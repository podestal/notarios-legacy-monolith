<?php
require_once 'conexion.php';

$idCondicion = $_POST['idCondicion'];
$condicion = $_POST['condicion'];
$parte = $_POST['parte'] == '-1'?'':$_POST['parte'];
$uif = $_POST['uif'] == '-1'?'':$_POST['uif'];
$montop = $_POST['montop'] == '-1'?'':$_POST['montop'];
$codSisgen = $_POST['codigoCnl'];

$sql = "UPDATE actocondicion SET condicion = '$condicion',parte = '$parte',montop = '$montop',uif = '$uif',codconsisgen = '$codSisgen' WHERE idcondicion = '$idCondicion' ";

$result = mysqli_query($conn,$sql);

$objResponse  = new stdClass();
$objResponse->error = 0;
$objResponse->errorDescription = 'Se actualizo correctamente';

echo json_encode($objResponse);

