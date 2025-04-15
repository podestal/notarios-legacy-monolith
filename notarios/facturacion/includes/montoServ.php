<?php
require("../../conexion.php");

$cdgsrv = $_REQUEST["cdgsrv"];

$consulta = mysql_query("SELECT servicios.precio1 FROM servicios WHERE servicios.codigo =  '".$cdgsrv."'", $conn) or die(mysql_error());
$rowa = mysql_fetch_array($consulta);

$data = $rowa["precio1"];
echo $data;
?>