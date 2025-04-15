<?php
$anio = $_REQUEST['anio'];
//$nomnotaria = "Nombre de la Notaria";
$nomnotaria = " ";

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        
        	<title>.:: REPORTE UIF - IAOC ::.</title>
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
	</head>
        <body>
        <div><div id="logo_emp"><?php echo $nomnotaria ?></div> <!--<div id="fec_actual">Fecha: <?php echo $fec=date("d/m/Y H:m:s"); ?></div>--></div>        
<p align="center"><br><br>
     <strong>REPORTE UIF - IAOC</strong></p>
<p align="center"><strong>Listado del año <?php echo $anio ?></strong></p>

<TABLE  BORDER=1 CELLSPACING=0 CELLPADDING=0 align="center">
            
       <!--<TR><TD width="70" height="19">Numero</TD><TD width="86">Fec. Ingr.</TD><TD width="86">Fec. Dilig.</TD><TD width="93">Zona</TD><TD width="171">&nbsp; Remitente</TD><TD width="275">&nbsp; Destinatario</TD></TR>-->
       
       		  <TR>
                <TD align='center' width="113" height="19">Mes</td>
                <TD align='center' width="136">Cant. Operac.</td>
				<TD align='center' width="136">Operac. Soles</td>
				<TD align='center' width="136">Operac. Dolares</td>
                <TD align='center' width="260">Monto Soles</td>
                <TD align='center' width="196">Monto Dolares</td>
              </TR>
       
       
</TABLE>
<?php 
include('../conexion.php');
$anio = $_REQUEST['anio'];

$consulta = mysql_query("SELECT UPPER(d_tablas.des_item) AS 'mes',COUNT(*) AS 'Cant_Operaciones',
	COUNT(IF(IDMON=1,1,NULL)) AS 'Ope_Soles',
	COUNT(IF(IDMON=2,1,NULL)) AS 'Ope_Dolares',
	ROUND(SUM(IF(patrimonial.idmon = '1', patrimonial.importetrans,'0.00')),2) AS 'monto_soles',
	ROUND(SUM(IF(patrimonial.idmon = '2', patrimonial.importetrans,'0.00')),2) AS 'monto_dolares',
	SUM(patrimonial.importetrans) AS 'Monto Operacion' ,DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y') AS 'fec_escritura' 
	FROM patrimonial
	INNER JOIN kardex ON patrimonial.kardex = kardex.kardex
	INNER JOIN tiposdeacto ON patrimonial.idtipoacto = tiposdeacto.idtipoacto
	INNER JOIN d_tablas ON RIGHT(d_tablas.num_item,2) = SUBSTRING(DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y'),4,2) AND d_tablas.tip_item = 'mes'
	WHERE DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y') <> '00/00/0000' AND SUBSTRING(DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y'),7,4) = '$anio'
	AND ((patrimonial.idmon='1' AND patrimonial.importetrans>='7500') OR (patrimonial.idmon='2' AND patrimonial.importetrans>='2500')
	OR tiposdeacto.actouif='048' OR tiposdeacto.actouif='050' OR tiposdeacto.actouif='051' OR tiposdeacto.actouif='052' 
	OR tiposdeacto.actouif='053' OR tiposdeacto.actouif='054' OR tiposdeacto.actouif='055' OR tiposdeacto.actouif='037' 
	OR tiposdeacto.actouif='038' OR tiposdeacto.actouif='039' OR tiposdeacto.actouif='040' OR tiposdeacto.actouif='041' 
	OR tiposdeacto.actouif='042' OR tiposdeacto.actouif='043' OR tiposdeacto.actouif='044' OR tiposdeacto.actouif='045')
	GROUP BY SUBSTRING(DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y'),4,2)
	ORDER BY SUBSTRING(DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y'),4,2) ASC", $conn) or die(mysql_error());		

while($rowkar = mysql_fetch_array($consulta)){

echo"<TABLE BORDER='1' CELLPADDING='0' CELLSPACING='0' ALIGN='CENTER'>
  <TR>
    <TD WIDTH='113'  valign='top'>".$rowkar['mes']."</TD>
    <TD WIDTH='136' valign='top' align='right'>".$rowkar['Cant_Operaciones']."</TD>
	<TD WIDTH='136' valign='top' align='right'>".$rowkar['Ope_Soles']."</TD>
	<TD WIDTH='136' valign='top' align='right'>".$rowkar['Ope_Dolares']."</TD>
    <TD WIDTH='260' valign='top' align='right'>".$rowkar['monto_soles']."</TD>
	<TD WIDTH='196' valign='top' align='right'>".$rowkar['monto_dolares']."</TD>
  </TR>
</TABLE>";
}
?>
</body>
</html>