<?php 
require_once("../../includes/combo.php")    ; 
$id_viaje = $_REQUEST["id_viaje"];

$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT UPPER(c_descontrat) AS 'des', c_codcontrat AS 'id'  FROM viaje_contratantes WHERE c_condicontrat != '010' AND id_viaje = '$id_viaje' "; 
			//echo $oCombo->dataSource;
			$oCombo->value      = "id";
			$oCombo->text       = "des";
			$oCombo->size       = "150"; 
			$oCombo->name       = "codi_testigo";
			$oCombo->style      = "css"; 
			$oCombo->click      = "//evallenght();";   
			//$oCombo->selected   =  $id;
			$oCombo->Show();
			$oCombo->oDesCon(); 
?>