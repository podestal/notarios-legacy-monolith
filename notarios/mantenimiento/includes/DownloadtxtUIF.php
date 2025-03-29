<?php

$nom        = $_GET["nom"];

#Se escoge el disco
$disk = "C:/";
#Se escoge la carpeta base
$mainfile = "RO/";

$rutageneral = $disk.$mainfile;

	
$ruta = $rutageneral;	
$archivo = $nom;//.".txt"; 

/**************************************** GUARDAR COMO 	*********************************************************************************/

$root = $ruta;
$file = basename($archivo);
$path = $root.$file;
$type = '';
 
if (is_file($path))
{
	 $size = filesize($path);
	 if (function_exists('mime_content_type')) 
	 {
		$type = mime_content_type($path);
	 }
	 else if (function_exists('finfo_file')) 
	 {
		$info = finfo_open(FILEINFO_MIME);
		$type = finfo_file($info, $path);
		finfo_close($info);
	 }
	 
	 if ($type == '')
	 {
		$type = "application/force-download";
	 }
	 // Definir headers
	 header("Content-Type: $type");
	 header("Content-Disposition: attachment; filename=$file");
	 header("Content-Transfer-Encoding: binary");
	 header("Content-Length: " . $size);
	 // Descargar archivo
	 readfile($path);
}
else
{
	die("El archivo no se ha generado Correctamente..!!");
}

?>