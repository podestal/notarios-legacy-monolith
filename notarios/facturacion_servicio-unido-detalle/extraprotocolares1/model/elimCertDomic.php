<?php
include('../../conexion.php');

$id_domiciliario = $_POST["id_domiciliario"];

$elimcertidom = "DELETE FROM cert_domiciliario WHERE cert_domiciliario.id_domiciliario = '$id_domiciliario'";
mysql_query($elimcertidom,$conn) or die(mysql_error());
mysql_close($conn);

?>