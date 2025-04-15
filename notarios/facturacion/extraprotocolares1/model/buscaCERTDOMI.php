<?php 
include("../../conexion.php");

$numformu		= $_POST["numformu"];
$solicitanted 	= $_POST["solicitanted"];
$rangopc1 		= $_POST["rangopc1"];
$rangopc2		= $_POST["rangopc2"];


if($rangopc1=='' && $rangopc2=='')
{
$consulkar=mysql_query("SELECT * FROM cert_domiciliario WHERE 
						RIGHT(num_certificado,6) LIKE CONCAT('%','$numformu','%')
						AND cert_domiciliario.nombre_solic LIKE CONCAT('%','$solicitanted','%')
  					    ORDER BY cert_domiciliario.num_certificado DESC", $conn) or die(mysql_error());
}
else if($rangopc1=='' || $rangopc2=='')
{
	if($rangopc1!='' && $rangopc2=='')
	{
	$consulkar=mysql_query("SELECT * FROM cert_domiciliario WHERE 
						cert_domiciliario.num_formu  LIKE CONCAT('%','$numformu','%')
						AND cert_domiciliario.nombre_solic LIKE CONCAT('%','$solicitanted','%')
						AND fec_ingreso >= DATE_FORMAT(STR_TO_DATE('$rangopc1','%d/%m/%Y'),'%Y-%m-%d')
  					    ORDER BY cert_domiciliario.num_certificado DESC", $conn) or die(mysql_error());
	
	}
	else if($rangopc2!='' && $rangopc1=='')
	{
	$consulkar=mysql_query("SELECT * FROM cert_domiciliario WHERE 
						cert_domiciliario.num_formu  LIKE CONCAT('%','$numformu','%')
						AND cert_domiciliario.nombre_solic LIKE CONCAT('%','$solicitanted','%')
						AND fec_ingreso <= DATE_FORMAT(STR_TO_DATE('$rangopc2','%d/%m/%Y'),'%Y-%m-%d')
  					    ORDER BY cert_domiciliario.num_certificado DESC", $conn) or die(mysql_error());
	}
}
else if($rangopc1!='' && $rangopc2!='')
{
$consulkar=mysql_query("SELECT * FROM cert_domiciliario WHERE 
						cert_domiciliario.num_formu  LIKE CONCAT('%','$numformu','%')
						AND cert_domiciliario.nombre_solic LIKE CONCAT('%','$solicitanted','%')
						AND fec_ingreso >= DATE_FORMAT(STR_TO_DATE('$rangopc1','%d/%m/%Y'),'%Y-%m-%d')
						AND fec_ingreso <= DATE_FORMAT(STR_TO_DATE('$rangopc2','%d/%m/%Y'),'%Y-%m-%d')
  					    ORDER BY cert_domiciliario.num_certificado DESC", $conn) or die(mysql_error());
}







while($rowkar = mysql_fetch_array($consulkar)){

$numcarta = $rowkar['num_certificado'];
$numcarta2 = substr($numcarta,5,6).'-'.substr($numcarta,0,4);

echo "<table width='880' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='63' align='center' ><span class='reskar'><a href='EdiCertDomiVie.php?id_domiciliario=".$rowkar['id_domiciliario']."'>".$numcarta2."</a></span></td>
	<td width='86' align='center' ><span class='reskar'>".$rowkar['fec_ingreso']."</span></td>
	<td width='86' align='center' ><span class='reskar'>".$rowkar['num_formu']."</span></td>
    <td width='100' align='center'><span class='reskar'>".$rowkar['nombre_solic']."</span></td>
  </tr>
</table>";
}


?>