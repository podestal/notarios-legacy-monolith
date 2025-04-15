<?php
include('../../conexion.php');

$id_cambio       = $_POST["id_cambio"];
$id_dato         = $_POST["detalle"];

$elimcambiocarac = "DELETE FROM det_cambiocarac WHERE id_cambio = '$id_cambio' AND id_dato = '$id_dato'";

mysql_query($elimcambiocarac,$conn) or die(mysql_error());
mysql_close($conn);

?>