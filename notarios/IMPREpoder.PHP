<?php
//$nomnotaria = "Nombre de la Notaria";
$nomnotaria = " ";
//$fechade = '01/01/2013';
//$fechaa = '31/01/2013';

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
$consulta = mysql_query("SELECT ingreso_poderes.*, poderes_asunto.des_asunto AS 'des_as' ,
						(CASE WHEN (ingreso_poderes.swt_est='' OR ISNULL(ingreso_poderes.swt_est)) THEN '' ELSE 'NO CORRE' END) AS 'Estado' , 																																																																																									                         DATE_FORMAT(ingreso_poderes.fec_crono,'%d/%m/%Y') AS 'fecha_crono2',
						 DATE_FORMAT(ingreso_poderes.fec_ingreso,'%d/%m/%Y') AS 'fec_ingreso2', ingreso_poderes.swt_est
						 FROM ingreso_poderes 
						 INNER JOIN poderes_asunto ON poderes_asunto.id_asunto = ingreso_poderes.id_asunto
						 WHERE ingreso_poderes.fec_crono BETWEEN STR_TO_DATE('$fechade','%d/%m/%Y') AND STR_TO_DATE('$fechaa','%d/%m/%Y')
						 ORDER BY ingreso_poderes.id_poder ASC", $conn) or die(mysql_error());
}
else if($nocorre == '')
{
$consulta = mysql_query("SELECT ingreso_poderes.*, poderes_asunto.des_asunto AS 'des_as' ,
						(CASE WHEN (ingreso_poderes.swt_est='' OR ISNULL(ingreso_poderes.swt_est)) THEN '' ELSE 'NO CORRE' END) AS 'Estado' , 																																																																																									                         DATE_FORMAT(ingreso_poderes.fec_crono,'%d/%m/%Y') AS 'fecha_crono2',
						 DATE_FORMAT(ingreso_poderes.fec_ingreso,'%d/%m/%Y') AS 'fec_ingreso2',ingreso_poderes.swt_est 
						 FROM ingreso_poderes 
						 INNER JOIN poderes_asunto ON poderes_asunto.id_asunto = ingreso_poderes.id_asunto
						 WHERE ingreso_poderes.fec_crono BETWEEN STR_TO_DATE('$fechade','%d/%m/%Y') AND STR_TO_DATE('$fechaa','%d/%m/%Y')
						 AND (swt_est = '' OR ISNULL(swt_est))
						 ORDER BY ingreso_poderes.id_poder ASC", $conn) or die(mysql_error());		
}


while($rowkar = mysql_fetch_array($consulta)){
	
$numkar = $rowkar['num_kardex'];
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);

echo"<TABLE BORDER='1' CELLPADDING='0' CELLSPACING='0' ALIGN='CENTER'>
  <TR>
    <TD WIDTH='37'  HEIGHT='19' ><span style='font-family:'Arial Black', Gadget, sans-serif; font-size:10px;'>".$rowkar['id_poder']."</span></TD>
    <TD WIDTH='80'  valign='top'><span style='font-family:'Arial Black', Gadget, sans-serif; font-size:10px;'>".$numkar2."</span></TD>
    <TD WIDTH='200'  valign='top'><span style='font-family:'Arial Black', Gadget, sans-serif; font-size:10px;'>".strtoupper($rowkar['des_as'])."</span></TD>
    <TD WIDTH='86'  valign='top'><span style='font-family:'Arial Black', Gadget, sans-serif; font-size:10px;'>".$rowkar['fecha_crono2']."</span></TD>
    <TD WIDTH='350' valign='top'><span style='font-family:'Arial Black', Gadget, sans-serif; font-size:10px;'>";
	
	$consulcont = mysql_query("SELECT * FROM poderes_contratantes  WHERE poderes_contratantes.id_poder='".$rowkar['id_poder']."'", $conn) or die(mysql_error());
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

	echo  $ncliente.": ".$rowcont['c_descontrat']."<br>";
	}
	echo"</span></TD>
    <TD WIDTH='86' valign='top'><span style='font-family:'Arial Black', Gadget, sans-serif; font-size:10px;'>".$rowkar['fec_ingreso2']."</span></TD>
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