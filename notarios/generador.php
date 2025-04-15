<?php
//DECLARAMOS LA CONEXION
include("conexion.php");
$usuario_imprime	= $_REQUEST["usuario_imprime"];
$nom_notario    	= $_REQUEST["nom_notario"];
$tipo				= $_REQUEST["tipo"];
$tipo2				= "";

if(isset($_REQUEST["tipo2"]))
	$tipo2=$_REQUEST["tipo2"];
//CONSULTA PARA EXTRAER LA EXTENSION ODT O DOCX QUE VAMOS A GENERAR
$sql_plantilla="SELECT * FROM confiplantillas where id='1'"; 
$rpta_plantillas=mysql_query($sql_plantilla,$conn) or die(mysql_error());
$row_plantillas = mysql_fetch_array($rpta_plantillas);
//CONSUTA PARA EL SERVIDOR
$sql="select * from servidor where idservidor='1'";
$rpta=mysql_query($sql,$conn) or die(mysql_error());
$row=mysql_fetch_array($rpta);
//CONSULTA DEL REGISTRO  SEGUN MODULO:
/*
.1 - CERTIFICACION DE LIBROS
.2 - CARTAS NOTARIALES
.3 - PERMISOS DE VIAJE
.4 - PODERES FUERA DE REGISTRO
.5 - CERTIF. SUPERVIVENCIA PERSONA
.6 - CERTIFICADO DOMICILIARIO
.7 - CAMBIO CARACTERISTICAS
.8 - PROTESTOS
.
.15 - KARDEX GENERAL
.16 - ESCRITURAS PUBLICAS
.17 - ASUNTOS NO CONTENCIOSOS
.18 - ACTAS VEHICULARES
.19 - GARANTIAS MOBILIARIAS
.20 - TESTAMENTOS
.21 - CERTIFICACIONES DE FIRMAS
........
*/

if($tipo==1){
	$sql_plantillaxx="SELECT ano FROM libros where numlibro='".$_REQUEST["numcarta"]."'"; 
	$rpta_plantillasxx=mysql_query($sql_plantillaxx,$conn) or die(mysql_error());
	$row_plantillasxx = mysql_fetch_array($rpta_plantillasxx);
	//DECLARACION DE VARIABLES 2
	$num_carta        = str_replace("CL","",$_REQUEST["numcarta"]);
	//CREAMOS EL NOMBRE DEL ARCHIVO DIGITAL
	
	
	if($tipo2==30){
		$nom  = "XXLi".$num_carta;
	}else{
		$nom  = "Libr".$row_plantillasxx[0].$num_carta;
	}
	
}else if($tipo==2){
	//DECLARACION DE VARIABLES 2
	$num_crono       = str_replace("-","",str_replace("CN","",$_REQUEST["numcarta"]));
	$num_crono_final=substr($num_crono,6,4).substr($num_crono,0,6);
	//CREAMOS EL NOMBRE DEL ARCHIVO DIGITAL
	
	print_r($_REQUEST);
	if($tipo2==28){
		$nom  = "XXCa".$num_crono;
	}else{
		$nom  = "Cart".$num_crono_final;
	}
	
	
}else if($tipo==3){
	//DECLARACION DE VARIABLES 2
	$sqla=mysql_query("select num_kardex from permi_viaje where id_viaje='".$_REQUEST["id_viaje"]."'",$conn);
	$rowa=mysql_fetch_array($sqla);	
	$num_crono  = str_replace("PV","",$rowa[0]);
		
	if($tipo2==26){
		$nom  		= "XVViaj".str_pad($_REQUEST["id_viaje"], 8, "0", STR_PAD_LEFT);
	}else{
		$nom  		= "Viaj".$num_crono;	
	}
	
}else if($tipo==4){
	//DECLARACION DE VARIABLES 2
	$sql2="select * from ingreso_poderes where id_poder='".$_REQUEST["id_poder"]."'";
	$rpta2=mysql_query($sql2,$conn) or die(mysql_error());
	$row2=mysql_fetch_array($rpta2);
	$row2['num_kardex'];
	
	if($tipo2==27){
		$nom  		= "XPPode".str_pad($_REQUEST["id_poder"], 8, "0", STR_PAD_LEFT);
	}else{
		$nom  		= "Pode".str_replace("P","",$row2['num_kardex']);	
	}
	
	//$nom  = "Pode".str_replace("P","",$row2['num_kardex']);
	
}else if($tipo==5){
	//DECLARACION DE VARIABLES 2
	$nom  = "Pers".str_replace("PI","",str_replace("PC","",$_REQUEST["num_crono"]));	
}else if($tipo==6){
	//DECLARACION DE VARIABLES 2
	$nom  = "Domi".str_replace("CD","",$_REQUEST["num_crono"]);
}else if($tipo==7){
	//DECLARACION DE VARIABLES 2
	//$nom  = "Cara".str_replace("-","",str_replace("CC","",substr($_REQUEST["num_crono"],6,4).substr($_REQUEST["num_crono"],0,6)));
	$nom=substr($_REQUEST["num_crono"],7,4);
	$nom.=substr($_REQUEST["num_crono"],0,6);
	$nom="Cara".$nom;
}else if($tipo==8){
	//DECLARACION DE VARIABLES 2
	
	$tipo_protesto	= $_REQUEST["tipoprotesto"];
	$num_protesto   = $_REQUEST["num_protesto"];
	  
	$sqlProtesto="SELECT anio,LPAD(prot_id_anio,6,'0') as prot_id_anio FROM protesto where id_protesto='".$num_protesto."'";
	$queryProtesto=mysql_query($sqlProtesto,$conn);
	$rowProtesto=mysql_fetch_assoc($queryProtesto);
	$num_protesto=$rowProtesto["prot_id_anio"]."-".$rowProtesto["anio"];


	if($tipo_protesto=="aval"){
		$nom  = "Protesto_aval".$num_protesto;
	}else if($tipo_protesto=="deudor"){
		$nom  = "Protesto_deudor".$num_protesto;
	}else if($tipo_protesto=="protesto"){	
		    $num_protesto   = $_REQUEST["num_protesto"];
			$nom  = "Protesto".substr($num_protesto,5,6)."-".substr($num_protesto,0,4);
	
	}else{
		die("Error al generar..!".$path);	
	}
	

}else if($tipo==15){
	### KARDEX ####
	$tipo = 15;
	$nom="__".$_REQUEST["numcarta"];
	
}else if($tipo==23){
	### KARDEX ####
	$tipo = 23;
	$nom="/BORRADOR/__PROY__".$_REQUEST["numcarta"];
	
}else if($tipo==21){
	//DECLARACION DE VARIABLES 2
	$nom  = "Firm".str_replace("CF","",$_REQUEST["numcarta"]);
	
}

//RUTA PARA LIBROS ES 1

if($tipo2==26 || $tipo2==27 || $tipo2==28 || $tipo2==30){	
	$sql_ruta="select * from rutaplantillas where id='$tipo2'";	
}else{	
	$sql_ruta="select * from rutaplantillas where id='$tipo'";
}
//echo $sql_ruta."<br>";

$rpta_ruta=mysql_query($sql_ruta,$conn) or die(mysql_error());
$row_ruta=mysql_fetch_array($rpta_ruta);
//DECLARACION DE VARIABLES
$server = $row['nombre'];
$SO = $row['so'];
$path="";

//CAMBIAMOS LA EXTENSION DEPENDIENO DE QUE XUXA SEA
if($tipo==15 || $tipo==23){
	$extensionfinal=$row_plantillas['extension_proto']; 
}else{
	// antes $row_plantillas['extension'];  ahora docx
	$extensionfinal="docx";
}
//ASIGNAMOS SU EXTENSION SEGUN LA HAYAMOS CONFIGURADO
//se cambio la extension a docx
$archivo = $nom.".docx"; 
//COMPROBAMOS EL SISTEMA OPERATIVO, PARA PODER JALAR POR IP
if($row["so"]=="WINDOWS"){
	//$path="\\"."\\".$server;
	$path=$server;
}else if($row["so"]=="LINUX"){
	$path="";
} 
//DECLARAMOS EL TYPE
$type = '';
//BASENAMOS DE ARCHIVO IMPORTANTE SINO SE NOS DESCARARA EL FICHERO COMO .PHP Y NO .***
$file = basename($archivo);

$path.=$row_ruta["ruta_generar"].$file;
$path=$path;


if (is_file($path))
{
	 chmod($path, 0777);
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
	echo $path;
	
}
else
{
	//echo "<script>alert('El archivo **".$path."** no existe.');window.close();</script>";
}
echo "<script>window.close();</script>";
?>