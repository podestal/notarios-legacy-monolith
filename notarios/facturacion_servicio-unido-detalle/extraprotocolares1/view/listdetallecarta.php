<?php 
include("../../conexion.php");

$dessello = $_REQUEST["dessello"];

$consulkar=mysql_query("SELECT * FROM selloscartas WHERE dessello LIKE '%".$dessello."%'", $conn) or die(mysql_error());

while($rowkar = mysql_fetch_array($consulkar)){

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='90' align='center' ><span class='reskar'><a href='#' id='".$rowkar['idsello']."' name='".$rowkar['contenido']."' onclick='ShowDetSello(this.id,this.name)'>".$rowkar['idsello']."</a></span></td>
	<td width='250' align='center' ><span class='reskar'><a href='#' id='".$rowkar['idsello']."' name='".$rowkar['contenido']."' onclick='ShowDetSello(this.id,this.name)'>".$rowkar['dessello']."</a></span></td>
  </tr>
</table>";

}
?>