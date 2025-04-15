<?php

include_once '../Cpu/Person.php';

$objPerson = new Person(1,true);
$objPerson->setFileCookie('cookie.txt');
$objPerson->setImageName('reniec');
$objPerson->getImageCaptcha();
