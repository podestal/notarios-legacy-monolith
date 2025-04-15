<?php

$kardex = $_GET["kardex"];
$accion = $_GET["accion"];

$nombreKardex = '';
if($accion == 'actualizar'){
    $nombreKardex = $kardex.'-actualizado';
}else{
    $nombreKardex = $kardex;
}

$directorio='';

if (strpos($kardex, 'ACT') !== false) {
    $directorio= 'C://Proyectos/Vehicular/';
}else{
    $directorio= 'C://Proyectos/Escrituras/';
}


header("Content-Disposition: attachment; filename=__PROY__".$nombreKardex.".docx");   
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer");            
header("Content-Length: " . filesize($directorio.'__PROY__'.$nombreKardex.'.docx'));
flush(); // this doesn't really matter.

$fp = fopen($directorio.'__PROY__'.$nombreKardex.'.docx', "r+");
while (!feof($fp))
{
    echo fread($fp, 65536);
    // flush(); // this is essential for large downloads
} 
fclose($fp);
?>