<?php
 session_start();
	
require_once("../dompdf/dompdf_config.inc.php");
include('../conexion.php');
include('../extraprotocolares/view/funciones.php');
include('../facturacion/consultas/comprobante.php');

$sql=mysql_query("SELECT MAX(m_regventas.id_regventas) AS ultimo						
				FROM m_regventas",$conn);
$res=mysql_fetch_assoc($sql);

$id=$res['ultimo'];	

function actual_date()  
{  
    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $week_days[$week_day_now] . ", " . $day_now . " de " . $months[$month_now] . " de " . $year_now;   
    return $date;    
} 
							
$arr_regventa = dame_comprobante($id);

	$id_pago=$arr_regventa[10];
	$id_bol=$arr_regventa[1];
	
$arr_documentos = dame_documentos();
$arr_comprobantes = dame_comprobantes($id_bol);
$arr_tipospagos = dame_tipopagos($id_pago);
$arr_servicios = dame_servicios();
$arr_usuarios = dame_usuarios();
$arr_dregventas = dame_dregventas($id);

$html='<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>hola</title>
<style>
body{
	font-size:10px ;
	font-family:arial;
 }
</style>
</head>
<body>
<table width="380" border="0" cellspacing="0" cellpadding="0">

<tr><td height="20" colspan="8"></td></tr>
  <tr>
    <td width="50">.</td>
    <td colspan="5">'.$arr_regventa[6].'</td>
    <td>Lima, '.$date.'</td>
    
  </tr>
  <tr>
  	<td width="50">.</td>
    <td colspan="5">.'.$arr_regventa[8].'</td>
    <td>'.$arr_regventa[7].'</td>
  </tr>
<tr><td height="15" colspan="8"></td></tr>  
<table width="100%" style="min-height:70px"><tr><td height="10"></td></tr>';     
for($i=0; $i<count($arr_dregventas); $i++){
									
$html=$html.'
  <tr>
  	
    <td width="50">'.(int)$arr_dregventas[$i][6].'</td>
    <td align="left" colspan="3" width="250">'.$arr_dregventas[$i][4].'</td>
	<td >'.$arr_dregventas[$i][5].'&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   '.$arr_dregventas[$i][5].'</td>
  </tr>'; 
} 
$html =$html.'
<tr><td height="80"></td></tr>
  <tr>
 	<td width="50">.</td>
    <td align="left" colspan="3">.</td>
	<td >'.$arr_dregventas[$i][5].'&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>

<tr><td height="5"></td></tr>  
  <tr>
 	<td width="50">.</td>
    <td align="left" colspan="3">'.valorEnLetras($arr_regventa[14]).'</td>
	<td >'.$arr_dregventas[$i][5].'&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
   
<tr><td height="5"></td></tr>  
<table border="0" width="430" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100">.</td>
    <td width="100">.</td>
	<td width="50">'.$arr_regventa[12]."     ".$arr_regventa[13]."     ".$arr_regventa[14].'</td>
  </tr>
 </table>
</body></html>';

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('my.pdf',array('Attachment'=>1));

?>


