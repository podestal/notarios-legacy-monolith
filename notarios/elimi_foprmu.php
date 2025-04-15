<?php 
include("conexion.php");
$idrenta=$_POST['melixx'];

mysql_query("delete from formulario where idformulario='$idrenta'", $conn) or die(mysql_error());

mysql_close($conn);
?>