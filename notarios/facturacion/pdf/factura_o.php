<?php



include('../../conexion.php');
include('../../extraprotocolares/view/funciones.php');
include('../../facturacion/consultas/comprobante.php');

$id=$_GET['id_regventas'];
/*
$sql=mysql_query("SELECT MAX(m_regventas.id_regventas) AS ultimo						
				FROM m_regventas",$conn);
$res=mysql_fetch_assoc($sql);

$id=$res['ultimo'];  */
//cantidad maxima de lineas	
$cantidad_maxima=9;
//conteo de detalle
$count_detalle=0;
//cantidad maxima de caracteres direccion
$maximo_direccion=80;
$maximo_nombre=47;

$maximo_servicio=51;


function actual_date()  
{  
    $week_days = array ("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado");  
    $months = array ("", "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");  
    $year_now = date ("Y");  
    $month_now = date ("n");  
    $day_now = date ("j");  
    $week_day_now = date ("w");  
    $date = $day_now . "            " . $months[$month_now] . "        " . substr($year_now,2,4);   
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
    $date = $day_now . "            " . $months[$month_now] . "           " . substr($year_now,2,4);   
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

function detalle($Texto){
$TextoResumen1="";
$TextoResumen2="";
$TextoResumen3="";
$TextoResumen4="";
$TextoResumen5="";
$TextoResumen6="";
$TextoResumen7="";
$TextoResumen8="";
$TextoResumen9="";

$consulta=false;
$alto=false;
$numero=strlen($Texto);
//agregar mas 1
$cantmax=53 + 2;
//capturamos primera linea
if($numero<=$cantmax){$TextoResumen1=$Texto;}else{
$numero1=strrpos(substr($Texto,0,$cantmax)," ");
$TextoResumen1 = substr($Texto,0,strrpos(substr($Texto,0,$cantmax)," "));
//capturamos segunda linea
$cant2=strrpos(substr($Texto,0,$cantmax)," ");
if(strlen(substr($Texto,$cant2))<=$cantmax){$consulta=true;};
if($consulta==true){$TextoResumen2=substr($Texto,$cant2);}else{
$TextoResumen2= substr($Texto,$cant2,strrpos(substr($Texto,$cant2,$cantmax)," "));};
//capturamos tercera linea
if($consulta!=true){
$cant3=strrpos(substr($Texto,$cant2,$cantmax)," ") + $cant2;
if(strlen(substr($Texto,$cant3))<=$cantmax){$consulta=true;};
if($consulta==true){$TextoResumen3=substr($Texto,$cant3);}else{
$TextoResumen3 = substr($Texto,$cant3,strrpos(substr($Texto,$cant3,$cantmax)," "));};};
//capturamos cuarta linea
if($consulta!=true){
$cant4=strrpos(substr($Texto,$cant3,$cantmax)," ") + $cant3;
if(strlen(substr($Texto,$cant4))<=$cantmax){$consulta=true;};
if($consulta==true){$TextoResumen4=substr($Texto,$cant4);}else{
$TextoResumen4 = substr($Texto,$cant4,strrpos(substr($Texto,$cant4,$cantmax)," "));};};
//capturamos quinta linea
if($consulta!=true){
$cant5=strrpos(substr($Texto,$cant4,$cantmax)," ") + $cant4;
if(strlen(substr($Texto,$cant5))<=$cantmax){$consulta=true;};
if($consulta==true){$TextoResumen5=substr($Texto,$cant5);}else{
$TextoResumen5 = substr($Texto,$cant5,strrpos(substr($Texto,$cant5,$cantmax)," "));};};
//capturamos sexta linea
if($consulta!=true){
$cant6=strrpos(substr($Texto,$cant5,$cantmax)," ") + $cant5;
if(strlen(substr($Texto,$cant6))<=$cantmax){$consulta=true;};
if($consulta==true){$TextoResumen6=substr($Texto,$cant6);}else{
$TextoResumen6 = substr($Texto,$cant6,strrpos(substr($Texto,$cant6,$cantmax)," "));};};
//capturamos octaba linea
if($consulta!=true){
$cant7=strrpos(substr($Texto,$cant6,$cantmax)," ") + $cant6;
if(strlen(substr($Texto,$cant7))<=$cantmax){$consulta=true;};
if($consulta==true){$TextoResumen7=substr($Texto,$cant7);}else{
$TextoResumen7 = substr($Texto,$cant7,strrpos(substr($Texto,$cant7,$cantmax)," "));};};
//capturamos septima linea
if($consulta!=true){
$cant8=strrpos(substr($Texto,$cant7,$cantmax)," ") + $cant7;
if(strlen(substr($Texto,$cant8))<=$cantmax){$consulta=true;};
if($consulta==true){$TextoResumen8=substr($Texto,$cant8);}else{
$TextoResumen8 = substr($Texto,$cant8,strrpos(substr($Texto,$cant8,$cantmax)," "));};};
//capturamos novena linea
if($consulta!=true){
$cant9=strrpos(substr($Texto,$cant8,$cantmax)," ") + $cant8;
if(strlen(substr($Texto,$cant9))<=$cantmax){$consulta=true;};
if($consulta==true){$TextoResumen9=substr($Texto,$cant9);}else{
$TextoResumen9 = substr($Texto,$cant9,strrpos(substr($Texto,$cant9,$cantmax)," "));};};
}
if($TextoResumen1!="" && $TextoResumen1 != " "){$matriz_array=array($TextoResumen1);}
if($TextoResumen2!="" && $TextoResumen2 != " "){array_push($matriz_array,$TextoResumen2);}
if($TextoResumen3!="" && $TextoResumen3 != " "){array_push($matriz_array,$TextoResumen3);}
if($TextoResumen4!="" && $TextoResumen4 != " "){array_push($matriz_array,$TextoResumen4);}
if($TextoResumen5!="" && $TextoResumen5 != " "){array_push($matriz_array,$TextoResumen5);}
if($TextoResumen6!="" && $TextoResumen6 != " "){array_push($matriz_array,$TextoResumen6);}
if($TextoResumen7!="" && $TextoResumen7 != " "){array_push($matriz_array,$TextoResumen7);}
if($TextoResumen8!="" && $TextoResumen8 != " "){array_push($matriz_array,$TextoResumen8);}
if($TextoResumen9!="" && $TextoResumen9 != " "){array_push($matriz_array,$TextoResumen9);}

return $matriz_array;
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


	$acu=" ";
	$ini=13;
	$arr=$ini-$contador;
	
for($i=1;$i<=$arr;$i++){
	
	$acu=$acu." ";
}

$nombre=$arr_regventa[6];
  ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title></title>
<style>
.aaaa{
	letter-spacing: 0px;
	font-size:27px;
	font-family:sans-serif, Roman;
}
.bbbb{
	letter-spacing: 0px;
	font-size:27px;
	font-family:sans-serif, Roman;
}

.Estilo2 {font-family: Roman}
.Estilo3 {font-family: sans-serif}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>






<table width="1300" class="aaaa"  >
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
    <td height="62" colspan="2" >&nbsp;</td>
    <td width="472">&nbsp;</td>
    <td width="170">&nbsp;</td>
    <td width="86">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="108" colspan="2" >&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><?php echo $arr_regventa[2]."-".$arr_regventa[3]; ?></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="11" height="80" >&nbsp;</td>
    <td colspan="2" ><?php echo $numkardex; ?></td>
    <td class="aaaa"><?php echo $arr_regventa[10]; ?></td>
    <td>&nbsp;</td>
    <td width="32">&nbsp;</td>
    <td width="105">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td height="56" colspan="2" >&nbsp;</td>
    <td colspan="4" valign="top" class="aaaa"><?php 
	if(strlen($nombre)<=$maximo_nombre){
	echo strtoupper(str_replace("?","'",$nombre));
	}else{
	echo  strtoupper(substr(str_replace("?","'",$nombre),0,strrpos(substr(str_replace("?","'",$nombre),0,$maximo_nombre)," "))); 
	 }
	 
	  ?></td>
    <td colspan="4"></td>
  </tr>
  <tr>
    <td colspan="2" >&nbsp;</td>
    <td colspan="8" ><div align="left" ><?php
	if(strlen($arr_regventa[8])<=$maximo_direccion){
	echo strtoupper($arr_regventa[8]);
	}else{
	echo strtoupper(substr($arr_regventa[8],0,strrpos(substr($arr_regventa[8],0,$maximo_direccion)," ")));
	 }
	 ?></div></td>
	
  </tr>
  <tr>
    <td height="45" colspan="2" >&nbsp;</td>
    <td colspan="2" valign="top">
    <div align="left"><?php echo $arr_regventa[7]; ?></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4" valign="top"><?php echo dame_dia(); echo (' de '); echo dame_mes(); echo (' del ');  echo dame_anio();?></td>
  </tr>
  <tr>
    <td colspan="2" >&nbsp;</td>
    <td colspan="5">&nbsp;</td>
    <td width="5">&nbsp;</td>
    <td width="170">&nbsp;</td>
    <td width="115">&nbsp;</td>
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
    <td width="42" height="36" >&nbsp;</td>
    <td width="62"><?php echo (int)$arr_dregventas[$i][6]; ?></td>
    <td width="827"><div align="left"><?php 
	if( strlen($arr_dregventas[$i][4]) <= $maximo_servicio ){
	 echo strtoupper($arr_dregventas[$i][4]);
	}else{
	 echo strtoupper(substr($arr_dregventas[$i][4],0,strrpos(substr($arr_dregventas[$i][4],0,$maximo_servicio)," ")));
	}
	?></div></td>
    <td width="150" align="right"><?php echo ('S/. ');echo number_format($arr_dregventas[$i][5], 2, '.', ' '); ?></td>
    <td width="171" align="right"><?php echo ('S/. ');echo number_format($pre, 2, '.', ' '); ?></td>
    <td width="20" align="center">&nbsp;</td>
  </tr>
<?php	
	if($arr_dregventas[$i][9]!="" && $arr_dregventas[$i][9]!=" "  ){
	   $matriz2=array();
       $matriz2=detalle($arr_dregventas[$i][9]);
	   $top_detalle=($cantidad_maxima-count($arr_dregventas))-$count_detalle;
	for($j=0; $j<count($matriz2); $j++){
?>
  <tr>
    <td width="42" height="36" >&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="827"><div align="left"><?php echo strtoupper($matriz2[$j]); ?></div></td>
    <td width="150" >&nbsp;</td>
    <td width="171" >&nbsp;</td>
    <td width="20" >&nbsp;</td>
  </tr>
 <?php 
   $c++;
   if($top_detalle-($j+1)<0){break;};
   $count_detalle=$count_detalle+1;
    }		
	}
  $c++;
} 
?>


<?php
//si tiene detraccion
//$arr_regventa[16]
$detraccion=0;
$monto_detraccion=0;
if(floatval($arr_regventa[16])>=700.01){
$detraccion=1;
$monto_detraccion=($arr_regventa[16]*10)/100;
}
if($detraccion==1){
$n=($cantidad_maxima-$c)-3;
}else{
$n=$cantidad_maxima-$c;
}


for($i=0;$i<$n; $i++){
?>
  <tr>
   <td width="42" height="36">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="827">&nbsp;</td>
    <td width="150">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  
 <?php	
}
?>

  <?php 
	if($detraccion==1)
	{
	?>
   <tr>
   <td width="42" height="36">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="827">OPERACION SUJETA AL SISTEMA DE PAGO DE OBLIGACIONES</td>
    <td width="150">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
   <tr>
   <td width="42" height="36">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="827">TRIBUTARIAS CON EL GOBIERNO CENTRAL. DETRACCION DEL</td>
    <td width="150">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
    <tr>
   <td width="42" height="36">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="827"><?php  echo ('10% MONTO  '); echo number_format($monto_detraccion, 2, '.', ' ');  ?></td>
    <td width="150">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
	<?php
	}
	?>

</table>


<table width="1300" class="aaaa" >
  <tr>
    <td height="4">&nbsp;</td>
    <td width="33" height="4">&nbsp;</td>
    <td height="4" colspan="7"><?php echo  strtoupper(valorEnLetras($arr_regventa[16])); ?></td>
    <td height="4">&nbsp;</td>
    <td height="4">&nbsp;</td>
    <td height="4">&nbsp;</td>
    <td height="4">&nbsp;</td>
    <td height="4">&nbsp;</td>
    <td height="4">&nbsp;</td>
    <td height="4">&nbsp;</td>
    <td height="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" >&nbsp;</td>
    <td colspan="9" valign="top" >&nbsp;</td>
    <td colspan="3" >&nbsp;</td>
    <td >&nbsp;</td>
    <td colspan="2" >&nbsp;</td>
  </tr>
  <tr>
    <td height="20" colspan="2">&nbsp;</td>
    <td width="52">&nbsp;</td>
    <td width="69" rowspan="2"></td>
    <td width="262" rowspan="2"></td>
    <td width="57" rowspan="2" ><?php echo dame_dia(); ?></td>
    <td width="6" rowspan="2"></td>
    <td width="158" rowspan="2" ><?php echo dame_mes(); ?></td>
    <td width="65" rowspan="2"></td>
    <td colspan="2" rowspan="2" ><?php echo dame_anio(); ?></td>
    <td colspan="3">&nbsp;</td>
    <td width="34" align="right" valign="top">S/.</td>
    <td width="93" align="right" valign="top"><?php echo number_format($arr_regventa[14], 2, '.', ' '); ?></td>
    <td width="80" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="2" rowspan="2">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="126">&nbsp;</td>
    <td width="47" align="right" valign="top">18</td>
    <td width="18">&nbsp;</td>
    <td align="right" valign="bottom">S/.</td>
    <td align="right" valign="middle"><?php echo number_format($arr_regventa[15], 2, '.', ' '); ?></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td align="left" valign="bottom">S/.</td>
    <td align="right" valign="middle"><?php echo number_format($arr_regventa[16], 2, '.', ' '); ?></td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td width="33">&nbsp;</td>
    <td colspan="4"><?php echo dame_hora(); echo ('  S.E.U.O.'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="52">&nbsp;</td>
    <td width="43">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</body></html>






