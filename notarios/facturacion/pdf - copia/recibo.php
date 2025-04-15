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
$maximo_direccion=60;
$maximo_nombre=45;

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
	letter-spacing: 0px;
	font-size:12px;
	font-family:sans-serif, Roman;
}
.bbbb{
	letter-spacing: 0px;
	font-size:12px;
	font-family:sans-serif, Roman;
}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>






<table width="700" class="aaaa">
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
    <td height="30" colspan="9" class="aaaa">&nbsp;</td>
  </tr>
  <tr>
    <td height="37" colspan="9" class="aaaa">&nbsp;</td>
  </tr>
  <tr>
    <td height="15" colspan="2" class="aaaa">&nbsp;</td>
    <td width="197" height="15" class="aaaa">&nbsp;</td>
    <td width="35" height="15" class="aaaa">&nbsp;</td>
    <td width="140" class="aaaa"><?php echo $arr_regventa[2]."-".$arr_regventa[3]; ?></td>
    <td height="15" class="aaaa">&nbsp;</td>
    <td height="15" class="aaaa">&nbsp;</td>
    <td height="15" class="aaaa">&nbsp;</td>
    <td height="15" class="aaaa">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="9" class="aaaa"><div align="right">&nbsp;</div></td>
  </tr>
  <tr>
    <td width="40" class="aaaa">&nbsp;</td>
	<td colspan="2" class="aaaa"><?php echo $numkardex; ?></td>
	<td colspan="2"><?php echo $arr_regventa[10]; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="35" colspan="2" class="aaaa">&nbsp;</td>
    <td colspan="3" class="bbbb"><div align="left" ><?php 
	 echo strtoupper(substr($nombre,0,strrpos(substr($nombre,0,47)," "))); ?></div></td>
    <td width="20" valign="top"><?php echo dame_dia(); ?></td>
    <td width="22" valign="top"><?php echo dame_mes(); ?></td>
    <td width="178" valign="top"><?php echo dame_anio(); ?></td>
    <td width="6">&nbsp;</td>
  </tr>
  <tr>
    <td height="23" colspan="2" class="aaaa">&nbsp;</td>
    <td colspan="7">&nbsp;</td>
  </tr>
</table>

<table width="700" class="aaaa">

<?php 
$n=0;
$c=0;     
for($i=0; $i<count($arr_dregventas); $i++){
		$pre=$arr_dregventas[$i][5]*$arr_dregventas[$i][6];
						
?>

  <tr>
    <td width="45" >&nbsp;</td>
    <td width="26"><?php echo (int)$arr_dregventas[$i][6]; ?></td>
    <td width="342" align="left"><?php echo strtoupper(substr($arr_dregventas[$i][4],0,strrpos(substr($arr_dregventas[$i][4],0,51)," "))); ?></td>
    <td width="79" align="right"><?php echo number_format($pre, 2, '.', ' '); ?></td>
    <td width="184">&nbsp;</td>
  </tr>
  
<?php
  $c++;
} 
?>

<?php
$n=7-$c;
for($i=0;$i<$n; $i++){
?>
  <tr>
   <td width="45">&nbsp;</td>
    <td width="26">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
 <?php	
}
?>
</table>


<table width="700" class="aaaa">
  <tr>
    <td height="4">&nbsp;</td>
    <td height="4"><?php echo  strtoupper(valorEnLetras($arr_regventa[16])); ?></td>
    <td height="4">&nbsp;</td>
    <td height="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="80" >&nbsp;</td>
    <td width="335" >&nbsp;</td>
    <td width="82" rowspan="2" align="right" valign="middle"  ><?php echo number_format($arr_regventa[16], 2, '.', ' '); ?></td>
    <td width="183" >&nbsp;</td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
    <td><?php echo dame_hora(); echo (' S.E.U.O'); ?></td>
    <td>&nbsp;</td>
  </tr>
</table>
</body></html>




