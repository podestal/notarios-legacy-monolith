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

if($nocorre == 'nc')
{
$consulta = mysql_query("SELECT permi_viaje.*,(CASE WHEN(permi_viaje.asunto='001') THEN 'PERMISO VIAJE AL INTERIOR' ELSE 'PERMISO VIAJE AL EXTERIOR' END) AS 'tipo_permiso',
						(CASE WHEN (permi_viaje.swt_est='' OR ISNULL(permi_viaje.swt_est)) THEN '' ELSE 'NO CORRE' END) AS 'Estado' , DATE_FORMAT(permi_viaje.fecha_crono,'%d/%m/%Y') AS 'fecha_crono2'
						, DATE_FORMAT(permi_viaje.fec_ingreso,'%d/%m/%Y') AS 'fec_ingreso2', permi_viaje.swt_est 
						FROM permi_viaje 
						WHERE permi_viaje.fecha_crono BETWEEN STR_TO_DATE('$fechade','%d/%m/%Y') AND STR_TO_DATE('$fechaa','%d/%m/%Y')
						ORDER BY permi_viaje.fecha_crono ASC", $conn) or die(mysql_error());
}
else if($nocorre == '')
{
$consulta = mysql_query("SELECT permi_viaje.*,(CASE WHEN(permi_viaje.asunto='001') THEN 'PERMISO VIAJE AL INTERIOR' ELSE 'PERMISO VIAJE AL EXTERIOR' END) AS 'tipo_permiso',
						(CASE WHEN (permi_viaje.swt_est='' OR ISNULL(permi_viaje.swt_est)) THEN '' ELSE 'NO CORRE' END) AS 'Estado' , DATE_FORMAT(permi_viaje.fecha_crono,'%d/%m/%Y') AS 'fecha_crono2'
						, DATE_FORMAT(permi_viaje.fec_ingreso,'%d/%m/%Y') AS 'fec_ingreso2', permi_viaje.swt_est 
						FROM permi_viaje 
						WHERE permi_viaje.fecha_crono BETWEEN STR_TO_DATE('$fechade','%d/%m/%Y') AND STR_TO_DATE('$fechaa','%d/%m/%Y')
						ORDER BY permi_viaje.fecha_crono ASC", $conn) or die(mysql_error());		
}


while($rowkar = mysql_fetch_array($consulta)){
	
$numkar = $rowkar['num_kardex'];
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);

echo"<TABLE BORDER='1' CELLPADDING='0' CELLSPACING='0' ALIGN='CENTER'>
  <TR>
    <TD WIDTH='37' align='center' valign='middle'><span style='font-size:10px;'>".$rowkar['id_viaje']."</span></TD>
    <TD WIDTH='80'  align='center' valign='middle'><span style='font-size:10px;'>".$numkar2."</span></TD>
    <TD WIDTH='400'  valign='middle'><span style='font-size:10px;'>";
	
	$consulcont = mysql_query("SELECT * FROM viaje_contratantes WHERE viaje_contratantes.id_viaje='".$rowkar['id_viaje']."'", $conn) or die(mysql_error());
	while($rowcont = mysql_fetch_array($consulcont)){
		$cantidadc=$rowcont['c_condicontrat'];
		
	switch ($cantidadc) {
	case "001":
	$ncliente="PADRE";
	break;
	case "002":
	$ncliente="HIJO";	
	break;
	case "003":
	$ncliente="APODERADO";
	break;
	case "004":
	$ncliente="TUTOR";	
	break;
	case "005":
	$ncliente="MADRE";
	break;
	case "006":
	$ncliente="APODERADO";	
	break;		
	case "007":
	$ncliente="PODERDANTE";	
	break;	
	case "008":
	$ncliente="TESTIGO A RUEGO";	
	break;	
	case "009":
	$ncliente="CAUSANTE";	
	break;
	case "010":
	$ncliente="TESTIGO";	
	break;			
}
    $textormatx=str_replace("?","'",$rowcont['c_descontrat']);
    $textoampermatx=str_replace("*","&",$textormatx);
	$nom= strtoupper($textoampermatx);
	echo  $ncliente.": ".$nom."<br>";
	
	}
	echo"</span></TD>
    <TD WIDTH='86'  align='center' valign='middle'><span style='font-size:10px;'>".$rowkar['fecha_crono2']."</span></TD>
    <TD WIDTH='150' align='center' valign='middle'><span style='font-size:10px;'>".$rowkar['tipo_permiso']."</span></TD>
    <TD WIDTH='86' align='center' valign='middle'><span style='font-size:10px;'>".$rowkar['fec_ingreso2']."</span></TD>
<td width='86'align='center' valign='middle'><span style='font-size:10px;'>";
	if($rowkar['swt_est']==""){
		
		echo"CERRADO";
		}else{
			echo "NO CORRE";
			}
	 echo"</span></td>
  </TR>
</TABLE>";
}
?>
<!--</page>-->
