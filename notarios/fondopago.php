<?php 
include("conexion.php");

$codkardex=$_POST['codkardex'];
$valor=$_POST['valor'];
$item=$_POST['title'];
$fecha_modificacion = date("d/m/Y");

mysql_query("UPDATE contratantesxacto SET ofondo='$valor' where id='$item' and kardex='$codkardex'", $conn) or die(mysql_error());
echo "Origen de los Fondos Grabados...";
$sqlmodificacion="UPDATE KARDEX SET  fecha_modificacion ='$fecha_modificacion' WHERE KARDEX ='$codkardex'"; 
mysql_query($sqlmodificacion,$conn) or die(mysql_error());

?>