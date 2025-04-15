<?php 
require_once("../../includes/combo.php")    ; 
$idpoder = $_POST["idpoder"];
$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT num_item AS 'id', des_item AS 'des' FROM d_tablas WHERE tip_item = 'poder'"; 
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "100"; 
			$oCombo->name       = "codi_tiptestigo";
			$oCombo->style      = "css"; 
			$oCombo->click      = "//evallenght();";   
			$oCombo->selected   =  $id;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>