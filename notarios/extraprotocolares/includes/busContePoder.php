<?php
require("../../conexion.php");

$idasunto = $_REQUEST["idasunto"];

$consulb = mysql_query("SELECT contenido AS 'contenido' FROM contenidopoderes WHERE id_asunto = '".$idasunto."'", $conn) or die(mysql_error());
$rowb = mysql_fetch_assoc($consulb);

$data = $rowb["contenido"];
echo $data;
?>