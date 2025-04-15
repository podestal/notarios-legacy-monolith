<?php

// Carga las librerias:
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');

## notario :
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO' , confinotario.direccion, confinotario.distrito FROM confinotario";
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum = mysql_fetch_array($numcartabus);
$muesnotario = $rownum[0];
$direccion   =  strtoupper($rownum[1]);
$distrito_notario   =  strtoupper($rownum[2]);
##

//se crea el objeto  ClaseLetras
	$fecha = new ClaseNumeroLetra();
	$fec_firma = new ClaseNumeroLetra();

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
	//$template = "plantilla_123.odt";
	$template = "plantilla_protocolar_audiencia.odt";

	$template = basename($template);
	$x = pathinfo($template);
	$template_ext  = $x['extension'];
	$template_name = $x['basename'];
	if (!file_exists($template)) exit("Archivo no existe.");

	$num_kardex       = $_REQUEST["num_kardex"];        //Num. kardex a exportar.
	//$idtipoacto       = $_REQUEST["idtipoacto"];        //Id del tipo de acto.
	
	//$numcrono2        = substr($num_crono,5,6).'-'.substr($num_crono,0,4);	//Para Mostrar num_crono.
	$usuario_imprime  = $_REQUEST["usuario_imprime"];  //Nombre del usuario que imprime.
	$nom_notario      = $muesnotario;       //Nombre del notario.
	$num_doc      	  = $_REQUEST["num_doc"];           //numero documento notario
	$reg_contrib      = $_REQUEST["reg_contrib"];       //registro unico de contribuyentes.
	$num_doc2      	  = $_REQUEST["num_doc2"];           //numero libreta militar
	$direc_notario	  = $direccion; 		//Direccion del notario.
	$fecha_impresion  = date("d/m/Y");                 //Fecha de impresion.
	
	

//Consulta segun parametro enviado:

######################
## Cabecera Datos I ##

$consulcabecera1 = mysql_query('select kardex.numescritura as "escritura", kardex.kardex as "num_kardex" 
from kardex where kardex.kardex =  "'.$num_kardex.'" ', $conn) or die(mysql_error());
	$rowcabecera1 = mysql_fetch_array($consulcabecera1);

######################################
## Obtener Referencia y Contrato(s) ##

$consulcabecera2 = mysql_query('SELECT kardex.referencia AS "referencia", kardex.contrato AS "contrato"
FROM kardex WHERE kardex.kardex =   "'.$num_kardex.'" ', $conn) or die(mysql_error());
	$rowcabecera2 = mysql_fetch_array($consulcabecera2);

######################################


######################################
## Obtener Folios y Papel ini y fin  ##

$consulfolio = mysql_query('select kardex.folioini, kardex.foliofin, kardex.papelini, kardex.papelfin
from kardex where kardex.kardex = "'.$num_kardex.'" ', $conn) or die(mysql_error());
	$rowfolio = mysql_fetch_array($consulfolio);

######################################
######################################


######################
## Contratantes     ##

## PERSONA NATURAL. ##
## Objeto para naturales.
$consulcontratantes = mysql_query('SELECT DISTINCT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.idcontratante,
cliente2.nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu",
cliente2.numdoc , (CASE WHEN(cliente2.idprofesion<>"0") THEN profesiones.desprofesion ELSE ""  END) AS "Ocupacion", 
tipoestacivil.desestcivil AS "ecivil", cliente2.direccion,  (CASE WHEN ISNULL(ubigeo.nomdis) THEN "" ELSE ubigeo.nomdis  END) AS "Distrito"  , cliente2.sexo AS "sexo" ,cliente2.tipper,
contratantesxacto.uif
FROM contratantesxacto
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente2.idprofesion
LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND cliente2.tipper="N"', $conn) or die(mysql_error());
##WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND contratantesxacto.idtipoacto = "'.$idtipoacto.'" ', $conn) or die(mysql_error());

	//$rowcontratantes =  mysql_fetch_array($consulcontratantes);

## Objeto para juridicas.
#######################
$consulcontratantes5 = mysql_query('SELECT DISTINCT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.idcontratante,
cliente2.nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu",
cliente2.numdoc , (CASE WHEN(cliente2.idprofesion<>"0") THEN profesiones.desprofesion ELSE ""  END) AS "Ocupacion", 
tipoestacivil.desestcivil AS "ecivil", cliente2.direccion,  (CASE WHEN ISNULL(ubigeo.nomdis) THEN "" ELSE ubigeo.nomdis  END) AS "Distrito"  , cliente2.sexo AS "sexo" ,cliente2.tipper
FROM contratantesxacto
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente2.idprofesion
LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND cliente2.tipper="N" ', $conn) or die(mysql_error());
###########################
	
	
## NUMERO DE CONTRATANTES (NATURAL Y JURIDICOS)
$consulnumcontrat = mysql_query('SELECT DISTINCT cliente2.idcliente FROM contratantesxacto 
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
WHERE kardex=  "'.$num_kardex.'" ', $conn) or die(mysql_error());

$numcontratantes =  mysql_num_rows($consulnumcontrat);	

//$rowcontratantes =  mysql_fetch_array($consulcontratantes);
	
## PERSONA JURIDICA. ##
$consuljuridica = mysql_query('SELECT DISTINCT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.idcontratante,
cliente2.razonsocial, (CASE WHEN ISNULL(nacionalidades.descripcion) THEN "23" ELSE nacionalidades.descripcion END) AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu",
cliente2.numdoc, cliente2.domfiscal AS "direccion",  ubigeo.nomdis AS "Distrito" , cliente2.actmunicipal, cliente2.tipper, cliente2.numpartida
FROM contratantesxacto
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
LEFT OUTER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
left outer join ubigeo ON ubigeo.coddis = cliente2.idubigeo
WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND cliente2.tipper="J" ', $conn) or die(mysql_error());
##WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND contratantesxacto.idtipoacto = "'.$idtipoacto.'" ', $conn) or die(mysql_error());

	//$rowjuridica =  mysql_fetch_array($consuljuridica);
	$numjuridica =  mysql_num_rows($consuljuridica);	
	
########################

## FECHA DE CONCLUSION
$consulfecconclu = mysql_query('SELECT DATE_FORMAT(STR_TO_DATE(kardex.fechaconclusion,"%d/%m/%Y"),"%Y/%m/%d") FROM kardex WHERE kardex.kardex = "'.$num_kardex.'" ', $conn) or die(mysql_error());

$numfecconlusion =  mysql_num_rows($consulfecconclu);
$rowfecconlusion =  mysql_fetch_array($consulfecconclu);	

if($numfecconlusion == 0)
{
	$fec_conclusion  =  " ";
}
else if($numfecconlusion > 0)
{ 
    $fec_conclusion = $fec_firma->fun_fech_letras($rowfecconlusion[0]);
}

//Definicion de las variables para llenar la plantilla dinamicamente
// # cabecera I
	$num_escritura    = $rowcabecera1[0];
	$num_kardex       = $rowcabecera1[1];
	$num_reg          = "1"; #$rowcabecera1[2];
	
// # cabecera II
	$contrato         = strtoupper($rowcabecera2[1]);
	$referencia       =strtoupper($rowcabecera2[0]);

// # Contratantes 
	$nom_contratante  = $rowcontratantes[3];
	$nacionalidad     = $rowcontratantes[4];
	$numdoc_contrat   = $rowcontratantes[6];
	$ocupacion        = $rowcontratantes[7];
	$est_civil        = $rowcontratantes[8];
	$domicilio        = $rowcontratantes[9];
	$nom_distrito     = $rowcontratantes[10];
	$cont_sexo        = $rowcontratantes[11];

// # Datos adicionales
#1. dependiendo el numero:

if($numcontratantes==0)
{
	echo '<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		  <title>Impresion</title>
       	  </head>
		  <body><center>
		  Falta Ingresar: Contratantes.</br>'; 
	echo '<a href="#" onclick="javascript:self.close();">Cerrar ventana</a>';
	echo '</center></body></html>';
	exit();	}

else if($numcontratantes==1)
{
	$evalnumcon = "EL(ELLA)";
	$evalotor   = "EL(LA) OTORGANTE";	
}
else if($numcontratantes>1)
{
	$evalnumcon = "ELLOS";
	$evalotor   = "LOS OTORGANTES";	
}

// # Folio:
	$folioini         = $rowfolio[1];
	$foliofin         = $rowfolio[0];


	
//# referencia_contratantes

	$referencia_contratantes= " ";
	
############################################################
###################### EVALUA LA MINUTA: ###################

#Se escoge el disco:
$disk      = "C:/";
#Se escoge la carpeta base:
$mainfile  = "minutas/";
#Se escoge nombre archivo:
$archivo = $num_kardex.".docx"; 

//$archivo = $num_kardex.".odt";
//$archivo = $num_kardex.".txt";
$ruta =  $disk.$mainfile;

$varwordx = $ruta.$archivo.".docx";
$varword  = $ruta.$archivo.".doc";
$varodt   = $ruta.$archivo.".odt";


/*if (isset($varwordx) && is_null($varword) && is_null($varodt))
{
	$archivo_ruta = $varwordx;
}
else if(isset($varword) && is_null($varwordx) && is_null($varodt))
{
	$archivo_ruta = $varword;	
}
else if(isset($varodt) && is_null($varwordx) && is_null($varword))
{
	$archivo_ruta = $varodt;	
}
*/

$fp = fopen($ruta.$archivo, 'r'); 
$contents = fread($fp, filesize($ruta.$archivo)); 

######## WORD ##########
$archivo_ruta = $ruta.$archivo;
function docx2text($filename) {
   return readZippedXML($filename, "word/document.xml");
 }

function readZippedXML($archiveFile, $dataFile) {
// se crea archivo ZIP
$zip = new ZipArchive;

// abrir archivo
if (true === $zip->open($archiveFile)) {
    // si existe busca la data en el archivo
    if (($index = $zip->locateName($dataFile)) !== false) {
        // si encuentra la convierte a cadena
        $data = $zip->getFromIndex($index);
        // cierra el archivo
        $zip->close();
        // carga el XML dela cadena
        // pasa errores y alertas
        $xml = DOMDocument::loadXML($data, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
        // retorna la data sin etiquetas de formato XML 
        return strip_tags($xml->saveXML());
    }
    $zip->close();
}

// En caso de que falle retorna una cadena vacia
return "";
}
########################

$contents2 = utf8_decode(docx2text($archivo_ruta));

if($contents=="")
{
	//echo "No existe el archivo: ".$archivo;
	//exit();
$contents2="No se ha definido la minuta";	
}

################################################################################################################################
############################################## DEFINICION Y CARGA DE LOS INSERTOS ##############################################

$diskinserto              = "C:/";
$mainfile_inserto         = "insertos/";
#Se escoge nombre archivo:
$archivo_inserto = $num_kardex.".docx"; 

$ruta_inserto =  $diskinserto.$mainfile_inserto;

$fp = fopen($ruta.$archivo, 'r'); 
$contents = fread($fp, filesize($ruta.$archivo)); 

######## WORD ##########
$archivo_ruta = $ruta.$archivo;

//$contents2 = utf8_decode(docx2text($archivo_ruta));

//if($contents=="")
//{$contents2="No se ha definido la minuta";	}

##### BUSQUEDA DE LOS INSERTOS
$busca_insertos = mysql_query('SELECT insertos FROM kardex WHERE kardex.kardex = "'.$num_kardex.'" ', $conn) or die(mysql_error());
$row_inserto =  mysql_fetch_array($busca_insertos);
	
$values = explode(",",$row_inserto[0]);	

$num_insertos =  substr_count($row_inserto[0], ',');


$todos_insertos = array();
for($i=0;$i<=$num_insertos-1;$i++)
	{
		trim($values[$i].".docx");
		$fp = fopen($ruta.$archivo, 'r'); 
		$contents_inserto  = fread($fp, filesize($ruta_inserto.trim($values[$i]).".docx")); 
		$contents2_inserto = strtoupper(utf8_decode(docx2text($ruta_inserto.trim($values[$i]).".docx")));
			if($contents2_inserto=="")
				{
					$contents2_inserto="";	
				}
	//echo $contents2_inserto.chr(13).chr(10);	
	//$todos_insertos[] = array('data_insertos_todo' => $contents2_inserto);
	$data_insertar .= $contents2_inserto.chr(13).chr(10);
	}
	//echo var_dump($todos_insertos);
	//exit();
	if($data_insertar=="")
	{$data_insertar = "";}
############################################## DEFINICION Y CARGA DE LOS INSERTOS ##############################################
################################################################################################################################


//echo "contenido: ".$contents."</br>".$ruta.$archivo;
//exit();

############################################################
############################################################

// Evalua el numero de datos:

$dataContratantes = array();
$dataContratantes2 = array();
$dataRepresentantes2 = array();

// Evalua multiplicidad de representantes para una empresa
$dataRepresentantes = array();
		$consultrepre = mysql_query('SELECT contratantes.idcontratante FROM contratantes WHERE contratantes.kardex = "'.$num_kardex.'" AND contratantes.tiporepresentacion != "1"', $conn) or die(mysql_error());
		
for($i = 0; $i <= $numcontratantes-1; $i++)
	{
		
		$rowcontratantes =  mysql_fetch_array($consulcontratantes);
		$rowrept =  mysql_fetch_array($consultrepre);	
		
		//echo $rowcontratantes[2];exit();
		#busca conyuge:
		$consulconyuge1 = mysql_query('SELECT cliente.nombre AS "conyuge" FROM cliente WHERE idcliente = (SELECT cliente2.conyuge FROM cliente2 WHERE idcontratante =  "'.$rowcontratantes[2].'") ', $conn) or die(mysql_error());
	    $rowconyuge1 = mysql_fetch_array($consulconyuge1);
		//echo $rowconyuge1[0]; exit();
		//evalua conyuge:
		if($rowconyuge1 != "")
		{
			$nom_conyuge      = strtoupper(utf8_decode($rowconyuge1[0]));
			$formaconyuge     = "CON ".strtoupper(utf8_decode($rowconyuge1[0]));
		}
	
		else if($rowconyuge1=="")
		{
			$nom_conyuge      = "";
			$formaconyuge     = "";
		}
		
		//evalua sexo:
		if($rowcontratantes[11]=="M")
		{
			$evalsexo = "DON";	
		}
		else if($rowcontratantes[11]=="F")
		{
			$evalsexo = utf8_decode("DOÑA");
		}
		
		//evalua ocupacion:
		if($rowcontratantes[7]=="")
		{
			$evalocupacion = "NO ESPECIFICA";	
		}
		else if($rowcontratantes[7]!="")
		{
			$evalocupacion = utf8_decode($rowcontratantes[7]);	
		}
		
		
		if( $rowcontratantes[8]=="CASADO")
		{
			if($rowcontratantes[11]=="F"){
			$esposa = strtoupper(utf8_decode($rowcontratantes[3]));}
		}
		if( $rowcontratantes[8]=="CASADO")
		{
			if($rowcontratantes[11]=="M"){
			$esposo = strtoupper(utf8_decode($rowcontratantes[3]));}
		}
		
		
		if($rowcontratantes[12]=='N')
		{
		$evalua_rept = utf8_decode($rowrept[0]);
		$evalrepresentante = $rowcontratantes[2];
		
		if(($evalrepresentante == $evalua_rept) && ($evalua_rept != ""))
		{
				if($rowcontratantes[13]!='INT')
			{
			
	$dataContratantes2[] = array('nom_contratante'=>$evalsexo." ".strtoupper(utf8_decode($rowcontratantes[3])).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".$rowcontratantes[4].", DE ESTADO CIVIL ".$rowcontratantes[8]." ".utf8_decode($formaconyuge).", DE OCUPACION Y/O PROFESION".utf8_decode($evalocupacion).", DOMICILIAR EN ".utf8_decode($rowcontratantes[9]).", DISTRITO DE ".utf8_decode($rowcontratantes[10]).", PROVINCIA Y DEPARTAMENTO DE LIMA SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO ".$rowcontratantes[6]."Y DECLARA QUE PROCEDE POR DERECHO PROPIO ", 'nom_firma'=>strtoupper(utf8_decode($rowcontratantes[3])));	

	$dataContratantes[] = array('nom_contratante'=>$evalsexo." ".strtoupper(utf8_decode($rowcontratantes[3])).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".$rowcontratantes[4].", DE ESTADO CIVIL ".$rowcontratantes[8]." ".utf8_decode($formaconyuge).", DE OCUPACION Y/O PROFESION".utf8_decode($evalocupacion).", DOMICILIAR EN ".utf8_decode($rowcontratantes[9]).", DISTRITO DE ".utf8_decode($rowcontratantes[10]).", PROVINCIA Y DEPARTAMENTO DE LIMA SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO ".$rowcontratantes[6]."Y DECLARA QUE PROCEDE POR DERECHO PROPIO ");	

			}
			else if($rowcontratantes[13]=='INT')
			{
				$dataRepresentantes[] = array('nom_contratante'=>$evalsexo." ".strtoupper(utf8_decode($rowcontratantes[3])).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".$rowcontratantes[4].", DE ESTADO CIVIL ".$rowcontratantes[8]." ".utf8_decode($formaconyuge).", DE OCUPACION Y/O PROFESION".utf8_decode($evalocupacion).", DOMICILIAR EN ".utf8_decode($rowcontratantes[9]).", DISTRITO DE ".utf8_decode($rowcontratantes[10]).", PROVINCIA Y DEPARTAMENTO DE LIMA SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO ".$rowcontratantes[6]."Y DECLARA QUE PROCEDE POR DERECHO PROPIO ", 'nom_firma'=>strtoupper(utf8_decode($rowcontratantes[3])));
				
				$dataRepresentantes2[] = array('nom_contratante'=>$evalsexo." ".strtoupper(utf8_decode($rowcontratantes[3])).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".$rowcontratantes[4].", DE ESTADO CIVIL ".$rowcontratantes[8]." ".utf8_decode($formaconyuge).", DE OCUPACION Y/O PROFESION".utf8_decode($evalocupacion).", DOMICILIAR EN ".utf8_decode($rowcontratantes[9]).", DISTRITO DE ".utf8_decode($rowcontratantes[10]).", PROVINCIA Y DEPARTAMENTO DE LIMA SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO ".$rowcontratantes[6]."Y DECLARA QUE INTERVIENE EN CALIDAD DE ABOGADO(A) PATROCINADOR(A) DE: ".$esposo." Y ".$esposa."", 'nom_firma'=>strtoupper(utf8_decode($rowcontratantes[3])));
				
			}
		}  
		
		
		}	
	
	}
	

// Plantilla - Contratantes a imprimir
$contratante = utf8_decode($nom_contratante).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".utf8_decode($nacionalidad).", DE ESTADO CIVIL ".$est_civil." ".utf8_decode($formaconyuge).", DE OCUPACION Y/O PROFESION ".$ocupacion.", DOMICILIAR EN ".utf8_decode($domicilio).", DISTRITO DE ".utf8_decode($nom_distrito).", PROVINCIA Y DEPARTAMENTO DE LIMA, SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO ".utf8_decode($numdoc_contrat). " Y DECLARA QUE PROCEDE POR PROPIO DERECHO";


//Carga la plantilla;
	$TBS->LoadTemplate($template);
	
	// Creando el bloque para la impresion de contratanates:
	
	//$TBS->MergeBlock('a,b', $data);
	$TBS->MergeBlock('a', $dataContratantes);
	
	$TBS->MergeBlock('d,e', $dataRepresentantes);
	
	$TBS->MergeBlock('f', $dataRepresentantes2);
	
	$TBS->MergeBlock('b,c', $dataContratantes2);
	
	//$TBS->MergeBlock('i', $todos_insertos);
	
	# $TBS->MergeBlock('c', $dataContratantes);
	
	
//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

//Nombre para el archivo a descargar.
	//$file_name = 

    $file_name = 'K'.$num_kardex.'.odt';
	//$file_name = str_replace('.','_'.$suffix.'.',$file_name);
	
    //$TBS->Show(TBSZIP_FILE, $file_name);
	//$TBS->Show(OPENTBS_FILE+TBS_EXIT, $file_name);
	
	$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
#}
	echo '<!DOCTYPE HTML><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Impresion</title>
	</head>
		<body><center>
			Archivo Generado correctamente..!!</br>
			Nombre del archivo: '.$file_name.'</br>'; 
	echo '  Fecha de creación : '.date("d-m-Y").'</br>'; 
	echo '<a href="download.php?file='.$file_name.'" target="_blank">Descargar archivo</a>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="javascript:self.close();">Cerrar ventana</a>';
	echo'</center></body>
	</html>';

//$TBS->Show(OPENTBS_DOWNLOAD, $file_name);
?>
