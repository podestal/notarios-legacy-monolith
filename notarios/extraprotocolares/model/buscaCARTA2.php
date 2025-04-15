
   <?php 
include("../../conexion.php");

$nombrer    = $_POST['nombrer'];
$nombred    = $_POST['nombred'];
$lol        = $_POST['numcarta'];
$rangocuno	= $_POST['rangocuno'];
$rangocdos	= $_POST['rangocdos'];

// SIN FECHAS
if($rangocuno=='' && $rangocdos=='')
{
$consulkar=mysql_query("SELECT  ingreso_cartas.* FROM ingreso_cartas
	WHERE ingreso_cartas.nom_remitente LIKE CONCAT('%','$nombrer','%') 
	AND nom_destinatario LIKE CONCAT('%','$nombred','%')
	AND RIGHT(num_carta,6) LIKE CONCAT('%','$lol','%')");
}
// CON ALGUNA DE LAS FECHAS
else if($rangocuno=='' || $rangocdos=='')
{
	if($rangocuno=='' && $rangocdos!='')
	{
		$consulkar=mysql_query("SELECT  ingreso_cartas.* FROM ingreso_cartas
		WHERE ingreso_cartas.nom_remitente LIKE CONCAT('%','$nombrer','%') 
		AND nom_destinatario LIKE CONCAT('%','$nombred','%')
		AND RIGHT(num_carta,6) LIKE CONCAT('%','$lol','%') AND fec_ingreso <= DATE_FORMAT(STR_TO_DATE('$rangocdos','%d/%m/%Y'),'%Y-%m-%d')");	
	}
	else if	($rangocdos=='' && $rangocuno!='')
	{
		$consulkar=mysql_query("SELECT  ingreso_cartas.* FROM ingreso_cartas
		WHERE ingreso_cartas.nom_remitente LIKE CONCAT('%','$nombrer','%') 
		AND nom_destinatario LIKE CONCAT('%','$nombred','%')
		AND RIGHT(num_carta,6) LIKE CONCAT('%','$lol','%')
		AND fec_ingreso >= DATE_FORMAT(STR_TO_DATE('$rangocuno','%d/%m/%Y'),'%Y-%m-%d')");		
	}
}
// CON LAS DOS FECHAS
else if($rangocuno!='' && $rangocdos!='')
{
$consulkar=mysql_query("SELECT  ingreso_cartas.* FROM ingreso_cartas
	WHERE ingreso_cartas.nom_remitente LIKE CONCAT('%','$nombrer','%') 
	AND nom_destinatario LIKE CONCAT('%','$nombred','%')
	AND RIGHT(num_carta,6) LIKE CONCAT('%','$lol','%')
	AND fec_ingreso >= DATE_FORMAT(STR_TO_DATE('$rangocuno','%d/%m/%Y'),'%Y-%m-%d')
	AND fec_ingreso <= DATE_FORMAT(STR_TO_DATE('$rangocdos','%d/%m/%Y'),'%Y-%m-%d')");	
}

while($rowkar = mysql_fetch_array($consulkar)){
$numcarta = $rowkar['num_carta'];
$numcarta2 = substr($numcarta,5,6).'-'.substr($numcarta,0,4);

echo "<table width='858' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333'   >
  <tr>  
   
    <td width='63' align='center' ><span class='reskar'><a href='EditCartasVie.php?numcarta=".$rowkar['num_carta']."'>".$numcarta2."</a></span></td>
	<td width='86' align='center' ><span class='reskar'>".strtoupper($rowkar['fec_ingreso'])."</span></td>
	<td width='200' align='center' ><span class='reskar'>".strtoupper($rowkar['nom_remitente'])."</span></td>
    <td width='224' align='center'><span class='reskar'>".strtoupper($rowkar['nom_destinatario'])."</span></td>
  </tr>
</table>";
}

?>

