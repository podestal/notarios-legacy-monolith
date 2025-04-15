<?php 
include('conexion.php');

$fechade=$_POST['fechade'];
$tiempo = explode ("/", $fechade);
$desde = $tiempo[2] . "-" . $tiempo[1] . "-" . $tiempo[0];

$fechaa=$_POST['fechaa'];
$tiempo2 = explode ("/", $fechaa);
$hasta = $tiempo2[2] . "-" . $tiempo2[1] . "-" . $tiempo2[0];


$consulta = mysql_query("SELECT *, DATE_FORMAT(fecing,'%d/%m/%Y') AS 'fecha' FROM libros WHERE fecing BETWEEN '$desde' AND '$hasta' order by numlibro asc", $conn) or die(mysql_error());

while($rowkar = mysql_fetch_array($consulta)){

echo "
<table width='823' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333'>
  <tr>
    <td width='79' align='center' valign='middle'><span style='font-size:11px;'>".$rowkar['numlibro']."-".$rowkar['ano']."</span></td>
    <td width='84' align='center' valign='middle'><span style='font-size:11px;'>".$rowkar['fecha']."</span></td>
    <td width='153' align='center' valign='middle'><span style='font-size:11px;'>"; 
	if ($rowkar['tipper']=="N"){
		echo strtoupper ( $rowkar['apepat']." ".$rowkar['apemat']." ".$rowkar['prinom']." ".$rowkar['segnom']);
		} else{
			
			echo strtoupper ($rowkar['empresa']);
			}
	 echo"</span></td>
    <td width='116'align='center' valign='middle'><span style='font-size:11px;'>";
	$sqlss=mysql_query("Select * from tipolibro where idtiplib='".$rowkar['idtiplib']."'", $conn) or die(mysql_error());
	$rowss=mysql_fetch_array($sqlss);
	echo strtoupper ($rowss['destiplib']);
	
	echo"</span></td>
    <td width='101' align='center' valign='middle'><span style='font-size:11px;'>";
	$sqlssa=mysql_query("Select * from nlibro where idnlibro='".$rowkar['idnlibro']."'", $conn) or die(mysql_error());
	$rowssa=mysql_fetch_array($sqlssa);
	echo strtoupper ($rowssa['desnlibro']);
	
	
	echo"</span></td>
    <td width='68' align='center' valign='middle'><span style='font-size:11px;'>".$rowkar['folio']."</span></td>
    <td width='101' align='center'><span style='font-size:11px;'>";
	$sqlssd=mysql_query("Select * from tipofolio where idtipfol='".$rowkar['idtipfol']."'", $conn) or die(mysql_error());
	$rowssd=mysql_fetch_array($sqlssd);
	echo strtoupper ($rowssd['destipfol']);
	
	echo"</span></td>
    <td width='73' align='center' valign='middle'><span style='font-size:11px;'>".strtoupper ($rowkar['ruc'])."</span></td>
    
  </tr>
</table>";
}


?>