<?php
include('../../conexion.php');

$idimpedido = $_REQUEST["idimpedido"];
$idcliente 	= $_REQUEST["idcliente"];
$descli 	= $_REQUEST["descli"];
$fechaing 	= $_REQUEST["fechaing"];
$oficio 	= $_REQUEST["oficio"];
$origen 	= $_REQUEST["origen"];
$motivo 	= $_REQUEST["motivo"];
$pep 	    = "0"; //$_REQUEST["pep"];
$laft 	    = "0"; //$_REQUEST["laft"];

$entidad 	= $_REQUEST["entidad"];
$remite 	= $_REQUEST["remite"];


$grabaracto="UPDATE impedidos SET  impedidos.fechaing = '$fechaing', impedidos.oficio = '$oficio', impedidos.origen = '$origen', impedidos.motivo = '$motivo', impedidos.pep = '$pep', impedidos.laft = '$pep' WHERE impedidos.idimpedido = '$idimpedido'";
mysql_query($grabaracto,$conn) or die(mysql_error());

$updateclient = "UPDATE cliente SET  impeingre = '$fechaing', impnumof = '$oficio', impeorigen = '$origen', impmotivo = '$motivo', impentidad = '$entidad', impremite = '$remite' WHERE idcliente = '$idcliente'";
mysql_query($updateclient,$conn) or die(mysql_error());

mysql_close($conn);
?>