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

$consulta = mysql_query("SELECT *, DATE_FORMAT(fecing,'%d/%m/%Y') AS 'fecha' FROM libros WHERE fecing BETWEEN '$desde' AND '$hasta' order by numlibro asc", $conn) or die(mysql_error());

echo "<table width='1000' bordercolor='#333333'  border='1' cellpadding='0' cellspacing='0' align='left'>";

while($rowkar = mysql_fetch_array($consulta)){

echo "
 <tr>
    <td width='80' align='center'><span style='font-size:10px;'>".$rowkar['numlibro']."-".$rowkar['ano']."</span></td>
    <td width='76' align='center'><span style='font-size:10px;'>".$rowkar['fecha']."</span></td>
    <td width='254' align='center'><span style='font-size:10px;'>"; 
	if ($rowkar['tipper']=="N"){
		$nom=$rowkar['apepat']." ".$rowkar['apemat']." ".$rowkar['prinom']." ".$rowkar['segnom'];
	$textormat=str_replace("?","'",$nom);
    $textoampermat=str_replace("*","&",$textormat);
	echo strtoupper($textoampermat);
	
		} else{
			
			$textormatx=str_replace("?","'",$rowkar['empresa']);
    $textoampermatx=str_replace("*","&",$textormatx);
	echo strtoupper($textoampermatx);
			}
	 echo"</span></td>
    <td width='199' align='center'><span style='font-size:10px;'>";
	$sqlss=mysql_query("Select * from tipolibro where idtiplib='".$rowkar['idtiplib']."'", $conn) or die(mysql_error());
	$rowss=mysql_fetch_array($sqlss);
	echo $rowss['destiplib'];
	
	echo"</span></td>
    <td width='107' align='center'><span style='font-size:10px;'>";
	$sqlssa=mysql_query("Select * from nlibro where idnlibro='".$rowkar['idnlibro']."'", $conn) or die(mysql_error());
	$rowssa=mysql_fetch_array($sqlssa);
	echo $rowssa['desnlibro'];
	
	
	echo"</span></td>
    <td width='76' align='center'><span style='font-size:10px;'>".$rowkar['folio']."</span></td>
    <td width='99' align='center'><span style='font-size:10px;'>";
	$sqlssd=mysql_query("Select * from tipofolio where idtipfol='".$rowkar['idtipfol']."'", $conn) or die(mysql_error());
	$rowssd=mysql_fetch_array($sqlssd);
	echo $rowssd['destipfol'];
	
	echo"</span></td>
    <td width='91' align='center'><span style='font-size:10px;'>".$rowkar['ruc']."</span></td>
    
  </tr>
";
}
echo"</table>";
?>
