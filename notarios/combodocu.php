<?php 
require_once("mantenimiento/includes/combo.php")    ; 
$id = $_POST["id"];
$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tipodocumento.idtipdoc AS 'value', tipodocumento.destipdoc AS 'nombre' FROM tipodocumento WHERE idtipdoc='8' OR  idtipdoc='10' "; 
			$oCombo->value      = "value";
			$oCombo->text       = "nombre";
			$oCombo->size       = "150"; 
			$oCombo->name       = "tipodoc";
			$oCombo->style      = "css"; 
			$oCombo->click      = "evallenght();";   
			$oCombo->selected   =  $id;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>