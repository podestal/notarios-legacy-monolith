<?php 
include("../../conexion.php");

$desparticipante = $_REQUEST["desparticipante"];

$consulkar=mysql_query("SELECT  (CASE WHEN cliente.nombre != '' THEN cliente.nombre ELSE cliente.razonsocial  END) AS 'des', cliente.numdoc AS 'id' FROM cliente WHERE (cliente.nombre LIKE '%".$desparticipante."%') OR (cliente.razonsocial LIKE '%".$desparticipante."%')", $conn) or die(mysql_error());

while($rowkar = mysql_fetch_array($consulkar)){

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='90' align='center' ><span class='reskar'><a href='#' id='".$rowkar['id']."' name='".$rowkar['des']."' onclick='ShowDetSello(this.id,this.name)'>".$rowkar['id']."</a></span></td>
	<td width='250' align='center' ><span class='reskar'><a href='#' id='".$rowkar['id']."' name='".$rowkar['des']."' onclick='ShowDetSello(this.id,this.name)'>".$rowkar['des']."</a></span></td>
  </tr>
</table>";

}
?>