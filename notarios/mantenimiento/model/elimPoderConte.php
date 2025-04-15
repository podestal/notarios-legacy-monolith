<?php
include('../../conexion.php');

$idsello = $_POST["idsello"];

$grabartipkardex="DELETE FROM poderes_asunto WHERE poderes_asunto.id_asunto = '$idsello'";
mysql_query($grabartipkardex,$conn) or die(mysql_error());
mysql_close($conn);
?>