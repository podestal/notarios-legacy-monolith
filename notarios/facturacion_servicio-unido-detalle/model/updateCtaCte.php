<?php
session_start();
include('../../conexion.php');

$id_ctaventas  = $_POST["id_ctaventas"];
//$num_docu_cli  = $_POST["id_regventas"];
//$codigo_cli    = $_POST["id_regventas"];
//$tipo_movi     = $_POST["id_regventas"];
$fecha         = $_POST["txtfecha"];
$tipo_docu     = $_POST["tipdocu2"];
$serie         = $_POST["seriedoc"];
$documento     = $_POST["numdocumen"];
//$kardex        = $_POST["id_regventas"];
$concepto      = $_POST["concepto"];
$importe       = floatval($_POST["txtmonto"]);
//$fecha_ven     = $_POST["id_regventas"];
$saldo         = floatval($_POST["txtsaldo"]);
//$swt_est       = $_POST["id_regventas"];
//$swt_anul      = $_POST["id_regventas"];
//$tipo_cambi    = $_POST["id_regventas"];
//$observacion   = $_POST["id_regventas"];
//$monedatipo    = $_POST["id_regventas"];
$tipopago      = $_POST["tippago"];
$banco         = $_POST["txtbanco"];
$cheque        = $_POST["numcta"];
//$monto_igv     = $_POST["id_regventas"];
//$codiempl      = $_POST["id_regventas"];

$consulta = mysql_query("SELECT m_cteventas.saldo FROM m_cteventas WHERE  m_cteventas.id_ctaventas =  '".$id_ctaventas."'", $conn) or die(mysql_error());
$rowsaldo = mysql_fetch_array($consulta);
$saldoant = floatval($rowsaldo["saldo"]);


if($saldo <= $importe)
{
	$saldoact = $saldoant - $saldo;
}
else if($saldo > $importe) 
{
	$saldoact = $saldoant - $saldo;
}

if($importe - $saldo <= 0.00)
{
	$swt_est = "T";
}
else if($importe - $saldo > 0.00)
{
	$swt_est = "";	
}


## CAMPOS PARA EL REGISTRO DE PAGOS.

## Numero boucher:
$busnumbouc = "SELECT CONCAT(REPEAT('0',10-LENGTH((MAX(CAST(m_regpagos.num_vouc AS DECIMAL))+1))),
(MAX(CAST(m_regpagos.num_vouc AS DECIMAL))+1)) AS numvouc FROM m_regpagos";

$numboucbus    = mysql_query($busnumbouc,$conn) or die(mysql_error());
$rownum        = mysql_fetch_array($numboucbus);
$new_num_vouc  = $rownum[0];
##################

## Num. documento del Cliente.
$busnumdoc = "SELECT m_cteventas.num_docu_cli FROM m_cteventas WHERE m_cteventas.id_ctaventas = '".$id_ctaventas."'";

$numdocbus        = mysql_query($busnumdoc,$conn) or die(mysql_error());
$rownumdoc        = mysql_fetch_array($numdocbus);
$new_num_doccli   = $rownumdoc[0];
##############################



$fec_pago = date("d/m/Y");
$id_mon   = "01";
$swt_estX  = "";
$usu_pago = $_SESSION["apepat_usu"].' '.$_SESSION["nom1_usu"];

## 1. ACTUALIZA LA CUENTA CORRIENTE :
$updateCtaCte = "UPDATE m_cteventas SET concepto = '$concepto', 
saldo = '$saldoact', swt_est = '$swt_est', tipopago = '$tipopago', banco = '$banco', cheque = '$cheque'
WHERE id_ctaventas = '$id_ctaventas'";
mysql_query($updateCtaCte,$conn) or die(mysql_error());

## 2. REGISTRA EL PAGO CON UN NUMERO DE BOUCHER :
$grabaRegPagos = "INSERT INTO m_regpagos(id_regpagos, num_vouc, num_doc_cli, fec_pago, tipo_docu, serie, numero, imp_pago, id_mon, swt_est, usu_pago)
VALUES (NULL, '$new_num_vouc', '$new_num_doccli', STR_TO_DATE('$fec_pago','%d/%m/%Y'), '$tipo_docu', '$serie', '$documento', '$saldo', '$id_mon', '$swt_estX', '$usu_pago')";
mysql_query($grabaRegPagos,$conn) or die(mysql_error());

?>



