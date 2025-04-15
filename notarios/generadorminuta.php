<?php
//DECLARAMOS LA CONEXION
include("conexion.php");
$nom=$_REQUEST["kardex"];
//CONSUTA PARA EL SERVIDOR
$sql="select so,nombre from servidor where idservidor='1'";
$rpta=mysql_query($sql,$conn) or die(mysql_error());
$row=mysql_fetch_array($rpta);

/*
$sql_ruta="select ruta_generar from rutaplantillas where id='22'";
$rpta_ruta=mysql_query($sql_ruta,$conn) or die(mysql_error());
$row_ruta=mysql_fetch_array($rpta_ruta);
*/


//ASIGNAMOS SU EXTENSION SEGUN LA HAYAMOS CONFIGURADO
$archivo = "__MIN__".$nom.".".$_REQUEST["ext"]; 
$path="";
//COMPROBAMOS EL SISTEMA OPERATIVO, PARA PODER JALAR POR IP
if($row["so"]=="WINDOWS"){
	//$path="\\"."\\".$row["nombre"];
	    $path="C:/Minutas/";

}else if($row["so"]=="LINUX"){
	$path=$row["nombre"]."/notarysoft/";
} 
//DECLARAMOS EL TYPE
$type = '';
//BASENAMOS DE ARCHIVO IMPORTANTE SINO SE NOS DESCARARA EL FICHERO COMO .PHP Y NO .***
$file = basename($archivo);
$path.=$row_ruta["ruta_generar"].$file;
$path=$path;


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

}
else
{
	die("El archivo no se encuentra...!".$path);
}

?>