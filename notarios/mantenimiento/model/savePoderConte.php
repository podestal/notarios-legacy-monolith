<?php
include('../../conexion.php');

$dessello = $_POST["dessello"];
$contenido = $_POST["contenido"];

# Genera el ID a guardar:
$consulIdPoderConte = mysql_query("SELECT CONCAT(REPEAT('0',3-LENGTH((MAX(CAST(RIGHT(poderes_asunto.id_asunto,3) AS DECIMAL))+1))),
(MAX(CAST(RIGHT(poderes_asunto.id_asunto,3) AS DECIMAL))+1)) AS idasunto FROM poderes_asunto", $conn) or die(mysql_error());
$rowPoderConte = mysql_fetch_array($consulIdPoderConte);
$new_id = $rowPoderConte[0];

$grabartipkardex="INSERT INTO poderes_asunto (id_asunto, des_asunto, conte_asunto, contenido) VALUES ('$new_id','$dessello','F','$contenido')";
mysql_query($grabartipkardex,$conn) or die(mysql_error());
mysql_close($conn);
?>