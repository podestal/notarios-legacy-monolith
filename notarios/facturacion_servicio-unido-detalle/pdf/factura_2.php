<?php



include('../../conexion.php');
include('../../extraprotocolares/view/funciones.php');
include('../../facturacion/consultas/comprobante.php');

$id=$_GET['id_regventas'];

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
    $date = $day_now . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $months[$month_now] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . substr($year_now,2,4);   
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

function dame_fecha_corto()
{ 
   
    $months = array ("", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("d");  
    $date = $day_now . "/" . $months[$month_now] . "/" . substr($year_now,0,4);   
    return $date;    

}

function dame_dia()
{ 
   
    $months = array ("", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("d");  
    $date = $day_now;   
    return $date;    

}

function dame_anio()
{ 
   
    $months = array ("", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("d");  
    $date =substr($year_now,2,4);   
    return $date;    

}

function dame_mes()  
{  
    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $months[$month_now];   
    return $date;    
} 
function dame_mes_corto()  
{  
    $months = array ("", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("d");  
    $date =$months[$month_now];   
    return $date;  
} 

function dame_hora(){
$hora= date ("h:i:s");
return $hora;
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title></title>
<style>


.aaaa{
	letter-spacing: 2px;
	font-size:12px;
	font-family:"Arial",Helvetica, sans-serif;
}
.bbbb{
	letter-spacing: 1px;
	font-size:9px;
	font-family:"Arial",Helvetica, sans-serif;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>






<table width="1300" class="aaaa">
  <tr>
    <td height="28" colspan="10" >&nbsp;</td>
  </tr>
  <tr>
    <td height="30" >&nbsp;</td>
    <td width="72" >&nbsp;</td>
    <td width="315" >&nbsp;</td>
    <td width="217" ><?php echo $arr_regventa[10]; ?></td>
    <td width="110" ><?php echo $arr_regventa[2]."-".$arr_regventa[3]; ?></td>
    <td colspan="5" >&nbsp;</td>
  </tr>
  <tr>
    <td height="52" colspan="10" >&nbsp;</td>
  </tr>
  <tr>
    <td width="203" height="21" >&nbsp;</td>
    <td colspan="8"><div align="left"><?php echo $nombre; ?></div></td>
  </tr>
  <tr>
    <td height="21" >&nbsp;</td>
    <td colspan="9" class="bbbb"><div align="left"><?php echo strtoupper( $arr_regventa[8]); ?></div></td>
  </tr>
  <tr>
    <td height="25" >&nbsp;</td>
    <td colspan="4">
      <div align="left"><?php echo $arr_regventa[7]; ?></div></td>
    <td width="112"><?php echo dame_dia(); ?></td>
    <td width="186"><?php echo dame_mes(); ?></td>
    <td width="19" align="right">&nbsp;</td>
    <td width="26" align="right"><?php echo dame_anio(); ?></td>
  </tr>
  <tr>
    <td height="25" colspan="10" ><div align="center"></div></td>
  </tr>
</table>

<table width="1300" class="aaaa" >

<?php 
$n=0;
$c=0;     
for($i=0; $i<count($arr_dregventas); $i++){
		$pre=$arr_dregventas[$i][5]*$arr_dregventas[$i][6];
						
?>

  <tr>
    <td height="21" width="63" >&nbsp;</td>
    <td width="95"><?php echo (int)$arr_dregventas[$i][6]; ?></td>
    <td width="845"><?php echo $arr_dregventas[$i][4]; ?></td>
    <td width="162"><?php echo number_format($arr_dregventas[$i][5], 2, '.', ' '); ?></td>
    <td width="111"><?php echo number_format($pre, 2, '.', ' '); ?></td>
  </tr>
  
<?php
  $c++;
} 
?>

<?php
$n=8-$c;
for($i=0;$i<$n; $i++){
?>
  <tr>
   <td height="21" width="63">&nbsp;</td>
    <td width="95">&nbsp;</td>
    <td width="845">&nbsp;</td>
    <td width="162">&nbsp;</td>
    <td width="111">&nbsp;</td>
  </tr>
  
 <?php	
}
?>
</table>


<table width="1300" class="aaaa" >
  <tr>
    <td height="28"></td>
    <td width="107" height="28">&nbsp;</td>
    <td height="28" colspan="10" valign="top"><div align="left"><?php echo  strtoupper(valorEnLetras($arr_regventa[16])); ?></div></td>
    <td height="28">&nbsp;</td>
    <td height="28">&nbsp;</td>
    <td width="85" height="28">&nbsp;</td>
    <td width="7" height="28">&nbsp;</td>
    <td height="28">&nbsp;</td>
  </tr>
  <tr>
    <td width="47" >&nbsp;</td>
    <td colspan="10" ></td>
    <td colspan="4" >&nbsp;</td>
    <td >&nbsp;</td>
    <td width="108" valign="bottom" ><?php echo number_format($arr_regventa[14], 2, '.', ' '); ?></td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="56" rowspan="2"></td>
    <td width="156" rowspan="2"></td>
    <td width="61" valign="bottom"><?php echo dame_dia(); ?></td>
    <td width="77" rowspan="2"></td>
    <td width="109" valign="bottom"><?php echo dame_mes_corto(); ?></td>
    <td width="8" rowspan="2"></td>
    <td width="80" valign="bottom"><?php echo dame_anio(); ?></td>
    <td width="75" rowspan="2"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="57" rowspan="2" valign="middle">18</td>
    <td colspan="2" rowspan="2" valign="middle">S/</td>
    <td rowspan="2" valign="middle"><?php  echo number_format($arr_regventa[15], 2, '.', ' '); ?></td>
  </tr>
  <tr>
    <td height="21" rowspan="2">&nbsp;</td>
    <td colspan="2" rowspan="2">&nbsp;</td>
    <td width="61" valign="top">&nbsp;</td>
    <td width="109" valign="top">&nbsp;</td>
    <td width="80" valign="top">&nbsp;</td>
    <td width="57">&nbsp;</td>
    <td width="41">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="bottom"><?php echo number_format($arr_regventa[16], 2, '.', ' '); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="8">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">GRACIAS POR SU VISITA</td>
    <td colspan="4"><?php echo dame_hora(); echo (' S.E.U.O'); ?></td>
    <td colspan="5">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body></html>




