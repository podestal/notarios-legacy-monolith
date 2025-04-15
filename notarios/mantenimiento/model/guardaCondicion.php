<?php
include('../../conexion.php');

$idcondicion = $_POST["idcondicion"];
$idtipoacto  = $_POST["idtipoacto"];
$condicion 	 = strtoupper($_POST["condicion"]);
$parte 	     = strtoupper($_POST["parte"]);
$uif 	     = strtoupper($_POST["uif"]);
$formulario  = $_POST["formulario"];
$montop      = $_POST["montop"];

//nuevo ID deacuerdo al mayo de la tabla:
$selectid="SELECT MAX(actocondicion.idcondicion) FROM actocondicion";
$result = mysql_query($selectid,$conn) or die(mysql_error());
$row = mysql_fetch_array($result);

$newid  = intval($row[0]) + 1;
$newid2 = strval($newid);

$grabaractos = "INSERT INTO actocondicion (idcondicion, idtipoacto, condicion, parte, uif, formulario, montop) VALUES ('$newid2', '$idtipoacto',  '$condicion', '$parte',  '$uif',  '$formulario', '$montop')";
mysql_query($grabaractos,$conn) or die(mysql_error());
mysql_close($conn);

?>