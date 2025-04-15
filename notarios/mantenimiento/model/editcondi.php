<?php
include('../../conexion.php');

$idcondicion = $_POST["idcondicion"];
$idtipoacto  = $_POST["idtipoacto"];
$condicion 	 = strtoupper($_POST["condicion"]);
$parte 	     = strtoupper($_POST["parte"]);
$uif 	     = strtoupper($_POST["uif"]);
$formulario  = $_POST["formulario"];
$montop      = $_POST["montop"];

$grabaracto="UPDATE actocondicion SET  actocondicion.idtipoacto = '$idtipoacto',actocondicion.condicion = '$condicion', actocondicion.parte = '$parte',actocondicion.uif = '$uif', actocondicion.formulario = '$formulario',  actocondicion.montop = '$montop' WHERE actocondicion.idcondicion = '$idcondicion'";
mysql_query($grabaracto,$conn) or die(mysql_error());
mysql_close($conn);
?>