<?php
    $idContratante	= $_REQUEST["idContratante"];
    $directorio	= $_REQUEST["directorio"];
    $url="C:/Proyectos/DDJJ/".$directorio."/";
    $nom  = "__DECLARACION_JURADA_".$directorio."__".$idContratante;
    $rutageneral = $url;

    $ruta = $rutageneral;	
    $archivo = $nom.".docx";
    $root = $ruta;
    $file = basename($archivo);
    $path = $root.$file;
    $type = '';
    // print_r($path);return false;
    if (is_file($path)){
        $size = filesize($path);
        if (function_exists('mime_content_type')){
            $type = mime_content_type($path);
        }else if (function_exists('finfo_file')){
            $info = finfo_open(FILEINFO_MIME);
            $type = finfo_file($info, $path);
            finfo_close($info);
        }
        if ($type == ''){
            //$type = "application/octet-stream"; #
            $type = "application/force-download";
        }
        ############################################################################
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$file);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . $size);
        ob_clean();
        flush();
        readfile($path);
        exit;
        ############################################################################
    }
    else
    {
        die("El archivo no se encuentra...!");
    }
?>