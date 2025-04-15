<?php
include('conexion.php');

$detmp = $_POST["detmp"];

$grabardetpago="DELETE FROM detallemediopago WHERE detallemediopago.detmp = '$detmp'";

mysql_query($grabardetpago,$conn) or die(mysql_error());

mysql_close($conn);

?>