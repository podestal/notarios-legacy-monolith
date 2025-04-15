<?php

    $kardex = $_GET['kardex'];
    $anio = $_GET['anio'];
    $directorio = $_GET['directorio'];

    $url = 'C://Proyectos/'.$directorio.'/'.$anio.'/__PROY__'.$kardex.'.docx';
    // $word_replace = str_replace('N:','D:',$url);
    // $mi_word = $word_replace;
    
    header("Content-Disposition: attachment; filename=__PROY__".$kardex.".docx");   
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Description: File Transfer");            
    header("Content-Length: " . filesize($url));
    flush(); // this doesn't really matter.

    $fp = fopen($url, "r+");
    while (!feof($fp))
    {
        echo fread($fp, 65536);
        // flush(); // this is essential for large downloads
    } 
    fclose($fp);
    


?>