<?php
	
//$ruta    = "C:/Doc_Generados/poderes/";	
//$archivo = "Carta202.odt"; 
#####################
$num_protesto        = $_REQUEST["num_protesto"];
$usuario_imprime  = $_REQUEST["usuario_imprime"];
$nom_notario      = $_REQUEST["nom_notario"];
$anio        = $_REQUEST["anio"];

//Carta000024-2013.odt
$nom  = "Protesto_aval".$num_protesto;
//echo $nom; exit();
# disco
$disk = "C:/";
# carpeta base
$mainfile = "Doc_Generados/protestos/";

$rutageneral = $disk.$mainfile;
	
$ruta = $rutageneral;	
$archivo = $nom.".odt"; 

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
		//$type = "application/octet-stream"; #
		$type = "application/force-download";
	 }
	 // Definir headers
	 // header('Content-Description: File Transfer'); #
	/* header("Content-Type: $type");
	 header("Content-Disposition: attachment; filename=$file");
	 header("Content-Transfer-Encoding: binary");
	 // header('Expires: 0'); #
	 // header('Cache-Control: must-revalidate'); #
	 // header('Pragma: public'); # 
	 header("Content-Length: " . $size);
	 // Descargar archivo
	  ob_clean();
    flush();
	 readfile($path);
	 */
	 
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