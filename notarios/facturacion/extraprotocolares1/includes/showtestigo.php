<?php 
require_once("../../includes/combo.php")    ; 
$idpoder = $_REQUEST["idpoder"];

$oCombo = new CmbList()  ;					 		
			$oCombo->dataSource = "SELECT UPPER(c_descontrat) AS 'des', c_codcontrat AS 'id' FROM poderes_contratantes WHERE c_condicontrat !='008' AND id_poder = '$idpoder' "; 
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