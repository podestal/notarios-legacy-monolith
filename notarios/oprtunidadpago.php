<?php 
include("conexion.php");

$codkardex=$_POST['codkardex'];
$valor=$_POST['valor'];
$item=$_POST['title'];


mysql_query("UPDATE contratantesxacto SET opago='$valor' where id='$item' and kardex='$codkardex'", $conn) or die(mysql_error());
echo "Oportunidad de Pago Grabada";
?>