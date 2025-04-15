<?php
include('../../conexion.php');

$num_crono		= $_POST["num_crono"];

$elimcarta="DELETE FROM cambio_caracter WHERE cambio_caracter.num_crono = '$num_crono'";
mysql_query($elimcarta,$conn) or die(mysql_error());
mysql_close($conn);

?>