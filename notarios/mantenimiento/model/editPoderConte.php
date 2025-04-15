<?php
include('../../conexion.php');

$idsello   = $_POST["idsello"];
$dessello  = strtoupper($_POST["dessello"]);
$contenido = strtoupper($_POST["contenido"]);

$grabartipkardex="UPDATE poderes_asunto SET poderes_asunto.des_asunto = '$dessello', poderes_asunto.contenido = '$contenido' WHERE poderes_asunto.id_asunto = '$idsello'";
mysql_query($grabartipkardex,$conn) or die(mysql_error());
mysql_close($conn);
?>