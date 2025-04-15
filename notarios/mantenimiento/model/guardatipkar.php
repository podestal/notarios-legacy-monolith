<?php
include('../../conexion.php');

$idkar = $_POST["idkar"];
$tipkar = $_POST["tipkar"];
$nomtipkar = strtoupper($_POST["nomtipkar"]);

//nuevo ID deacuerdo al mayo de la tabla:
$selectid="SELECT MAX(idtipkar) FROM tipokar";
$result = mysql_query($selectid,$conn) or die(mysql_error());
$row = mysql_fetch_array($result);

$newid  = intval($row[0]) + 1;
$newid2 = strval($newid);

$grabartipkardex="INSERT INTO tipokar (idtipkar, nomtipkar, tipkar) VALUES ('$newid2','$nomtipkar','$tipkar')";
mysql_query($grabartipkardex,$conn) or die(mysql_error());
mysql_close($conn);
?>