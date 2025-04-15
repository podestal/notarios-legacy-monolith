<?php
include('../../conexion.php');

$idkar = $_POST["idkar"];

$grabartipkardex="DELETE FROM tipokar WHERE tipokar.idtipkar = '$idkar'";
mysql_query($grabartipkardex,$conn) or die(mysql_error());
mysql_close($conn);
?>