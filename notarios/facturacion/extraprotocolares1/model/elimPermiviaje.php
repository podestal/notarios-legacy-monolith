<?php
include('../../conexion.php');

$id_viaje = $_POST["id_viaje"];

$elimpermiviaje="DELETE FROM permi_viaje WHERE permi_viaje.id_viaje = '$id_viaje'";
mysql_query($elimpermiviaje,$conn) or die(mysql_error());
mysql_close($conn);

?>