<?php 
require_once("../includes/combo.php")    ; 
$id = $_POST["id"];	 		
			$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT tiposdeacto.idtipoacto AS 'id', tiposdeacto.desacto AS 'des' FROM tiposdeacto WHERE idtipkar='".$id."'"; 
			//echo $oCombo->dataSource;
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "250"; 
			$oCombo->name       = "idtipoacto";
			$oCombo->style      = "camposss"; 
			$oCombo->click      = "//funcionprueba()";   
			$oCombo->selected   =  $variable;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>