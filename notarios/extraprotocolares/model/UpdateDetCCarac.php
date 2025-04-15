<?php
include('../../conexion.php');

$id_cambio       = $_POST["id_cambio"];
$id_dato         = $_POST["id_dato"];
$descripcion     = $_POST["descripcion"];

$updatecertidom = "UPDATE det_cambiocarac SET descripcion = '$descripcion' WHERE id_cambio = '$id_cambio' AND id_dato = '$id_dato' ";

mysql_query($updatecertidom, $conn) or die(mysql_error());
mysql_close($conn);
?>
