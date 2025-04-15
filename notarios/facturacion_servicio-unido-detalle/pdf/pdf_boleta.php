<?php


header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=boleta$id.xls");

date_default_timezone_set("America/Lima");

$sql=mysql_query("SELECT MAX(m_regventas.id_regventas) AS ultimo			

			
				FROM m_regventas",$conn);
$res=mysql_fetch_assoc($sql);

//$id=$res['ultimo'];	

$id=$_GET['id_regventas'];

function actual_date()  
{  
    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", 

"Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", 

"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $week_days[$week_day_now].", ".$day_now." de ".$months[$month_now].
" del ".$year_now;   
    return $date;    
} 

function actual_date_2()  
{  
    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", 

"Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", 

"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $day_now."/".$month_now."/".$year_now;  
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

$sqluser=mysql_query("SELECT
						
usuarios.idusuario AS id
FROM usuarios
WHERE CONCAT(usuarios.apepat,' ',usuarios.apemat, ', ',usuarios.prinom, ' ',usuarios.segnom) 
LIKE '%$arr_regventa[13]%'
ORDER BY usuarios.loginusuario ASC",$conn);

$userbol=mysql_fetch_assoc($sqluser);

echo '<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>hola</title>
<style>
body{
	font-size:12px ;
	font-family:arial;
 }
</style>
</head>
<body>
<table width="380" border="0" cellspacing="0" cellpadding="0">
  <tr>
  
    <td  colspan="7"  valign="top" align="center" >'.$arr_regventa[3].'&nbsp;</td>
    
    
  </tr>
<tr><td height="5" colspan="7"  valign="top" align="center"></td></tr> 

  <tr>
    <td width="50">.</td>
    <td colspan="3">'.$arr_regventa[6].'</td>
    <td colspan="2" align="right" >'.actual_date().'</td>
  </tr>

  <tr>
  	<td width="40">.</td>
<td></td>
    <td colspan="3">.'.$arr_regventa[8].'</td>
    <td align="center">.'.$arr_regventa[7].'</td>
	<td align="center">|'.$userbol['id'].'</td>
  </tr>
<tr><td height="10"></td></tr>
<table border="0" width="100%" style="min-height:70px"><tr><td height="10"></td></tr>'; 

    
for($i=0; $i<count($arr_dregventas); $i++){
								

$cantidades=$arr_dregventas[$i][5]*$arr_dregventas[$i][6];	
echo '
  <tr>
  	
    <td width="20" align="left">'.(int)$arr_dregventas[$i][6].'</td>
    <td align="left" colspan="3" width="250">'.$arr_dregventas[$i][4].'</td>
	<td align="right" >
   '.number_format($arr_dregventas[$i][5], 2, ',', ' ').'</td>
   <td align="right" >
   '.number_format($cantidades, 2, ',', ' ').'</td>
  </tr>'; 
} 
echo '
<tr><td height="80" colspan="5"></td></tr> 
<tr>
  	
    <td width="50">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" colspan="5" width="250">'.valorEnLetras($arr_regventa[16]).'</td>
	<td align="center">.  </td>
  </tr>

<tr><td height="5" colspan="7"></td></tr> 
<table border="0" width="600">
  <tr>

	<td colspan="4" align="left"></td>

	<td align="right" colspan="2">'.actual_date_2

()."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($arr_regventa[16], 2, ',', ' ').'</td>

	


  </tr>
  


  </tr>

<tr>
<td width="50" align="left"></td>
<td align="left" colspan="3"></td>
<td align="center">';

echo date("H:i:s");
echo '</td>
</tr>
 </table>
</body></html>';



?>


