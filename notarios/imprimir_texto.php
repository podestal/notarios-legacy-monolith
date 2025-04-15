<?php


include('conexion.php');
include('extraprotocolares/view/funciones.php');
include('facturacion/consultas/comprobante.php');

$id='2015000001';

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

//echo $contador;


	$acu="&nbsp;";
	$ini=13;
	$arr=$ini-$contador;
	
for($i=1;$i<=$arr;$i++){
	
	$acu=$acu."&nbsp;";
}

$nombre=$arr_regventa[6].$acu;
  ?>
<!doctype html>
<html>
<head>
<title>rctm</title>
<style>
body{
	font-size:10px;
	font-family:arial;
}
</style>
</head>
<body>

<table width="653" border="0" cellspacing="0" cellpadding="0">

<tr><td height="50" colspan="6"></td></tr>
  <tr>

    <td colspan="3" align="right" style="margin-left:-20px;"></td>
    <td width="29"></td><td width="155"><font size="2"><?php echo $arr_regventa[3]; ?></font>&nbsp;</td>
    
  </tr>
  <tr><td height="10" colspan="7"></td></tr>
  <tr>
    <td width="68">.</td>
    <td colspan="4"><font size="2"></font></td>
    <td width="218"></td>
  </tr>
  
  
  <tr>
    <td width="68">.</td>
    <td colspan="5"><font size="2"><?php echo $nombre; ?></font></td>
     <td width="173" colspan="3" align="right"><font size="2"><?php echo $arr_regventa[7]; ?></font></td>
  </tr>
<tr><td height="5" colspan="6"></td></tr>
  <tr>
  	<td width="68">.</td>
    <td colspan="5" align="left"><font size="2"><?php echo $arr_regventa[8]; ?></font></td>
    <td colspan="3" align="right"><font size="2"><?php echo actual_date2(); ?></font></td>
  </tr>
    <tr><td height="30" colspan="7"></td></tr>
    
</table>
 
<table width="656" style="min-height:70px">'; 

<?php 
$c=0;     
for($i=0; $i<count($arr_dregventas); $i++){
		$pre=$arr_dregventas[$i][5]*$arr_dregventas[$i][6];	
		
					
?>
  <tr>
  	
    <td width="73" align="center"><?php echo (int)$arr_dregventas[$i][6]; ?></td>
    <td align="left" colspan="3"><font size="2"><?php echo $arr_dregventas[$i][4]; ?></font></td>
	<td width="339" align="right"><font size="2"><?php echo number_format($arr_dregventas[$i][5], 2, ',', ' '); ?></font></td>
   <td width="136" colspan="-1" align="right"><span style="font-size:11px" ><font size="2"><?php echo number_format($pre, 2, ',', ' '); ?></font></td>
  </tr>
  
  <?php
  $c++;
} 


if($c==0){
echo '
<tr><td height="90"></td></tr>';
}else if($c==1){
echo '
<tr><td height="90"></td></tr>';
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
?>



<tr><td height="25"></td></tr>
<tr>  	
    <td width="73" height="25"></td>
    <td align="left" colspan="5"><font size="2"> <?php echo  valorEnLetras($arr_regventa[16]); ?></font></td>
	<td width="19" colspan="-1" align="right"><font size="2"></font></td>
  </tr>
  <tr>  	
    <td width="73" height="15"></td>
    <td height="15" colspan="2" align="left"></td>
	<td height="15" colspan="2" align="left"><font size="2"></font></td>
	
	<td height="15" align="right"><font size="2"><?php echo number_format($arr_regventa[14], 2, ',', ' '); ?></font></td>
  </tr>  
  <tr>  	
    <td width="73" height="15"></td>
    <td height="15" colspan="2" align="left"></td>
	<td height="15" colspan="4" align="center"><table width="426" border="0" align="right" cellpadding="0" cellspacing="0">
	  <tr>
	    <td width="265"><font size="2"><?php echo actual_date(); ?></font></td>
	    <td width="139" align="right"><font size="2"><?php echo number_format($arr_regventa[15], 2, ',', ' '); ?></font></td>
	    <td width="22" align="right">&nbsp;</td>
	    </tr>
    </table></td>
  </tr>
<tr>  	
    <td width="73" height="15"></td>
    <td height="15" colspan="4" align="left"></td>
	<td height="15" align="right"><font size="2"><?php echo number_format($arr_regventa[16], 2, ',', ' '); ?></font></td>
  </tr>
  </table> 
</body></html>




