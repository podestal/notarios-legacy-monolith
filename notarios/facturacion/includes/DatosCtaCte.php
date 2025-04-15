<?php
require("../../conexion.php");

$id_ctaventas = $_REQUEST["id_ctaventas"];

$consulta = mysql_query("SELECT CONCAT(m_cteventas.id_ctaventas,'|', tip_documen.des_docum ,'|', m_cteventas.serie ,'|', m_cteventas.documento ,'|',
m_cteventas.fecha ,'|', m_cteventas.saldo ,'|', m_regventas.concepto ,'|', m_cteventas.tipo_docu ,'|', m_cteventas.codiempl ,'|', 
DATE_FORMAT(m_cteventas.fecha,'%d/%m/%Y') ,'|', m_cteventas.tipopago ,'|', m_cteventas.banco ,'|', m_cteventas.cheque ,'|', m_cteventas.monedatipo ,'|', 
m_cteventas.swt_est ,'|', m_cteventas.importe ,'|', m_cteventas.saldo ,'|', m_regventas.swt_det ,'|', m_regventas.detraccion) AS 'datos'
FROM m_cteventas
INNER JOIN m_regventas ON m_regventas.id_regventas = m_cteventas.id_ctaventas
INNER JOIN tip_documen ON tip_documen.id_documen = m_cteventas.tipo_docu
WHERE m_cteventas.swt_est <> 'T' AND m_cteventas.id_ctaventas =  '".$id_ctaventas."'", $conn) or die(mysql_error());
$rowa = mysql_fetch_array($consulta);

$data = $rowa["datos"];
echo $data;
?>