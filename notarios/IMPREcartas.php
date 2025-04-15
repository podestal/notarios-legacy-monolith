<?php
$fechade = $_REQUEST['fecini'];
$fechaa = $_REQUEST['fecfin'];

?>

            <style type="text/css">
			
			</style>

<?php 
include('conexion.php');

//$fechade=$_REQUEST['fecini'];
$fechade = $_REQUEST['fecini'];

$tiempo = explode ("/", $fechade);
$desde = $tiempo[2] . "-" . $tiempo[1] . "-" . $tiempo[0];

//$fechaa = $_REQUEST['fecfin'];
$fechaa = $_REQUEST['fecfin'];

$tiempo2 = explode ("/", $fechaa);
$hasta = $tiempo2[2] . "-" . $tiempo2[1] . "-" . $tiempo2[0];

$consulta = mysql_query("SELECT num_carta, DATE_FORMAT(STR_TO_DATE(fec_ingreso,'%d/%m/%Y'),'%d/%m/%Y'), fec_entrega, nom_remitente, nom_destinatario,zona_destinatario FROM ingreso_cartas WHERE STR_TO_DATE(fec_ingreso,'%d/%m/%Y') BETWEEN STR_TO_DATE('$fechade','%d/%m/%Y') AND STR_TO_DATE('$fechaa','%d/%m/%Y') ORDER BY num_carta asc", $conn) or die(mysql_error());

echo"<table width='850' align=center' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333'>";

while($row = mysql_fetch_array($consulta)){

$numcarta = $row[0];
$numcarta2 = substr($numcarta,5,6).'-'.substr($numcarta,0,4);

echo"
  <tr>
    <td width='74'  height='19' valign='middle' align='center'><span style='font-size:10px;'>".$numcarta2."</span></td>
    <td width='73'  valign='middle' align='center'><span style='font-size:10px;'>".$row[1]."</span></td>
    <td width='85'  valign='middle' align='center'><span style='font-size:10px;'>".$row[2]."</span></td>
    <td width='125'  valign='middle' align='center'><span style='font-size:10px;'>";
	
	$consulta2 = mysql_query("SELECT ubigeo.nomdis FROM ubigeo WHERE ubigeo.coddis='".$row[5]."' ", $conn) or die(mysql_error());
	while($row2 = mysql_fetch_array($consulta2)){
		echo $row2[0];
	}
	 echo"</span></td>
    <td width='182' valign='middle' align='center'><span style='font-size:10px;'>";
	$textormat=str_replace("?","'",$row[3]);
    $textoampermat=str_replace("*","&",$textormat);
	echo strtoupper($textoampermat);
	echo"</span></td>
    <td width='297' valign='middle' align='center'><span style='font-size:10px;'>";
	$textormat4=str_replace("?","'",$row[4]);
    $textoampermat4=str_replace("*","&",$textormat4);
	echo strtoupper($textoampermat4);
	echo"</span></td>
  </tr>
";
}
echo"</table>";
?>
