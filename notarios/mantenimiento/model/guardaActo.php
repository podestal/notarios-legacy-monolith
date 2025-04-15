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

//nuevo ID deacuerdo al mayo de la tabla:
$selectid="SELECT MAX(tiposdeacto.idtipoacto) FROM tiposdeacto";
$result = mysql_query($selectid,$conn) or die(mysql_error());
$row = mysql_fetch_array($result);

$newid  = intval($row[0]) + 1;
$newid2 = strval($newid);

$grabartipkardex="INSERT INTO tiposdeacto (idtipoacto, actosunat, actouif, idtipkar, desacto, umbral, impuestos, idcalnot, idecalreg, idmodelo) VALUES ('$newid2', '$actosunat',  '$actouif', '$idtipkar',  '$desacto',  '$umbral',   '$impuestos', '$idcalnot',   '$idecalreg',   '$idmodelo')";
mysql_query($grabartipkardex,$conn) or die(mysql_error());
mysql_close($conn);
?>