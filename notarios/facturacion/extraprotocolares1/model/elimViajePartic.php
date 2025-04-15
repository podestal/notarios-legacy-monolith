<?php
include('../../conexion.php');

$id_viaje = $_POST["id_viaje"];
$id_contratante = $_POST["id_contratante"];

$elimpermiviaje="DELETE FROM viaje_contratantes WHERE viaje_contratantes.id_viaje = '$id_viaje' AND viaje_contratantes.id_contratante = '$id_contratante'";
mysql_query($elimpermiviaje,$conn) or die(mysql_error());

mysql_close($conn);

?>