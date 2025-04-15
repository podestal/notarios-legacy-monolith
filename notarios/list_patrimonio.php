
<!-- #################################################  -->

<html> 
<head> 
<title>Ingreso de la Minuta</title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="stylesglobal.css"> 
</head> 
<body  oncontextmenu="return false" >
<style type='text/css'>
<!--
.bbnnee {font-family: Calibri; font-weight: bold; font-style: italic; font-size: 12px; }
.bnes {font-size: 12px}
.senb {font-family: Calibri; font-size: 12px; font-style: italic; }
-->
</style>

<?php 
include("conexion.php");

$cod=$_POST['cod'];
$tipoactopatri=$_POST['tipoactopatri'];

$sqllistbie=mysql_query("SELECT patrimonial.itemmp, patrimonial.kardex, tiposdeacto.desacto, patrimonial.nminuta,
(CASE WHEN (patrimonial.idmon='1') THEN 'SOL' ELSE 'DOL' END) AS 'Moneda', patrimonial.importetrans, patrimonial.exhibiomp, patrimonial.idtipoacto ,`tiposdeacto`.`idtipkar`
FROM patrimonial INNER JOIN tiposdeacto ON CAST(tiposdeacto.idtipoacto AS DECIMAL) = patrimonial.idtipoacto WHERE patrimonial.kardex='".$cod."' ORDER BY patrimonial.itemmp ASC", $conn) or die(mysql_error());

$sql=mysql_query("select idtipkar from kardex where kardex='".$cod."'",$conn) or die(mysql_error());
$row=mysql_fetch_array($sql);

echo "<table width='650' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333'>
  <tr>
    <td width='57' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Itemmp</span></td>
    <td width='136' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Kardex - Año</span></td>
    <td width='162' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Descripcion</span></td>
	<td width='157' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>";
	if($row[0]!="3"){
		echo "Fecha de Minuta";
	}else{
		echo "Fecha de Acta";
	}
	echo "</span></td>
    <td width='81' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Moneda</span></td>
	<td width='81' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Importe</span></td>
	<td width='81' align='center' bgcolor='#CCCCCC'><span class='bbnnee'>Ex.Bien</span></td>
    <td width='20' align='center' bgcolor='#CCCCCC'><span class='bnes'></span></td>
    
  </tr>"; 
 while($rowbb=mysql_fetch_array($sqllistbie)){
  echo"<tr>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>".$rowbb[0]."</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>".$rowbb[1]."</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>".$rowbb[2]."</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>".$rowbb[3]."</span></td>
    <td align='center' bgcolor='#FFFFFF'><span class='senb'>".$rowbb[4]."</span></td>
	<td align='center' bgcolor='#FFFFFF'><span class='senb'>".$rowbb[5]."</span></td>
	<td align='center' bgcolor='#FFFFFF'><span class='senb'>".$rowbb[6]."</span></td>
    <td align='center' bgcolor='#FFFFFF'><a href='#' id='".$rowbb[0]."' name='".$rowbb[7]."' onclick='editpatr(this.id,this.name)'><img src='iconos/editamv.png' width='16' height='18'></a></td>
	<td align='center' bgcolor='#FFFFFF'><a href='#' id='".$rowbb[0]."' name='".$rowbb[7]."' onclick='elimpatr(this.id,this.name)'><img src='iconos/eliminamv.png' width='16' height='18'></a></td>

  </tr>";
  }

echo"</table>";


?>
<!--  <td width='21' align='center' bgcolor='#CCCCCC'><span class='bnes'></span></td>        -->
<!--     <td align='center' bgcolor='#FFFFFF'><img src='iconos/eliminamv.png' width='18' height='17'></td>       -->
</body></html>