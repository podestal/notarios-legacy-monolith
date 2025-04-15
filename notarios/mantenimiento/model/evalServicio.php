<?php
require("../../conexion.php");

$codigoservi = $_POST["codigoservi"];

$consulb = mysql_query("SELECT d_regventas.codigo FROM d_regventas WHERE d_regventas.codigo =  '".$codigoservi."' LIMIT 0,1", $conn) or die(mysql_error());
$rowb = mysql_fetch_array($consulb);

$data = $rowb[0];
echo $data;
?>