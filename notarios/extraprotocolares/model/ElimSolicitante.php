<?php
include('../../conexion.php');

$id_cambio        = $_POST["id_cambio"];
$id_solicitante   = $_POST["id_solicitante"];
$elimpermiviaje="DELETE FROM ccaracter_solicitantes WHERE ccaracter_solicitantes.id_cambio = '$id_cambio' AND ccaracter_solicitantes.id_solicitante = '$id_solicitante'";
mysql_query($elimpermiviaje,$conn) or die(mysql_error());
mysql_close($conn);
?>