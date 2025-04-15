<?php

// Carga las librerias:
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../extraprotocolares/Config/Configuracion.php');
include_once('../ClaseLetras.class.php');

## notario :
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO' FROM confinotario";
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$muesnotario = $rownum[0];
##

###########################################
##  SE DEFINE PATH PARA TEMPLATES Y SALIDAS
# 1 Se crea Objetos
$ruta_templates  = new AsignaPath;	
$ruta_archivos   = new AsignaPath;
# 2. Templates
$path_template   = $ruta_templates->__set_path_template();
# 3. Salida de Data
$path_exit       = $ruta_archivos->__set_path_exit('protestos');

$extension       = $ruta_archivos->__set_tip_output_ep();
###########################################

//se crea el objeto  ClaseLetras
	$fecha = new ClaseNumeroLetra();
	
	$dia  = $fecha->fun_fecha_dia(); 
	$mes  = $fecha->fun_fecha_mes();
	$anio = $fecha->fun_fecha_anio();
	$fec_letras = $fecha->fun_fech_comple(date("Y/m/d"));

//Se crea el objeto TBS
	$TBS = new clsTinyButStrong; 
// Se cargan las propiedades del PLUGIN
	$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

	$suffix = '';
	$debug  = '';

// Se verifica que formato de plantilla se usara.
	$template = $path_template."plantilla_protesto".$extension;
	
	//echo $template; exit;
	//$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");

	$id_prote        = $_REQUEST["id_prote"];        //Num. Cronologico a exportar.
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.
	$nombre_notario   = strtoupper(utf8_decode($muesnotario));       //Nombre del notario.
	//$nom_dist     = $_REQUEST["dist_notario"];       //Nombre del Distrito.
	$fecha_impresion  = date("d/m/Y");                 //Fecha de impresion.

//Consulta segun parametro enviado:



$consulcartas = mysql_query('SELECT protesto.id_protesto,protesto.solicitante,protesto.num_protesto,protesto.numero ,
IF(DATE_FORMAT(protesto.fec_ingreso,"%Y-%m-%d")="0000-00-00","",DATE_FORMAT(protesto.fec_ingreso,"%Y/%m/%d")) AS "fec_ingreso2",
IF(DATE_FORMAT(protesto.fec_notificacion,"%Y-%m-%d")="0000-00-00","",DATE_FORMAT(protesto.fec_notificacion,"%Y/%m/%d")) AS "fec_notificacion2",
IF(DATE_FORMAT(protesto.fec_constancia,"%Y-%m-%d")="0000-00-00","",DATE_FORMAT(protesto.fec_constancia,"%Y/%m/%d")) AS "fec_constancia2",
monedas.desmon,protesto.importe, CONCAT(RIGHT(protesto.num_protesto,6),"-", LEFT(protesto.num_protesto,4)) AS "num_protesto",tipo_protesto.des_tipop,
protesto.doc_referencia
FROM protesto
LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda 
INNER JOIN tipo_protesto ON tipo_protesto.cod_tipop = protesto.tipo
WHERE protesto.id_protesto = "'.$id_prote.'" ', $conn) or die(mysql_error());

// CONCAT(RIGHT("'.$num_carta.'",4),"0", LEFT("'.$num_carta.'",5))
	$rowcartas = mysql_fetch_array($consulcartas);

//CONSULTA PARA LOS PARTICIPANTES DE PROTESTO (OBLIGADOS)
$consulparti = mysql_query('SELECT protesto_participantes.tip_condi,protesto_participantes.id_protesto, protesto_participantes.descri_parti
FROM protesto_participantes
INNER JOIN protesto ON protesto.id_protesto = protesto_participantes.id_protesto
WHERE protesto_participantes.tip_condi = "002" AND protesto_participantes.id_protesto  = "'.$id_prote.'" ', $conn) or die(mysql_error());


	$rowparti = mysql_fetch_array($consulparti);

//Definicion de las variables para llenar la plantilla dinamicamente

	$num_notificacion	          = $rowcartas[0];
	

		$num_acta1 = $rowcartas['2'];
		$num_acta = substr($num_acta1,5,6).'-'.substr($num_acta1,0,4);

if($rowcartas['2']  == '')
{
echo "No existe numero de acta...!";
exit();
}else{
	$tipop						  = $rowcartas[10];
	
	if($rowcartas[7] = '')
	{
		$desmon = '';
		
	}else {
		
		$desmon = $rowcartas[7];
		
		}

	if($rowcartas[1] = '')
	{
		$solicitante = '';
		
	}else {
		
		$solicitante = $rowcartas[1];
		
		}
	
	$importe 					  = $rowcartas[8];
	$domicilio					  = $rowcartas[11];
	//$fec_diligencia       = $rowcartas[2];
	$fec_ingreso      			  = $fecha->fun_fech_comple($rowcartas[4]);
	$fec_notificacion      		  = $fecha->fun_fech_comple($rowcartas[5]);
	$fec_constancia      		  = $fecha->fun_fech_comple($rowcartas[6]);
//Defino varialbes de rowparti	

	if($rowparti[2]='')
	{
		$obligado = '';
		
	}else {
		
		$obligado 					  = $rowparti[2];
		
		}


//Carga la plantilla;
	$TBS->LoadTemplate($template);

//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

//Nombre para el archivo a descargar.
	//$file_name = 

    $file_name = $path_exit.'Protesto'.$num_acta.$extension;
	$file_name_show = 'Protesto'.$num_acta.$extension;
	
	//$file_name = str_replace('.','_'.$suffix.'.',$file_name);
	
    $TBS->Show(TBSZIP_FILE, $file_name);
	
	//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
#}
	echo "Se genero el archivo: ".$file_name_show." satisfactoriamente..!!";
	}
//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
?>
