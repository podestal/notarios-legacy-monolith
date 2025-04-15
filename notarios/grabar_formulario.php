<?php 
include("conexion.php");

$idrenta=$_POST['idrenta'];
$numformu=$_POST['numformu'];
$monto=$_POST['monto'];


mysql_query("INSERT INTO formulario (idformulario, idrenta, numformu, monto) VALUES (NULL,'$idrenta','$numformu','$monto')", $conn) or die(mysql_error());

?>