<?php
require_once 'Cpu/ROClass.php';
$initialDate = $_POST["initialDate"];
$finalDate = $_POST["finalDate"];
$objRoClass = new RoClass($initialDate,$finalDate);
$objRoClass->loadData();
$objRoClass->generateData();

$listErros = $objRoClass->getListErrors();
$countErrors =  $objRoClass->getCountErrors();
$totalKardex = $objRoClass->getTotalKardex();

$listErrors = array();
foreach ($listErros as $key => $row) {
	$rowError = array();
	foreach ($listErros[$key] as $objItemRo) {
		$rowError['idKardex'] =  $objItemRo->getIdKardex();
		$rowError['kardex'] =  $objItemRo->getKardex();
		$rowError['act'] =  $objItemRo->getAct();
		$rowError['codeElement'] =  $objItemRo->getCodeElement();
		$rowError['descriptionElement'] = $objItemRo->getDescriptionElement();
		$rowError['detailsError'] = $objItemRo->getDetailsError();
		$rowError['rowType'] = $objItemRo->getRowType();
		$rowError['statusError'] = $objItemRo->getStatusError();
		$listErrors[] = $rowError;
	}
	
}
echo json_encode(array('list'=>$listErrors,'totalError'=>$countErrors,'totalKardex'=>$totalKardex));