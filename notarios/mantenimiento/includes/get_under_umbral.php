<?php
require_once '../../Cpu/ROClass.php';

$year = $_POST['year'];

/*
$month = $_POST['month'];
$typeChange = $_POST['typeChange'];

$objRoClass = new RoClass($initialDate,$finalDate);
$objRoClass->loadData();
$objRoClass->generateData();
$dataUndeUmbral = $objRoClass->generateDataUmbral($month,$year,$typeChange);
$totalOperations = $objRoClass->getTotalKardexUmbral();
$totalAmountoOperations = $objRoClass->getTotalAmountOperationUmbral();

$objResponse = new stdClass();
$objResponse->totalOperations = $totalOperations;
$objResponse->totalAmountOperations = $totalAmountOperations;
*/
$objRoClass = new RoClass();
$objRoClass->setYear($year);
$objRoClass->loadDataByYear();
$array =  $objRoClass->generateDataByYearUnderUmbral();
echo json_encode(array('data'=>$array));