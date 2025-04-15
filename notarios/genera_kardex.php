<?php
	include("conexion.php");
	
$sql="select nombre from servidor where idservidor='1'";
$rpta=mysql_query($sql,$conn) or die(mysql_error());
$row=mysql_fetch_array($rpta);
$server = $row['nombre'];
//$ruta    = "C:/Doc_Generados/poderes/";	
//$archivo = "Carta202.odt"; 
#####################
$num_kardex        = $_REQUEST["numcarta"];
$usuario_imprime  = $_REQUEST["usuario_imprime"];
$nom_notario      = $_REQUEST["nom_notario"];
//$numdocu        = $_REQUEST["numdocu"];

$arrKardex = explode('-',$num_kardex);
$anioKardex = $arrKardex[1];

//Carta000024-2013.odt
$nom  = "__PROY__".$num_kardex;

$sqlx="select idtipkar from kardex where kardex='$num_kardex'";
$rptax=mysql_query($sqlx,$conn) or die(mysql_error());
$roww=mysql_fetch_array($rptax);

$xidTipoKardex=$roww["idtipkar"];

# disco
$disk = "C:";
if($xidTipoKardex==1)
	// $mainfile = $disk."/Proyectos/BORRADOR/";
	$mainfile = $disk."/Proyectos/Escrituras/".$anioKardex."/";
else if($xidTipoKardex==3)
	$mainfile = $disk."/Proyectos/Vehicular/".$anioKardex."/";
else if($xidTipoKardex==2)
	$mainfile = $disk."/Proyectos/NoContenciosos/".$anioKardex."/";
else if($xidTipoKardex==4)
	$mainfile = $disk."/Proyectos/GarantiasMobiliarias/".$anioKardex."/";
else if($xidTipoKardex==5)
	$mainfile = $disk."/Proyectos/Testamentos/".$anioKardex."/";

//$rutageneral = "\\"."\\".$server.$mainfile;
$rutageneral = $mainfile;
	
$ruta = $rutageneral;	
$archivo = $nom.".docx"; 

$root = $ruta;
$file = basename($archivo);
$path = $root.$file;
$type = '';
 ;

if (is_file($path))
{

	echo "ssiii";
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
	header("Content-Type: application/force-download");
	header('Content-Type: application/octet-stream');
	header("Content-Type: application/download");
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
	die("El archivo no se encuentraaaaaa...!");
}

?>