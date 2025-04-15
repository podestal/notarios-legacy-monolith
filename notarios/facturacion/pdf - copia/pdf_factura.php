<?php

$id=$_GET['id_regventas'];
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=factura$id.xls");

$sql=mysql_query("SELECT MAX(m_regventas.id_regventas) AS ultimo						
				FROM m_regventas",$conn);
$res=mysql_fetch_assoc($sql);

//$id=$res['ultimo'];	



function actual_date()  
{  
    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $day_now . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $months[$month_now] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . substr($year_now,2,4);   
    return $date;    
} 

function actual_date2()  
{  
    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $day_now . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $months[$month_now] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . substr($year_now,2,4);   
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
	$ini=13;
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
	font-size:11px;
	font-family:arial;
}
</style>
</head>
<body>
<table width="1000" border="0" cellspacing="0" cellpadding="0">

<tr><td height="60" colspan="6"></td></tr>
  <tr>

    <td colspan="3" align="right" style="margin-left:-20px;"></td>
    <td></td><td><font size="2">'.$arr_regventa[3].'</font>&nbsp;</td>
    
  </tr>
  <tr><td height="10" colspan="7"></td></tr>
  <tr>
    <td width="20">.</td>
    <td colspan="4"><font size="2"></font></td>
    <td></td>
  </tr>
  
  
  <tr>
    <td width="20">.</td>
    <td colspan="5"><font size="2">'.$nombre.'</font></td>
     <td colspan="3" align="right"><font size="2">'.$arr_regventa[7].'&nbsp;</font></td>
  </tr>
<tr><td height="5" colspan="6"></td></tr>
  <tr>
  	<td width="20">.</td>
    <td colspan="5" align="left"><font size="2">'.$arr_regventa[8].'</font></td>
    <td colspan="3" align="right"><font size="2">'.actual_date2().'</font></td>
  </tr>
    <tr><td height="35" colspan="7"></td></tr>
 
<table width="100%" style="min-height:70px">'; 
$c=0;     
for($i=0; $i<count($arr_dregventas); $i++){
		$pre=$arr_dregventas[$i][5]*$arr_dregventas[$i][6];					
echo '
  <tr>
  	
    <td width="20" align="left">'.(int)$arr_dregventas[$i][6].'</td>
    <td align="left" colspan="5" width="200"><font size="2">'.$arr_dregventas[$i][4].'</font></td>
	<td align="center" width="10" colspan="2"><font size="2">
	'.number_format($arr_dregventas[$i][5], 2, ',', ' ').'</font></td>
   <td align="right"><span style="font-size:11px" ><font size="2">'.number_format($pre, 2, ',', ' ').'</font></td>
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
    <td width="50" height="25"></td>
    <td align="left" colspan="7" width="250"><font size="2">'.valorEnLetras($arr_regventa[16]).'</font></td>
	<td align="right"><font size="2"></font></td>
  </tr>
  <tr>  	
    <td width="50" height="20"></td>
    <td align="left" colspan="2" width=""></td>
	<td align="left" colspan="4" width=""><font size="2"></font></td>
	
	<td align="right" colspan="2"><font size="2">'.number_format($arr_regventa[14], 2, ',', ' ').'</font></td>
  </tr>  
  <tr>  	
    <td width="50" height="25"></td>
    <td align="left" colspan="2" width=""></td>
	<td align="left" colspan="4" width=""><font size="2">'.actual_date().'</font></td>
	
	<td align="right" colspan="2"><font size="2">'.number_format($arr_regventa[15], 2, ',', ' ').'</font></td>
  </tr>
<tr>  	
    <td width="50" height="25"></td>
    <td align="left" colspan="6" width="250"></td>
	<td align="right" colspan="2"><font size="2">'.number_format($arr_regventa[16], 2, ',', ' ').'</font></td>
  </tr>
</body></html>';



?>


