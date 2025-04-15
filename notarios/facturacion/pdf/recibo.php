<?php



include('../../conexion.php');
include('../../extraprotocolares/view/funciones.php');
include('../../facturacion/consultas/comprobante.php');

$id=$_GET['id_regventas'];
/*
$sql=mysql_query("SELECT MAX(m_regventas.id_regventas) AS ultimo						
				FROM m_regventas",$conn);
$res=mysql_fetch_assoc($sql);

$id=$res['ultimo'];	
*/
//cantidad maxima de lineas	
//$cantidad_maxima=9;
//conteo de detalle
$maximo_direccion=80;
$maximo_nombre=50;
$maximo_servicio=50;


//cantidad maxima de lineas	
$cantidad_maxima=7;
$count_detalle=0;
$maximo_nombre=50;
$maximo_servicio=50;
$maximo_direccion=80;






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
$cantmax=49 + 2;
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
//if($TextoResumen6!="" && $TextoResumen6 != " "){array_push($matriz_array,$TextoResumen6);}
//if($TextoResumen7!="" && $TextoResumen7 != " "){array_push($matriz_array,$TextoResumen7);}
//if($TextoResumen8!="" && $TextoResumen8 != " "){array_push($matriz_array,$TextoResumen8);}
//if($TextoResumen9!="" && $TextoResumen9 != " "){array_push($matriz_array,$TextoResumen9);}

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


	$acu="&nbsp;";
	$ini=13;
	$arr=$ini-$contador;
	
for($i=1;$i<=$arr;$i++){
	
	$acu=$acu."&nbsp;";
}

$nombre=$arr_regventa[6];
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
	if( strlen($nombre) <= $maximo_nombre ){
	 echo strtoupper(str_replace("?","'",$nombre));
	}else{
	 echo strtoupper(substr(str_replace("?","'",$nombre),0,strrpos(substr(str_replace("?","'",$nombre),0,$maximo_nombre)," ")));
	}
	?></div></td>
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
    <td width="342" align="left"><?php 
	if( strlen($arr_dregventas[$i][4]) <= $maximo_servicio ){
	 echo strtoupper($arr_dregventas[$i][4]);
	}else{
	 echo strtoupper(substr($arr_dregventas[$i][4],0,strrpos(substr($arr_dregventas[$i][4],0,$maximo_servicio)," ")));
	}
	 ?></td>
    <td width="79" align="right"><?php echo number_format($pre, 2, '.', ' '); ?></td>
    <td width="184">&nbsp;</td>
  </tr>
<?php	
	if($arr_dregventas[$i][9]!="" && $arr_dregventas[$i][9]!=" "  ){
	   $matriz2=array();
       $matriz2=detalle($arr_dregventas[$i][9]);
	   $top_detalle=($cantidad_maxima-count($arr_dregventas))-$count_detalle;
	for($j=0; $j<count($matriz2); $j++){
?>
<tr>
    <td width="45" >&nbsp;</td>
    <td width="26">&nbsp;</td>
    <td width="342" align="left"><?php echo strtoupper($matriz2[$j]); ?></td>
    <td width="79">&nbsp;</td>
    <td width="184">&nbsp;</td>
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
$n=$cantidad_maxima-$c;
for($i=0;$i<$n; $i++){
?>
<tr>
    <td width="45" >&nbsp;</td>
    <td width="26">&nbsp;</td>
    <td width="342">&nbsp;</td>
    <td width="79">&nbsp;</td>
    <td width="184">&nbsp;</td>
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




