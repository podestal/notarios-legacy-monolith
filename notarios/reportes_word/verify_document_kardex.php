<?php
include_once '../Cpu/TemplateClass.php';


$kardex = $_POST["kardex"];
$typeDocument = (int)$_POST['typeDocument'];
$pkTemplate = (int)$_POST['pkTemplate'];
$pkTypeAct = (int)$_POST['pkTypeAct'];

$rootPath = 'C:/Doc_Generados/kardex/';
$arrPathTypeDocument = array(1=>'documentos/',2=>'parte_notarial/',3=>'testimonio/');
$pathTypeDocument = $arrPathTypeDocument[$typeDocument];

$objTemplate  = new TemplateClass($pkTemplate,$pkTypeAct);
$fileType = $objTemplate->getFileType();
$documentKardex = $kardex.$fileType;

$arrMessagesDocumentExists = array(1=>'El kardex ya fue generado, ¿Que es lo que desea hacer ?',
	2=>'Parte notarial ya fue generado, ¿Que es lo que desea hacer ?',
	3=>'Testimonio ya fue generado, ¿Que es lo que desea hacer ?');
$arrMessagesNotGenerateDocument = array(2=>'Error,El documento no se a generado aun',3=>'Error,Parte notarial aun no se a generado');

$pathDocument = $rootPath.$pathTypeDocument.$documentKardex;
$objResponse = new stdClass();

/*
if($objTemplate->getError() != 0){
	$objResponse = new stdClass();
	$objResponse->error = 3;
	$objResponse->descriptionError = $objTemplate->getDescriptionError();
	echo json_encode($objResponse);
	exit();
}
*/
if($typeDocument > 1){
	$pathPreviousDocument = $rootPath.$arrPathTypeDocument[$typeDocument-1].$documentKardex;

	if(!file_exists($pathPreviousDocument)){
		$objResponse->error = 2;
		$objResponse->descriptionError = $arrMessagesNotGenerateDocument[$typeDocument];
		echo json_encode($objResponse);
		exit();

	}

}

 if(file_exists($pathDocument)){
	$objResponse->error = 1;
	$objResponse->descriptionError = $arrMessagesDocumentExists[$typeDocument];
	echo json_encode($objResponse);

	
}else{
	$objResponse = new stdClass();
	$objResponse->error = 0;
	$objResponse->descriptionError = 'Documento no ha sido generado';
	echo json_encode($objResponse);
}