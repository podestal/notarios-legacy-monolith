<?php
include('../../conexion.php');

$idsello   = $_POST["idsello"];
$dessello  = strtoupper($_POST["dessello"]);
$contenido = strtoupper($_POST["contenido"]);

$grabartipkardex="UPDATE diligencia_protesto SET diligencia_protesto.des_diligenciap = '$dessello', diligencia_protesto.cont_diligenciap = '$contenido' WHERE diligencia_protesto.id_diligenciap = '$idsello'";
mysql_query($grabartipkardex,$conn) or die(mysql_error());
mysql_close($conn);
?>
