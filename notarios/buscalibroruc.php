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
$dnilib=$_POST['dnilib'];

$sqlbuspro=mysql_query("select * from libros where ruc='$dnilib'", $conn) or die(mysql_error());
while ($rowbuspro=mysql_fetch_array($sqlbuspro)){

echo "
<table width='823' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333'>
  <tr>
    <td width='79' align='center'><span class='titubuskar0'>".$rowbuspro['ano']."-".$rowbuspro['numlibro']."</span></td>
    <td width='84' align='center'><span class='titubuskar0'>".$rowbuspro['fecing']."</span></td>
    <td width='153' align='center'><span class='titubuskar0'>"; 
	if ($rowbuspro['tipper']=="N"){
		echo $rowbuspro['apepat']." ".$rowbuspro['apemat']." ".$rowbuspro['prinom']." ".$rowbuspro['segnom'];
		} else{
			
			echo $rowbuspro['empresa'];
			}
	 echo"</span></td>
    <td width='116' align='center'><span class='titubuskar0'>";
	$sqlss=mysql_query("Select * from tipolibro where idtiplib='".$rowbuspro['idtiplib']."'", $conn) or die(mysql_error());
	$rowss=mysql_fetch_array($sqlss);
	echo $rowss['destiplib'];
	
	echo"</span></td>
    <td width='101' align='center'><span class='titubuskar0'>";
	$sqlssa=mysql_query("Select * from nlibro where idnlibro='".$rowbuspro['idnlibro']."'", $conn) or die(mysql_error());
	$rowssa=mysql_fetch_array($sqlssa);
	echo $rowssa['desnlibro'];
	
	
	echo"</span></td>
    <td width='68' align='center'><span class='titubuskar0'>".$rowbuspro['folio']."</span></td>
    <td width='101' align='center'><span class='titubuskar0'>";
	$sqlssd=mysql_query("Select * from tipofolio where idtipfol='".$rowbuspro['idtipfol']."'", $conn) or die(mysql_error());
	$rowssd=mysql_fetch_array($sqlssd);
	echo $rowssd['destipfol'];
	
	echo"</span></td>
    <td width='73' align='center'><span class='titubuskar0'>".$rowbuspro['ruc']."</span></td>
    <td width='28' align='center'><a href='verlibro.php?numlibro=".$rowbuspro['numlibro']."'><img src='iconos/verkar.png' width='30' height='31' border='0'></a></td>
  </tr>
</table>";

};



?>
