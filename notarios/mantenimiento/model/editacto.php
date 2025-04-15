<?php
include('../../conexion.php');

$idtipoacto = $_POST["idtipoacto"];
$actosunat 	= strtoupper($_POST["actosunat"]);
$actouif 	= strtoupper($_POST["actouif"]);
$idtipkar 	= $_POST["idtipkar"];
$desacto 	= strtoupper($_POST["desacto"]);
$umbral 	= intval($_POST["umbral"]);
$impuestos 	= intval($_POST["impuestos"]);
$idcalnot 	= intval($_POST["idcalnot"]);
$idecalreg 	= intval($_POST["idecalreg"]);
$idmodelo 	= intval($_POST["idmodelo"]);

$grabaracto="UPDATE tiposdeacto SET  tiposdeacto.actosunat = '$actosunat', tiposdeacto.actouif = '$actouif',tiposdeacto.idtipkar = '$idtipkar', tiposdeacto.desacto = '$desacto',tiposdeacto.umbral = '$umbral', tiposdeacto.impuestos = '$impuestos',tiposdeacto.idcalnot = '$idcalnot', tiposdeacto.idecalreg = '$idecalreg', tiposdeacto.idmodelo = '$idmodelo' WHERE tiposdeacto.idtipoacto = '$idtipoacto'";
mysql_query($grabaracto,$conn) or die(mysql_error());
mysql_close($conn);
?>