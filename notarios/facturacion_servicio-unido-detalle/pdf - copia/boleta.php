<?php



include('../../conexion.php');
include('../../extraprotocolares/view/funciones.php');
include('../../facturacion/consultas/comprobante.php');

//$id=$_GET['id_regventas'];

$sql=mysql_query("SELECT MAX(m_regventas.id_regventas) AS ultimo						
				FROM m_regventas",$conn);
$res=mysql_fetch_assoc($sql);

$id=$res['ultimo'];	


//cantidad maxima de lineas	
$cantidad_maxima=9;
//conteo de detalle
$count_detalle=0;
//cantidad maxima de caracteres direccion
$maximo_direccion=30;




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
    $date =substr($year_now,0,4);   
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
	letter-spacing: 0px;
	font-size:12px;
	font-family:sans-serif, Roman;
}
.bbbb{
	letter-spacing: 0px;
	font-size:12px;
	font-family:sans-serif, Roman;
}
.cccc{
	letter-spacing: 0px;
	font-size:10px;
	font-family:sans-serif, Roman;
}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<table width="661" class="aaaa">
<?php

$numkardex="";
for($i=0; $i<count($arr_dregventas); $i++){
	if($arr_dregventas[$i][0]!=""){
		
	if($numkardex==""){
    $numkardex=$arr_dregventas[$i][0];
	}
	}
	}
	$numkardex = 'KARDEX '.preg_replace('/[^0-9]+/', '', $numkardex);
?>
  <tr>
    <td height="17" colspan="9" class="aaaa">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2" class="aaaa">&nbsp;</td>
    <td width="20" height="25" class="aaaa">&nbsp;</td>
    <td width="196" class="aaaa">&nbsp;</td>
    <td width="117" rowspan="2" class="cccc" ><?php echo $arr_regventa[2]."-".$arr_regventa[3]; ?></td>
    <td width="248" height="25" valign="top" class="aaaa">&nbsp;</td>
  </tr>
  <tr>
    <td height="25" colspan="2" class="aaaa">&nbsp;</td>
    <td width="20" height="25" class="aaaa">&nbsp;</td>
    <td width="196" class="aaaa">&nbsp;</td>
    <td width="248" height="25" valign="top" class="aaaa">&nbsp;</td>
  </tr>
  
  <tr>
    <td width="30" class="aaaa">&nbsp;</td>
    <td colspan="3" class="aaaa"><?php echo $numkardex; ?></td>
    <td colspan="2" class="aaaa"><?php echo $arr_regventa[10]; ?></td>
  </tr>
  <tr>
    <td height="21" colspan="2" class="aaaa">&nbsp;</td>
    <td colspan="3" class="bbbb"><div align="left" ><?php 
echo strtoupper(substr($nombre,0,strrpos(substr($nombre,0,40)," ")));
	 ?></div></td>
    <td colspan="2" class="bbbb"><?php echo dame_fecha_corto(); ?></td>
  </tr>
  <tr>
    <td colspan="2" class="aaaa">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
<table width="663" class="aaaa">

<?php 
$n=0;
$c=0;     
for($i=0; $i<count($arr_dregventas); $i++){
		$pre=$arr_dregventas[$i][5]*$arr_dregventas[$i][6];
						
?>

  <tr>
    <td width="34" >&nbsp;</td>
    <td width="31"><?php echo (int)$arr_dregventas[$i][6]; ?></td>
    <td width="329" align="left"><?php echo $arr_dregventas[$i][4]; ?></td>
    <td width="72" align="right"><?php echo number_format($pre, 2, '.', ' '); ?></td>
    <td width="173">&nbsp;</td>
  </tr>
  
<?php
  $c++;
} 
?>

<?php
$n=5-$c;
for($i=0;$i<$n; $i++){
?>
  <tr>
   <td width="34">&nbsp;</td>
    <td width="31">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
 <?php	
}
?>
</table>


<table width="662" class="aaaa">
  
  <tr>
    <td width="62" height="45" rowspan="2" >&nbsp;</td>
    <td colspan="3" rowspan="2" >
    <div align=""><?php echo  strtoupper(valorEnLetras($arr_regventa[16])); ?></div></td>
    <td colspan="2" >&nbsp;</td>
  </tr>
  <tr>
    <td align="right" valign="bottom" >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr>
    <td height="19">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td width="72" align="right" valign="bottom"><?php echo number_format($arr_regventa[16], 2, '.', ' '); ?></td>
    <td width="172">&nbsp;</td>
  </tr>
  <tr>
    <td height="9">&nbsp;</td>
    <td width="31">&nbsp;</td>
    <td width="274">&nbsp;</td>
    <td width="23">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td height="10">&nbsp;</td>
    <td colspan="3"><?php echo dame_hora(); echo (' S.E.U.O'); ?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</body></html>




