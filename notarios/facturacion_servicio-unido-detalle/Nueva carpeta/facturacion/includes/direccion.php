<?php
require("../../conexion.php");

$numdoc = $_REQUEST["numdoc"];

$consula = mysql_query("SELECT cliente.direccion FROM cliente WHERE cliente.numdoc = '".$numdoc."'", $conn) or die(mysql_error());
$rowa = mysql_fetch_array($consula);

$data = $rowa["direccion"];


echo $data;
?>