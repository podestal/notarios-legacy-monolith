<?php

$kardex = $_GET["kardex"];
$directorio = $_GET["directorio"];
$anio = $_GET["anio"];

$uri= 'D:/escaneos/'.$anio.'/'.$directorio.'/';
//print_r($directorio.$kardex.'.pdf');return false;

$mi_pdf = $uri.$kardex.'.pdf';
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="'.$mi_pdf.'"');
readfile($mi_pdf);


/*header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=".$kardex.".pdf");   
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Description: File Transfer");            
header("Content-Length: " . filesize($directorio.$kardex.'.pdf'));
flush(); // this doesn't really matter.

$fp = fopen($directorio.$kardex.'.pdf', "r+");
while (!feof($fp))
{
    echo fread($fp, 65536);
    // flush(); // this is essential for large downloads
} 
fclose($fp);*/
?>