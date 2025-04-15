<?php
include('../../conexion.php');

$idsello = $_POST["idsello"];

$grabartipkardex="DELETE FROM diligencia_protesto WHERE diligencia_protesto.id_diligenciap = '$idsello'";
mysql_query($grabartipkardex,$conn) or die(mysql_error());
mysql_close($conn);
?>