<?php
include_once '../Cpu/PDTClass.php';
define(PROTOCOLARES, '1');
define(EXTRAPROTOCOLARES, '2');

$initialDate = $_POST["initialDate"];
$finalDate = $_POST["finalDate"];
$typeKardex = (int)$_POST["typeKardex"];
$isProtocalar = $typeKardex == 0?2:1;

$objPdt = new PDTClass();
$objPdt->setInitialDate($initialDate);
$objPdt->setFinalDate($finalDate);
$totalRecords = 0;
switch ($isProtocalar) {
	case PROTOCOLARES:
		# code...
		$objPdt->setFkTypeKardex($typeKardex);
		$objPdt->initialData();
		$objPdt->loadDataAct();
		$objPdt->loadDataBien();
		$objPdt->loadDataOtorgante();
		$objPdt->loadDataMedioPago();
		$objPdt->loadDataFormulario();
		$arrErrors = $objPdt->getRowActiFile();
		$countErrors = $objPdt->getCountErrors();
		$totalRecords = $objPdt->getTotalKardex();
		$listErrors = array();
		foreach ($arrErrors as $key => $row) {
			$rowError = array();
			foreach ($arrErrors[$key] as $objItemRo) {
				
				$rowError['idKardex'] =  $objItemRo->getIdKardex();
				$rowError['kardex'] =  $objItemRo->getKardex();
				$rowError['act'] =  $objItemRo->getAct();
				$rowError['errorItem'] =  $objItemRo->getErrorItem();
				$rowError['fileType'] = $objItemRo->getFileType();
				$rowError['typeAct'] = $objItemRo->getTypeAct();
				$rowError['itemMp'] = $objItemRo->getItemMp();
				$rowError['typeOfCorrection'] = $objItemRo->getTypeOfCorrection();
				$rowError['categoryCorrect'] = $objItemRo->getCategoryCorrect();
				$rowError['writingDate'] = $objItemRo->getWritingDate();
				$rowError['idContractor'] = $objItemRo->getIdContractor();
				$rowError['isCorrectable'] = $objItemRo->isCorrectable();
				$listErrors[] = $rowError;
			}
			
		}
		break;
	case EXTRAPROTOCOLARES:
		$objPdt->loadDataLibro();
		$arrErrors = $objPdt->getErrorsLib();
		$countErrors = $objPdt->getCountErrors();
		$totalRecords = $objPdt->getTotalLibro();
		$listErrors = array();
		foreach ($arrErrors as $key => $row) {
			$rowError = array();
			foreach ($arrErrors[$key] as $objItemRo) {
				
				$rowError['idKardex'] =  $objItemRo->getIdKardex();
				$rowError['bookNumber'] =  $objItemRo->getBookNumber();
				$rowError['act'] =  $objItemRo->getAct();
				$rowError['errorItem'] =  $objItemRo->getErrorItem();
				$rowError['fileType'] = $objItemRo->getFileType();
				$rowError['typeAct'] = $objItemRo->getTypeAct();
				$rowError['itemMp'] = $objItemRo->getItemMp();
				$rowError['typeOfCorrection'] = $objItemRo->getTypeOfCorrection();
				$rowError['categoryCorrect'] = $objItemRo->getCategoryCorrect();
				$rowError['writingDate'] = $objItemRo->getWritingDate();
				$rowError['idContractor'] = $objItemRo->getIdContractor();
				$rowError['isCorrectable'] = $objItemRo->isCorrectable();
				$listErrors[] = $rowError;
			}
			
		}
		break;
	default:
		# code...
		break;
}
echo json_encode(array('list'=>$listErrors,'totalError'=>$countErrors,'totalRecords'=>$totalRecords));