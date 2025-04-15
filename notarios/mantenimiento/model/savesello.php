<?php
include('../../conexion.php');

$dessello = strtoupper($_POST["dessello"]);
$contenido = strtoupper($_POST["contenido"]);

$grabartipkardex="INSERT INTO selloscartas (idsello, dessello, contenido) VALUES (NULL,'$dessello','$contenido')";
mysql_query($grabartipkardex,$conn) or die(mysql_error());
mysql_close($conn);
?>