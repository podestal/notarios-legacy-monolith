<style type='text/css'>
<!--
.bbnnee {font-family: Calibri; font-weight: bold; font-style: italic; font-size: 12px; }
.bnes {font-size: 12px}
.senb {font-family: Calibri; font-size: 12px; font-style: italic; }
-->
</style>

<?php 
include("conexion.php");

$codkardex=$_POST['codkardex'];
$tipoactopatri=$_POST['tipoactopatri'];

$sqllistbie=mysql_query("Select * from detallebienes where kardex='".$codkardex."'", $conn) or die(mysql_error());


echo "<table width='650' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333'>
  <tr>
    <td width='57' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Kardex - Año</span></td>
    <td width='136' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Acto</span></td>
    <td width='162' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Tipo </span></td>
    <td width='157' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Tipo de Bien</span></td>
    <td width='81' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Fec.Cons</span></td>
    <td width='20' align='center' bgcolor='#CCCCCC'><span class='bnes'></span></td>
    <td width='21' align='center' bgcolor='#CCCCCC'><span class='bnes'></span></td>
  </tr>"; 
 while($rowbb=mysql_fetch_array($sqllistbie)){
  echo"<tr>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>".$rowbb['kardex']."</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>";  
	  $sqlactito = mysql_query("SELECT * FROM tiposdeacto WHERE tiposdeacto.idtipoacto = '".$rowbb['idtipacto']."'", $conn) or die(mysql_error());
$rowactito = mysql_fetch_array($sqlactito);
 
	echo"<span class='senb'>".$rowactito['desacto']."</span>";
	echo"</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>".$rowbb['tipob']."</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>";
	$sqltb=mysql_query("Select * from tipobien where idtipbien='".$rowbb['idtipbien']."'", $conn) or die(mysql_error());
	$rowtb=mysql_fetch_array($sqltb);
	echo $rowtb['desestcivil'];
	 echo"</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>".$rowbb['fechaconst']."</span></td>
    <td align='center' bgcolor='#FFFFFF'><a href='#' id='".$rowbb['detbien']."' onclick='muesbieneditable2(this.id)'><img src='iconos/editamv.png' width='16' height='18'></a></td>
    <td align='center' bgcolor='#FFFFFF'><a href='#' id='".$rowbb['detbien']."' onclick='ElimDetBienes2(this.id)'><img src='iconos/eliminamv.png' width='18' height='17'></a></td>
  </tr>";
  }

echo"</table>";


?>
