<?php

// Carga las librerias:
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');
include_once('../extraprotocolares/Config/Configuracion.php');
include_once('fecha_letra.php');

$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.

$queryUsuario = "SELECT loginusuario,
						dni
				FROM usuarios 
				WHERE CONCAT(apepat,' ',prinom)='$usuario_imprime'";
$executeQuery = mysql_query($queryUsuario);
$arrUsuario = mysql_fetch_assoc($executeQuery);

$USUARIO = $arrUsuario['loginusuario'];
$USUARIO_DNI = $arrUsuario['dni'];
$COMPROBANTE = 'sin';

## notario :

$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO' , confinotario.direccion, confinotario.distrito FROM confinotario"; 
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$muesnotario     = strtoupper(utf8_decode($rownum[0]));
$direc_notario   = strtoupper(utf8_decode($rownum[1]));
$ubigeo_notario  = strtoupper(utf8_decode($rownum[2]));

##

###########################################
##  SE DEFINE PATH PARA TEMPLATES Y SALIDAS
# 1 Se crea Objetos
$ruta_templates  = new AsignaPath;	
$ruta_archivos   = new AsignaPath;
# 2. Templates
$path_template   = $ruta_templates->__set_path_template();
# 3. Salida de Data
$path_exit       = $ruta_archivos->__set_path_exit('certifi_domiciliario');
$extension       = $ruta_archivos->__set_tip_output_ep();
###########################################

//se crea el objeto  ClaseLetras
	$fecha = new ClaseNumeroLetra();

	$dia  = $fecha->fun_fecha_dia(); 
	$mes  = $fecha->fun_fecha_mes();
	$anio = $fecha->fun_fecha_anio();
	
	/*$num_cronoss       = $_REQUEST["num_certificado"]; 
	
	$fechitainterior = "SELECT cert_domiciliario.fec_ingreso FROM cert_domiciliario where cert_domiciliario.num_certificado='".$num_cronoss."'";
	$resulfecha = mysql_query($fechitainterior,$conn) or die(mysql_error());
	$rowviaint = mysql_fetch_array($resulfecha);
	$fechaconv	      = explode('-',$rowviaint[0]);
	$fechaingresovieint  = $fechaconv[2]."/".$fechaconv[1]."/".$fechaconv[0];
	$fecha_letras_viaext = strtoupper(fechaALetras($fechaingresovieint));*/
	
	$fec_letras2 = $fecha->fun_fech_comple(date("Y/m/d"));

//Se crea el objeto TBS
	$TBS = new clsTinyButStrong; 
// Se cargan las propiedades del PLUGIN
	$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

	$suffix = '';
	$debug  = '';

// Se verifica que formato de plantilla se usara.
	$template = $path_template."plantilla_certifi_domiciliario".$extension;
	//print_r($template);return false;
	$template = 'D:/plantillas/EXTRAPROTOCOLARES/CERTIFICACIONES/CONSTATACION DOMICILIARIA/CERTIFICADO DOMICILIARIO BASE.docx';

	#$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");

	$num_crono        = $_REQUEST["num_certificado"];        //Num. certificado a exportar.
	$numcrono2        = substr($num_crono,5,6).'-'.substr($num_crono,0,4);	//Para Mostrar num_crono.
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.
	$nombre_notario   = $muesnotario;      //Nombre del notario.
	$direccion_notario	  = $direc_notario; 		//Direcion del notario.
	$distrito_notario = $ubigeo_notario;
	$fecha_impresion  = date("d/m/Y");                 //Fecha de impresion.
	
//Consulta segun parametro enviado:
$consulcertificado = mysql_query('SELECT UPPER(cert_domiciliario.num_certificado) AS "NUM_CERTI",
cert_domiciliario.fec_ingreso AS "FEC_INGRESO", 
UPPER(cert_domiciliario.num_formu) AS "NUM_FORMU",
CONCAT(cliente.prinom," ",cliente.segnom," ",cliente.apepat," ",cliente.apemat) AS "NOMBRE_SOLIC", 
UPPER(tipodocumento.td_abrev) AS "TIP_DOC",
 UPPER(cert_domiciliario.numdoc_solic) AS "NUM_DOC",
UPPER(cert_domiciliario.domic_solic) AS "DIRECCION", 
UPPER(cert_domiciliario.motivo_solic) AS "MOTIVO", 
UPPER(ubigeo.nomdis) AS "NOM_DIST" ,
UPPER(cert_domiciliario.texto_cuerpo) AS "OBSERVACION",
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto )) AS "UBIGEO",
cert_domiciliario.IDESTCIVIL AS "E_CIVIL",
cert_domiciliario.profesionc AS "IDPROFESION",
cert_domiciliario.detprofesionc "PROFESION",
CONCAT(" DEL DISTRITO DE ",ubigeo.nomdis," PROVINCIA DE ",ubigeo.nomprov, " Y DEPARTAMENTO DE ",ubigeo.nomdpto) AS "DISTRITO", 
id_domiciliario AS "iddomiciliriario",
cert_domiciliario.fecha_ocupa,
cert_domiciliario.declara_ser,
cert_domiciliario.propietario,
cert_domiciliario.recibido,
cert_domiciliario.numero_recibo,
cert_domiciliario.mes_facturado,
cert_domiciliario.recibo_empresa,
cliente.sexo,
n.descripcion as nacionalidad
FROM cert_domiciliario
INNER JOIN tipodocumento ON cert_domiciliario.tipdoc_solic = tipodocumento.codtipdoc
INNER JOIN cliente ON cert_domiciliario.numdoc_solic = cliente.numdoc
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cert_domiciliario.distrito_solic
INNER JOIN nacionalidades as n ON n.idnacionalidad = cliente.nacionalidad
WHERE cert_domiciliario.num_certificado = "'.$num_crono.'"  ', $conn) or die(mysql_error());
	$registro = mysql_fetch_array($consulcertificado);

// CONSULTA TESTIGO A RUEGO :
$consultestigo = mysql_query('SELECT UPPER(cert_domiciliario.nom_testigo), UPPER(tipodocumento.td_abrev) AS "TIP_DOC" , cert_domiciliario.ndocu_testigo AS "NUMDOCU_TESTIGO",
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto )) AS "UBIGEO"
FROM cert_domiciliario
INNER JOIN tipodocumento ON cert_domiciliario.tdoc_testigo = tipodocumento.codtipdoc
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cert_domiciliario.distrito_solic
WHERE cert_domiciliario.num_certificado = "'.$num_crono.'" ', $conn) or die(mysql_error());
	$rowtestigo = mysql_fetch_array($consultestigo);

//Definicion de las variables para llenar la plantilla dinamicamente

	$nombre_persona0   = strtoupper(utf8_decode($registro[3]));
	$nombre_persona1   = str_replace("?","'",$nombre_persona0);
	$nombre_persona2   = str_replace("*","&",$nombre_persona1);
	$nombre_persona    = strtoupper($nombre_persona2);	
	$P_NOM    = strtoupper($nombre_persona2);	
	
	$fecha_letras_viaext2 = $fecha->fun_fech_diayanio($registro[1]);
	$fec_letras= strtoupper(utf8_decode($fecha_letras_viaext2));
	
	//$fecha_letras_viaext3 = $fecha->fun_fech_completo2_anio($registro[1]);
	$fecha_letras_viaext3 = $fecha->fun_fech_letras($registro[1]);
	//print_r($fecha_letras_viaext3);return false;
	$fec_letras_completa= strtoupper(utf8_decode($fecha_letras_viaext3));

	$tip_doc           = utf8_decode($registro[4]);
	$P_DOC           = utf8_decode('IDENTIFICADO CON '.$registro[4]. ' N°');
	$DOC           = utf8_decode($registro[4]. ' N°');
	$num_doc           = utf8_decode($registro[5]);
	$P_IDE           = utf8_decode($registro[5]);
	
	$domicilio0        = strtoupper(utf8_decode($registro[6]));
	$domicilio1	       = str_replace("?","'",$domicilio0);
	$domicilio2	   	   = str_replace("*","&",$domicilio1);
	$domicilio 		   = strtoupper($domicilio2);
	$P_DOMICILIO 	   = strtoupper('CON DOMICILIO EN '.$domicilio2).utf8_decode($registro[14]);
	
	$observaciones    = strtoupper(utf8_decode($registro[9]));
	$ubigeo			  = strtoupper(utf8_decode($registro[10]));
	$MOTIVO			  = strtoupper(utf8_decode($registro[7]));
	$e_civil          = strtoupper(utf8_decode($registro[11]));
	
	$ocupacion 		  = strtoupper(utf8_decode($registro[13]));
	$P_OCUPACION 		  = strtoupper(utf8_decode($registro[13]));
	$dsitrito		  = strtoupper(utf8_decode($registro[14]));
	$iddomiciliaro	  = strtoupper(utf8_decode($registro[15]));
		
	$nom_testigo0      = strtoupper(utf8_decode($rowtestigo[0]));
	$nom_testigo1	   = str_replace("?","'",$nom_testigo0);
	$nom_testigo2	   = str_replace("*","&",$nom_testigo1);
	$nom_testigo 	   = strtoupper($nom_testigo2);
	
	$tipdoc_testigo   = strtoupper(utf8_decode($rowtestigo[1]));
	$numdoc_testigo   = strtoupper(utf8_decode($rowtestigo[2]));
	$ubigeo_testigo   = strtoupper(utf8_decode($rowtestigo[3]));
	
	if($registro[22]=='SEDA JULIACA S.A.'){
		$RECIBO_SERVICIOS_D = 'saneamiento y agua potable';
	}else if($registro[22]=='ELECTRO PUNO S.A.A'){
		$RECIBO_SERVICIOS_D = 'servicios de luz eléctrica';
	}
	$fecha_que_ocupa = $fecha->fun_fech_letras($registro[16]);
	$FECHA_OCUPA = utf8_decode($fecha_que_ocupa);
	$DECLARA_SER = utf8_decode($registro[17]);
	$PROPIETARIO = utf8_decode($registro[18]);
	$RECIBIDO_POR = utf8_decode($registro[19]);
	$NRO_RECIBO_SERVICIOS = utf8_decode($registro[20]);
	$MES_RECIBO_SERVICIOS = utf8_decode($registro[21]);
	$RECIBO_SERVICIOS = utf8_decode($registro[22]);
	

	if($registro[23]=='F'){
		$EL_LA = 'LA';
		$DEL_A = 'DE LA';
		$P_O_A = 'A';
		$A_EL = 'A LA';
		$P_ESTADO_CIVIL          = strtoupper(utf8_decode(substr($registro[11],0,-1).'A'));
		$P_NACIONALIDAD = utf8_decode(substr($registro[24],0,-1).'A');
	}
	if($registro[23]=='M'){
		$EL_LA = 'EL';
		$DEL_A = 'DEL';
		$P_O_A = 'O';
		$A_EL = 'AL';
		$P_ESTADO_CIVIL          = strtoupper(utf8_decode(substr($registro[11],0,-1).'O'));
		$P_NACIONALIDAD = utf8_decode(substr($registro[24],0,-1).'O');
	}
	
	if($nom_testigo!=''){
		$datos_testigo = "INTERVIENE EN CALIDAD DE TESTIGO A RUEGO :".$nom_testigo.", CON ".$tipdoc_testigo." NUMERO ".$numdoc_testigo.utf8_decode(" , POR SER ILETRADA LA SOLICITANTE, LA MISMA QUE ESTAMPA SU HUELLA DACTILAR EN SEÑAL DE CONFORMIDAD"." ".$ubigeo_testigo);
	}
	else{$datos_testigo = "" ;}			
	
	if($nom_testigo=='' || empty($nom_testigo))
			{
				# ARMA FIRMA TESTIGO
				$evalua_firma     = "-----------------------------------".chr(13).chr(10).$nombre_persona.chr(13).chr(10).$tip_doc.utf8_decode(" N°: ").$num_doc.chr(13).chr(10).chr(13).chr(10).chr(13).chr(10);
				$evalua_firma_testigo     = "";
			}
				else if($nom_testigo!='')
				{
					$evalua_firma = "-----------------------------------".chr(13).chr(10)."HUELLA DEL SOLICITANTE".chr(13).chr(10).$nombre_persona.chr(13).chr(10).$tip_doc.utf8_decode(" N°: ").$num_doc.chr(13).chr(10).chr(13).chr(10).chr(13).chr(10);
					$evalua_firma_testigo = "-----------------------------------".chr(13).chr(10).$nom_testigo.chr(13).chr(10).$tipdoc_testigo.utf8_decode(" N°: ").$numdoc_testigo.chr(13).chr(10).chr(13).chr(10).chr(13).chr(10);	
				}
	
			
	//Carga la plantilla;
	$TBS->NoErr = true;
	$TBS->LoadTemplate($template);

	//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

	$anioKardex = explode('-',$numcrono2);

	if(!file_exists($path_exit.$anioKardex[1])){
		mkdir($path_exit.$anioKardex[1],0700);
	}

	//Nombre para el archivo a descargar.
    $file_name      = $path_exit.$anioKardex[1].'/__CDOM__'.$numcrono2.'.docx';
	$file_name_show = '__CDOM__'.$numcrono2.'.docx';
	
    $TBS->Show(TBSZIP_FILE, $file_name);

	//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
#}
	echo "Se genero el archivo: ".$file_name_show." satisfactoriamente..!!";
//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
?>
