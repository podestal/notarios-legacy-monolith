<?php
require_once 'conexion.php';
$codTipoActo = $_POST['codActos'];
$codSunat = $_POST['codSunat'];
$codUif = $_POST['codUif'];
$codCnl = $_POST['codCnl'];


$sql = "UPDATE tiposdeacto SET  actosunat = '$codSunat',actouif = '$codUif',cod_ancert = '$codCnl' WHERE idtipoacto = '$codTipoActo'";

$result = mysqli_query($conn,$sql);

$objResponse  = new stdClass();
$objResponse->error = 0;
$objResponse->errorDescription = 'Se actualizo correctamente';

echo json_encode($objResponse);