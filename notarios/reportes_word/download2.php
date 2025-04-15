<?php
include_once('../extraprotocolares/Config/Configuracion.php');

$ruta_archivos   = new AsignaPath;
$path_exit       = $ruta_archivos->__set_path_exit();
 
if (!isset($_GET['file']) || empty($_GET['file'])) {
 exit();
}
$root = $path_exit;
$file = $_GET['file'];


$fichero = $file;
if (fopen($fichero,r)) {
            echo ("El fichero se ha abierto con exito.");
} else {
            echo ("Error, no se a podido abrir el fichero");
}

?>