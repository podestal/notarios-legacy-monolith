<?php 
include('../../conexion.php');

 $fechade = $_POST['fechade'];
$tiempo  = explode ("/", $fechade);
 $desde   = $tiempo[2] . "-" . $tiempo[1] . "-" . $tiempo[0];
//echo "<br>";
 $fechaa  = $_POST['fechaa'];
$tiempo2 = explode ("/", $fechaa);
 $hasta   = $tiempo2[2] . "-" . $tiempo2[1] . "-" . $tiempo2[0];
//echo "<br>";

/*echo $consulta = mysql_query("SELECT DATE_FORMAT(m_cteventas.fecha,'%d/%m/%Y') AS 'Fec.Emision', (CASE WHEN ISNULL(m_regpagos.fec_pago) THEN 'NO PAGADO' ELSE DATE_FORMAT(m_regpagos.fec_pago,'%d/%m/%Y') END) AS 'Fec.Pago', tip_documen.des_docum AS 'Tipo', m_cteventas.serie AS 'Serie',
m_cteventas.documento AS 'N.Documen.', (CASE WHEN (cliente.tipper='N') THEN cliente.nombre ELSE cliente.razonsocial END) AS 'Cliente',
m_regventas.subtotal AS 'BaseImp.', m_regventas.impuesto AS 'I.G.V.', m_regventas.imp_total AS 'Imp.Total'
FROM m_cteventas
LEFT OUTER JOIN m_regpagos ON m_cteventas.tipo_docu = m_regpagos.tipo_docu  AND m_cteventas.serie = m_regpagos.serie AND m_cteventas.documento = m_regpagos.numero
INNER JOIN m_regventas ON m_cteventas.tipo_docu = m_regventas.tipo_docu  AND m_cteventas.serie = m_regventas.serie  AND m_cteventas.documento = m_regventas.factura
INNER JOIN cliente ON cliente.numdoc = m_cteventas.num_docu_cli
INNER JOIN tip_documen ON m_cteventas.tipo_docu = tip_documen.id_documen
WHERE m_cteventas.fecha >= STR_TO_DATE('".$fechade."','%d/%m/%Y') AND m_cteventas.fecha <= STR_TO_DATE('".$fechaa."','%d/%m/%Y')
ORDER BY m_cteventas.fecha ASC", $conn) or die(mysql_error());*/



$consulta = mysql_query("SELECT  DATE_FORMAT(m_regventas.fecha,'%d/%m/%Y') AS 'Fec.Emision',m_regventas.factura AS 'N.Documen.',m_regventas.concepto as Cliente,tip_documen.des_docum AS 'Tipo',m_regventas.serie AS 'Serie',m_regventas.subtotal AS 'BaseImp.', m_regventas.impuesto AS 'I.G.V.', m_regventas.imp_total AS 'Imp.Total'
FROM m_regventas
INNER JOIN tip_documen ON m_regventas.tipo_docu = tip_documen.id_documen
WHERE m_regventas.fecha >= STR_TO_DATE('".$fechade."','%d/%m/%Y') AND m_regventas.fecha <= STR_TO_DATE('".$fechaa."','%d/%m/%Y')

ORDER BY m_regventas.concepto ASC", $conn) or die(mysql_error());





while($row = mysql_fetch_array($consulta)){

echo"<table width='834' border='1' cellpadding='0' cellspacing='0' >
  <tr>
    <td width='70' valign='top'><span class='Estilo12'>".$row['Fec.Emision']."</span></td>
    <td width='60' valign='top'><span class='Estilo12'>".$row['Tipo']."</span></td>
    <td width='30' valign='top'><span class='Estilo12'>".$row['Serie']."</span></td>
	 <td width='50'  valign='top'><span class='Estilo12'>".$row['N.Documen.']."</span></td>
    <td width='120' valign='top'><span class='Estilo12'>".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($row['Cliente']))))."</span></td>
    <td width='50' align='right' valign='top'><span class='Estilo12'>".$row['BaseImp.']."</span></td>
    <td width='50' align='right' valign='top'><span class='Estilo12'>".$row['I.G.V.']."</span></td>
	<td width='50' align='right' valign='top'><span class='Estilo12'>".$row['Imp.Total']."</span></td>
  </tr>
</table>";
}

?>
<!--  <td width='70' valign='top'><span class='Estilo12'>".$row['Fec.Pago']."</span></td>-->