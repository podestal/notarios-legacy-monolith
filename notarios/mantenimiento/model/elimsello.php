<?php
include('../../conexion.php');

$idsello = $_POST["idsello"];

$grabartipkardex="DELETE FROM selloscartas WHERE selloscartas.idsello = '$idsello'";
mysql_query($grabartipkardex,$conn) or die(mysql_error());
mysql_close($conn);
?>