<?php
require("../../conexion.php");

$tipdocu = $_REQUEST["tipdocu"];

$consulta = mysql_query("SELECT t_params.grp_item FROM t_params WHERE  t_params.num_item =  '".$tipdocu."'", $conn) or die(mysql_error());
$rowa = mysql_fetch_array($consulta);

$data = $rowa["grp_item"];
echo $data;
?>