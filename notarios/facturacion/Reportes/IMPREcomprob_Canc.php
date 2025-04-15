<?php
$fechade = $_REQUEST['fecini'];
$fechaa = $_REQUEST['fecfin'];
//$nomnotaria = "Nombre de la Notaria";
$nomnotaria = " ";
//$fechade = '01/01/2013';
//$fechaa = '31/01/2013';
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        
        	<title>.::Comprobantes Emitidos - Cancelados::.</title>
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
<p align="center">  <br><br>
     <strong>COMPROBANTES EMITIDOS - CANCELADOS</strong></p>
<p align="center"><strong>Listado del <?php echo $fechade ?> al <?php echo $fechaa ?></strong></p>

<TABLE  BORDER=1 CELLSPACING=0 CELLPADDING=0 align="center">
            
       <TR><td width="70" height="19" >Fec.Emision</td>
              <td width="90" >Fec.Pago</td>
              <td width="100" >Tipo</td>
              <td width="50" >Serie</td>
              <td width="70" >N.Doc.</td>
              <td width="230" >Cliente</td>
              <td width="90" align="right" >Base Imp.</td>
              <td width="90" align="right" >I.G.V.</td>
              <td width="90" align="right" >Imp. Total</td></TR>
</TABLE>
<?php 
include('../../conexion.php');

//$fechade=$_REQUEST['fecini'];
$fechade = $_REQUEST['fecini'];

$tiempo = explode ("/", $fechade);
$desde = $tiempo[2] . "-" . $tiempo[1] . "-" . $tiempo[0];

//$fechaa = $_REQUEST['fecfin'];
$fechaa = $_REQUEST['fecfin'];

$tiempo2 = explode ("/", $fechaa);
$hasta = $tiempo2[2] . "-" . $tiempo2[1] . "-" . $tiempo2[0];

$consulta = mysql_query("SELECT DATE_FORMAT(m_cteventas.fecha,'%d/%m/%Y') AS 'Fec.Emision', (CASE WHEN ISNULL(m_regpagos.fec_pago) THEN 'NO PAGADO' ELSE DATE_FORMAT(m_regpagos.fec_pago,'%d/%m/%Y') END) AS 'Fec.Pago', tip_documen.des_docum AS 'Tipo', m_cteventas.serie AS 'Serie',
m_cteventas.documento AS 'N.Documen.', (CASE WHEN (cliente.tipper='N') THEN cliente.nombre ELSE cliente.razonsocial END) AS 'Cliente',
m_regventas.subtotal AS 'BaseImp.', m_regventas.impuesto AS 'I.G.V.', m_regventas.imp_total AS 'Imp.Total'
FROM m_cteventas
INNER JOIN m_regpagos ON m_cteventas.tipo_docu = m_regpagos.tipo_docu  AND m_cteventas.serie = m_regpagos.serie AND m_cteventas.documento = m_regpagos.numero
INNER JOIN m_regventas ON m_cteventas.tipo_docu = m_regventas.tipo_docu  AND m_cteventas.serie = m_regventas.serie  AND m_cteventas.documento = m_regventas.factura
INNER JOIN cliente ON cliente.numdoc = m_cteventas.num_docu_cli
INNER JOIN tip_documen ON m_cteventas.tipo_docu = tip_documen.id_documen
WHERE m_cteventas.fecha >= STR_TO_DATE('".$fechade."','%d/%m/%Y') AND m_cteventas.fecha <= STR_TO_DATE('".$fechaa."','%d/%m/%Y')
ORDER BY m_cteventas.fecha ASC", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consulta)){

echo"<TABLE BORDER='1' CELLPADDING='0' CELLSPACING='0' ALIGN='CENTER'>
  <TR>
    <td width='70' valign='top'>".$row['Fec.Emision']."</td>
    <td width='90' valign='top'>".$row['Fec.Pago']."</td>
    <td width='100' valign='top'>".$row['Tipo']."</td>
    <td width='50' valign='top'>".$row['Serie']."</td>
	 <td width='70'  valign='top'>".$row['N.Documen.']."</td>
    <td width='230' valign='top'>".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($row['Cliente']))))."</td>
    <td width='90' align='right' valign='top'>".$row['BaseImp.']."</td>
    <td width='90' align='right' valign='top'>".$row['I.G.V.']."</td>
	<td width='90' align='right' valign='top'>".$row['Imp.Total']."</td>
  </TR>
</TABLE>";
}
?>
</body>
</html>