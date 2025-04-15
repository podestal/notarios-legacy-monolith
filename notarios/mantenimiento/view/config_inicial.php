<?php

include("../../conexion.php");

$ini_sisnot       = $_POST['ini_sisnot'];
$ini_correlativo  = $_POST['ini_correlativo'];
$ini_banco        = $_POST['ini_banco'];




//consultamos las abreviaturas
$consulta_k=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10001'", $conn) or die(mysql_error());
$row_k = mysql_fetch_array($consulta_k);
$abre_k=$row_k["c_valor"];
$consulta_nc=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10002'", $conn) or die(mysql_error());
$row_nc = mysql_fetch_array($consulta_nc);
$abre_nc=$row_nc["c_valor"];
$consulta_ac=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10003'", $conn) or die(mysql_error());
$row_ac = mysql_fetch_array($consulta_ac);
$abre_ac=$row_ac["c_valor"];
$consulta_ga=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10004'", $conn) or die(mysql_error());
$row_ga = mysql_fetch_array($consulta_ga);
$abre_ga=$row_ga["c_valor"];
$consulta_te=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10005'", $conn) or die(mysql_error());
$row_te = mysql_fetch_array($consulta_te);
$abre_te=$row_te["c_valor"];
//bancos
$consulta_k=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10006'", $conn) or die(mysql_error());
$row_k = mysql_fetch_array($consulta_k);
$abre_bcp=$row_k["c_valor"];
$consulta_nc=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10007'", $conn) or die(mysql_error());
$row_nc = mysql_fetch_array($consulta_nc);
$abre_scb=$row_nc["c_valor"];
$consulta_ac=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10008'", $conn) or die(mysql_error());
$row_ac = mysql_fetch_array($consulta_ac);
$abre_cnt=$row_ac["c_valor"];
$consulta_ga=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10009'", $conn) or die(mysql_error());
$row_ga = mysql_fetch_array($consulta_ga);
$abre_inb=$row_ga["c_valor"];
$consulta_te=mysql_query("select c_valor from tb_abreviatura where c_c_abreviatura='10010'", $conn) or die(mysql_error());
$row_te = mysql_fetch_array($consulta_te);
$abre_otr=$row_te["c_valor"];

//consultamos si hay data
$consultadata=mysql_query("SELECT * from kardex  LIMIT 1 ", $conn) or die(mysql_error());
$rowdata    =    mysql_num_rows($consultadata);

if($rowdata!=0){
//consultamos si hay data para unico o multiple 

$consulclien=mysql_query("SELECT kardex.* FROM kardex WHERE ( 
                                    kardex.kardex LIKE '%$abre_k%' OR  
                                    kardex.kardex LIKE '%$abre_nc%' OR 
                                    kardex.kardex LIKE '%$abre_ac%' OR 
                                    kardex.kardex LIKE '%$abre_ga%' OR 
                                    kardex.kardex LIKE '%$abre_te%' OR
                                    kardex.kardex LIKE '%$abre_bcp%' OR 
                                    kardex.kardex LIKE '%$abre_scb%' OR 
                                    kardex.kardex LIKE '%$abre_cnt%' OR 
                                    kardex.kardex LIKE '%$abre_inb%' OR 
                                    kardex.kardex LIKE '%$abre_otr%' ) LIMIT 1 ", $conn) or die(mysql_error());
$totalFilas2    =    mysql_num_rows($consulclien);

//si hay data es multiple
if($totalFilas2!=0){

//multiple true  / unico false	
if($ini_sisnot=='true'){
	
	$update_ini=mysql_query("UPDATE tb_control SET c_valor='1' WHERE c_c_control ='10001'", $conn) or die(mysql_error());
if($ini_correlativo=='true'){
	$update_correlativo=mysql_query("UPDATE tb_control SET c_valor='1' WHERE c_c_control ='10002'", $conn) or die(mysql_error());
}else{
	$update_correlativo=mysql_query("UPDATE tb_control SET c_valor='0' WHERE c_c_control ='10002'", $conn) or die(mysql_error());
}
if($ini_banco=='true'){
	$update_bancos=mysql_query("UPDATE tb_control SET c_banco='1' WHERE c_c_control ='10001'", $conn) or die(mysql_error());
}else{
	$update_bancos=mysql_query("UPDATE tb_control SET c_banco='0' WHERE c_c_control ='10001'", $conn) or die(mysql_error());
}

echo 'Configuración Grabada.';
	
}else{
	
if($ini_correlativo=='true'){
	$update_correlativo=mysql_query("UPDATE tb_control SET c_valor='1' WHERE c_c_control ='10002'", $conn) or die(mysql_error());
}else{
	$update_correlativo=mysql_query("UPDATE tb_control SET c_valor='0' WHERE c_c_control ='10002'", $conn) or die(mysql_error());
}
if($ini_banco=='true'){
	$update_bancos=mysql_query("UPDATE tb_control SET c_banco='1' WHERE c_c_control ='10001'", $conn) or die(mysql_error());
}else{
	$update_bancos=mysql_query("UPDATE tb_control SET c_banco='0' WHERE c_c_control ='10001'", $conn) or die(mysql_error());
}
	
echo 'La opcion Unico no puede ser activa por que tiene información. Configuración Grabada.';
	
	
}


}else{
	
	

	
if($ini_sisnot=='true'){
	
	if($ini_correlativo=='true'){
	$update_correlativo=mysql_query("UPDATE tb_control SET c_valor='1' WHERE c_c_control ='10002'", $conn) or die(mysql_error());
}else{
	$update_correlativo=mysql_query("UPDATE tb_control SET c_valor='0' WHERE c_c_control ='10002'", $conn) or die(mysql_error());
}
if($ini_banco=='true'){
	$update_bancos=mysql_query("UPDATE tb_control SET c_banco='1' WHERE c_c_control ='10001'", $conn) or die(mysql_error());
}else{
	$update_bancos=mysql_query("UPDATE tb_control SET c_banco='0' WHERE c_c_control ='10001'", $conn) or die(mysql_error());
}
	
echo 'La opcion Multiple no puede ser activa por que tiene información. Configuración Grabada.';

}else{
	
	$update_ini=mysql_query("UPDATE tb_control SET c_valor='0' WHERE c_c_control ='10001'", $conn) or die(mysql_error());
if($ini_correlativo=='true'){
	$update_correlativo=mysql_query("UPDATE tb_control SET c_valor='1' WHERE c_c_control ='10002'", $conn) or die(mysql_error());
}else{
	$update_correlativo=mysql_query("UPDATE tb_control SET c_valor='0' WHERE c_c_control ='10002'", $conn) or die(mysql_error());
}
if($ini_banco=='true'){
	$update_bancos=mysql_query("UPDATE tb_control SET c_banco='1' WHERE c_c_control ='10001'", $conn) or die(mysql_error());
}else{
	$update_bancos=mysql_query("UPDATE tb_control SET c_banco='0' WHERE c_c_control ='10001'", $conn) or die(mysql_error());
}

echo 'Configuración Grabada.';
	
	
	
}
	

	
}

// si no hay data
}else{

  if($ini_sisnot=='true'){
	  $update_ini=mysql_query("UPDATE tb_control SET c_valor='1' WHERE c_c_control ='10001'", $conn) or die(mysql_error());
  }else{
	  $update_ini=mysql_query("UPDATE tb_control SET c_valor='0' WHERE c_c_control ='10001'", $conn) or die(mysql_error());
  }
  
if($ini_correlativo=='true'){
	$update_correlativo=mysql_query("UPDATE tb_control SET c_valor='1' WHERE c_c_control ='10002'", $conn) or die(mysql_error());
}else{
	$update_correlativo=mysql_query("UPDATE tb_control SET c_valor='0' WHERE c_c_control ='10002'", $conn) or die(mysql_error());
}

if($ini_banco=='true'){
	$update_bancos=mysql_query("UPDATE tb_control SET c_banco='1' WHERE c_c_control ='10001'", $conn) or die(mysql_error());
}else{
	$update_bancos=mysql_query("UPDATE tb_control SET c_banco='0' WHERE c_c_control ='10001'", $conn) or die(mysql_error());
}


echo 'Configuración grabada correctamente.';


}	

	
	
?>