<style type="text/css">
<!--
.textubi {
	font-family: Calibri;
	font-size: 12px;
	color: #333333;
}
-->
</style>
<?php 
include("conexion.php");
$crono=$_POST['crono'];
$tiempo = explode ("-",$crono);
$libro = $tiempo[1];

$sqlbuspro=mysql_query("select *, DATE_FORMAT(STR_TO_DATE(fecing,'%d/%m/%Y'),'%d/%m/%Y') as 'fecha' from libros where numlibro='$libro'", $conn) or die(mysql_error());
while ($rowbuspro=mysql_fetch_array($sqlbuspro)){

echo "
<table width='823' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333'>
  <tr>
    <td width='79' align='center' valign='middle'><a href='verlibro.php?numlibro=".$rowbuspro['numlibro']."'><span style='font-size:10px;'>".$rowbuspro['numlibro']."-".$rowbuspro['ano']."</span></a></td>
    <td width='84' align='center'><span style='font-size:10px;'>".$rowbuspro['fecha']."</span></td>
    <td width='153' align='center'><span style='font-size:10px;'>"; 
	if ($rowbuspro['tipper']=="N"){
		echo strtoupper ($rowbuspro['apepat']." ".$rowbuspro['apemat']." ".$rowbuspro['prinom']." ".$rowbuspro['segnom']);
		} else{
			
			echo strtoupper ($rowbuspro['empresa']);
			}
	 echo"</span></td>
    <td width='116' align='center'><span style='font-size:10px;'>";
	$sqlss=mysql_query("Select * from tipolibro where idtiplib='".$rowbuspro['idtiplib']."'", $conn) or die(mysql_error());
	$rowss=mysql_fetch_array($sqlss);
	echo strtoupper ($rowss['destiplib']);
	
	echo"</span></td>
    <td width='101' align='center'><span style='font-size:10px;'>";
	$sqlssa=mysql_query("Select * from nlibro where idnlibro='".$rowbuspro['idnlibro']."'", $conn) or die(mysql_error());
	$rowssa=mysql_fetch_array($sqlssa);
	echo strtoupper ($rowssa['desnlibro']);
	
	
	echo"</span></td>
    <td width='68' align='center'><span style='font-size:10px;'>".strtoupper ($rowbuspro['folio'])."</span></td>
    <td width='101' align='center'><span style='font-size:10px;'>";
	$sqlssd=mysql_query("Select * from tipofolio where idtipfol='".$rowbuspro['idtipfol']."'", $conn) or die(mysql_error());
	$rowssd=mysql_fetch_array($sqlssd);
	echo strtoupper ($rowssd['destipfol']);
	
	echo"</span></td>
    <td width='73' align='center'><span style='font-size:10px;'>".strtoupper ($rowbuspro['ruc'])."</span></td>
    <td width='28' align='center'></td>
  </tr>
</table>";

};



?>
