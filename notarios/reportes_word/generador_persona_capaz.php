<?php

// Carga las librerias:
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');
include_once('../extraprotocolares/Config/Configuracion.php');
include_once('fecha_letra.php');
## notario :
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO' , confinotario.direccion, confinotario.distrito FROM confinotario";
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$muesnotario = strtoupper(utf8_decode($rownum[0]));
$direccion   =  strtoupper(utf8_decode($rownum[1]));
$distrito_notario   =  strtoupper(utf8_decode($rownum[2]));
##

###########################################
##  SE DEFINE PATH PARA TEMPLATES Y SALIDAS
# 1 Se crea Objetos
$ruta_templates  = new AsignaPath;	
$ruta_archivos   = new AsignaPath;
# 2. Templates
$path_template   = $ruta_templates->__set_path_template();
# 3. Salida de Data
$path_exit       = $ruta_archivos->__set_path_exit('certificado_persona');

$extension       = $ruta_archivos->__set_tip_output_ep();
###########################################

//se crea el objeto  ClaseLetras
	$fecha = new ClaseNumeroLetra();

	$dia  = $fecha->fun_fecha_dia(); 
	$mes  = $fecha->fun_fecha_mes();
	$anio = $fecha->fun_fecha_anio();
	
	$num_cronos        = $_REQUEST["num_crono"]; 
	
	$fechitainterior = "SELECT cert_supervivencia.fecha,SUBSTR(num_crono, -6) AS idcapaz  FROM cert_supervivencia where cert_supervivencia.num_crono='".$num_cronos."' AND SWT_CAPACIDAD ='C'";
	$resulfecha = mysql_query($fechitainterior,$conn) or die(mysql_error());
	$rowviaint = mysql_fetch_array($resulfecha);
	$fechaconv	      = explode('-',$rowviaint[0]);
	$fechaingresovieint  = $fechaconv[2]."/".$fechaconv[1]."/".$fechaconv[0];
	$fecha_letras_viaext = strtoupper(fechaALetras($fechaingresovieint));
	
	$fecha_letras_viaext2 = $fecha->fun_fech_completo2_anio($rowviaint[0]);
	
	$fec_letras_completa= strtoupper(utf8_decode($fecha_letras_viaext2));
	
	
	$fec_letras = $fecha->fun_fech_comple(date("Y/m/d"));

	$capaz = (int)$rowviaint[1];
	
	
//Se crea el objeto TBS
	$TBS = new clsTinyButStrong; 
// Se cargan las propiedades del PLUGIN
	$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

	$suffix = '';
	$debug  = '';

// Se verifica que formato de plantilla se usara.
	$template = $path_template."plantilla_persona_capaz".$extension;

	#$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");

	$num_crono        = $_REQUEST["num_crono"];        //Num. Cronologico a exportar.
	$numcrono2        = substr($num_crono,5,6).'-'.substr($num_crono,0,4);	//Para Mostrar num_crono.
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.
	$nombre_notario   = $muesnotario;       //Nombre del notario.
	$direc_notario	  = $direccion; 		//Direccion del notario.
	$fecha_impresion  = date("d/m/Y");                 //Fecha de impresion.


	if($num_crono=='')
	{
		echo "Error al generar"; exit();	
	}

//Consulta segun parametro enviado:
$consulcertificado = mysql_query('SELECT CONCAT(cliente.prinom," ",cliente.segnom," ",cliente.apepat," ",cliente.apemat) AS "NOMBRE_PERSONA", UPPER(tipodocumento.td_abrev) AS "TIP_DOC", UPPER(cert_supervivencia.numdocu) AS "NUM_DOC", 
UPPER(nacionalidades.descripcion) AS "NACIONALIDAD", IF(ISNULL(tipoestacivil.desestcivil),"<NO INGRESADO>", UPPER(tipoestacivil.desestcivil)) AS "EST_CIVIL",
UPPER(cert_supervivencia.direccion) AS "DOMICILIO",
UPPER(ubigeo.nomdis) AS "NOM_DIST" , UPPER(cert_supervivencia.observaciones) AS "OBSERVACIONES",
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto )) AS "UBIGEO",
IF(cert_supervivencia.detprofesion="","<NO INGRESADO>",UPPER(cert_supervivencia.detprofesion)) AS "DETPROFESION"
FROM cert_supervivencia    
INNER JOIN tipodocumento ON cert_supervivencia.tipdocu = tipodocumento.codtipdoc
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cert_supervivencia.nacionalidad
INNER JOIN cliente ON cert_supervivencia.numdocu = cliente.numdoc
LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cert_supervivencia.ecivil
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cert_supervivencia.ubigeo
WHERE num_crono = "'.$num_crono.'" AND SWT_CAPACIDAD ="C"', $conn) or die(mysql_error());
	$registro = mysql_fetch_array($consulcertificado);
	
	
// CONSULTA TESTIGO:
$consultestigo = mysql_query('SELECT UPPER(cert_supervivencia.nom_testigo) AS "NOMBRE_TESTIGO", UPPER(cert_supervivencia.ndocu_testigo) AS "NUMDOCU_TESTIGO", UPPER(tipodocumento.td_abrev) AS "TIP_DOC",
cert_supervivencia.especificacion
FROM cert_supervivencia    
INNER JOIN tipodocumento ON cert_supervivencia.tdoc_testigo = tipodocumento.codtipdoc
WHERE num_crono = "'.$num_crono.'" AND SWT_CAPACIDAD ="C" ', $conn) or die(mysql_error());
	$rowtestigo = mysql_fetch_array($consultestigo);	


//Definicion de las variables para llenar la plantilla dinamicamente
	$nombre_persona0  = strtoupper(utf8_decode($registro[0]));
	$nombre_persona1  = str_replace("?","'",$nombre_persona0);
	$nombre_persona2  = str_replace("*","&",$nombre_persona1);
	$nombre_persona	  = strtoupper($nombre_persona2);
	
	
	$tip_doc          = $registro[1];
	$num_doc          = $registro[2];
	$est_civil        = $registro[4];
	$nacionalidad     = $registro[3];
	
	$domicilio0       = strtoupper(utf8_decode($registro[5]));
	$domicilio1	      = str_replace("?","'",$domicilio0);
	$domicilio2	   	  = str_replace("*","&",$domicilio1);
	$domicilio	  	  = strtoupper($domicilio2);
	
	$observaciones    = strtoupper(utf8_decode($registro[7]));
	$ubigeo           = strtoupper(utf8_decode($registro[8]));
	$profesion		  = strtoupper(utf8_decode($registro[9]));
	
	

// DATOS TESTIGO :
	$nombre_testigo0  = strtoupper(utf8_decode($rowtestigo[0]));
	$nombre_testigo1  = str_replace("?","'",$nombre_testigo0);
	$nombre_testigo2  = str_replace("*","&",$nombre_testigo1);
	$nombre_testigo	  = strtoupper($nombre_testigo2);
	
	$tipdoc_testigo   = $rowtestigo[2];
	$numdoc_testigo   = $rowtestigo[1];
	$especificacion1  = strtoupper($rowtestigo[3]);
	
		
	switch ($especificacion1) {
    case "IL":
        $especificacion = "POR SER ILETRADO(A)";
        break;
    case "IN":
        $especificacion = "POR TENER INCAPACIDAD FISICA";
        break;
    case "AR":
        $especificacion = "A RUEGO DE";
        break;
    }
		
	if($nombre_testigo!='')
				{
					$datos_testigo = "INTERVIENE EN CALIDAD DE TESTIGO A RUEGO: ".$nombre_testigo.", CON ".$tipdoc_testigo." NUMERO ".$numdoc_testigo.utf8_decode(" , ".$especificacion." LA SOLICITANTE, LA MISMA QUE ESTAMPA SU HUELLA DACTILAR EN SEÑAL DE CONFORMIDAD");
				}
	else{$datos_testigo = "" ;}			

	
	if($nombre_testigo=='')
			{
				# ARMA FIRMA TESTIGO
				//$evalua_firma     = "-----------------------------------".chr(13).chr(10).$nombre_persona.chr(13).chr(10).$tip_doc.utf8_decode(" N°: ").$num_doc.chr(13).chr(10).chr(13).chr(10).chr(13).chr(10)."-----------------".chr(13).chr(10).utf8_decode("IMPRESIÓN DACTILAR ÍNDICE DERECHO").chr(13).chr(10);	
				$evalua_firma     = "-----------------------------------".chr(13).chr(10).$nombre_persona.chr(13).chr(10).utf8_decode(" DNI N°: ").$num_doc;	
			}
				else if($nombre_testigo!='')
				{
			
					$evalua_firma = "-----------------------------------".chr(13).chr(10).$nombre_testigo.chr(13).chr(10).$tipdoc_testigo.utf8_decode(" N°: ").$numdoc_testigo.chr(13).chr(10).chr(13).chr(10).chr(13).chr(10)."-----------------------------------".chr(13).chr(10).$nombre_persona.chr(13).chr(10).$tip_doc.utf8_decode(" N°: ").$num_doc.chr(13).chr(10);	
					# "-----------------".chr(13).chr(10).utf8_decode("IMPRESIÓN DACTILAR ÍNDICE DERECHO").chr(13).chr(10);	
				}



//Carga la plantilla;
	$TBS->LoadTemplate($template);

//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

//Nombre para el archivo a descargar.
	//$file_name = 

    $file_name = $path_exit.'Ccapaz'.$numcrono2.$extension;
	$file_name_show = 'Ccapaz'.$numcrono2.$extension;
	
	//$file_name = str_replace('.','_'.$suffix.'.',$file_name);
	
    $TBS->Show(TBSZIP_FILE, $file_name);
	
	//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
#}
	echo "Se genero el archivo: ".$file_name_show." satisfactoriamente..!!";
//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
?>
