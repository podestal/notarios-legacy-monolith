<?php
include('conexion.php');

$detbienx = $_POST["detbienx"];

$grabardetbien="DELETE FROM detallebienes WHERE detallebienes.detbien = '$detbienx'";

mysql_query($grabardetbien,$conn) or die(mysql_error());

mysql_close($conn);

?>