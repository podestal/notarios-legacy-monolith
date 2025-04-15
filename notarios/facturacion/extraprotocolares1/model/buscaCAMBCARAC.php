<?php 
include("../../conexion.php");

$numformu 		= $_POST["numformu"];
$solicitantec 	= $_POST["solicitantec"];
$rangocc1 		= $_POST["rangocc1"];
$rangocc2 		= $_POST["rangocc2"];


if($rangocc1=='' && $rangocc2==''){
		$consulkar=mysql_query("SELECT * FROM cambio_caracter WHERE 
		cambio_caracter.num_crono  LIKE CONCAT('%','$numformu','%') 
		AND nombre  LIKE CONCAT('%','$solicitantec','%') 
		ORDER BY num_crono DESC", $conn) or die(mysql_error());
}
else if($rangocc1=='' || $rangocc2=='')
{
	if($rangocc1!='' && $rangocc2=='')
	{
				$consulkar=mysql_query("SELECT * FROM cambio_caracter WHERE 
		cambio_caracter.num_crono  LIKE CONCAT('%','$numformu','%') 
		AND nombre  LIKE CONCAT('%','$solicitantec','%') 
		AND fec_ingreso >= DATE_FORMAT(STR_TO_DATE('$rangocc1','%d/%m/%Y'),'%Y-%m-%d')
		ORDER BY num_crono DESC", $conn) or die(mysql_error());
	}
	else if($rangocc2!='' && $rangocc1=='')
	{
				$consulkar=mysql_query("SELECT * FROM cambio_caracter WHERE 
		cambio_caracter.num_crono  LIKE CONCAT('%','$numformu','%') 
		AND nombre  LIKE CONCAT('%','$solicitantec','%') 
		AND fec_ingreso <= DATE_FORMAT(STR_TO_DATE('$rangocc2','%d/%m/%Y'),'%Y-%m-%d')
		ORDER BY num_crono DESC", $conn) or die(mysql_error());
	
	}
}
else if($rangocc1!='' && $rangocc2!='')
{
				$consulkar=mysql_query("SELECT * FROM cambio_caracter WHERE 
		cambio_caracter.num_crono  LIKE CONCAT('%','$numformu','%') 
		AND nombre  LIKE CONCAT('%','$solicitantec','%') 
		AND fec_ingreso >= DATE_FORMAT(STR_TO_DATE('$rangocc1','%d/%m/%Y'),'%Y-%m-%d')
		AND fec_ingreso <= DATE_FORMAT(STR_TO_DATE('$rangocc2','%d/%m/%Y'),'%Y-%m-%d')
		ORDER BY num_crono DESC", $conn) or die(mysql_error());
}

while($rowkar = mysql_fetch_array($consulkar)){ 
	$numcrono = $rowkar['num_crono'];
	$numrono2 = substr($numcrono,5,6).'-'.substr($numcrono,0,4);

echo "<table width='880' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
	</td> 
    <td width='63' align='center' ><span class='reskar'><a href='editCambioCaracVie.php?num_crono=".$rowkar['num_crono']."'>".$numrono2."</a></span></td>
	<td width='86' align='center' ><span class='reskar'>".$rowkar['fec_ingreso']."</span></td>
	<td width='70' align='center' ><span class='reskar'>".$rowkar['num_formu']."</span></td>
    <td width='200' align='center'><span class='reskar'>".$rowkar['nombre']."</span></td>
  </tr>
</table>";
}

?>