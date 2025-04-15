<?php
include('../../conexion.php');

$idtipoacto = $_POST["idtipoacto"];

$grabartipacto="DELETE FROM tiposdeacto WHERE tiposdeacto.idtipoacto = '$idtipoacto'";
mysql_query($grabartipacto,$conn) or die(mysql_error());
mysql_close($conn);

?>