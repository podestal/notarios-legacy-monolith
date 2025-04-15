<?php 
include('conexion.php');
$consulta = mysql_query("SELECT COUNT(kardex) AS cantidad FROM sisgen_temp", $conn) or die(mysql_error()); 
while($cantidad = mysql_fetch_array($consulta)){ 
$canti=$cantidad['cantidad'];
} 
$mensage = "SE HAN GENERADO ".$canti." KARDEX";
?>
<td height="36" align="LEFT" colspan="6"><span style="font-family:Verdana, Geneva, sans-serif; font-size:14px; color:#036;"><strong><?php echo $mensage; ?></strong></span></td>