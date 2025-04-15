<?php
require("../../conexion.php");

$numdoc = $_REQUEST["numdoc"];

$consulb = mysql_query("SELECT cliente.numpartida FROM cliente WHERE cliente.numdoc = '".$numdoc."'", $conn) or die(mysql_error());
$rowb = mysql_fetch_array($consulb);

$data = $rowb["numpartida"];


echo $data;
?>