<?php
require("../../conexion.php");

$idasunto = $_REQUEST["idasunto"];

$consulb = mysql_query("SELECT poderes_asunto.contenido AS 'contenido' FROM poderes_asunto WHERE poderes_asunto.id_asunto = '".$idasunto."'", $conn) or die(mysql_error());
$rowb = mysql_fetch_array($consulb);

$data = $rowb["contenido"];
echo $data;
?>