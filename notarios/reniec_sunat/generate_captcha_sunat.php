<?php

include_once '../Cpu/Person.php';
$objPerson = new Person(2,true);
$objPerson->setFileCookie('cookie1.txt');
$objPerson->setImageName('sunat');
$objPerson->getImageCaptcha();
