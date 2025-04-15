<?php
include("../conexion.php");

$consulcartas = mysql_query("SELECT * FROM detalle_cambios", $conn) or die(mysql_error());
//$rowcrono = mysql_fetch_array($consulcartas);

$d=mysql_num_rows($consulcartas);
if($d>0){
	header('Content-type: application/vnd.ms-word');
	header("Content-Disposition: attachment; filename = archivo.doc");
	header("Pragma: no-cache");
	header("Expires: 0");
	
	echo("<TABLE  BORDER=1 CELLSPACING=0 CELLPADDING=0 align='center'>");
	echo("<tr>");
	echo("<td> id_Cambio </td>");
	echo("<td> Descripcion </td>");
	echo("<td> Contenido </td>");
	echo("</tr>");

	while($registro = mysql_fetch_array($consulcartas)){
		echo ("<tr>");
		echo ("<td> $registro[0] </td>");
		echo ("<td> $registro[1] </td>");
		echo ("<td> $registro[2] </td>");
		echo("</tr>");
	}
	echo("</table>");
}
else{
echo("No hay registros en la tabla");
}
mysql_close();
?>
