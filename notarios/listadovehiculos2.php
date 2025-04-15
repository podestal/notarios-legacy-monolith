<style type='text/css'>
<!--
.bbnnee {font-family: Calibri; font-weight: bold; font-style: italic; font-size: 12px; }
.bnes {font-size: 12px}
.senb {font-family: Calibri; font-size: 12px; font-style: italic; }
-->
</style>

<?php 
include("conexion.php");

$codkardex     = $_POST['codkardex'];
$tipoactopatri = $_POST['tipoactopatri'];

$sqllistbie = mysql_query("SELECT detallevehicular.detveh, detallevehicular.kardex, tiposdeacto.desacto, det_placa.descripcion, 
detallevehicular.numplaca, detallevehicular.clase, detallevehicular.marca, detallevehicular.color, detallevehicular.motor
FROM detallevehicular
INNER JOIN tiposdeacto ON tiposdeacto.idtipoacto = detallevehicular.idtipacto
INNER JOIN det_placa ON det_placa.id_placa = detallevehicular.idplaca
where detallevehicular.kardex = '".$codkardex."' group by detallevehicular.detveh", $conn) or die(mysql_error());

echo "<table width='650' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333'>
  <tr>
    <td width='57' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Tipo</span></td>
    <td width='60' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Numero</span></td>
    <td width='70' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Clase </span></td>
    <td width='70' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Marca</span></td>
    <td width='81' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Color</span></td>
	<td width='81' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Motor</span></td>
    <td width='20' align='center' bgcolor='#CCCCCC'><span class='bnes'></span></td>
    <td width='21' align='center' bgcolor='#CCCCCC'><span class='bnes'></span></td>
  </tr>"; 
 while($rowVehi=mysql_fetch_array($sqllistbie)){
  echo"<tr>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>".strtoupper($rowVehi['descripcion'])."</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>".strtoupper($rowVehi['numplaca'])."</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>".strtoupper($rowVehi['clase'])."</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>".strtoupper($rowVehi['marca'])."</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>".strtoupper($rowVehi['color'])."</span></td>
	<td align='center' bgcolor='#FFFFFF'><span class='senb'>".strtoupper($rowVehi['motor'])."</span></td>
    <td align='center' bgcolor='#FFFFFF'><a href='#' id='".$rowVehi['detveh']."'  onclick='muesVehiEditable2(this.id)'><img src='iconos/editamv.png' width='16' height='18'></a></td>
    <td align='center' bgcolor='#FFFFFF'><a href='#' id='".$rowVehi['detveh']."' onclick='ElimVehi2(this.id)'><img src='iconos/eliminamv.png' width='18' height='17'></a></td>
  </tr>";
  }

echo"</table>";

?>
