<?php 
require_once("mantenimiento/includes/combo.php")    ; 
$id = $_POST["id"];
$oCombo2 = new CmbList()  ;					 		
			$oCombo2->dataSource = "SELECT tipodocumento.idtipdoc AS 'value', tipodocumento.destipdoc AS 'nombre' FROM tipodocumento WHERE idtipdoc<>'8' and idtipdoc<>'10'"; 
			$oCombo2->value      = "value";
			$oCombo2->text       = "nombre";
			$oCombo2->size       = "150"; 
			$oCombo2->name       = "tipodoc";
			$oCombo2->style      = "css"; 
			$oCombo2->click      = "evallenght();";   
			$oCombo2->selected   =  $id;
			$oCombo2->Show();
			$oCombo2->oDesCon(); 
?>