<?php
include('../../conexion.php');

$num_vouc  = $_POST["id_ctaventas"];


$consulta   = mysql_query("SELECT m_regpagos.imp_pago FROM m_regpagos WHERE  m_regpagos.num_vouc =  '".$num_vouc."'", $conn) or die(mysql_error());
$rowsaldo   = mysql_fetch_array($consulta);
$imp_pagado = floatval($rowsaldo["imp_pago"]);


$consulta2   = mysql_query("SELECT m_regpagos.num_doc_cli, m_regpagos.tipo_docu, m_regpagos.serie, m_regpagos.numero FROM m_regpagos WHERE m_regpagos.num_vouc =  '".$num_vouc."'", $conn) or die(mysql_error());
$rowX   = mysql_fetch_array($consulta2);

$num_doc_cli = $rowX["num_doc_cli"];
$tipo_docu   = $rowX["tipo_docu"];
$serie       = $rowX["serie"];
$documento   = $rowX["numero"];

$consulta3   = mysql_query("SELECT m_cteventas.saldo FROM m_cteventas WHERE m_cteventas.num_docu_cli = '$num_doc_cli' AND m_cteventas.tipo_docu = '$tipo_docu' AND m_cteventas.serie = '$serie' AND m_cteventas.documento = '$documento'", $conn) or die(mysql_error());
$rowY   = mysql_fetch_array($consulta3);

$saldoact = floatval($rowY["saldo"]);

//echo 'saldo actual: '.$saldoact.' imp_pagado: '.$imp_pagado;exit();

$new_saldo = $saldoact + $imp_pagado;

$swt_est = "";

$updateCtaCte = "UPDATE m_cteventas SET  saldo = '$new_saldo', swt_est = '$swt_est', m_cteventas.banco = '', m_cteventas.cheque = ''
WHERE m_cteventas.num_docu_cli = '$num_doc_cli' AND m_cteventas.tipo_docu = '$tipo_docu' AND m_cteventas.serie = '$serie' AND m_cteventas.documento = '$documento'";
mysql_query($updateCtaCte,$conn) or die(mysql_error());

$updateRegPagos = "UPDATE m_regpagos SET m_regpagos.swt_est = 'A' WHERE m_regpagos.num_vouc = '$num_vouc'";
mysql_query($updateRegPagos,$conn) or die(mysql_error());


?>
