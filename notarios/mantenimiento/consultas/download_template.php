<?php
include_once 'TplTemplate.php';
$pkTemplate = $_GET['pkTemplate'];

$objTemplate = new TplTemplate();
$objTemplate->setPkTemplate($pkTemplate);
$data = $objTemplate->getTemplateByPk();

$fileName = $data[0]['fileName'];
$fileUrl = $data[0]['urlTemplate'].$fileName;

$objFile = new Cpu_File();
$objFile->downloadFile($fileUrl);





