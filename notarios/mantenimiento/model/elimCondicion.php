<?php
include('../../conexion.php');

$idcondicion = $_POST["idcondicion"];

$elimcondicion="DELETE FROM actocondicion WHERE actocondicion.idcondicion = '$idcondicion'";
mysql_query($elimcondicion,$conn) or die(mysql_error());
mysql_close($conn);

?>