<style>
.fuente{
	
	font-family:Verdana, Geneva, sans-serif;
	font-size:11px;
	}

</style>
<?php 
include("conexion.php");
$formu=$_POST['formu'];

mysql_query("delete from formulario where idformulario='$formu'", $conn) or die(mysql_error());

?>