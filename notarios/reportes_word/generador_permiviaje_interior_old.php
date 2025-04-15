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
$nom_notario   = strtoupper(utf8_decode($rownum[0]));
$direc_notario = strtoupper(utf8_decode($rownum[1]));
$dist_notario  = strtoupper(utf8_decode($rownum[2]));
if($nom_notario=='' || $direc_notario=='' or $dist_notario =='')
{
	echo "Faltan Datos del notarios";
	exit();	
}

##

###########################################
##  SE DEFINE PATH PARA TEMPLATES Y SALIDAS
# 1 Se crea Objetos
$ruta_templates  = new AsignaPath;	
$ruta_archivos   = new AsignaPath;
# 2. Templates
$path_template   = $ruta_templates->__set_path_template();
# 3. Salida de Data
$path_exit       = $ruta_archivos->__set_path_exit('permiviaje');

$extension       = $ruta_archivos->__set_tip_output_ep();
###########################################

//se crea el objeto  ClaseLetras
	$fecha = new ClaseNumeroLetra();

	$dia   = $fecha->fun_fecha_dia(); 
	$mes   = $fecha->fun_fecha_mes();
	$anio  = $fecha->fun_fecha_anio();
	
	
	$id_viajess       = $_REQUEST["id_viaje"];        //Num. viaje a exportar.
	//$numcrono2        = substr($num_crono,5,6).'-'.substr($num_crono,0,4);	//Para Mostrar num_crono.
	
	$fechitainterior = "SELECT permi_viaje.fec_ingreso FROM permi_viaje where permi_viaje.id_viaje='".$id_viajess."'";
	$resulfecha = mysql_query($fechitainterior,$conn) or die(mysql_error());
	$rowviaint = mysql_fetch_array($resulfecha);
	$fechaconv	      = explode('-',$rowviaint[0]);
	$fechaingresovieint  = $fechaconv[2]."/".$fechaconv[1]."/".$fechaconv[0];
	$fecha_letras_viaint = strtoupper(fechaALetras($fechaingresovieint));
	
	$fec_letras = $fecha->fun_fech_comple(date("Y/m/d"));
	
	
	
	
	# PRUEBA
	$fec_letras_2 = $fecha->fun_fech_comple("2013/12/01");
	#echo $fec_letras_2;
	#exit();
	 
//Se crea el objeto TBS
	$TBS = new clsTinyButStrong; 
// Se cargan las propiedades del PLUGIN
	$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

	$suffix = '';
	$debug  = '';

// Se verifica que formato de plantilla se usara.
	$template = $path_template."plantilla_permiviaje_interior".$extension;

	#$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");

	$id_viaje        = $_REQUEST["id_viaje"];        //Num. viaje a exportar.
	//$numcrono2        = substr($num_crono,5,6).'-'.substr($num_crono,0,4);	//Para Mostrar num_crono.
	
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.
	$nombre_notario   = $muesnotario;       //Nombre del notario.
	$fecha_impresion  = date("d/m/Y");
	
	
	                 //Fecha de impresion.

## CONSULTAS:

########################################################################
## BUSCA AL PADRE		001		GUARDA DENTRO DE [onshow.datos_padmat_1]
# YO nombre_apoderado DE NACIONALIDAD nacionalidad IDENTIFICADO(A) CON tip_doc N° num_doc Y DOMICILIO EN domicilio
$consulpadre = mysql_query('SELECT CONCAT(cliente.prinom, " ", cliente.segnom, " ", cliente.apepat, " ", cliente.apemat) AS "NOMBRE_APODERADO", tipodocumento.destipdoc AS "TIP_DOC", cliente.numdoc AS "NUM_DOC", nacionalidades.descripcion AS "NACIONALIDAD", 
cliente.direccion AS "DIRECCION",  viaje_contratantes.c_fircontrat,
IF(ubigeo.coddis="" OR ISNULL(ubigeo.coddis) ,"",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))  AS "ubigeo",
tipoestacivil.desestcivil AS "ECIVIL", IF(ISNULL(profesiones.desprofesion),"",profesiones.desprofesion) AS "PROFESION", IF(ISNULL(viaje_contratantes.codi_podera),"",viaje_contratantes.codi_podera),cliente.detaprofesion AS "PROFESION_CLIENTE"
FROM viaje_contratantes 
INNER JOIN cliente ON cliente.numdoc = viaje_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente.idprofesion
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
WHERE viaje_contratantes.c_condicontrat = "001" AND viaje_contratantes.id_viaje = "'.$id_viaje.'" ', $conn) or die(mysql_error());
$rowpadre = mysql_fetch_array($consulpadre);


########################################################################
## BUSCA A LA MADRE		005		GUARDA DENTRO DE [onshow.datos_padmat_2]
# Y YO nombre_apoderado DE NACIONALIDAD nacionalidad. IDENTIFICADO(A) CON tip_doc N° num_doc
$consulmadre = mysql_query('SELECT  CONCAT(cliente.prinom, " ", cliente.segnom, " ", cliente.apepat, " ", cliente.apemat) AS "NOMBRE_APODERADO", tipodocumento.destipdoc AS "TIP_DOC", cliente.numdoc AS "NUM_DOC", nacionalidades.descripcion AS "NACIONALIDAD", 
cliente.direccion AS "DIRECCION",  viaje_contratantes.c_fircontrat,
IF(ubigeo.coddis="" OR ISNULL(ubigeo.coddis) ,"",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))  AS "ubigeo",
tipoestacivil.desestcivil AS "ECIVIL", IF(ISNULL(profesiones.desprofesion),"",profesiones.desprofesion) AS "PROFESION", IF(ISNULL(viaje_contratantes.codi_podera),"",viaje_contratantes.codi_podera),cliente.detaprofesion AS "PROFESION_CLIENTE"
FROM viaje_contratantes 
INNER JOIN cliente ON cliente.numdoc = viaje_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente.idprofesion
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
WHERE viaje_contratantes.c_condicontrat = "005" AND viaje_contratantes.id_viaje = "'.$id_viaje.'" ', $conn) or die(mysql_error());
$rowmadre = mysql_fetch_array($consulmadre);


########################################################################
## BUSCA AL APODERADO   003		FUARDA DENTRO DE [onshow.datos_apoderado]
# YO nombre_apoderado DE NACIONALIDAD nacionalidad IDENTIFICADO(A) CON tip_doc N° num_doc Y DOMICILIO EN domicilio , 
$consulapoderado = mysql_query('SELECT  CONCAT(cliente.prinom, " ", cliente.segnom, " ", cliente.apepat, " ", cliente.apemat) AS "NOMBRE_APODERADO", tipodocumento.destipdoc AS "TIP_DOC", cliente.numdoc AS "NUM_DOC", nacionalidades.descripcion AS "NACIONALIDAD", 
cliente.direccion AS "DIRECCION",  viaje_contratantes.c_fircontrat,
IF(ubigeo.coddis="" OR ISNULL(ubigeo.coddis) ,"",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))  AS "ubigeo", 
IF(ISNULL(client_apoderado.nombre),"",client_apoderado.nombre) AS "client_nombre", IF(ISNULL(client_apoderado.numdoc),"",client_apoderado.numdoc) AS "client_numdoc", 
IF(ISNULL(viaje_contratantes.codi_podera),"",viaje_contratantes.codi_podera) AS "client_codi_podera",
tipoestacivil.desestcivil AS "ECIVIL", IF(ISNULL(profesiones.desprofesion),"",profesiones.desprofesion) AS "PROFESION"
FROM viaje_contratantes 
INNER JOIN cliente ON cliente.numdoc = viaje_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente.idprofesion
LEFT OUTER JOIN cliente client_apoderado ON client_apoderado.numdoc = viaje_contratantes.codi_podera
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
WHERE viaje_contratantes.c_condicontrat = "003" AND viaje_contratantes.id_viaje = "'.$id_viaje.'" ', $conn) or die(mysql_error());
$rowapoderado = mysql_fetch_array($consulapoderado);

########################################################################
## BUSCA AL TESTIGO -> NUEVOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO

$consultestigo = mysql_query('SELECT  cliente.nombre AS "NOMBRE_APODERADO", tipodocumento.destipdoc AS "TIP_DOC", cliente.numdoc AS "NUM_DOC", nacionalidades.descripcion AS "NACIONALIDAD", 
cliente.direccion AS "DIRECCION",  viaje_contratantes.c_fircontrat,
IF(ubigeo.coddis="" OR ISNULL(ubigeo.coddis) ,"",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))  AS "ubigeo",
viaje_contratantes.codi_testigo AS "COD_TESTIGO", viaje_contratantes.tip_incapacidad AS "INCAPACIDAD",  d_tablas.val_item AS "TIPO_INCAPACIDAD"
FROM viaje_contratantes 
INNER JOIN cliente ON cliente.numdoc = viaje_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
INNER JOIN d_tablas ON d_tablas.num_item  = viaje_contratantes.tip_incapacidad AND d_tablas.tip_item = "poder"
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente.idubigeo
WHERE viaje_contratantes.c_condicontrat = "010" AND viaje_contratantes.id_viaje = "'.$id_viaje.'" ', $conn) or die(mysql_error());
$rowtestigo = mysql_fetch_array($consultestigo);



########################################################################	
# BUSCA AL MENOR   002	ARRAY ( VARIOS MENORES)
$consulmenor = mysql_query('SELECT  IF(viaje_contratantes.edad<>"",CONCAT(IF (viaje_contratantes.edad="","",viaje_contratantes.edad)," ", IF(viaje_contratantes.condi_edad="1","AÑOS","MESES")),"") AS "EDAD_MENOR", viaje_contratantes.c_codcontrat,
viaje_contratantes.c_descontrat
FROM viaje_contratantes 
WHERE viaje_contratantes.c_condicontrat = "002" AND viaje_contratantes.id_viaje = "'.$id_viaje.'" ', $conn) or die(mysql_error());

	//$rowmenor = mysql_fetch_array($consulmenor);	
	$nummenores =  mysql_num_rows($consulmenor);	


###########################	
#### Para el destino ######
$consuldestino = mysql_query('SELECT permi_viaje.lugar_formu  AS "DESTINO", permi_viaje.observacion AS "OBSERVACION" FROM permi_viaje WHERE permi_viaje.id_viaje = "'.$id_viaje.'" ', $conn) or die(mysql_error());
	$rowdestino = mysql_fetch_array($consuldestino);	


###########################################################	
#### PARA LA PARTIDA ELECTRÓNICA Y LA SEDE REGISTRAL ######
$consulpartielec = mysql_query('SELECT viaje_contratantes.partida_e,viaje_contratantes.sede_regis,
permi_viaje.partida_e, permi_viaje.sede_regis 
FROM permi_viaje 
INNER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
WHERE permi_viaje.id_viaje ="'.$id_viaje.'" AND viaje_contratantes.partida_e!="" AND viaje_contratantes.sede_regis != ""', $conn) or die(mysql_error());
	$rowpartielec = mysql_fetch_array($consulpartielec);	

	
##########################
## Verifica num kardex  ##
$consulnumkardex = mysql_query('SELECT permi_viaje.num_kardex FROM permi_viaje WHERE permi_viaje.id_viaje = "'.$id_viaje.'" ', $conn) or die(mysql_error());
	$rownum_kar = mysql_fetch_array($consulnumkardex);	

if($rownum_kar[0] == '')
{
	echo 'Error 01: Falta Generar Nro. Cronologico.';
	$numcrono2 = "";
	exit();	
		
}
else if($rownum_kar[0] != '')
{
	$numcrono2  = substr($rownum_kar[0],4,6).'-'.substr($rownum_kar[0],0,4);	//Para Mostrar num_crono.
}
##########################
##########################
	//echo $rowpadre[0]. " " .$rowmadre[0]. " "  .$rowapoderado[0] ;
	//exit();

if( $rowpadre[0] == '' &&   $rowmadre[0] == '' && $rowapoderado[0] == '' )
{
	echo 'Error 02:  Falta ingresar Participantes';
	exit();	
	
}


//Definicion de las variables para llenar la plantilla dinamicamente
	# PADRE
	$nombre_padre0         = strtoupper(utf8_decode($rowpadre[0]));
	$nombre_padre1		   = str_replace("?","'",$nombre_padre0);
	$nombre_padre2		   = str_replace("*","&",$nombre_padre1);
	$nombre_padre		   = strtoupper($nombre_padre2);


	$nacionalidad_padre       = strtoupper(utf8_decode($rowpadre[3]));
	$tip_doc_padre            = utf8_decode($rowpadre[1]);
	$num_doc_padre            = utf8_decode($rowpadre[2]);
	
	$domicilio_padre0          = strtoupper(utf8_decode($rowpadre[4]));
	$domicilio_padre1		   =str_replace("?","'",$domicilio_padre0);
	$domicilio_padre2		   =str_replace("*","&",$domicilio_padre1);
	$domicilio_padre		   =strtoupper($domicilio_padre2);
	
	
	$ubigeo_padre             = strtoupper(utf8_decode($rowpadre[6]));
	
	// SEGUN NUEVO REQURIMIENTO:
	$ecivil_padre    = strtoupper(utf8_decode($rowpadre[7]));
	$profocupa_padre = strtoupper(utf8_decode($rowpadre[10]));
	
	// EVALUA SI EL PADRE REPRESENTA A LA MADRE
	$_eval_repre_madre = "";
	if($rowpadre[9] != "")
	{
		$_eval_repre_madre = utf8_decode(" Y EN REPRESENTACIÓN DE ").strtoupper(utf8_decode($rowmadre[0])).utf8_decode(" MADRE DEL (LOS) MENOR (ES) SEGÚN PODER INSCRITO EN LA PARTIDA ELECTRÓNICA N° ") .$rowpartielec[0]. " DEL REGISTRO DE MANDATOS Y PODERES DE ".strtoupper($rowpartielec[1]);	
	}
	
	# ARMA VARIABLE PADRE:
	if($nombre_padre!='')
	{
		## EVALUA SI ESTA REPRESENTADO
		$consulApoderado_pad = mysql_query('SELECT viaje_contratantes.c_codcontrat FROM viaje_contratantes WHERE viaje_contratantes.id_viaje = "'.$id_viaje.'" AND (viaje_contratantes.codi_podera = "'.$num_doc_padre.'" OR viaje_contratantes.codi_podera = "AMBOS")', $conn) or die(mysql_error());
	    $rowpad_Apod = mysql_fetch_array($consulApoderado_pad);	
		
		
			if($rowpad_Apod[0] == "") # padre no representado
			{
				$datos_padmad_1 = "POR EL PRESENTE DOCUMENTO, YO  ".$nombre_padre.", IDENTIFICADO CON ".$tip_doc_padre.utf8_decode(" N° ") .$num_doc_padre." DE NACIONALIDAD ".$nacionalidad_padre.", DOMICILIADO EN " .$domicilio_padre." ".$ubigeo_padre.".";
			}
			
			else if($rowpad_Apod[0] != "") # padre representado
			{
				$datos_padmad_1 = "";	
			}

		# ARMA FIRMA VARIABLE PADRE
			if($rowpadre[5]=='SI')
				{
				$firma_padmad_1 = "------------------------------------------".chr(13).chr(10).$nombre_padre.chr(13).chr(10).$tip_doc_padre.utf8_decode(" N°: ").$num_doc_padre ;
				}else if($rowpadre[5]=='HUELLA')
				{
				$firma_padmad_1 = "------------------------------------------".chr(13).chr(10).$nombre_padre.chr(13).chr(10).$tip_doc_padre.utf8_decode(" N°: ").$num_doc_padre ;
					}
			else if($rowpadre[5]=='NO')
				{
				$firma_padmad_1 = "" ;
				}	
	}
	else {
		 $datos_padmad_1  = "";
		 $firma_padmad_1  = "";
		 }

	# MADRE
	$nombre_madre0            = strtoupper(utf8_decode($rowmadre[0]));
	$nombre_madre1		      = str_replace("?","'",$nombre_madre0);
	$nombre_madre2		      = str_replace("*","&",$nombre_madre1);
	$nombre_madre		      = strtoupper($nombre_madre2);
	
	
	$nacionalidad_madre       = strtoupper(utf8_decode($rowmadre[3]));
	$tip_doc_madre            = utf8_decode($rowmadre[1]);
	$num_doc_madre            = utf8_decode($rowmadre[2]);
	
	$domicilio_madre0         = strtoupper(utf8_decode($rowmadre[4]));
	$domicilio_madre1		  = str_replace("?","'",$domicilio_madre0);
	$domicilio_madre2		  = str_replace("*","&",$domicilio_madre1);
	$domicilio_madre		  = strtoupper($domicilio_madre2);
	
	$ubigeo_madre             = strtoupper(utf8_decode($rowmadre[6]));
	
	//SEGUN NUEVO REQUERIMIENTO:
	$ecivil_madre    = strtoupper(utf8_decode($rowmadre[7]));
	$profocupa_madre = strtoupper(utf8_decode($rowmadre[10]));
	
	// EVALUA SI EL PADRE REPRESENTA A LA MADRE
	$_eval_repre_madre = "";
	if($rowmadre[9] != "")
	{
		$_eval_repre_padre = utf8_decode(" Y EN REPRESENTACIÓN DE ").strtoupper(utf8_decode($rowpadre[0])).utf8_decode(" PADRE DEL (LOS) MENOR (ES) SEGÚN PODER INSCRITO EN LA PARTIDA ELECTRÓNICA N° ") .$rowpartielec[0]. " DEL REGISTRO DE MANDATOS Y PODERES DE ".strtoupper($rowpartielec[1]);	
	}
	
	# ARMA VARIABLE MADRE:
	# variable coma: Evalua si el padre está primero 
	$coma_padre = "";
	if($nombre_padre!='')
	{
		$coma_padre = ", ";
	}
	if($nombre_madre!='')
	{
		## EVALUA SI ESTA REPRESENTADO
		$consulApoderado_mad = mysql_query('SELECT viaje_contratantes.c_codcontrat FROM viaje_contratantes WHERE viaje_contratantes.id_viaje = "'.$id_viaje.'" AND (viaje_contratantes.codi_podera = "'.$num_doc_madre.'" OR viaje_contratantes.codi_podera = "AMBOS")', $conn) or die(mysql_error());
	    $rowmad_Apod = mysql_fetch_array($consulApoderado_mad);	
		
		
			if($rowmad_Apod[0] == "") # madre no representada
			{
				$datos_padmad_2 = /*$coma_padre.*/"POR EL PRESENTE DOCUMENTO, YO ".$nombre_madre.", IDENTIFICADA CON ".$tip_doc_madre. utf8_decode(" NUMERO ") .$num_doc_madre."DE NACIONALIDAD ".$nacionalidad_madre.", DOMICILIADA EN".$domicilio_madre." ".$ubigeo_madre." PROVINCIA Y DEPARTAMENTO DE LIMA.";
			}
			else if($rowmad_Apod[0] != "") # madre representada
			{
				$datos_padmad_2 = "";
			}

		# ARMA FIRMA VARIABLE MADRE
		
			if($rowmadre[5]=='SI')
				{
				$firma_padmad_2 = "------------------------------------------".chr(13).chr(10).$nombre_madre.chr(13).chr(10).$tip_doc_madre.utf8_decode(" N°: ").$num_doc_madre ;
				}else if($rowmadre[5]=='HUELLA')
				{
				$firma_padmad_2 = "------------------------------------------".chr(13).chr(10).$nombre_madre.chr(13).chr(10).$tip_doc_madre.utf8_decode(" N°: ").$num_doc_madre ;
				}
			else if($rowmadre[5]=='NO')
				{
				$firma_padmad_2 = "" ;
				}		
	}
	else {
		$datos_padmad_2 = "";
		$firma_padmad_2 = "";
		}
		
	# APODERADO
	$nombre_apoderado0        = strtoupper(utf8_decode($rowapoderado[0]));
	$nombre_apoderado1		  = str_replace("?","'",$nombre_apoderado0);
	$nombre_apoderado2		  = str_replace("*","&",$nombre_apoderado1);
	$nombre_apoderado		  = strtoupper($nombre_apoderado2);
	
	$nacionalidad_apoderado   = strtoupper(utf8_decode($rowapoderado[3]));
	$tip_doc_apoderado        = $rowapoderado[1];
	$num_doc_apoderado        = $rowapoderado[2];
	
	$domicilio_apoderado0      = strtoupper(utf8_decode($rowapoderado[4]));
	$domicilio_apoderado1	   =str_replace("?","'",$domicilio_apoderado0);
	$domicilio_apoderado2	   =str_replace("*","&",$domicilio_apoderado1);
	$domicilio_apoderado	   =strtoupper($domicilio_apoderado2);
	
	$ubigeo_apoderado         = strtoupper(utf8_decode($rowapoderado[6]));
	
	$client_apoderado         = strtoupper(utf8_decode($rowapoderado[7]));
	
	$numdoc_cliente_poder     = strtoupper(utf8_decode($rowapoderado[8]));
	
	// SEGÚN NUEVO REQUERIMIENTO
	$ecivil_apoderado         = strtoupper(utf8_decode($rowapoderado[10]));
	$profocupa_apoderado      = strtoupper(utf8_decode($rowapoderado[11]));
	
	// COMPARECENCIA: A QUIEN REPRESENTA EL PODERDANTE
	$eval_poder_comparecencia = "";
	
	// COMPARECENCIA: EVALUA SI REPRESENTA A AMBOS.
	$eval_repre_ambos     = strtoupper($rowapoderado[9]);
	
	# ARMA VARIABLE APODERADO:
	if($nombre_apoderado!='')
	{
		## EVALUA DE QUIEN ES EL APODERADO
		
		if($num_doc_padre == $numdoc_cliente_poder)
		{
			$eval_poder_comparecencia = $client_apoderado.utf8_decode(" PADRE DEL (LOS) MENOR (ES) SEGÚN PODER INSCRITO EN LA PARTIDA ELECTRÓNICA N° ") .$rowpartielec[0]. " DEL REGISTRO DE MANDATOS Y PODERES DE  ".strtoupper($rowpartielec[1]);	
		}
		else if($num_doc_madre == $numdoc_cliente_poder)
		{
			$eval_poder_comparecencia = $client_apoderado.utf8_decode(" MADRE DEL (LOS) MENOR (ES) SEGÚN PODER INSCRITO EN LA PARTIDA ELECTRÓNICA N° ") .$rowpartielec[0]. " DEL REGISTRO DE MANDATOS Y PODERES DE ".strtoupper($rowpartielec[1]);		
		}
		else if($numdoc_cliente_poder == "" && $eval_repre_ambos == "AMBOS")
		{
			$eval_poder_comparecencia = $nombre_padre.utf8_decode(" PADRE DEL (LOS) MENOR (ES) SEGÚN PODER INSCRITO EN LA PARTIDA ELECTRÓNICA N° ") .$rowpartielec[0]. " DEL REGISTRO DE MANDATOS Y PODERES DE ".strtoupper($rowpartielec[1])." Y ".
										$nombre_madre.utf8_decode(" MADRE DEL (LOS) MENOR (ES) SEGÚN PODER INSCRITO EN LA PARTIDA ELECTRÓNICA N° ") .$rowpartielec[0]. " DEL REGISTRO DE MANDATOS Y PODERES DE  ".strtoupper($rowpartielec[1]);		
		}	
		
	$datos_apoderado = "APODERADO(A): ".$nombre_apoderado." QUIEN MANIFIESTA SER DE NACIONALIDAD ".$nacionalidad_apoderado.", ESTADO CIVIL " .$ecivil_apoderado. utf8_decode(", PROFESIÓN Y OCUPACIÓN ") .$profocupa_apoderado. ", DOMICILIAR EN " .$domicilio_apoderado. " ".$ubigeo_apoderado.", SE IDENTIFICA CON ".$tip_doc_apoderado.utf8_decode(" NUMERO ").$num_doc_apoderado.utf8_decode(" Y DECLARA QUE PROCEDE EN REPRESENTACIÓN DE ") .$eval_poder_comparecencia.".";
	# ARMA FIRMA VARIABLE APODERADO
	
		if($rowapoderado[5]=='SI')
			{
			$firma_apoderado = "------------------------------------------".chr(13).chr(10).$nombre_apoderado.chr(13).chr(10).$tip_doc_apoderado.utf8_decode(" N°: ").$num_doc_apoderado ;
			}
		else if($rowapoderado[5]=='NO')
			{
			$firma_apoderado = "" ;
			}	
	
	}
	else {
		$datos_apoderado = "";
		$firma_apoderado = "";
		}
	

################# INICIO EVALUA AL TESTIGOOOOOOOOOOOOOOOOOOOOO ####################################

# $rowtestigo
	$nombre_testigo0        = strtoupper(utf8_decode($rowtestigo[0]));
	$nombre_testigo1	    =str_replace("?","'",$nombre_testigo0);
	$nombre_testigo2	    =str_replace("*","&",$nombre_testigo1);
	$nombre_testigo	  		=strtoupper($nombre_testigo2);
	
	$nacionalidad_testigo   = strtoupper(utf8_decode($rowtestigo[3]));
	$tip_doc_testigo        = $rowtestigo[1];
	$num_doc_testigo        = $rowtestigo[2];
	
	$domicilio_testigo0      = strtoupper(utf8_decode($rowtestigo[4]));
	$domicilio_testigo1	    =str_replace("?","'",$domicilio_testigo0);
	$domicilio_testigo2	    =str_replace("*","&",$domicilio_testigo1);
	$domicilio_testigo	  		=strtoupper($domicilio_testigo2);
	
	$ubigeo_testigo         = strtoupper(utf8_decode($rowtestigo[6]));
	
	$codi_testigo           = strtoupper(utf8_decode($rowtestigo[7]));
	$tipinca_testigo        = strtoupper(utf8_decode($rowtestigo[8]));
	
	$tipinca_testigo        = strtoupper(utf8_decode($rowtestigo[9]));
	
	
	## BUSCA AL ATESTIGUADO:
	$consulatestiguado = mysql_query('SELECT viaje_contratantes.c_descontrat FROM viaje_contratantes
WHERE viaje_contratantes.c_condicontrat != "010" AND viaje_contratantes.id_viaje = "'.$id_viaje.'" AND c_codcontrat = "'.$codi_testigo.'" ', $conn) or die(mysql_error());
$rowatestiguado = mysql_fetch_array($consulatestiguado);

	$nombre_atestiguado     = strtoupper(utf8_decode($rowatestiguado[0]));
	
	$ecivil_testigo    = "" ;
	$profocupa_testigo = "" ;
	
	# ARMA VARIABLE TESTIGO:
	if($nombre_testigo!='')
	{
		
	$datos_testigo = "TESTIGO A RUEGO: ".$nombre_testigo.", QUIEN MANIFIESTA SER DE NACIONALIDAD ".$nacionalidad_testigo.", DE ESTADO CIVIL " .$ecivil_testigo. utf8_decode(", DE PROFESIÓN U OCUPACIÓN ") .$profocupa_testigo. ", DOMICILIAR EN " .$domicilio_testigo." ".$ubigeo_testigo. ", SE IDENTIFICA CON ".$tip_doc_testigo.utf8_decode(" NUMERO ").$num_doc_testigo.", Y DECLARA QUE PROCEDE EN CALIDAD DE TESTIGO A RUEGO DE ".$nombre_atestiguado." POR SER ".$tipinca_testigo;
	# ARMA FIRMA VARIABLE APODERADO
	
		if($rowtestigo[5]=='SI')
			{
			$firma_testigo = "------------------------------------------".chr(13).chr(10).$nombre_testigo.chr(13).chr(10).$tip_doc_testigo.utf8_decode(" N°: ").$num_doc_testigo ;
			}
		else if($rowtestigo[5]=='NO')
			{
			$firma_testigo = "" ;
			}	
	
	}
	else {
		$datos_testigo = "";
		$firma_testigo = "";
		}
	
	
################# FIN    EVALUA AL TESTIGOOOOOOOOOOOOOOOOOOOOO ####################################
	
	
	#DATOS PODER
	$observaciones      = strtoupper(utf8_decode($rowdestino[1]));
	$destino            = strtoupper(utf8_decode($rowdestino[0]));
	
	##EVALUA MULTIPLICIDAD (PADRE Y MADRE)
	$_var_eval_padres = "";
	if($rowmadre[0] == "")
	{
		$_var_eval_padres = " POR LA PRESENTE ACTA EL PADRE MANIFIESTA EXPRESAMENTE QUE AUTORIZA ";	
	}
	if($rowpadre[0] == "" )
	{
		$_var_eval_padres = " POR LA PRESENTE ACTA LA MADRE MANIFIESTA EXPRESAMENTE QUE AUTORIZA ";	
	}
	if($rowmadre[0] != "" && $rowpadre[0] != "" )
	{
		$_var_eval_padres = " POR LA PRESENTE ACTA LOS PADRES MANIFIESTAN EXPRESAMENTE QUE AUTORIZAN ";	
	}
	
//VARIOS MENORES:
$dataMenores = array();

for($i = 0; $i <= $nummenores-1; $i++)
	{
		while($rowmenor = mysql_fetch_array($consulmenor)){
			$contador=mysql_num_rows($rowmenor);
		if($rowmenor[2] == '')
		{
			echo 'Error 03: Falta Ingresar: Menor(es).';
			exit();	
		}
		
		if($rowmenor[0] == "")
		{
			$edad_hijo = "<NO INGRESADO>";  
		}
		else if($rowmenor[0] != "")
		{
			$edad_hijo1			= $rowmenor[0];
			
			$sql=mysql_query("SELECT GROUP_CONCAT(viaje_contratantes.edad) AS edades FROM viaje_contratantes
WHERE viaje_contratantes.c_condicontrat = '002' AND viaje_contratantes.id_viaje = '".$id_viaje."'",$conn);
			
			$filas=mysql_fetch_assoc($sql);
			
			$edad_hijo = strtoupper(utf8_decode($filas['edades']))."AÑOS DE EDAD.";
		}
			$nomre_hijo0 		= $rowmenor[2];
			$nomre_hijo1	    =str_replace("?","'",$nomre_hijo0);
			$nomre_hijo2	    =str_replace("*","&",$nomre_hijo1);
			$nomre_hijo	  		=strtoupper($nomre_hijo2);
			
		$dataMenores[] = array('nom_hijo' => strtoupper(utf8_decode($nomre_hijo)));# CON DESTINO A ".$destino);
		}
	}

	//echo var_dump($dataMenores)."</br>";
	//echo $nummenores;
	//exit();
	

//Carga la plantilla;
	$TBS->LoadTemplate($template);
	
	$TBS->MergeBlock('a', $dataMenores);
	

//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

// utf8_decode()

//Nombre para el archivo a descargar.
    $file_name      = $path_exit.'PViaje'.$id_viaje.$extension;
	$file_name_show = 'PViaje'.$id_viaje.$extension;
	//$file_name = str_replace('.','_'.$suffix.'.',$file_name);
	
    $TBS->Show(TBSZIP_FILE, $file_name);
	
	//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);

	echo "Se genero el archivo: ".$file_name_show." satisfactoriamente..!!";
//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
?>
