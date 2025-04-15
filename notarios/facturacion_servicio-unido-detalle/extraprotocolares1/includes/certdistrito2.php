<?php
require("../../conexion.php");

$numdoc = $_REQUEST["numdoc"];

$consulb = mysql_query("SELECT cliente.idubigeo FROM cliente WHERE cliente.numdoc = '".$numdoc."'", $conn) or die(mysql_error());
$rowb = mysql_fetch_array($consulb);


 $consulubigeo= mysql_query("SELECT * FROM ubigeo where coddis='".$rowb["idubigeo"]."'", $conn) or die(mysql_error());
 $rowubbi=mysql_fetch_array($consulubigeo);
 
 $data=$rowubbi['nomdpto']."/".$rowubbi['nomprov']."/".$rowubbi['nomdis'];

echo $data;

?>