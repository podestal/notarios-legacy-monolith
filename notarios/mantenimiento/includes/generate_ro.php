<?php
require_once '../../Cpu/ROClass.php';
$initialDate = $_GET["initialDate"];
$finalDate = $_GET["finalDate"];
$objRoClass = new RoClass($initialDate,$finalDate);
$objRoClass->generateData();
$objRoClass->generateFileRo();


