<?php 
include("conexion.php");

$dessello = $_REQUEST["dessello"];

$consulkar=mysql_query("SELECT * FROM diligencia_protesto WHERE des_diligenciap LIKE '%".$dessello."%'", $conn) or die(mysql_error());

while($rowkar = mysql_fetch_array($consulkar)){

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
<td width='90' align='center' ><span class='reskar'><a href='#' id='".$rowkar['id_diligenciap']."' name='".$rowkar['cont_diligenciap']."' onclick='ShowDetSello(this.id,this.name)'>".$rowkar['id_diligenciap']."</a></span></td>
	<td width='250' align='center' ><span class='reskar'><a href='#' id='".$rowkar['id_diligenciap']."' name='".$rowkar['cont_diligenciap']."' onclick='ShowDetSello(this.id,this.name)'>".$rowkar['des_diligenciap']."</a></span></td>
  		<td width='250' align='center' ><span class='reskar'><a href='#' id='".$rowkar['id_diligenciap']."' name='".$rowkar['cont_diligenciap']."' onclick='ShowDetSello(this.id,this.name)'>".$rowkar['cont_diligenciap']."</a></span></td>
  </tr>
</table>";

}
?>