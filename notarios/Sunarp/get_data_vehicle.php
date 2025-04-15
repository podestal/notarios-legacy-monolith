<?php
$licensePlate = $_POST['placa'];
include_once '../Cpu/VehicleClass.php';
$objVehicle = new VehicleClass($licensePlate);
$objVehicle->setFileCookie('cookie2.txt');
$objVehicle->runQuery();
$objResponse = new stdClass();
$objResponse->licensePlate = $objVehicle->getLicensePlate();
$objResponse->serialNumber = $objVehicle->getSerialNumber();
$objResponse->engineNumber = $objVehicle->getEngineNumber();
$objResponse->color = $objVehicle->getColor();
$objResponse->mark = $objVehicle->getMark();
$objResponse->model = $objVehicle->getModel();
$objResponse->messageDescription =  $objVehicle->getMessageReponseContent();
$objResponse->error = $objVehicle->getErrorResponseContent();
echo json_encode($objResponse);