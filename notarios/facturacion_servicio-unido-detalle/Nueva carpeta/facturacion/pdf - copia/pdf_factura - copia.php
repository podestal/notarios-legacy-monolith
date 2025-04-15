

<?php


header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=factura.xls");

$sql=mysql_query("SELECT MAX(m_regventas.id_regventas) AS ultimo	

					
				FROM m_regventas",$conn);
$res=mysql_fetch_assoc($sql);

//$id=$res['ultimo'];	

$id=$_GET['id_regventas'];

function actual_date()  
{  
    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", 

"Jueves", "Viernes", "Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", 

"Junio", "Julio", "Agosto", "Septiembre", "Octubre", 

"Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $week_days[$week_day_now].", ".$day_now." de ".$months

[$month_now].
" del ".$year_now;   
    return $date;    
} 

function actual_date_2()  
{  
    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", 

"Jueves", "Viernes", "Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", 

"Junio", "Julio", "Agosto", "Septiembre", "Octubre", 

"Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $day_now . 

"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $months[$month_now] . 

"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . 

$year_now;   
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


$contador=strlen($arr_regventa[6]);

echo $contador;


	$acu="&nbsp;";
	$ini=153;
	$arr=$ini-$contador;
	
for($i=1;$i<=$arr;$i++){
	
	$acu=$acu."&nbsp;";
}

$nombre=$arr_regventa[6].$acu;

echo '<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>hola</title>
<style>
body{
	font-size:9px;
	font-family:arial;
 }
</style>
</head>
<body>
<table border="0" width:"400" cellspacing="0" cellpadding="0" sTYLE="table-layout:fixed">
<tr><td height="40" colspan="5"></td><td 

style="width:100px"></td></tr>

  <tr width="400"> 
    <td width="100" >.</td>
    <td colspan="" height="42" width="150"><span style="font-

size:8px;"><font size="-2">'.$nombre.'</font></span></td>
	
    <td colspan="4" 

align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.actual_date

().'</td>
  </tr>

  <tr>
  	<td width="40">.</td>
    <td colspan="3" width="100"><span style="font-size:9px">'.$arr_regventa

[8].'</span></td>
    <td colspan="1" align="center">'.$arr_regventa[7].'</td>
  </tr>
<tr><td height="28" colspan="6"></td></tr>

<table border="0" style="min-height:70px">';    
$c=0;
$subtotal=$arr_regventa[14]-$arr_regventa[15];
for($i=0; $i<count($arr_dregventas); $i++){
	$cantidades=$arr_dregventas[$i][5]*$arr_dregventas[$i][6];								
echo '
  <tr>
  	
    <td width="30" align="left">'.(int)$arr_dregventas[$i][6].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" colspan="2" >'.$arr_dregventas[$i]

[4].'</td>
	<td align="right" colspan="3">
   '.number_format($cantidades, 2, ',', ' ').'</td>
  </tr>'; 
  $c++;
} 
if($c==0){
echo '
<tr><td height="150"></td></tr>';
}else if($c==1){
echo '
<tr><td height="130"></td></tr>';
}else if($c==2){
echo '
<tr><td height="112"></td></tr>';
}else if($c==3){
echo '
<tr><td height="105"></td></tr>';
}else if($c==4){
echo '
<tr><td height="94"></td></tr>';
}else if($c==5){
echo '
<tr><td height="79"></td></tr>';
}else if($c==6){
echo '
<tr><td height="65"></td></tr>';
}


echo '
<tr><td height="25"></td></tr>
<tr>
  	
    <td width="50">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" colspan="4" width="250">'.valorEnLetras

($arr_regventa[16]).'</td>
	<td align="center">.  </td>
  </tr>
  <tr>
 	<td width="50">.</td>
    <td align="left" colspan="3">.</td>
	<td >'.$arr_dregventas[$i][5].'&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
<tr><td height="7"></td></tr>  

</table>
<table border="0">
  <tr>

	<td colspan="3" align="center">'.actual_date_2().'</td>
	<td align="right" colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;'.number_format($arr_regventa[14], 2, ',', ' ')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($arr_regventa

[15], 2, ',', ' ')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".number_format($arr_regventa[16], 2, 

',', ' ').'</td>

	

  </tr>
  

 
 </table>
</body></html>';



?>




