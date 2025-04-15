<?php
require("../../conexion.php");

$fecha_tcambio = $_REQUEST["fecha_tcambio"];

$consulta = mysql_query("SELECT DATE_FORMAT(tipocambio.tc_fecha,'%d/%m/%Y') AS 'fecha_busqueda' FROM tipocambio WHERE DATE_FORMAT(tipocambio.tc_fecha,'%Y-%m-%d') = STR_TO_DATE('".$fecha_tcambio."','%d/%m/%Y')", $conn) or die(mysql_error());
$rowa = mysql_fetch_array($consulta);

$data = $rowa["fecha_busqueda"];
echo $data;
?>