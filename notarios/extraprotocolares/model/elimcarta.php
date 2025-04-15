<?php
include('../../conexion.php');

$num_carta = $_POST["num_carta"];

$elimcarta="DELETE FROM ingreso_cartas WHERE ingreso_cartas.num_carta = '$num_carta'";
mysql_query($elimcarta,$conn) or die(mysql_error());
mysql_close($conn);

?>