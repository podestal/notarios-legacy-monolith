<?php
$fechade = $_REQUEST['fecini'];
$fechaa  = $_REQUEST['fecfin'];
//$nomnotaria = "Nombre de la Notaria";
$nomnotaria = " ";
//$fechade = '01/01/2013';
//$fechaa = '31/01/2013';
$nocorre = $_REQUEST['nocorre'];
?>

            <style type="text/css">
			#logo_emp{
				float:left;
				padding:0px;
				margin:0px;
				margin-top:10px;
				margin-left:10px;
				}
			#fec_actual{
				float:right;
				padding:0px;
				margin:0px;
				margin-top:10px;
				margin-right:10px;
				}	
			</style>

<?php 
include('conexion.php');
$fechade = $_REQUEST['fecini'];
$fechaa  = $_REQUEST['fecfin'];


$consulta = mysql_query("SELECT cert_supervivencia.*, DATE_FORMAT(cert_supervivencia.fecha,'%d/%m/%Y') AS 'fecha2'
FROM cert_supervivencia WHERE cert_supervivencia.swt_capacidad = 'C'
AND  (cert_supervivencia.fecha >= STR_TO_DATE('$fechade', '%d/%m/%Y') AND cert_supervivencia.fecha <= STR_TO_DATE('$fechaa','%d/%m/%Y'))
ORDER BY cert_supervivencia.num_crono asc", $conn) or die(mysql_error());		

while($rowkar = mysql_fetch_array($consulta)){
	
$numkar = $rowkar['num_crono'];
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);

echo"<TABLE BORDER='1' CELLPADDING='0' CELLSPACING='0' ALIGN='CENTER'>
  <TR>
    <TD WIDTH='113'  HEIGHT='19' >".$numkar2."</TD>
    <TD WIDTH='136'  valign='top'>".$rowkar['fecha2']."</TD>
    <TD WIDTH='260' valign='top'>";
	$textormat=str_replace("?","'",$rowkar['nombre']);
    $textoampermat=str_replace("*","&",$textormat);
	echo strtoupper($textoampermat);
	echo"</TD>
    <TD WIDTH='196' valign='top'>".$rowkar['direccion']."</TD>
	
  </TR>
</TABLE>";
}
?>
