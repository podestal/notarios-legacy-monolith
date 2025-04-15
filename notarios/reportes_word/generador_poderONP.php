<?php

// Carga las librerias:
include('../conexion.php');
//include('../extraprotocolares/Config/Config_notario.php');

include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');
include_once('../extraprotocolares/Config/Configuracion.php');
include_once('fecha_letra.php');

include("../phpqrcode/qrlib.php");
$TBS =  new clsTinyButStrong('{,}');
	$TBS->NoErr = true;
// Se cargan las propiedades del PLUGIN
	$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
	$TBS->ResetVarRef(true);
	$TBS->MergeField('var');



## notario :
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO' , UPPER(confinotario.direccion), confinotario.distrito FROM confinotario";
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$muesnotario = strtoupper(utf8_decode($rownum[0]));
$direccion   =  strtoupper(utf8_decode($rownum[1]));
$TBS->VarRef['dist_notario']=strtoupper(utf8_decode($rownum[2]));
##

###########################################
##  SE DEFINE PATH PARA TEMPLATES Y SALIDAS
# 1 Se crea Objetos
$ruta_templates  = new AsignaPath;	
$ruta_archivos   = new AsignaPath;
//$muestra_notario   = new AsignaPath;
# 2. Templates
$path_template   = $ruta_templates->__set_path_template();
# 3. Salida de Data
$path_exit       = $ruta_archivos->__set_path_exit('poderes');

$extension       = $ruta_archivos->__set_tip_output_ep();
###########################################
//$notario = $muestra_notario->notario;
//echo $notario; exit();
//se crea el objeto  ClaseLetras
	$fecha = new ClaseNumeroLetra();

	$dia  = $fecha->fun_fecha_dia(); 
	$mes  = $fecha->fun_fecha_mes();
	$anio = $fecha->fun_fecha_anio();
	
	$id_poderr        = $_REQUEST["id_poder"]; 
	
	$fechitainterior = "SELECT ingreso_poderes.fec_ingreso FROM ingreso_poderes where ingreso_poderes.id_poder='".$id_poderr."'";
	$resulfecha = mysql_query($fechitainterior,$conn) or die(mysql_error());
	$rowviaint = mysql_fetch_array($resulfecha);
	$fechaconv	      = explode('-',$rowviaint[0]);
	$fechaingresovieint  = $fechaconv[2]."/".$fechaconv[1]."/".$fechaconv[0];

	// $TBS->VarRef['fecha_letras_viaext'] = utf8_decode(strtoupper(fechaALetras($fechaingresovieint)));
	
	
	$fec_letras = $fecha->fun_fech_comple(date("Y/m/d"));



	$suffix = '';
	$debug  = '';

	$rutaPlantilla="D:/plantillas/EXTRAPROTOCOLARES/PODER FUERA DE REGISTRO/";


	$template = $rutaPlantilla."COBRO DE PENSION ONP.docx";
// Se verifica que formato de plantilla se usara.
	// $template = $path_template."plantilla_poderONP".$extension;

	#$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Ruta o nombre de la plantilla definido Incorrectamente.");

	$id_poder         = $_REQUEST["id_poder"];        //Num. viaje a exportar.
	//$numcrono2        = substr($num_crono,5,6).'-'.substr($num_crono,0,4);	//Para Mostrar num_crono.
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.

	$queryUsuario = "SELECT loginusuario,
							dni
					FROM usuarios 
					WHERE CONCAT(apepat,' ',prinom)='$usuario_imprime'";
	$executeQuery = mysql_query($queryUsuario);
	$arrUsuario = mysql_fetch_assoc($executeQuery);

	$usuario = $arrUsuario['loginusuario'];
	$dni_usuario = $arrUsuario['dni'];
	$COMPROBANTE = 'sin';


	$nombre_notario   = $muesnotario;       //Nombre del notario.
	$direc_notario	  = $direccion; 		//Direccion del notario.
	$fecha_impresion  = date("d/m/Y");                 //Fecha de impresion.

// #= Consultas 

#########################
##### PODERDANTE ########
$consulpoderdante = mysql_query('SELECT CONCAT(UPPER(cliente.prinom)," ",UPPER(cliente.segnom)," ",UPPER(cliente.apepat)," ",UPPER(cliente.apemat)) AS "NOMBRE_APODERADO", 
UPPER(tipodocumento.td_abrev) AS "TIP_DOC", 
UPPER(cliente.numdoc) AS "NUM_DOC", 
UPPER(tipoestacivil.desestcivil) AS "EST_CIVIL", 
UPPER(nacionalidades.descripcion) AS "NACIONALIDAD", 
UPPER(cliente.direccion) AS "DIRECCION", 
poderes_contratantes.codi_asegurado AS "CODI_ASEGURADO", 
poderes_contratantes.c_fircontrat AS "firma",
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))  AS "UBIGEO",
IF(ISNULL(profesiones.desprofesion),"",profesiones.desprofesion) AS "PROFESION",
UPPER(cliente.sexo) AS "sexo",
UPPER(CONCAT(ct.prinom," ",ct.segnom," ",ct.apepat," ",ct.apemat)) AS nombre_testigo,
UPPER(tdt.td_abrev) AS tipo_documento_tstigo,
UPPER(ct.numdoc) AS numero_documento_testigo,
UPPER(tect.desestcivil) AS estado_civil_testigo,
UPPER(nt.descripcion) AS nacionalidad_testigo, 
UPPER(ct.direccion) AS direccion_testigo,
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))  AS ubigeo_testigo,
ct.sexo AS sexo_testigo,
ct.detaprofesion as ocupacion_testigo
FROM poderes_contratantes 
INNER JOIN cliente ON cliente.numdoc = poderes_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
LEFT JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente.idprofesion
LEFT OUTER JOIN ubigeo ON cliente.idubigeo = ubigeo.coddis
LEFT JOIN poderes_contratantes AS pct ON pct.codi_testigo=poderes_contratantes.c_codcontrat
LEFT JOIN cliente AS ct ON ct.numdoc=pct.c_codcontrat
LEFT JOIN tipodocumento AS tdt ON tdt.idtipdoc = ct.idtipdoc
LEFT JOIN tipoestacivil AS tect ON tect.idestcivil = ct.idestcivil
LEFT JOIN nacionalidades AS nt ON nt.idnacionalidad = ct.nacionalidad
LEFT JOIN ubigeo AS ut ON ut.coddis = ct.idubigeo
WHERE poderes_contratantes.c_condicontrat = "007" AND poderes_contratantes.id_poder = "'.$id_poder.'" ', $conn) or die(mysql_error());
	## $rowpoderdante = mysql_fetch_array($consulpoderdante);

	
#########################	
## APODERADO
$consulrepresenta = mysql_query('SELECT  UPPER(cliente.nombre) AS "NOMBRE_APODERADO", 
UPPER(tipodocumento.td_abrev) AS "TIP_DOC", 
UPPER(cliente.numdoc) AS "NUM_DOC",
 UPPER(tipoestacivil.desestcivil) AS "EST_CIVIL",
UPPER(nacionalidades.descripcion) AS "NACIONALIDAD", 
UPPER(cliente.direccion) AS "DIRECCION" ,
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto )) AS "UBIGEO",
UPPER(cliente.sexo) AS "sexo"
FROM poderes_contratantes 
INNER JOIN cliente ON cliente.numdoc = poderes_contratantes.c_codcontrat
LEFT JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
LEFT OUTER JOIN ubigeo ON cliente.idubigeo = ubigeo.coddis
WHERE poderes_contratantes.c_condicontrat = "006" AND poderes_contratantes.id_poder = "'.$id_poder.'" ', $conn) or die(mysql_error());
	//$rowrepresenta = mysql_fetch_array($consulrepresenta);	
	
	
#########################	
## TESTIGO A RUEGO
$consultestigo = mysql_query('SELECT  UPPER(cliente.nombre) AS "NOMBRE_TESTIGO", UPPER(tipodocumento.destipdoc) AS "TIP_DOC", UPPER(cliente.numdoc) AS "NUM_DOC", UPPER(tipoestacivil.desestcivil) AS "EST_CIVIL", 
UPPER(nacionalidades.descripcion) AS "NACIONALIDAD", UPPER(cliente.direccion) AS "DIRECCION" , atestiguados.nombre AS "ATESTIGUADO", d_tablas.des_item AS "INCAPACIDAD",
UPPER(documents_atesti.destipdoc) AS "TIP_DOC_ATES",  UPPER(atestiguados.numdoc) AS "NUM_DOC_ATES", d_tablas.val_item AS "DES_INCAPACIDAD", poderes_contratantes.c_fircontrat AS "firma"
FROM poderes_contratantes 
INNER JOIN cliente ON cliente.numdoc = poderes_contratantes.c_codcontrat
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente.idtipdoc
LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente.idestcivil
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente.nacionalidad
INNER JOIN cliente atestiguados ON atestiguados.numdoc = poderes_contratantes.codi_testigo
INNER JOIN tipodocumento documents_atesti ON documents_atesti.idtipdoc = atestiguados.idtipdoc
INNER JOIN d_tablas ON d_tablas.num_item = poderes_contratantes.tip_incapacidad AND d_tablas.tip_item = "poder"
WHERE poderes_contratantes.c_condicontrat = "008" AND poderes_contratantes.id_poder = "'.$id_poder.'" ', $conn) or die(mysql_error());
	//$rowtestigo = mysql_fetch_array($consultestigo);	
	$numtestigos =  mysql_num_rows($consultestigo);	

#########################	
###### DATOS PODER ######
$consuldatospoder = mysql_query('SELECT STR_TO_DATE(poderes_pension.p_fecotor,"%d/%m/%Y") AS "FEC_OTORGAMIENTO", poderes_pension.p_fecvcto AS "FEC_VCTO",
poderes_pension.p_pension AS "PRESTACION", poderes_pension.p_presauto AS "PREST_AUTORIZADA"  FROM poderes_pension WHERE poderes_pension.id_poder = "'.$id_poder.'" ', $conn) or die(mysql_error());
	$rowdatospoder = mysql_fetch_array($consuldatospoder);	

##########################
## Verifica num kardex  ##
$consulnumkardex = mysql_query('SELECT ingreso_poderes.num_kardex FROM ingreso_poderes WHERE ingreso_poderes.id_poder = "'.$id_poder.'" ', $conn) or die(mysql_error());
	$rownum_kar = mysql_fetch_array($consulnumkardex);	
	
if($rownum_kar[0] == '')
{
	echo 'Error 01: Falta Generar Nro. Cronologico.';	exit();	
}
else if($rownum_kar[0] != '')
{
	$numcrono2  = utf8_decode(substr($rownum_kar[0],0,4).' - N° '.substr($rownum_kar[0],5,6));	//Para Mostrar num_crono.
}

## EVALUA PARTICIPANTES.
# 1.
$numpoderdante  =  mysql_num_rows($consulpoderdante);

# 2.
$numrepresenta  =  mysql_num_rows($consulrepresenta);

	# PODERDANTES : 
	$dataPoderdantes   = array();
	$firmasPoderdantes = array();
	
	$contadorPoderdante=1;
	for($i=0; $i <= $numpoderdante-1; $i++)
	{
		$rowpoderdante = mysql_fetch_array($consulpoderdante);

		if($contadorPoderdante==1){
			$agregadoPoderdante = '';
		}else{
			$agregadoPoderdante = '_'.$contadorPoderdante;
		}

		if($rowpoderdante[10]=="F"){
			
			if($numpoderdante>1){
				$P_EL = 'Los';
				$EL_P = 'LOS';
				$P_S = 's';
				$S_P = 'S';
				$P_ES_SON = 'SON';
				$P_ES = 'es';
				$P_O_ARON = 'ARON';
				$P_N = 'n';
				$N_P = 'N';
				$P_DEL_A = 'DEL';
				$P_AMBOS = 'Ambos de';
				$P_DEL_LOS = 'de los';
				$P_A_LOS = 'a los';
				$P_O_A = 'AS';
				// $DON_A = utf8_decode('DOÑA');
			}else{
				$P_EL = 'La';
				$EL_P = 'LA';
				$P_S = '';
				$S_P = '';
				$P_ES_SON = 'ES';
				$P_ES = '';
				$P_O_ARON = utf8_decode('Ó');
				$P_N = '';
				$N_P = '';
				$P_DEL_A = 'DE LA';
				$P_AMBOS = 'De';
				$P_DEL_LOS = 'de la';
				$P_A_LOS = 'a la';
				$P_O_A = 'A';
				
			}
		}else if($rowpoderdante[10]=="M"){

			if($conteon3>1){
				$P_EL = 'Los';
				$EL_P = 'LOS';
				$P_S = 's';
				$S_P = 'S';
				$P_ES_SON = 'SON';
				$P_ES = 'es';
				$P_O_ARON = utf8_decode('ARON');
				$P_N = 'n';
				$N_P = 'N';
				$P_DEL_A = 'DEL';
				$P_AMBOS = 'Ambos de';
				$P_DEL_LOS = 'de los';
				$P_A_LOS = 'a los';
				$P_O_A = 'O';
				
			}else{
				$P_EL = 'El';
				$EL_P = 'EL';
				$P_S = '';
				$S_P = '';
				$P_ES_SON = '';
				$ES_P = '';
				$P_O_ARON = utf8_decode('Ó');
				$P_N = '';
				$N_P = 'N';
				$P_DEL_A = 'DEL';
				$P_AMBOS = 'De';
				$P_DEL_LOS = 'del';
				$P_A_LOS = 'al';
				$P_O_A  = 'OS';
				
			}
		}
		
		// Reemplaza (DOCUMENTO NACIONAL DE IDENTIDAD) por (D.N.I.)
		/*
			if($rowpoderdante[1] = "DOCUMENTO NACIONAL DE IDENTIDAD (DNI)") {"";}else {strtoupper($rowpoderdante[1]);}
		*/
				
				$nombre_poderdante0 		= $rowpoderdante[0];
				$nombre_poderdante1	    	=str_replace("?","'",$nombre_poderdante0);
				$nombre_poderdante2	   		=str_replace("*","&",$nombre_poderdante1);
				$nombre_poderdante	  		=strtoupper($nombre_poderdante2);
			
				$direccion_poderdante0 		= $rowpoderdante[5];
				$direccion_poderdante1	    =str_replace("?","'",$direccion_poderdante0);
				$direccion_poderdante2	    =str_replace("*","&",$direccion_poderdante1);
				$direccion_poderdante	  	=strtoupper($direccion_poderdante2);
				
				$ocupacion_poderdante	  	= strtoupper($rowpoderdante[9]);
				$codigo_pensionista		= strtoupper($rowpoderdante[6]);


				$nombreTestigo = strtoupper($rowpoderdante[11]);
				$numeroDocumentoTestigo = strtoupper($rowpoderdante[13]);
				$estadoCivilTestigo = strtoupper($rowpoderdante[14]);
				$nacionalidadTestigo = strtoupper($rowpoderdante[15]);
				$direccionTestigo = strtoupper($rowpoderdante[16]);
				$ubigeoTestigo = strtoupper($rowpoderdante[17]);
				$sexoTestigo = strtoupper($rowpoderdante[18]);
				$ocupacionTestigo = strtoupper($rowpoderdante[19]);
				
				## QQUEDA :
				

				if($rowpoderdante[10]=='F'){
					
					$estadoCivil= substr($rowpoderdante[3],0,-1).'A';
					$nacionalidad = substr($rowpoderdante[4],0,-1).'A';
					$identificado = 'identificada con DNI '.utf8_decode('N°');
				}
				if($rowpoderdante[10]=='M'){
					$estadoCivil = $rowpoderdante[3];
					$nacionalidad = substr($rowpoderdante[4],0,-1).'O';
					$identificado = 'identificado con DNI '.utf8_decode('N°');
				}
				if($sexoTestigo=='F'){
					$identificadoTestigo = 'identificada con DNI '.utf8_decode('N°');
				
				}else if($sexoTestigo=='M'){
					$identificadoTestigo = 'identificado con DNI '.utf8_decode('N°');
				}
				
				$dataPoderdantes['poderdantes'][] = array(
					'P_NOM'.$agregadoPoderdante=> $nombre_poderdante,
					'P_IDE'.$agregadoPoderdante=> $identificado,
					'P_DOC'.$agregadoPoderdante=> $rowpoderdante[2],
					'P_NACIONALIDAD'.$agregadoPoderdante=> $nacionalidad,
					'P_OCUPACION'.$agregadoPoderdante=> $ocupacion_poderdante,
					'P_ESTADO_CIVIL'.$agregadoPoderdante=> 'quien declara ser '.$estadoCivil,
					'P_DOMICILIO'.$agregadoPoderdante=> 'con domicilio en '. $rowpoderdante[5].', del '.$rowpoderdante[8],
					'P_SEXO'.$agregadoPoderdante=> $rowpoderdante[10],
					'P_EDAD'.$agregadoPoderdante=> 'mayor de edad',
			
					'T_INTERVIENE'.$agregadoPoderdante=> 'Interviene:',
					'T_NOM'.$agregadoPoderdante=> $nombreTestigo,
					'T_IDE'.$agregadoPoderdante=> $identificadoTestigo,
					'T_DOC'.$agregadoPoderdante=> $numeroDocumentoTestigo,
					'T_NACIONALIDAD'.$agregadoPoderdante=> $nacionalidadTestigo,
					'T_OCUPACION'.$agregadoPoderdante=> $ocupacionTestigo,
					'T_ESTADO_CIVIL'.$agregadoPoderdante=> 'quien declara ser '.$estadoCivilTestigo,
					'T_DOMICILIO'.$agregadoPoderdante=> 'con domicilio en '. $direccionTestigo.', del '.$ubigeoTestigo,
					'T_SEXO'.$agregadoPoderdante=> $sexoTestigo,
					'T_CALIDAD'.$agregadoPoderdante=> 'quien interviene en calidad de testigo a ruego',
				);
				
			
		if($rowpoderdante[7]=="SI")
		{	
			# ARMA FIRMA PODERDANTE
				$firmasPoderdantes[] = array('firma_poderdante'=> "------------------------------------------".chr(13).chr(10).strtoupper(utf8_decode($nombre_poderdante)).chr(13).chr(10).strtoupper($rowpoderdante[1]).utf8_decode(" N°: ").strtoupper($rowpoderdante[2]).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10));
		
		}
		
		$contadorPoderdante++;
		
	}
	
	/*
		[onshow.poderdante], IDENTIFICADO CON [onshow.tip_doc] N° [onshow.num_doc], QUIEN MANIFIESTA SER DE ESTADO CIVIL [onshow.est_civil], DE NACIONALIDAD [onshow.nacionalidad], CON DOMICILIO REAL EN [onshow.domicilio], CON CÓDIGO DE PENSIONISTA Nº [onshow.seguro].
	*/
	
	#APODERADO
	/*
	$apoderado        = utf8_decode(strtoupper($rowrepresenta[0]));
	$tdoc_apoderado   = strtoupper($rowrepresenta[1]);
	$doc_apoderado    = strtoupper($rowrepresenta[2]);
	$domi_apoderado   = utf8_decode(strtoupper($rowrepresenta[5]));
	*/
	
	
	#APODERADOS :
	$dataApoderados = array();
	for($i=0; $i <= $numrepresenta-1; $i++)
	{
		$rowrepresenta = mysql_fetch_array($consulrepresenta);
		
				$nombre_repre0 			= $rowrepresenta[0];
				$nombre_repre1	    	=str_replace("?","'",$nombre_repre0);
				$nombre_repre2	   		=str_replace("*","&",$nombre_repre1);
				$nombre_repre	  		=strtoupper($nombre_repre2);
		
		
				$dire_repre0 			= $rowrepresenta[5];
				$dire_repre1	    	=str_replace("?","'",$dire_repre0);
				$dire_repre2	   		=str_replace("*","&",$dire_repre1);
				$dire_repre	  			=strtoupper($dire_repre2);
				
		// $dataApoderados[] = array('datos_apoderado'=> strtoupper(utf8_decode($nombre_repre))." IDENTIFICADO CON ".strtoupper($rowrepresenta[1]).utf8_decode(" NUMERO ").strtoupper($rowrepresenta[2])." DOMICILIADO EN ".strtoupper(utf8_decode($dire_repre))." ".strtoupper(utf8_decode($rowrepresenta[6]))  )	;

		if($rowrepresenta[7]=='F'){
			$documentoIdentidad = 'IDENTIFICADA CON '.strtoupper($rowrepresenta[1]).utf8_decode(" N° ").strtoupper(utf8_decode($rowrepresenta[2])).', ';
			$coa = 'a';
		}
		if($rowrepresenta[7]=='M'){
			$documentoIdentidad = 'IDENTIFICADO CON '.strtoupper($rowrepresenta[1]).utf8_decode(" N° ").strtoupper(utf8_decode($rowrepresenta[2])).', ';
			$coa = 'o';
		}
		$dataApoderados[] = array(
			'C_NOM'=>strtoupper(utf8_decode($nombre_repre)).', ',
			'C_DOC'=>$documentoIdentidad,
			'C_IDE'=>'',
			'C_O_A'=>$coa,
		);
	}
	
	/*
		[onshow.apoderado] IDENTIFICADO CON [onshow.tdoc_apoderado] N° [onshow.doc_apoderado] DOMICILIADO EN [onshow.domi_apoderado],.
	*/
	
	#TESTIGOS:
	$dataTestigos = array();
	$firmasTestigos = array();
	
	for($i = 0; $i <= $numtestigos-1; $i++)
	{
		$rowtestigo = mysql_fetch_array($consultestigo);
		
		
				$nombre_testigoo0 			= $rowtestigo[0];
				$nombre_testigoo1	    	=str_replace("?","'",$nombre_testigoo0);
				$nombre_testigoo2	   		=str_replace("*","&",$nombre_testigoo1);
				$nombre_testigoo	  		=strtoupper($nombre_testigoo2);
		
		
				
			$dataTestigos[] = array('datos_testigo' =>"INTERVIENE ". strtoupper(utf8_decode($nombre_testigoo))." IDENTIFICADO CON ".strtoupper($rowtestigo[8])." NUMERO ".strtoupper($rowtestigo[2])." EN CALIDAD DE TESTIGO A RUEGO DE ".strtoupper(utf8_decode($rowtestigo[6]))." POR ENCONTRARSE ".strtoupper($rowtestigo[10]) );
			
			if($rowtestigo[11]=='SI')
			{
				# ARMA FIRMA TESTIGO
				$firmasTestigos[] = array('firma_testigo'=> "------------------------------------------".chr(13).chr(10).strtoupper(utf8_decode($nombre_poderdante)).chr(13).chr(10).strtoupper($rowpoderdante[1]).utf8_decode(" N°: ").strtoupper($rowpoderdante[2]).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10)."------------------------------------------".chr(13).chr(10).strtoupper(utf8_decode($rowtestigo[0])).chr(13).chr(10).strtoupper($rowtestigo[8]).": ".strtoupper($rowtestigo[2]).chr(13).chr(10).chr(13).chr(10).chr(13).chr(10));
			}

	}	
	//echo var_dump($dataTestigos)."</br>";
	//echo $numtestigos;
	//exit();
/*
		   [nom_testigo]			     [tipdoc_testigo][numdoc_testigo]							 [nom_atestiguado]					     [des_imposibilitado]
INTERVIENE [LUIS VELASQUEZ HERRERA] IDENTIFICADO CON [DNI] Nº[09999999] EN CALIDAD DE TESTIGO A RUEGO DE [CARLOS LLONTOP VILLAR] POR ENCONTRARSE [IMPOSIBILITADO FISICAMENTE DE FIRMAR]
*/	
	#DATOS PODER
	$emision2         = strtoupper(utf8_decode($rowdatospoder[0]));
	$prestacion       = strtoupper(utf8_decode($rowdatospoder[3])); #2
	$vigencia_fin     = strtoupper($rowdatospoder[1]);

	// PRESTACIÓN AUTORIZADA: 
	$prest_autorizada     = strtoupper($rowdatospoder[3]);
	
	// $emision = utf8_decode($fecha->fun_fech_comple2($emision2));
	$emision = utf8_decode($fecha->fun_fech_letras($emision2));

//qr
$sqlpoder = mysql_query('SELECT I.id_poder ,
I.num_kardex ,
IF(DATE_FORMAT(I.fec_ingreso,"%d-%m-%Y")="00-00-0000","",DATE_FORMAT(I.fec_ingreso,"%d/%m/%Y")) AS fec_ingreso,
IF(DATE_FORMAT(I.fec_crono,"%d-%m-%Y")="00-00-0000","",DATE_FORMAT(I.fec_crono,"%d/%m/%Y")) AS fecha_crono,
I.id_asunto,
I.swt_est AS estado,
I.num_formu,
P.p_pension as monto,
P.p_plazopoder AS poderplazo,
P.p_fecotor AS fechaemision,
P.p_fecvcto AS fechavencimiento,
P.p_presauto AS codigoprestamista
FROM ingreso_poderes I
INNER JOIN poderes_pension P ON P.id_poder =  I.id_poder  WHERE I.id_poder ="'.$id_poder.'"', $conn) or die(mysql_error());

$arr_viaje[]=array();
$poder = mysql_fetch_array($sqlpoder);
	$arr_viaje[0] = $poder["id_poder"]; 
	$arr_viaje[1] = $poder["num_kardex"]; 
	$arr_viaje[2] = $poder["fec_ingreso"]; 
	$arr_viaje[3] = $poder["fecha_crono"]; 
	$arr_viaje[4] = $poder["id_asunto"]; 
	$arr_viaje[5] = $poder["estado"]; 
	$arr_viaje[6] = $poder["num_formu"]; 
	$arr_viaje[7] = $poder["monto"]; 
	$arr_viaje[8] = $poder["poderplazo"]; 
	$arr_viaje[9] = $poder["fechaemision"]; 
	$arr_viaje[10] = $poder["fechavencimiento"]; 
	$arr_viaje[11] = $poder["codigoprestamista"]; 
	
	//JSON
         $objPermisoViaje = new stdClass();
		 $objPermisoViaje->codigotipoinstrumento = 108;
		 $objPermisoViaje->codigoinstrumento = 286; 
		 $objPermisoViaje->codigonotaria ="143";
		 $objPermisoViaje->fecharegistro =$arr_viaje[2];
		 $objPermisoViaje->fechainstrumento =  $arr_viaje[3]; 
		 $objPermisoViaje->numerocontrol =  $arr_viaje[0];
		 $objPermisoViaje->numeroformulario =$arr_viaje[6];
		 $objPermisoViaje->cronologico = $arr_viaje[1];
		 $objPermisoViaje->observacion = "";
		 $objPermisoViaje->fechaemision =  $arr_viaje[9];
		 $objPermisoViaje->fechavencimiento = $arr_viaje[10];
		 $objPermisoViaje->poderplazo = $arr_viaje[8];
		 $objPermisoViaje->concepto = "";
		 $objPermisoViaje->monto = $arr_viaje[7];
		 $objPermisoViaje->codigoasegurado = "";
		 $objPermisoViaje->prestacionautorizada = "";
		 $objPermisoViaje->codigoprestamista = $arr_viaje[11];
	    $objPermisoViaje->solicita = "";
		

		 
		
		 $consultapar = mysql_query('SELECT (CASE
		 WHEN P.c_condicontrat = 008 THEN "18" 
		 WHEN P.c_condicontrat = 009 THEN "16" 
		 WHEN P.c_condicontrat = 011 THEN "06" 
		 WHEN P.c_condicontrat = 006 THEN "07"
		 WHEN P.c_condicontrat = 007 THEN "17" 
	 END) AS campo,P.c_fircontrat,P.c_codcontrat,C.apepat,C.`apemat`, C.`prinom` , C.`idtipdoc`,C.`direccion`,SUBSTRING(C.`docpaisemi`, 1, 3) segundo,C.`email` 
			  ,C.`telcel` , C.`cumpclie`, U.nomdis, U.nomprov,U.nomdpto FROM poderes_contratantes P
				 INNER JOIN cliente C ON C.`numdoc`= P.c_codcontrat 
				 INNER JOIN ubigeo U ON U.coddis = C.`idubigeo` WHERE  P.id_poder ="'.$id_poder.'"', $conn) or die(mysql_error());
			$objParticipante = new stdClass();

			$datos = array();
		while($row3 = mysql_fetch_array($consultapar)){
		
			$objParticipante->condicion = $row3[0];
			$objParticipante->tipodocumento = '0'.$row3[6];
			$objParticipante->documento = $row3[2];
			$objParticipante->nombres = $row3[5];
			$objParticipante->apellidopaterno = $row3[3];
			$objParticipante->apellidomaterno = $row3[4];
			$objParticipante->direccion = $row3[7];
			$objParticipante->correo = $row3[9];
			$objParticipante->telefono = $row3[10];
			$objParticipante->nacionalidad = $row3[8];
			$objParticipante->departamento =  $row3[14];
			$objParticipante->provincia =  $row3[13];
			$objParticipante->distrito =  $row3[12];
			$objParticipante->observacion = '';

			$datos[] = array('condicion'=> $objParticipante->condicion, 'tipodocumento'=>$objParticipante->tipodocumento,
			'documento'=>$objParticipante->documento,'nombres'=>$objParticipante->nombres,'apellidopaterno'=>$objParticipante->apellidopaterno,
			'apellidomaterno'=>$objParticipante->apellidomaterno,'direccion'=>$objParticipante->direccion,'correo'=>$objParticipante->correo,
			'telefono'=>$objParticipante->telefono,'nacionalidad'=>$objParticipante->nacionalidad,
			'departamento'=>$objParticipante->departamento,'provincia'=>$objParticipante->provincia
			,'distrito'=>$objParticipante->distrito,'observacion'=>$objParticipante->observacion);
		}
		 
		 $objPermisoViaje->participantes  = $datos; 
		 // echo json_encode($objPermisoViaje);
		$objJson  = new stdClass();
		$objPermiViaje = new  stdClass();
		$objPermiViaje->ppoder = $objPermisoViaje;
		$objJson->ppoder = $objPermisoViaje;
		//$objJson->json = $objPermiViaje;
		$dataJson =  $objJson;
		$dataJson =  json_encode(array($objPermisoViaje));
		$std = new stdClass();
		$std->ppoder = $objPermisoViaje;
		$json = json_encode($std);
		$data = array("poderes" => $objPermisoViaje);
		$versiones = array(
			"poderes" => $objPermisoViaje
		);
		$myJSON = json_encode($versiones);

		$dataJson = json_encode(array("json" => $myJSON));
		
/*
		var_dump($myJSON);
		 die();
*/

		//define('WS_ENVIAR_DOCUMENTO','http://192.168.250.45/serviceqr/public/api/poderes');
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, WS_ENVIAR_DOCUMENTO);  
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_POST,true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: '.strlen($dataJson)));
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, true);
		$responseString = curl_exec ($ch); 

		$objResponse = json_decode($responseString, true);

/*
		var_dump($objResponse);
		die();*/

		

		$codigonuevo=$objResponse['instrumento']['codigoencriptado'];
		
		//var_dump ($arr_resp[0]);
		$TBS->VarRef['codigonuevo'] = $codigonuevo;
		
		if(count($objResponse['error'])>0){
			$erroresnew='';
			for ($i = 0; $i < count($objResponse['error']); $i++) {
				$arr_resp[$i]=$objResponse['error'][$i];
				$erroresnew = $erroresnew."\n".$arr_resp[$i];
			}
			echo "Error'.$erroresnew.' ";
			die();

		}else {

			$dir = 'tempo1/';
			//Si no existe la carpeta la creamos
			if (!file_exists($dir))
				mkdir($dir);
				//Declaramos la ruta y nombre del archivo a generar
			$filename = $dir.'ONP'.$arr_viaje[0] .'.png';
			$img='ONP'.$arr_viaje[0] .'.png';
				//Parametros de Condiguración
			$tamaño = 10; //Tamaño de Pixel
			$level = 'L'; //Precisión Baja
			$framSize = 3; //Tamaño en blanco
			$contenido =$objResponse['hash']; //Texto
				//Enviamos los parametros a la Función para generar código QR 
			QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
			//Mostramos la imagen generada
			//echo '<img src="'.$dir.basename($filename).'" /><hr/>'; 
			$imagen =$dir.basename($filename); 
			$ruta1 = getcwd().'\\tempo1\\';
			$ruta = $ruta1.$img;
			$TBS->VarRef['test'] =  $ruta;

	// print_r($dataPoderdantes);return false;
	$contratantesApoderados=array();
	foreach($dataPoderdantes['poderdantes'] as $key => $value){ 
		$contratantesApoderados += $value;
	}
	$dataDocumentoWord[]  = $contratantesApoderados;
//Carga la plantilla;
	$TBS->LoadTemplate($template);
	
	$TBS->MergeBlock('a', $dataTestigos);
	$TBS->MergeBlock('b', $dataApoderados);
	$TBS->MergeBlock('c', $dataPoderdantes);
	$TBS->MergeBlock('E', $dataDocumentoWord);
	$TBS->MergeBlock('d', $firmasPoderdantes);
	$TBS->MergeBlock('e', $firmasTestigos);
	

	

//Si existen comentios en la plantilla los oculta.

$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);
$TBS->PlugIn(OPENTBS_CHANGE_PICTURE, 'descripcionImagen', $ruta);
//Nombre para el archivo a descargar.

	$anioKardex = substr($rownum_kar[0],0,4);
	
	if(!file_exists($path_exit.$anioKardex)){
		mkdir($path_exit.$anioKardex,0700);
	}

	$file_name = $path_exit.$anioKardex.'/__PODER__'.$id_poder.'-'.$anioKardex.'.docx';
	$file_name_show = '__PODER__'.$id_poder.'-'.$anioKardex.'.docx';
    // $file_name      = $path_exit.'Poder'.$id_poder.$extension;
	// $file_name_show = 'Poder'.$id_poder.$extension;
	//$file_name = str_replace('.','_'.$suffix.'.',$file_name);
	
	
	$TBS->Show(TBSZIP_FILE, $file_name);
	
	//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
#}
	echo "Se genero el archivo: ".$file_name_show." satisfactoriamente..!!";
//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
		}
?>
