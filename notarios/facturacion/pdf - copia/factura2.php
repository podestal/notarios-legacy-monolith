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
	font-size:10px;
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



<?php

$cant_ventas=count($arr_dregventas);
$cant_maximo_linea=55;
$cant_lineas_item=count($arr_dregventas);
$cant_lineas_detalle=0;

for($i=0; $i<count($arr_dregventas); $i++){

     if(strlen($arr_dregventas[$i][4])>$cant_maximo_linea){
	//contamos caracteres
	$cant_caracteres=strlen($arr_dregventas[$i][4]);
	//cuantas lineas tendra todo
	$cantidad=  floor($cant_caracteres/$cant_maximo_linea);
	//cuantas lineas demas por item
	$cant_lineas_detalle=$cant_lineas_detalle + $cantidad -1;
	
	if(floor($cant_caracteres/$cant_maximo_linea)<($cant_caracteres/$cant_maximo_linea)){
	$cant_lineas_detalle=$cant_lineas_detalle + 1;
	}
	
	}else{
	$cant_lineas_detalle=$cant_lineas_detalle;
	}
					
}


?>



<table width="1200" class="aaaa">
  <tr>
    <td height="28" colspan="9" >&nbsp;</td>
  </tr>
  <tr>
    <td ><?php echo $cant_lineas_item; ?></td>
    <td width="81" ><?php echo $cant_lineas_detalle; ?></td>
    <td width="178" >&nbsp;</td>
    <td width="178" ><?php echo $arr_regventa[10]; ?></td>
    <td width="294" ><?php echo $arr_regventa[2]."-".$arr_regventa[3]; ?></td>
    <td colspan="4" >&nbsp;</td>
  </tr>
  <tr>
    <td height="54" colspan="9" >&nbsp;</td>
  </tr>
  <tr>
    <td width="177" height="21" >&nbsp;</td>
    <td colspan="7"><div align="left"><?php echo $nombre; ?></div></td>
  </tr>
  <tr>
    <td height="21" >&nbsp;</td>
    <td colspan="8" class="bbbb"><div align="left"><?php echo strtoupper( $arr_regventa[8]); ?></div></td>
  </tr>
  <tr>
    <td height="21" >&nbsp;</td>
    <td colspan="4">
      <div align="left"><?php echo $arr_regventa[7]; ?></div></td>
    <td width="61"><?php echo dame_dia(); ?></td>
    <td width="145"><?php echo dame_mes(); ?></td>
    <td width="50"><?php echo dame_anio(); ?></td>
  </tr>
  <tr>
    <td height="22" colspan="9" ><div align="center"></div></td>
  </tr>
</table>

<table width="1200" class="aaaa" >

  <tr>
    <td height="21" width="38" >&nbsp;</td>
    <td width="74">&nbsp;</td>
    <td width="490">&nbsp;</td>
    <td width="290" align="right">&nbsp;</td>
    <td width="284" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" width="38" >&nbsp;</td>
    <td width="74">&nbsp;</td>
    <td width="490">&nbsp;</td>
    <td width="290" align="right">&nbsp;</td>
    <td width="284" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" width="38" >&nbsp;</td>
    <td width="74">&nbsp;</td>
    <td width="490">&nbsp;</td>
    <td width="290" align="right">&nbsp;</td>
    <td width="284" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" width="38" >&nbsp;</td>
    <td width="74">&nbsp;</td>
    <td width="490">&nbsp;</td>
    <td width="290" align="right">&nbsp;</td>
    <td width="284" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" width="38" >&nbsp;</td>
    <td width="74">&nbsp;</td>
    <td width="490">&nbsp;</td>
    <td width="290" align="right">&nbsp;</td>
    <td width="284" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" width="38" >&nbsp;</td>
    <td width="74">&nbsp;</td>
    <td width="490">&nbsp;</td>
    <td width="290" align="right">&nbsp;</td>
    <td width="284" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" width="38" >&nbsp;</td>
    <td width="74">&nbsp;</td>
    <td width="490">&nbsp;</td>
    <td width="290" align="right">&nbsp;</td>
    <td width="284" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" width="38" >&nbsp;</td>
    <td width="74">&nbsp;</td>
    <td width="490">&nbsp;</td>
    <td width="290" align="right">&nbsp;</td>
    <td width="284" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" width="38" >&nbsp;</td>
    <td width="74">&nbsp;</td>
    <td width="490">&nbsp;</td>
    <td width="290" align="right">&nbsp;</td>
    <td width="284" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" width="38" >&nbsp;</td>
    <td width="74">&nbsp;</td>
    <td width="490">&nbsp;</td>
    <td width="290" align="right">&nbsp;</td>
    <td width="284" align="right">&nbsp;</td>
  </tr>
  
  

</table>


<table width="1200" class="aaaa" >
  <tr>
    <td height="4"></td>
    <td width="90" height="4">&nbsp;</td>
    <td height="4" colspan="10"><div align="left"><?php echo  strtoupper(valorEnLetras($arr_regventa[16])); ?></div></td>
    <td height="4">&nbsp;</td>
    <td height="4">&nbsp;</td>
    <td height="4">&nbsp;</td>
    <td height="4">&nbsp;</td>
    <td height="4">&nbsp;</td>
  </tr>
  <tr>
    <td width="47" >&nbsp;</td>
    <td colspan="10" ></td>
    <td colspan="4" >&nbsp;</td>
    <td >&nbsp;</td>
    <td width="99" >&nbsp;</td>
  </tr>
  <tr>
    <td height="20">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="56" rowspan="2"></td>
    <td width="171" rowspan="2"></td>
    <td width="46" rowspan="2" valign="top"><?php echo dame_dia(); ?></td>
    <td width="40" rowspan="2"></td>
    <td width="69" rowspan="2" valign="top"><?php echo dame_mes_corto(); ?></td>
    <td width="61" rowspan="2"></td>
    <td width="27" rowspan="2" valign="top"><?php echo dame_anio(); ?></td>
    <td width="75" rowspan="2"></td>
    <td colspan="4">&nbsp;</td>
    <td width="8">&nbsp;</td>
    <td valign="top"><?php echo ('S/ '); echo number_format($arr_regventa[14], 2, '.', ' '); ?></td>
  </tr>
  <tr>
    <td height="21" rowspan="2">&nbsp;</td>
    <td colspan="2" rowspan="2">&nbsp;</td>
    <td width="57">&nbsp;</td>
    <td width="150">&nbsp;</td>
    <td width="40">18</td>
    <td width="1">&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top"><?php echo ('S/ '); echo number_format($arr_regventa[15], 2, '.', ' '); ?></td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td>&nbsp;</td>
    <td valign="top"><?php echo ('S/ '); echo number_format($arr_regventa[16], 2, '.', ' '); ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="4">GRACIAS POR SU VISITA</td>
    <td><?php echo dame_hora(); echo(' S.E.U.O'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="8">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body></html>




