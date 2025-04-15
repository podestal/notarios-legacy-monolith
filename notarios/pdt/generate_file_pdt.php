<?php

include_once '../Cpu/PDTClass.php';
define(ACT,'1');
define(BIE,'2');
define(OTG,'3');
define(MPA,'4');
define(FORM,'5');
define(LIB,'6');
$initialDate = $_GET["initialDate"];
$finaleDate = $_GET["finalDate"];
$numberFile = (int)$_GET["numberFile"];
$objPdt = new PDTClass();
$objPdt->setInitialDate($initialDate);
$objPdt->setFinalDate($finaleDate);


switch ($numberFile) {
	case ACT:
		# code...
		$typeKardex = (int)$_GET["typeKardex"];
		$objPdt->setFkTypeKardex($typeKardex);
		$objPdt->initialData();
		$objPdt->loadDataAct();
		$objPdt->generateFileAct();
		break;
	case BIE:
		$typeKardex = (int)$_GET["typeKardex"];
		$objPdt->setFkTypeKardex($typeKardex);
		$objPdt->initialData();
		$objPdt->loadDataAct();
		$objPdt->loadDataBien();
		$objPdt->generateFileBien();
		break;
	case OTG:
		$typeKardex = (int)$_GET["typeKardex"];
		$objPdt->setFkTypeKardex($typeKardex);
		$objPdt->initialData();
		$objPdt->loadDataAct();
		$objPdt->loadDataBien();
		$objPdt->loadDataOtorgante();
		$objPdt->generateFileOtorgante();
		break;
	case MPA:
		$typeKardex = (int)$_GET["typeKardex"];
		$objPdt->setFkTypeKardex($typeKardex);
		$objPdt->initialData();
		$objPdt->loadDataAct();
		$objPdt->loadDataBien();
		$objPdt->loadDataOtorgante();
		$objPdt->loadDataMedioPago();
		$objPdt->generateFileMedio();
		break;	
	case FORM:
		$typeKardex = (int)$_GET["typeKardex"];
		$objPdt->setFkTypeKardex($typeKardex);
		$objPdt->initialData();
		$objPdt->loadDataAct();
		$objPdt->loadDataBien();
		$objPdt->loadDataOtorgante();
		$objPdt->loadDataMedioPago();
		$objPdt->loadDataFormulario();
		$objPdt->generateFileForm();
		break;	
	case LIB:
		$objPdt->loadDataLibro();
		$objPdt->generateFileLibro();
		break;	

	default:
		# code...
		break;
}