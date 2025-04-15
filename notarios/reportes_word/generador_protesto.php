<?php

// Carga las librerias:
include('../conexion.php');
include('../extraprotocolares/view/funciones.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../extraprotocolares/Config/Configuracion.php');
include_once('../ClaseLetras.class.php');

## notario :
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO', confinotario.distrito,confinotario.telefono,
confinotario.correo,confinotario.direccion FROM confinotario";
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$nom_notario = $rownum[0];
$direc_notario=$rownum[4];
$telf_notario=$rownum[2];
$correo_notario=$rownum[3];
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
	$fec_letras = $fecha->fun_fech_compleDO(date("Y/m/d"));

//Se crea el objeto TBS
	$TBS = new clsTinyButStrong; 
// Se cargan las propiedades del PLUGIN
	$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

	$suffix = '';
	$debug  = '';

// Se verifica que formato de plantilla se usara.
	$template = "plantilla_protesto.odt";
	
	//echo $template; exit;
	//$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");

	$id_prote        = $_REQUEST["id_prote"];        //Num. Cronologico a exportar.
	$anio2        = $_REQUEST["anio"];  
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.
	$nombre_notario   = $muesnotario;       //Nombre del notario.
	//$nom_dist     = $_REQUEST["dist_notario"];       //Nombre del Distrito.
	$fecha_impresion  = date("d/m/Y");                 //Fecha de impresion.

//Consulta segun parametro enviado:



$consulcartas = mysql_query('SELECT protesto.id_protesto,protesto.solicitante,protesto.num_protesto,protesto.numero ,
IF(DATE_FORMAT(protesto.fec_ingreso,"%Y-%m-%d")="0000-00-00","",DATE_FORMAT(protesto.fec_ingreso,"%Y/%m/%d")) AS "fec_ingreso2",
IF(DATE_FORMAT(protesto.fec_notificacion,"%Y-%m-%d")="0000-00-00","",DATE_FORMAT(protesto.fec_notificacion,"%Y/%m/%d")) AS "fec_notificacion2",
IF(DATE_FORMAT(protesto.fec_constancia,"%Y-%m-%d")="0000-00-00","",DATE_FORMAT(protesto.fec_constancia,"%Y/%m/%d")) AS "fec_constancia2",
monedas.desmon,protesto.importe, CONCAT(RIGHT(protesto.num_protesto,6),"-", LEFT(protesto.num_protesto,4)) AS "num_protesto",tipo_protesto.des_tipop,
protesto.doc_referencia, protesto.diligencia, IF(DATE_FORMAT(protesto.fec_venc,"%Y-%m-%d")="0000-00-00","",DATE_FORMAT(protesto.fec_venc,"%Y/%m/%d")) AS "fec_venc2"
,IF(DATE_FORMAT(protesto.fec_giro,"%Y-%m-%d")="0000-00-00","",DATE_FORMAT(protesto.fec_giro,"%Y/%m/%d")) AS "fec_giro2", monedas.simbolo AS simbol
FROM protesto
LEFT OUTER JOIN monedas ON monedas.idmon = protesto.moneda 
INNER JOIN tipo_protesto ON tipo_protesto.cod_tipop = protesto.tipo
WHERE protesto.id_protesto = "'.$id_prote.'" and protesto.anio="'.$anio2.'"', $conn) or die(mysql_error());

// CONCAT(RIGHT("'.$num_carta.'",4),"0", LEFT("'.$num_carta.'",5))
	$rowcartas = mysql_fetch_array($consulcartas);
/*
//CONSULTA PARA LOS PARTICIPANTES DE PROTESTO (OBLIGADOS)
$consulparti = mysql_query('SELECT protesto_participantes.tip_condi,protesto_participantes.id_protesto, protesto_participantes.descri_parti, protesto_participantes.direccion
FROM protesto_participantes
INNER JOIN protesto ON protesto.id_protesto = protesto_participantes.id_protesto
WHERE protesto_participantes.tip_condi = "002" AND protesto_participantes.id_protesto  = "'.$id_prote.'" and protesto_participantes.anio="'.$anio2.'" ', $conn) or die(mysql_error());*/

$consuldeudor = mysql_query('SELECT protesto_participantes.tip_condi,GROUP_CONCAT(CONCAT(cliente.prinom," ",cliente.segnom," ",cliente.apepat," ",cliente.apemat, cliente.razonsocial) SEPARATOR " / ") AS descri_parti, 
GROUP_CONCAT(CONCAT(`num_docparti`) SEPARATOR " / ") AS num_docparti,GROUP_CONCAT(CONCAT(IF(cliente.tipper="N",cliente.direccion,cliente.domfiscal))SEPARATOR " / ") AS direccion,
cliente.telfijo,protesto.id_protesto,protesto_participantes.id_participante
FROM protesto_participantes
LEFT OUTER JOIN cliente ON cliente.numdoc = protesto_participantes.num_docparti
LEFT OUTER JOIN protesto ON protesto.id_protesto = protesto_participantes.id_protesto
WHERE  protesto_participantes.tip_condi = "002" AND protesto.id_protesto = "'.$id_prote.'" and protesto.anio="'.$anio2.'" ', $conn) or die(mysql_error());
// CONCAT(RIGHT("'.$num_carta.'",4),"0", LEFT("'.$num_carta.'",5))
	$rowdeudor = mysql_fetch_array($consuldeudor);


	$rowparti = mysql_fetch_array($consulparti);

//CONSULTA PARA telefono y dni del obligadouuu
$consuldat = mysql_query("SELECT CASE WHEN IFNULL(cliente.apepat,'')='' THEN cliente.razonsocial 
ELSE CONCAT(cliente.apepat,' ',cliente.apemat,', ',cliente.prinom,' ',cliente.segnom)END  AS obligado,cliente.numdoc AS numdoc, IFNULL(cliente.telfijo,'') AS telfijo,ubigeo.nomdis AS ubigeo,ubigeo.`nomdpto` AS depa, cliente.domfiscal AS domruc FROM cliente 
INNER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
WHERE 
(CASE WHEN IFNULL(cliente.apepat,'')='' THEN cliente.razonsocial 
ELSE CONCAT(cliente.apepat,' ',cliente.apemat,', ',cliente.prinom,' ',cliente.segnom)END) LIKE '%".$rowparti[2]."%'", $conn) or die(mysq_error());


	$rowdat = mysql_fetch_array($consuldat);

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
	$importe 					  = $rowcartas[8];
	$domicilio					  = utf8_decode($rowdeudor['direccion']);
	//$fec_diligencia       = $rowcartas[2];
	$fec_ingreso      			  = $fecha->fun_fech_compleDO($rowcartas[4]);
	$fec_notificacion      		  = $fecha->fun_fech_compleDO($rowcartas[5]);
	$fec_constancia      		  = $fecha->fun_fech_compleDO($rowcartas[6]);
	$fec_venc      		  = $fecha->fun_fech_compleDO($rowcartas['fec_venc2']);
	$fec_giro2      		  = $fecha->fun_fech_compleDO($rowcartas['fec_giro2']);
	$solicitante = $rowcartas[1];
	$desmon = $rowcartas[7];
	$obligado 					  = utf8_decode($rowdeudor['descri_parti']);
	$dili=$rowcartas['diligencia'];
	$simbolmone=$rowcartas['simbol'];
	$telfijo=$rowdat['telfijo'];
	$numdoc=$rowdat['numdoc'];
	$valletras=strtoupper(valorEnLetras2($importe));
//Defino varialbes de rowparti	

	

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
