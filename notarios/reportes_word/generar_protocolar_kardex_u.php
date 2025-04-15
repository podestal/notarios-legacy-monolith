<?php

include_once '../Cpu/TemplateClass.php';
$kardex = $_REQUEST["num_kardex"];
$pkTypeAct = $_REQUEST['idtipoacto'];
$pkTemplate = $_REQUEST['pkTemplate'];
$download = (int)$_REQUEST['donwload'];
$typeDocument = (int)$_REQUEST['typeDocument'];


$pathDocument = 'C:/Doc_Generados/kardex/';
$objTemplate  = new TemplateClass($pkTemplate,$pkTypeAct);
$fileType = $objTemplate->getFileType();
$documentKardex = $kardex.$fileType;
$partNotarial = 'PARTE_NOTARIAL'.$fileType;
$testimony = 'TESTIMONIO'.$fileType;


$arrPathTypeDocument = array(1=>'documentos/',2=>'parte_notarial/',3=>'testimonio/');
$arrFolderTemplate = array(1=>'protocolares/',2=>'parte_notarial/',3=>'testimonio/');
$arrTemplateTypeDocument = array(2=>$partNotarial,
	3=>$testimony);

$pathTypeDocument = $arrPathTypeDocument[$typeDocument];
$folderTemplate = $arrFolderTemplate[$typeDocument];

$template = $arrTemplateTypeDocument[$typeDocument];
$tipDocumentAndKardex = $typeDocument.'#'.$kardex;

$pathDocument = $pathDocument.$pathTypeDocument.$documentKardex;





if(file_exists($pathDocument) && $download == 1 ){

	header ("Content-Disposition: attachment; filename=".$documentKardex." "); 
	header ("Content-Type: application/octet-stream");
	header ("Content-Length: ".filesize($pathDocument ));
	readfile($pathDocument);
	exit();
}





$arrVars = array('documento_kardex'=>$tipDocumentAndKardex);
$objTemplate->setKardex($kardex);
$objTemplate->setFolderTemplate($folderTemplate);
$objTemplate->setFileName($kardex);

$objTemplate->setVars($arrVars);

$objTemplate->setTypeDocument($typeDocument);

if($typeDocument != 1){
	$objTemplate->setTemplateName($template);		
}



if($objTemplate->getError() != 0){
	die($objTemplate->getDescriptionError());
	exit();
}

$objTemplate->run();


