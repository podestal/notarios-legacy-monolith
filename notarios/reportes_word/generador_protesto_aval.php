<?php

// Carga las librerias:
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../extraprotocolares/Config/Configuracion.php');
include_once('../ClaseLetras.class.php');

## notario :
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO', confinotario.direccion AS 'DIRECCION', confinotario.telefono AS 'telefono',
confinotario.correo AS 'CORREO' FROM confinotario";
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);

#datos del notario:

$nom_notario = $rownum[0];
$direc_notario = $rownum[1];
$telf_notario = $rownum[2];
$correo_notario = $rownum[3];
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
	$template = $path_template."plantilla_protesto_aval".$extension;
	
	//echo $template; exit;
	//$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");

	$id_prote        = $_REQUEST["id_prote"];
	$id_contrata	 = $_REQUEST["id_contrata"]; 
	$anio        = $_REQUEST["anio"];
	       //Num. Cronologico a exportar.
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.
	$nombre_notario   = $muesnotario;       //Nombre del notario.
	//$nom_dist     = $_REQUEST["dist_notario"];       //Nombre del Distrito.
	$fecha_impresion  = date("d/m/Y");                 //Fecha de impresion.


//CONSULTA PARA LOS PARTICIPANTES(DEUDOR)
$consuldeudor = mysql_query('SELECT protesto_participantes.tip_condi,protesto_participantes.descri_parti, protesto_participantes.num_docparti,cliente.direccion,cliente.telfijo,protesto.id_protesto
FROM protesto_participantes
LEFT OUTER JOIN cliente ON cliente.numdoc = protesto_participantes.num_docparti
LEFT OUTER JOIN protesto ON protesto.id_protesto = protesto_participantes.id_protesto
WHERE protesto_participantes.id_participante = "'.$id_contrata.'" AND  protesto_participantes.tip_condi = "003" AND protesto.id_protesto = "'.$id_prote.'" and protesto.anio="'.$anio.'"', $conn) or die(mysql_error());
// CONCAT(RIGHT("'.$num_carta.'",4),"0", LEFT("'.$num_carta.'",5))
	$rowdeudor = mysql_fetch_array($consuldeudor);

//Consulta segun parametro enviado:
$consulprotesto = mysql_query('SELECT protesto.id_protesto,protesto.importe,monedas.simbolo,protesto.solicitante,
IF(DATE_FORMAT(protesto.fec_venc,"%Y-%m-%d")="0000-00-00","",DATE_FORMAT(protesto.fec_venc,"%Y/%m/%d")) AS "fec_venc2",
tipo_protesto.des_tipop, IF(DATE_FORMAT(protesto.fec_giro,"%Y-%m-%d")="0000-00-00","",DATE_FORMAT(protesto.fec_giro,"%Y/%m/%d")) AS "fec_giro2"
FROM protesto
LEFT OUTER JOIN tipo_protesto ON tipo_protesto.cod_tipop = protesto.tipo
LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda
WHERE protesto.id_protesto = "'.$id_prote.'" and protesto.anio="'.$anio.'"', $conn) or die(mysql_error());

// CONCAT(RIGHT("'.$num_carta.'",4),"0", LEFT("'.$num_carta.'",5))
	$rowprotesto = mysql_fetch_array($consulprotesto);


//Definicion de las variables para llenar la plantilla dinamicamente


	$id_protesto	         	  = $rowprotesto[0];
	
	$tipo_protesto =  $rowprotesto['des_tipop'];//$tipo_protestos;
	$moneda=$rowprotesto['simbolo'];//$simbolos;
	$importe=$rowprotesto['importe'];//;$importes;
	$fec_venc = $fecha->fun_fech_comple($rowprotesto[4]);
	$fec_giro = $fecha->fun_fech_comple($rowprotesto[6]);
	$solicitante=$rowprotesto['solicitante'];//$solicitantes;
	
//Definicion variables del deudor

if($rowdeudor[1] == "" )
{
echo "No es el participante (aval)";
exit();	
}

	$paval	         	  	  = $rowdeudor[1];
	$pdni      			 	  = $rowdeudor[2];
	$pdomicilio			 	  = $rowdeudor[3];
	$ptelf				  	  = $rowdeudor[4];

	

//Carga la plantilla;
	$TBS->LoadTemplate($template);

//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

//Nombre para el archivo a descargar.
	//$file_name = 

    $file_name = $path_exit.'Protesto_aval'.$id_protesto.$extension;
	$file_name_show = 'Protesto_aval'.$id_protesto.$extension;
	
	//$file_name = str_replace('.','_'.$suffix.'.',$file_name);
	
    $TBS->Show(TBSZIP_FILE, $file_name);
	
	//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
#}
	echo "Se genero el archivo: ".$file_name_show." satisfactoriamente..!!";
//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
?>
