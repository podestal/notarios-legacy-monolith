<?php
$config['hostDataBase'] = 'localhost';
$config['userDataBase'] = 'root';
$config['passwordDataBase'] = '12345';
$config['nameDataBase'] = 'notarios';

//phpinfo();

$objPDO = new PDO('mysql:host='.$config['hostDataBase'].';dbname='.$config['nameDataBase'], $config['userDataBase'], $config['passwordDataBase']) or die('Error al conectarse al servidor') or die('Error al conectarse al servidor');