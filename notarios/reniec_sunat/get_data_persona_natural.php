<?php

$document = $_GET['dni'];
$codeCaptcha = strtoupper($_GET['imgCaptcha']);
include_once '../Cpu/Person.php';
$objPerson = new Person(1,false);
$objPerson->setDocument($document);
$objPerson->setCodeCaptcha($codeCaptcha);
$objPerson->setFileCookie('cookie.txt');
$objPerson->runQuery();

$objResponse = new stdClass();
$objResponse->fullName = $objPerson->getFullNames();
$objResponse->name1 = $objPerson->getName1();
$objResponse->name2 = $objPerson->getName2();
$objResponse->name3 = $objPerson->getName3();
$objResponse->surname1 = $objPerson->getSurname1();
$objResponse->surname2 = $objPerson->getSurname2();

$objResponse->messageDescription =  $objPerson->getMessageReponseContent();
$objResponse->error = $objPerson->getErrorResponseContent();

echo json_encode($objResponse);

