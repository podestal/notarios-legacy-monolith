<?php 
include('../conexion.php');

$anio = $_POST['anio'];
/*
SELECT UPPER(d_tablas.des_item) AS 'mes',COUNT(*) AS 'Cant_Operaciones', 
	SUM(IF(patrimonial.idmon = '1', patrimonial.importetrans,
		IF(ISNULL(patrimonial.tipocambio) OR patrimonial.tipocambio='' , ROUND((patrimonial.importetrans * 2.74),2) , ROUND((patrimonial.importetrans * patrimonial.tipocambio),2) ))) 	
	AS 'monto_soles',
	SUM(IF(patrimonial.idmon = '2', patrimonial.importetrans,
		IF(ISNULL(patrimonial.tipocambio) OR patrimonial.tipocambio='' , ROUND((patrimonial.importetrans / 2.74),2) , ROUND((patrimonial.importetrans / patrimonial.tipocambio),2) ))) 	
	AS 'monto_dolares' ,
	SUM(patrimonial.importetrans) AS 'Monto Operacion' ,DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y') AS 'fec_escritura' 
	FROM patrimonial
	INNER JOIN kardex ON patrimonial.kardex = kardex.kardex
	INNER JOIN d_tablas ON RIGHT(d_tablas.num_item,2) = SUBSTRING(DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y'),4,2) AND d_tablas.tip_item = 'mes'
	WHERE DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y') <> '00/00/0000'
	GROUP BY SUBSTRING(DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y'),4,2)
	ORDER BY SUBSTRING(DATE_FORMAT(kardex.fechaescritura,'%d/%m/%Y'),4,2) ASC
*/
if($anio!='')
{
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
}
else
{
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
}
while($rowkar = mysql_fetch_array($consulta)){

echo"<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>
  <tr>
	<td width='81' valign='top'><span class='Estilo12'>".$rowkar['mes']."</span></td>
	<td width='140' valign='top' align='right'><span class='Estilo12'>".$rowkar['Cant_Operaciones']."</span></td>
	<td width='140' valign='top' align='right'><span class='Estilo12'>".$rowkar['Ope_Soles']."</span></td>
	<td width='140' valign='top' align='right'><span class='Estilo12'>".$rowkar['Ope_Dolares']."</span></td>
	<td width='150' valign='top' align='right'><span class='Estilo12'>".$rowkar['monto_soles']."</span></td>
    <td width='73' valign='top' align='right'><span class='Estilo12'>".$rowkar['monto_dolares']."</span></td>
  </tr>
</table>";
}

?>