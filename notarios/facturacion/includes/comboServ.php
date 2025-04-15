<?php 
require("../../conexion.php");
require_once("../../includes/combo.php")  	 ;
$tipdocu = $_REQUEST["tipdocu"];

if($tipdocu=="01" || $tipdocu=="02")
	{
		$tipo="N";	
	}
else if($tipdocu=="03")
	{
		$tipo="C";
	}
else if($tipdocu=="04")
	{
		$tipo="E";
	}
else if($tipdocu=="")
	{
		$tipo="";
	}		

	$oCombo = new CmbList()  ;					 		
	$oCombo->dataSource = "SELECT servicios.descrip AS 'des', servicios.codigo AS 'id' FROM servicios WHERE servicios.tipo = '$tipo' ORDER BY servicios.descrip ASC"; 
	$oCombo->value      = "id";
	$oCombo->text       = "des";
	$oCombo->size       = "280"; 
	$oCombo->name       = "servicio";
	$oCombo->style      = "camposss"; 
	$oCombo->click      = "selectMonto();ChangeFocus();";   
	$oCombo->selected   =  $variable;
	$oCombo->Show();
	$oCombo->oDesCon(); 
?>