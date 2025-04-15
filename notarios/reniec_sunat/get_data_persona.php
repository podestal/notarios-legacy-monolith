<?php

include_once '../Cpu/Person.php';

$document = $_POST['document'];
$codeCaptcha = strtoupper($_POST['codeCaptcha']);
$documentType = (int)$_POST['typeDocument'];
$documentType = $documentType == 1?1:2;

$objPerson = new Person($documentType,false);
$objPerson->setDocument($document);
$objPerson->setCodeCaptcha($codeCaptcha);
$objResponse = new stdClass();
$objResponse->documentType = $documentType;
switch ($documentType) {
	case 1:
		# code...
		
		$objPerson->setFileCookie('cookie.txt');
		$objPerson->runQuery();
		$objResponse->fullNames = $objPerson->getFullNames();
		$objResponse->name1 = $objPerson->getName1();
		$objResponse->name2 = $objPerson->getName2();
		$objResponse->name3 = $objPerson->getName3();
		$objResponse->surname1 = $objPerson->getSurname1();
		$objResponse->surname2 = $objPerson->getSurname2();

		$objResponse->descriptionError =  $objPerson->getMessageReponseContent();
		$objResponse->error = $objPerson->getErrorResponseContent();


		echo  json_encode($objResponse);
		break;
	case 2:
		$objPerson->setFileCookie('cookie1.txt');
		$objPerson->runQuery();
		$objResponse->businessName = $objPerson->getBusinessName();
		$objResponse->address = $objPerson->getAddress();
		$objResponse->error = $objPerson->getErrorResponseContent();
		$objResponse->descriptionError =  $objPerson->getMessageReponseContent();
		echo  json_encode($objResponse);
		break;
	default:
		# code...
		break;
}





