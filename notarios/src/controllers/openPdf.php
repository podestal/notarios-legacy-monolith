<?php
    $kardex = $_GET["kardex"];
    $anio = $_GET["anio"];
    $directorio = $_GET["directorio"];
    $ruta= "D:/escaneos/".$anio."/".$directorio.'/';
    $mi_pdf = $ruta.$kardex.'.pdf';
    // print_r($mi_pdf);return false;

    header('Content-type: application/pdf');
    header('Content-Disposition: attachment; filename="'.$mi_pdf.'"');
    readfile($mi_pdf);
?>