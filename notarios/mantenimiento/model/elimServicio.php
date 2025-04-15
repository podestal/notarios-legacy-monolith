<?php
include('../../conexion.php');

$codigoservi = $_POST["codigoservi"];

$elimservicio = "DELETE FROM servicios WHERE servicios.codigo = '$codigoservi'";
mysql_query($elimservicio,$conn) or die(mysql_error());
mysql_close($conn);
?>