<?php
include_once('../extraprotocolares/Config/Configuracion.php');

$ruta_archivos   = new AsignaPath;
$path_exit       = $ruta_archivos->__set_path_exit();
 
if (!isset($_GET['file']) || empty($_GET['file'])) {
 exit();
}
$root = $path_exit;
$file = $_GET['file'];
$path = $file;
$type = '';
// echo $path ;exit();
if (is_file($path)) {
 $size = filesize($path);
 if (function_exists('mime_content_type')) {
 $type = mime_content_type($path);
 } else if (function_exists('finfo_file')) {
 $info = finfo_open(FILEINFO_MIME);
 $type = finfo_file($info, $path);
 finfo_close($info);
 }
 if ($type == '') {
 $type = "application/force-download";
 }
 // Definir headers
 header("Content-Type: $type");
 header("Content-Disposition: attachment; filename=$file");
 header("Content-Transfer-Encoding: binary");
 header("Content-Length: " . $size);
 // Descargar archivo
 readfile($path);
} else {
 die("El archivo no existe.");
}
 
?>