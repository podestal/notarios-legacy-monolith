<?php
include('../../conexion.php');

$idsello   = $_POST["idsello"];
$dessello  = strtoupper($_POST["dessello"]);
$contenido = strtoupper($_POST["contenido"]);

$grabartipkardex="UPDATE selloscartas SET selloscartas.dessello = '$dessello', selloscartas.contenido = '$contenido' WHERE selloscartas.idsello = '$idsello'";
mysql_query($grabartipkardex,$conn) or die(mysql_error());
mysql_close($conn);
?>

