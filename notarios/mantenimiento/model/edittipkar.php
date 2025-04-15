<?php
include('../../conexion.php');

$idkar = $_POST["idkar"];
$tipkar = strtoupper($_POST["tipkar"]);
$nomtipkar = strtoupper($_POST["nomtipkar"]);

$grabartipkardex="UPDATE tipokar SET tipokar.tipkar = '$tipkar', tipokar.nomtipkar = '$nomtipkar' WHERE tipokar.idtipkar = '$idkar'";
mysql_query($grabartipkardex,$conn) or die(mysql_error());
mysql_close($conn);
?>