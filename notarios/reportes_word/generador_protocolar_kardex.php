<?php

// Carga las librerias:
include('../conexion.php');
include_once('../includes/tbs_class.php');
include_once('../includes/tbs_plugin_opentbs.php');
include_once('../includes/ClaseLetras.class.php');

include_once('../QueryPath/QueryPath.php');

include_once('../HTMLtoDOC/class_rtf.php');

include_once('../HTMLtoDOC_2/html2doc.php');



#include_once('../QueryPath/examples/docx.php');
#echo $data; exit();

## notario :
$busnumcarta = "SELECT CONCAT(confinotario.nombre, ' ', confinotario.apellido ) AS 'NOTARIO' , confinotario.direccion, confinotario.distrito FROM confinotario";
$numcartabus = mysql_query($busnumcarta,$conn) or die(mysql_error());
$rownum      = mysql_fetch_array($numcartabus);
$muesnotario = $rownum[0];
$direccion   =  strtoupper($rownum[1]);
$distrito_notario   =  strtoupper($rownum[2]);
##

//se crea el objeto  ClaseLetras



    $fecha     = new ClaseNumeroLetra();
	$fec_firma = new ClaseNumeroLetra();

	$dia  = $fecha->fun_fecha_dia(); 
	$mes  = $fecha->fun_fecha_mes();
	$anio = $fecha->fun_fecha_anio();

	$fec_letras = $fecha->fun_fech_comple(date("Y/m/d"));
	$fec_letras2 = $fecha->fun_fech_comple(date("Y/m/d"));
	

//Se crea el objeto TBS
	$TBS = new clsTinyButStrong; 
// Se cargan las propiedades del PLUGIN
	$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);

	$suffix = '';
	$debug  = '';

// Se verifica que formato de plantilla se usara.
	//$template = "plantilla_123.odt";
	$template = "plantilla_protocolar_kardex.odt";

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

$consulcabecera1 = mysql_query('SELECT kardex.numescritura AS "escritura", kardex.kardex AS "num_kardex" , kardex.numminuta AS "num_minuta", kardex.txa_minuta 
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
CONCAT(cliente2.prinom," ",cliente2.segnom,", ",cliente2.apepat," ",cliente2.apemat) as nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu",
cliente2.numdoc, UPPER(cliente2.detaprofesion)  AS "Ocupacion", 
tipoestacivil.desestcivil AS "ecivil", cliente2.direccion, 

IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto ))  AS "Distrito"  , cliente2.sexo AS "sexo" ,CLIENTE2.tipper, IF(contratantes.firma = "0", "NO","SI") AS "firma",contratantes.tiporepresentacion,
contratantes.numpartida,sedesregistrales.dessede,contratantes.inscrito
FROM contratantesxacto
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
INNER JOIN contratantes ON contratantes.idcontratante = contratantesxacto.idcontratante AND contratantes.kardex = contratantesxacto.kardex
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
LEFT OUTER JOIN sedesregistrales ON  sedesregistrales.idsedereg = contratantes.idsedereg 
WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND cliente2.tipper="N" GROUP BY idcontratante ', $conn) or die(mysql_error());
# /*(CASE WHEN(cliente2.idprofesion<>"0") THEN profesiones.desprofesion ELSE ""  END)*/ -> ocupacion
#LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente2.idprofesion -> de la tabla profesiones
##WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND contratantesxacto.idtipoacto = "'.$idtipoacto.'" ', $conn) or die(mysql_error());
	# $rowcontratantes =  mysql_fetch_array($consulcontratantes);

## Objeto para juridicas.
###########################
$consulcontratantes5 = mysql_query('SELECT DISTINCT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.idcontratante, 
CONCAT(cliente2.prinom," ",cliente2.segnom,", ",cliente2.apepat," ",cliente2.apemat) as nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu",
cliente2.numdoc , UPPER(cliente2.detaprofesion)  AS "Ocupacion", 
tipoestacivil.desestcivil AS "ecivil", cliente2.direccion, 
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto )) AS "Distrito"  , cliente2.sexo AS "sexo" ,CLIENTE2.tipper
FROM contratantesxacto
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND cliente2.tipper="N" ', $conn) or die(mysql_error());
###########################
# /*(CASE WHEN(cliente2.idprofesion<>"0") THEN profesiones.desprofesion ELSE ""  END)*/
#LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente2.idprofesion	
	
## NUMERO DE CONTRATANTES (NATURAL Y JURIDICOS)
$consulnumcontrat = mysql_query('SELECT DISTINCT cliente2.idcliente FROM contratantesxacto INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante WHERE kardex=  "'.$num_kardex.'" ' , $conn) or die(mysql_error());

$numcontratantes =  mysql_num_rows($consulnumcontrat);	

//$rowcontratantes =  mysql_fetch_array($consulcontratantes);
	
## PERSONA JURIDICA. ##
$consuljuridica = mysql_query('SELECT DISTINCT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.idcontratante,
cliente2.razonsocial, (CASE WHEN ISNULL(nacionalidades.descripcion) THEN "23" ELSE nacionalidades.descripcion END) AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu",
cliente2.numdoc, cliente2.domfiscal AS "direccion",  
ubigeo.nomdis AS "Distrito" , cliente2.actmunicipal, CLIENTE2.tipper, cliente2.numpartida,sedesregistrales.dessede
FROM contratantesxacto
INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
LEFT OUTER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
left outer join ubigeo ON ubigeo.coddis = cliente2.idubigeo
INNER JOIN sedesregistrales ON cliente2.idsedereg = sedesregistrales.idsedereg
WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND cliente2.tipper="J" GROUP BY idcontratante', $conn) or die(mysql_error());
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
	$num_minuta       = $rowcabecera1[2];
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

$fp = fopen($ruta.$archivo, 'r'); 
$contents = fread($fp, filesize($ruta.$archivo)); 

######## WORD ##########
function format($qp, $findSelector = null) {

  // Create a new branch for printing later.
  $qr = $qp->branch();
  $text = "";
  $text = $qr->find($findSelector)->find('w|t')->text();
  $text = (checkUnderline($qp->branch())) ? '<u>'.$text.'</u>' : $text;
  $text = (checkBold($qp->branch())) ? '<b>'.$text.'</b>' : $text;
  return $text;
}

function checkBold($qp) {
  $qp->children("w|rPr");
  return ($qp->children('w|b')->html()) ? true : false;
}

function checkUnderline($qp) {
  $qp->children("w|rPr");
  return ($qp->children('w|u')->html()) ? true : false;
}

### new funtion 01
function read($filename)
	{
		// Save name of the file
		//parent::SetDocName($FilePath);
	
		$Data = docx2text($filename);
	
		$Data = str_replace("<", "&lt;", $Data);
		$Data = str_replace(">", "&gt;", $Data);
	
		$Breaks = array("\r\n", "\n", "\r");
		$Data = str_replace($Breaks, '<br />', $Data);
	
		return $Data."||||";
	}

########################

$archivo_ruta = $ruta.$archivo;
function docx2text($filename) {
    return readZippedXML($filename, "word/document.xml");
}


function readZippedXML($archiveFile, $dataFile)
{
    // Create new ZIP archive
    $zip = new ZipArchive;

    // Open received archive file
    if (true === $zip->open($archiveFile))
    {
        // If done, search for the data file in the archive
        if (($index = $zip->locateName($dataFile)) !== false)
        {
            // If found, read it to the string
            $data = $zip->getFromIndex($index);

            // Close archive file
            $zip->close();

            // Load XML from a string
            // Skip errors and warnings
            $xml = DOMDocument::loadXML($data, LIBXML_NOENT  | LIBXML_NOERROR | LIBXML_NOWARNING);

            $xmldata = $xml->saveXML();
            //$xmldata = str_replace("</w:t>", "\r\n", $xmldata);
            // Return data without XML formatting tags
			//ACA LE QUITO TODAS LAS ETIQUETAS PERO IGUAL NADA NI CON ESO EN XML
			//MAS ABAJO ESTAN TODAS LAS OPCIONES Q SE INTENT
            return strip_tags($xmldata);
        }

        $zip->close();
    }

    // In case of failure return empty string
    return "";
} 

########################

## Opcion 01
$data =  docx2text('C:/minutas/000001.docx',"word/document.xml");//docx2text($archivo_ruta);
//$path = $data;
#$contents2 = $data;


## Opcion 02
#$data2 = read('C:/minutas/000001.docx');


## Opcion 03			strip_tags(
#$contents2 = $rowcabecera1[3]; //$data2;


 $contents2 = stripslashes(utf8_decode($rowcabecera1[3]));



   
## Opcion 04
// $rtf = new rtf("rtf_config.php");
// $rtf->addText($rowcabecera1[3]);
// $contents2 = $rtf->getDocument();

   	
## Opcion 05
#$htmltodoc = new HTML_TO_DOC();
#$contents2 = $htmltodoc->createDoc($rowcabecera1[3],"doc",true); #,'',false);  
#$htmltodoc->_parseHtml($rowcabecera1[3]);#,"doc",false);  

#exit();

## Opcion 06
/*
set_time_limit(0); 
chmod("D:/000001.doc", 0644);
$fp = fopen("D:/000001.doc", 'w+'); 
$page = $rowcabecera1[3];
fwrite ($fp, $page); 
fclose($fp); 
exit();
*/
## **********************

## Opcion 07
function html2txt($document){ 
$search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript 
               '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags 
               '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly 
               '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA 
); 
$text = preg_replace($search, '', $document); 
return $text; 
} 

#$contents2 = html2txt($rowcabecera1[3]);


## Opción 08 
function strip_word_html($text, $allowed_tags = '<b><i><sup><sub><em><strong><u><br>') 
    { 
        mb_regex_encoding('UTF-8'); 
        //replace MS special characters first 
        $search = array('/&lsquo;/u', '/&rsquo;/u', '/&ldquo;/u', '/&rdquo;/u', '/&mdash;/u'); 
        $replace = array('\'', '\'', '"', '"', '-'); 
        $text = preg_replace($search, $replace, $text); 
        //make sure _all_ html entities are converted to the plain ascii equivalents - it appears 
        //in some MS headers, some html entities are encoded and some aren't 
        $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8'); 
        //try to strip out any C style comments first, since these, embedded in html comments, seem to 
        //prevent strip_tags from removing html comments (MS Word introduced combination) 
        if(mb_stripos($text, '/*') !== FALSE){ 
            $text = mb_eregi_replace('#/\*.*?\*/#s', '', $text, 'm'); 
        } 
        //introduce a space into any arithmetic expressions that could be caught by strip_tags so that they won't be 
        //'<1' becomes '< 1'(note: somewhat application specific) 
        $text = preg_replace(array('/<([0-9]+)/'), array('< $1'), $text); 
        $text = strip_tags($text, $allowed_tags); 
        //eliminate extraneous whitespace from start and end of line, or anywhere there are two or more spaces, convert it to one 
        $text = preg_replace(array('/^\s\s+/', '/\s\s+$/', '/\s\s+/u'), array('', '', ' '), $text); 
        //strip out inline css and simplify style tags 
        $search = array('#<(strong|b)[^>]*>(.*?)</(strong|b)>#isu', '#<(em|i)[^>]*>(.*?)</(em|i)>#isu', '#<u[^>]*>(.*?)</u>#isu'); 
        $replace = array('<b>$2</b>', '<i>$2</i>', '<u>$1</u>'); 
        $text = preg_replace($search, $replace, $text); 
        //on some of the ?newer MS Word exports, where you get conditionals of the form 'if gte mso 9', etc., it appears 
        //that whatever is in one of the html comments prevents strip_tags from eradicating the html comment that contains 
        //some MS Style Definitions - this last bit gets rid of any leftover comments */ 
        $num_matches = preg_match_all("/\<!--/u", $text, $matches); 
        if($num_matches){ 
              $text = preg_replace('/\<!--(.)*--\>/isu', '', $text); 
        } 
        return $text; 
    } 
# $contents2 = strip_word_html($rowcabecera1[3]);



## Opción 09
function xml_entities($text, $charset = 'Windows-1252'){
     // Debug and Test
    // $text = "test &amp; &trade; &amp;trade; abc &reg; &amp;reg; &#45;";
    
    // First we encode html characters that are also invalid in xml
    $text = htmlentities($text, ENT_COMPAT, $charset, false);
    
    // XML character entity array from Wiki
    // Note: &apos; is useless in UTF-8 or in UTF-16
    $arr_xml_special_char = array("&quot;","&amp;","&apos;","&lt;","&gt;");
    
    // Building the regex string to exclude all strings with xml special char
    $arr_xml_special_char_regex = "(?";
    foreach($arr_xml_special_char as $key => $value){
        $arr_xml_special_char_regex .= "(?!$value)";
    }
    $arr_xml_special_char_regex .= ")";
    
    // Scan the array for &something_not_xml; syntax
    $pattern = "/$arr_xml_special_char_regex&([a-zA-Z0-9]+;)/";
    
    // Replace the &something_not_xml; with &amp;something_not_xml;
    $replacement = '&amp;${1}';
    return preg_replace($pattern, $replacement, $text);
}

function xml_entity_decode($text, $charset = 'Windows-1252'){
    // Double decode, so if the value was &amp;trade; it will become Trademark
    $text = html_entity_decode($text, ENT_COMPAT, $charset);
    $text = html_entity_decode($text, ENT_COMPAT, $charset);
    return $text;
}

#$contents2 = xml_entities($rowcabecera1[3]);





/*foreach(qp($path, 'w|p') as $qp) {
  $qr = $qp->branch();
  echo format($qr->find('w|r:first'), 'w|r:first').' ';
  $qp->find('w|r:first');
  while($qp->next('w|r')->html() != null) {
    $qr = $qp->branch();
    echo format($qr->find('w|r'), 'w|r').' ';
  }
  echo '</br>';
}
exit();*/
#echo $data;exit();



//if($contents=="")
//{
	//echo "No existe el archivo: ".$archivo;
	//exit();
//$contents2="NO SE HA DEFINIDO LA MINUTA.";	
//}

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

##### BUSQUEDA DE LOS INSERTOS
$busca_insertos = mysql_query('SELECT insertos FROM kardex WHERE kardex.kardex = "'.$num_kardex.'" ', $conn) or die(mysql_error());
$row_inserto    =  mysql_fetch_array($busca_insertos);

# Guarda los insertos	
$values = explode(",",$row_inserto[0]);	

# Cuenta los insertos:
$num_insertos = substr_count($row_inserto[0], ',');

# Pushea el array con los Insertos
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
	if($data_insertar == "")
	{$data_insertar = "";}
############################################## DEFINICION Y CARGA DE LOS INSERTOS ##############################################
################################################################################################################################

// Evalua el numero de datos:

$dataContratantes = array();
$dataContratantes2 = array();

// Evalua multiplicidad de representantes para una empresa
$dataRepresentantes = array();

//opcion 2:

	$consultrepre = mysql_query('SELECT contratantes.idcontratante FROM contratantes WHERE contratantes.kardex = "'.$num_kardex.'" AND contratantes.tiporepresentacion = "1"', $conn) or die(mysql_error());

			
for($i = 0; $i <= $numcontratantes -1; $i++)
	{
		
		
			while($rowcontratantes = mysql_fetch_array($consulcontratantes)){	
					//echo $rowcontratantes[2];
					//echo $rowcontratantes[3]." ".$rowcontratantes[12]." ".$rowcontratantes[13];
					//BUSTINZA LOPEZ, MANUEL ARTURO N SI
					//BUSTINZA MOREANO, MANUEL ANTONIO N NO
					//CHUECA PALOMINO, MILAGROS ENCARNACION N SI
					//VASQUEZ PEREZ, LUIS GUILLERMO N SI

		$rowrept =  mysql_fetch_array($consultrepre);//Jala el id de los representantes	
		//echo $rowcontratantes[3]."FIRMA".$rowcontratantes[13]."FIN  ";
		#busca conyuge:
		$consulconyuge1 = mysql_query('SELECT cliente.nombre AS "conyuge" FROM cliente WHERE idcliente = (SELECT cliente2.conyuge FROM cliente2 WHERE idcontratante =  "'.$rowcontratantes[2].'") ', $conn) or die(mysql_error());
	    $rowconyuge1 = mysql_fetch_array($consulconyuge1);
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
			$evalsexo = "";	
		}
		else if($rowcontratantes[11]=="F")
		{
			$evalsexo = utf8_decode("");
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

		if($rowcontratantes[12]=='N')
		{
			
		$evalua_rept = utf8_decode($rowrept[0]);
		
		###################################
		## para evaluar personas naturales#
		/*$consulcontratantes3 = mysql_query('SELECT DISTINCT contratantesxacto.kardex, contratantesxacto.idtipoacto, contratantesxacto.idcontratante,
		cliente2.nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu",
		cliente2.numdoc, UPPER(cliente2.detaprofesion) AS "Ocupacion", 
		tipoestacivil.desestcivil AS "ecivil", cliente2.direccion,  (CASE WHEN ISNULL(ubigeo.nomdis) THEN "" ELSE ubigeo.nomdis  END) AS "Distrito"  , cliente2.sexo AS "sexo" ,CLIENTE2.tipper
		FROM contratantesxacto
		INNER JOIN cliente2 ON cliente2.idcontratante = contratantesxacto.idcontratante
		INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
		INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
		INNER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
		LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
		WHERE contratantesxacto.kardex =  "'.$num_kardex.'" AND cliente2.tipper="N" ', $conn) or die(mysql_error());
		$rowcontratantes3 =  mysql_fetch_array($consulcontratantes3);	*/
		###################################
		# LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente2.idprofesion
		# (CASE WHEN(cliente2.idprofesion<>"0") THEN profesiones.desprofesion ELSE ""  END) --> profesiones.

		$evalrepresentante = $rowcontratantes[2];
		//echo $evalrepresentante;
		//echo $evalua_rept;
		//echo $evalua_rept."cambio";
		if(($evalrepresentante == $evalua_rept) && ($evalua_rept != ""))
			{$eval_firma_natural = "";
}  

		}
		
		
			
			if($rowcontratantes[13]=="SI")	{
			
			if($rowcontratantes[13]=="SI" && $rowcontratantes[14]=="1"){
			
			$eval_firma_natural =  strtoupper(utf8_decode($rowcontratantes[3]))	;
						//echo $eval_firma_natural;
					$consulrepresentantenatural = mysql_query('SELECT DISTINCT CONCAT(cliente2.prinom," ",cliente2.segnom,", ",cliente2.apepat," ",cliente2.apemat) AS nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu", cliente2.numdoc,
UPPER(cliente2.detaprofesion) AS "Ocupacion", tipoestacivil.desestcivil AS "ecivil",
cliente2.direccion,  
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto )) AS "Distrito",contratantesxacto.uif,contratantes.inscrito
			FROM contratantes
			INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante
			INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
			INNER JOIN contratantesxacto ON contratantesxacto.idcontratante=contratantes.idcontratante  AND contratantes.kardex = contratantesxacto.kardex
			INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
			LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
			LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
			LEFT OUTER JOIN sedesregistrales ON  sedesregistrales.idsedereg = contratantes.idsedereg 
			WHERE contratantes.idcontratante =  "'.$rowcontratantes[2].'" GROUP BY numdoc ', $conn) or die(mysql_error());
			while($rowreprenatural = mysql_fetch_array($consulrepresentantenatural)){
			
			if($rowreprenatural[0]!=$rowcontratantes[3]){
				if($rowreprenatural[8]!="TE"){
					$evaltextito="Y DECLARA QUE PROCEDE EN REPRESENTACION DE ";
				}else if($rowreprenatural[8]=="TE"){
					$evaltextito="Y DECLARA QUE PROCEDE EN CALIDAD DE TESTIGO A RUEGO DE ";
					}
				if($rowreprenatural[9]=='1')
				{
					$prueba = "hola".$rowcontratantes[15];
					$prueba1 = "hola1".$rowcontratantes[16];
				}	else if($rowreprenatural[9]!='1')
				{$prueba = "fallo";
					$prueba1 = "fallo1";}
					
				$dataContratantes2[] = array('nom_contratante' => utf8_decode($evalseguim)." ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowreprenatural[0]))))." QUIEN MANIFIESTA SER DE NACIONALIDAD ".strtoupper(utf8_decode($rowreprenatural[1])).", DE ESTADO CIVIL ".strtoupper($rowreprenatural[5]).", DE OCUPACION Y/O PROFESION ".strtoupper(utf8_decode($rowreprenatural[4]))." , DOMICILIAR EN ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowreprenatural[6])))).", ".strtoupper(utf8_decode($rowreprenatural[7])).", SE IDENTIFICA CON ".strtoupper(utf8_decode($rowreprenatural[2]))." NUMERO ".strtoupper(utf8_decode($rowreprenatural[3])).strtoupper(utf8_decode($evaltextito)).str_replace("*","&",str_replace("?","'",strtoupper($rowcontratantes[3])))." CON ".strtoupper(utf8_decode($rowcontratantes[5]))." NUMERO ".strtoupper($rowcontratantes[6]).strtoupper(utf8_decode(", CON FACULTADES INSCRITAS EN LA PARTIDA NUMERO ")).strtoupper($rowcontratantes[11])." DEL REGISTRO DE MANDATOS Y PODERES DE LIMA.", 'nom_firma'=>strtoupper(utf8_decode($rowreprenatural[0])).chr(13).chr(10)." POR ".str_replace("*","&",str_replace("?","'",strtoupper($rowcontratantes[3]))));
				}
			}
			
			}else if($rowcontratantes[13]=="SI" && $rowcontratantes[14]=="0"){
			
			
			$eval_firma_natural =  strtoupper(utf8_decode($rowcontratantes[3]))	;
						
					//echo "hola".$eval_firma_natural;
						$dataContratantes2[] = array('nom_contratante'=>$evalsexo." ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowcontratantes[3])))).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".utf8_decode($rowcontratantes[4]).", DE ESTADO CIVIL ".$rowcontratantes[8]." ".utf8_decode($formaconyuge).", DE OCUPACION Y/O PROFESION ".utf8_decode($evalocupacion).", DOMICILIAR EN ".str_replace("*","&",str_replace("?","'",utf8_decode($rowcontratantes[9]))).",  ".utf8_decode($rowcontratantes[10]).",  SE IDENTIFICA CON ".strtoupper(utf8_decode($rowcontratantes[5]))." NUMERO ".$rowcontratantes[6]." Y QUIEN PROCEDE POR SU PROPIO DERECHO.", 'nom_firma'=>$eval_firma_natural); 
				## -> .strtoupper($rowrepderecho[2])." ".strtoupper($rowrepderecho[4])
			}else if($rowcontratantes[13]=="SI" && $rowcontratantes[14]=="2"){
			$eval_firma_natural =  strtoupper(utf8_decode($rowcontratantes[3]))	;
						$dataContratantes2[] = array('nom_contratante'=>$evalsexo." ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowcontratantes[3])))).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".utf8_decode($rowcontratantes[4]).", DE ESTADO CIVIL ".$rowcontratantes[8]." ".utf8_decode($formaconyuge).", DE OCUPACION Y/O PROFESION ".utf8_decode($evalocupacion).", DOMICILIAR EN ".str_replace("*","&",str_replace("?","'",utf8_decode($rowcontratantes[9]))).", ".utf8_decode($rowcontratantes[10]).",  SE IDENTIFICA CON ".strtoupper(utf8_decode($rowcontratantes[5]))." NUMERO ".$rowcontratantes[6]." Y QUIEN PROCEDE POR SU PROPIO DERECHO.", 'nom_firma'=>$eval_firma_natural); 
			
			}
			
			
				
			}else if($rowcontratantes[13]=="NO"){
			if($rowcontratantes[13]=="NO" && $rowcontratantes[14]=="0")
					{
						$eval_firma_natural =  strtoupper(utf8_decode($rowcontratantes[3]))	;
						//echo $eval_firma_natural;
					$consulrepresentantenatural = mysql_query('SELECT DISTINCT CONCAT(cliente2.prinom," ",cliente2.segnom,", ",cliente2.apepat," ",cliente2.apemat) AS nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu", cliente2.numdoc,
UPPER(cliente2.detaprofesion) AS "Ocupacion", tipoestacivil.desestcivil AS "ecivil",
cliente2.direccion,  
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto )) AS "Distrito",contratantesxacto.uif,contratantes.inscrito,
contratantes.numpartida,sedesregistrales.dessede,facultades
			FROM contratantes
			INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante
			INNER JOIN contratantesxacto ON contratantesxacto.idcontratante=contratantes.idcontratante  AND contratantes.kardex = contratantesxacto.kardex
			INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
			INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
			LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
			LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
			LEFT OUTER JOIN sedesregistrales ON  sedesregistrales.idsedereg = contratantes.idsedereg 
			WHERE contratantes.idcontratanterp =  "'.$rowcontratantes[2].'" GROUP BY numdoc ', $conn) or die(mysql_error());
	while($rowreprenatural = mysql_fetch_array($consulrepresentantenatural)){	
				if($rowreprenatural[8]!="TE"){
					
					if($rowreprenatural[9]=='1')
				{
					$prueba = strtoupper(utf8_decode(", CON FACULTADES INSCRITAS EN LA PARTIDA NUMERO ")).$rowreprenatural[10]." DEL REGISTRO DE MANDATOS Y PODERES DE ".$rowreprenatural[11];
				}	else if($rowreprenatural[9]!='1')
				{$prueba = strtoupper(utf8_decode(", CON FACULTADES INSCRITAS EN ")).$rowreprenatural[12];}
					
				$dataContratantes2[] = array('nom_contratante' => utf8_decode($evalseguim)." ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowreprenatural[0]))))." QUIEN MANIFIESTA SER DE NACIONALIDAD ".strtoupper(utf8_decode($rowreprenatural[1])).", DE ESTADO CIVIL ".strtoupper($rowreprenatural[5]).", DE OCUPACION Y/O PROFESION ".strtoupper(utf8_decode($rowreprenatural[4]))." , DOMICILIAR EN ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowreprenatural[6])))).", ".strtoupper(utf8_decode($rowreprenatural[7])).", SE IDENTIFICA CON ".strtoupper(utf8_decode($rowreprenatural[2]))." NUMERO ".strtoupper(utf8_decode($rowreprenatural[3])).strtoupper(utf8_decode(", Y DECLARA QUE PROCEDE EN REPRESENTACIÓN DE ")).str_replace("*","&",str_replace("?","'",strtoupper($rowcontratantes[3])))." CON ".strtoupper(utf8_decode($rowcontratantes[5]))." NUMERO ".strtoupper($rowcontratantes[6]), 'nom_firma'=>strtoupper(utf8_decode($rowreprenatural[0])).chr(13).chr(10)." POR ".str_replace("*","&",str_replace("?","'",strtoupper($rowcontratantes[3]))));}
				else if($rowreprenatural[8]=="TE"){
					
				$dataContratantes2[] = array('nom_contratante' => utf8_decode($evalseguim)." ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowreprenatural[0]))))." QUIEN MANIFIESTA SER DE NACIONALIDAD ".strtoupper(utf8_decode($rowreprenatural[1])).", DE ESTADO CIVIL ".strtoupper($rowreprenatural[5]).", DE OCUPACION Y/O PROFESION ".strtoupper(utf8_decode($rowreprenatural[4]))." , DOMICILIAR EN ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowreprenatural[6])))).",  ".strtoupper(utf8_decode($rowreprenatural[7])).", SE IDENTIFICA CON ".strtoupper(utf8_decode($rowreprenatural[2]))." NUMERO ".strtoupper(utf8_decode($rowreprenatural[3])).strtoupper(utf8_decode(", Y DECLARA QUE PROCEDE EN CALIDAD DE TESTIGO A RUEGO DE ")).str_replace("*","&",str_replace("?","'",strtoupper($rowcontratantes[3])))." CON ".strtoupper(utf8_decode($rowcontratantes[5]))." NUMERO ".strtoupper($rowcontratantes[6]).strtoupper(utf8_decode("<AQUI ESCRIBA CONDICION>")), 'nom_firma'=>strtoupper(utf8_decode($rowreprenatural[0])).chr(13).chr(10)." POR ".str_replace("*","&",str_replace("?","'",strtoupper($rowcontratantes[3]))));}
				## -> .strtoupper($rowrepderecho[2])." ".strtoupper($rowrepderecho[4])
					}}
					else if($rowcontratantes[13]=="SI" && $rowcontratantes[14]=="2"){
							$eval_firma_natural =  strtoupper(utf8_decode($rowcontratantes[3]))	;
						$dataContratantes2[] = array('nom_contratante'=>$evalsexo." ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowcontratantes[3])))).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".utf8_decode($rowcontratantes[4]).", DE ESTADO CIVIL ".$rowcontratantes[8]." ".utf8_decode($formaconyuge).", DE OCUPACION Y/O PROFESION ".utf8_decode($evalocupacion).", DOMICILIAR EN ".str_replace("*","&",str_replace("?","'",utf8_decode($rowcontratantes[9]))).", ".utf8_decode($rowcontratantes[10]).",  SE IDENTIFICA CON ".strtoupper(utf8_decode($rowcontratantes[5]))." NUMERO ".$rowcontratantes[6]." Y QUIEN PROCEDE POR SU PROPIO DERECHO.", 'nom_firma'=>$eval_firma_natural); 
						}
					 else if($rowcontratantes[13]=="SI" && $rowcontratantes[14]=="0")
					{
					
						$eval_firma_natural =  strtoupper(utf8_decode($rowcontratantes[3]))	;
						
					//echo "hola".$eval_firma_natural;

				$dataContratantes2[] = array('nom_contratante'=>$evalsexo." ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowcontratantes[3])))).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".utf8_decode($rowcontratantes[4]).", DE ESTADO CIVIL ".$rowcontratantes[8]." ".utf8_decode($formaconyuge).", DE OCUPACION Y/O PROFESION ".utf8_decode($evalocupacion).", DOMICILIAR EN ".str_replace("*","&",str_replace("?","'",utf8_decode($rowcontratantes[9]))).", ".utf8_decode($rowcontratantes[10]).",  SE IDENTIFICA CON ".strtoupper(utf8_decode($rowcontratantes[5]))." NUMERO ".$rowcontratantes[6]." Y QUIEN PROCEDE POR SU PROPIO DERECHO.", 'nom_firma'=>$eval_firma_natural); 
				## -> .strtoupper($rowrepderecho[2])." ".strtoupper($rowrepderecho[4])
					} 
			}
					
				
		}
	$rowcontratantesj =  mysql_fetch_array($consulcontratantes5);
	$rowjuridica     =  mysql_fetch_array($consuljuridica);
	
		
		
	if($rowjuridica[10]=='J')
	{
	$evaljuridica = utf8_decode($rowjuridica[2]);
	

	$consulrepresentante = mysql_query('SELECT CONCAT(cliente2.prinom," ",cliente2.segnom,", ",cliente2.apepat," ",cliente2.apemat) AS nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu", cliente2.numdoc,
UPPER(cliente2.detaprofesion) AS "Ocupacion", tipoestacivil.desestcivil AS "ecivil",
cliente2.direccion, 
IF(ubigeo.coddis="070101","DISTRITO DE CALLAO , PROVINCIA CONSTITUCIONAL DEL CALLAO",CONCAT("DISTRITO DE ",ubigeo.nomdis, ", PROVINCIA DE ", ubigeo.nomprov,", DEPARTAMENTO DE ",ubigeo.nomdpto )) AS "Distrito",facultades,inscrito
			FROM contratantes
			INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante
			INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
			INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
			LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
			LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
			WHERE contratantes.idcontratanterp =  "'.$rowjuridica[2].'" ', $conn) or die(mysql_error());
			
	while($rowrepresentante = mysql_fetch_array($consulrepresentante)){
		
			if($rowrepresentante[9]=='0')
			{
				$prueba = " CON FACULTADES INSCRITAS EN ".strtoupper(utf8_decode($rowrepresentante[8]));	
			}if($rowrepresentante[9]=='1'){
				$prueba = " CON FACULTADES INSCRITAS EN LA PARTIDA NUMERO ".strtoupper($rowjuridica[11])." DEL REGISTRO DE PERSONAS JURIDICAS DE  ".strtoupper(utf8_decode($rowjuridica[12]));
				}
			
			/*$dataContratantes2[] = array('nom_contratante' => utf8_decode($evalseguim)." ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresentante[0]))))." QUIEN MANIFIESTA SER DE NACIONALIDAD ".strtoupper($rowrepresentante[1]).", DE ESTADO CIVIL ".strtoupper($rowrepresentante[5]).", DE OCUPACION Y/O PROFESION ".strtoupper(utf8_decode($rowrepresentante[4]))." , DOMICILIAR EN ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresentante[6])))).", ".strtoupper(utf8_decode($rowrepresentante[7])).",  SE IDENTIFICA CON ".strtoupper(utf8_decode($rowrepresentante[2]))." NUMERO ".strtoupper(utf8_decode($rowrepresentante[3])).strtoupper(utf8_decode(", Y DECLARA QUE PROCEDE EN REPRESENTACIÓN DE ")).str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowjuridica[3]))))." CON REGISTRO UNICO DE CONTRIBUYENTE ".strtoupper($rowjuridica[6]).strtoupper(utf8_decode(", CON FACULTADES INSCRITAS EN LA PARTIDA NUMEROoooo ")).strtoupper($rowjuridica[11])." DEL REGISTRO DE PERSONAS JURIDICAS DE LIMA.", 'nom_firma'=>strtoupper(utf8_decode($rowrepresentante[0])).chr(13).chr(10)." POR ".str_replace("*","&",str_replace("?","'",strtoupper($rowjuridica[3]))));*/
			$dataContratantes2[] = array('nom_contratante' => utf8_decode($evalseguim)." ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresentante[0]))))." QUIEN MANIFIESTA SER DE NACIONALIDAD ".strtoupper($rowrepresentante[1]).", DE ESTADO CIVIL ".strtoupper($rowrepresentante[5]).", DE OCUPACION Y/O PROFESION ".strtoupper(utf8_decode($rowrepresentante[4]))." , DOMICILIAR EN ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresentante[6])))).", ".strtoupper(utf8_decode($rowrepresentante[7])).",  SE IDENTIFICA CON ".strtoupper(utf8_decode($rowrepresentante[2]))." NUMERO ".strtoupper(utf8_decode($rowrepresentante[3])).strtoupper(utf8_decode(", Y DECLARA QUE PROCEDE EN REPRESENTACIÓN DE ")).str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowjuridica[3]))))." CON REGISTRO UNICO DE CONTRIBUYENTE ".strtoupper($rowjuridica[6]).$prueba, 'nom_firma'=>strtoupper(utf8_decode($rowrepresentante[0])).chr(13).chr(10)." POR ".str_replace("*","&",str_replace("?","'",strtoupper($rowjuridica[3]))));
			//si inscrito es 0 agarra la caja facultades.
			//si inscrito es 1 armar variable.
	}
	}
	}
	
// Plantilla - Contratantes a imprimir
$contratante = str_replace("*","&",str_replace("?","'",utf8_decode($nom_contratante))).", QUIEN MANIFIESTA SER DE NACIONALIDAD ".utf8_decode($nacionalidad).", DE ESTADO CIVIL ".$est_civil." ".utf8_decode($formaconyuge).", DE OCUPACION Y/O PROFESION ".$ocupacion.", DOMICILIAR EN ".str_replace("*","&",str_replace("?","'",utf8_decode($domicilio))).", ".utf8_decode($nom_distrito).",  SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO ".utf8_decode($numdoc_contrat). " Y DECLARA QUE PROCEDE POR PROPIO DERECHO.";

/*for($i = 0; $i <= $numcontratantes-1; $i++)
	{
		
	// PEGAR PERSONA JURIDICA	
		
		$rowcontratantesj =  mysql_fetch_array($consulcontratantes5);
		$rowjuridica     =  mysql_fetch_array($consuljuridica);

		#busca conyuge para juridica:
		$consulconyuge1j = mysql_query('SELECT cliente.nombre AS "conyuge" FROM cliente WHERE idcliente = (SELECT cliente2.conyuge FROM cliente2 WHERE idcontratante =  "'.$rowcontratantesj[2].'") ', $conn) or die(mysql_error());
	    $rowconyuge1j = mysql_fetch_array($consulconyuge1j);

		//evalua conyuge juridica:
		if($rowconyuge1j != "")
		{
			$nom_conyuge      = utf8_decode($rowconyuge1j[0]);
			$formaconyuge     = "CON ".utf8_decode($rowconyuge1j[0]);
		}
	
		else if($rowconyuge1j=="")
		{
			$nom_conyuge      = "";
			$formaconyuge     = "";
		}
		//evalua sexo juridica:
		if($rowcontratantesj[11]=="M")
		{
			$evalsexo = "";	
		}
		else if($rowcontratantesj[11]=="F")
		{
			$evalsexo = utf8_decode("");
		}
		
		//evalua ocupacion :
		if($rowcontratantesj[7]=="")
		{
			$evalocupacion = "NO ESPECIFICA";	
		}
		else if($rowcontratantesj[7]!="")
		{
			$evalocupacion = utf8_decode($rowcontratantesj[7]);	
		}
		
		 $consulrepresentante = mysql_query('SELECT cliente2.nombre, nacionalidades.descripcion AS "nacionalidad", tipodocumento.destipdoc AS "tipo_docu", cliente2.numdoc,
UPPER(cliente2.detaprofesion) AS "Ocupacion", tipoestacivil.desestcivil AS "ecivil",
cliente2.direccion,  (CASE WHEN ISNULL(ubigeo.nomdis) THEN "" ELSE ubigeo.nomdis  END) AS "Distrito"
			FROM contratantes
			INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante
			INNER JOIN nacionalidades ON nacionalidades.idnacionalidad = cliente2.nacionalidad
			INNER JOIN tipodocumento ON tipodocumento.idtipdoc = cliente2.idtipdoc
			LEFT OUTER JOIN tipoestacivil ON tipoestacivil.idestcivil = cliente2.idestcivil
			LEFT OUTER JOIN ubigeo ON ubigeo.coddis = cliente2.idubigeo
			WHERE contratantes.idcontratanterp =  "'.$rowjuridica[2].'" ', $conn) or die(mysql_error());
			# (CASE WHEN(cliente2.idprofesion<>"0") THEN profesiones.desprofesion ELSE ""  END) --> profesiones
			# LEFT OUTER JOIN profesiones ON profesiones.idprofesion = cliente2.idprofesion
			
		if($rowjuridica[10]=='J')
		{
			$evaljuridica = utf8_decode($rowjuridica[2]);

			// EVALUA SI FIRMA O NO FIRMA.
			if($rowcontratantesj[13]=='SI')
				{
					$eval_firma = $rowcontratantesj[3];	
				}
				else if($rowcontratantesj[13]=='NO')
					{
						$eval_firma = "";		
					}
			
		     $i = 0;
		while($rowrepresentante = mysql_fetch_array($consulrepresentante))
			{
			
			if($i > 0){$evalseguim ="";}else {$evalseguim = "";}
				
		$dataRepresentantes[] = array('nom_contratante' => utf8_decode($evalseguim)." ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresentante[0]))))." QUIEN MANIFIESTA SER DE NACIONALIDAD ".strtoupper($rowrepresentante[1]).", DE ESTADO CIVIL ".strtoupper($rowrepresentante[5]).", DE OCUPACION Y/O PROFESION ".strtoupper(utf8_decode($rowrepresentante[4]))." , DOMICILIAR EN ".str_replace("*","&",str_replace("?","'",strtoupper(utf8_decode($rowrepresentante[6])))).", DISTRITO DE ".strtoupper(utf8_decode($rowrepresentante[7])).", PROVINCIA Y DEPARTAMENTO DE LIMA, SE IDENTIFICA CON DOCUMENTO NACIONAL DE IDENTIDAD NUMERO ".strtoupper(utf8_decode($rowrepresentante[3])).strtoupper(utf8_decode(", Y DECLARA QUE PROCEDE EN REPRESENTACIÓN DE ")).str_replace("*","&",str_replace("?","'",strtoupper($rowjuridica[3])))." CON REGISTRO UNICO DE CONTRIBUYENTE ".strtoupper($rowjuridica[6]).strtoupper(utf8_decode(", CON FACULTADES INSCRITAS EN LA PARTIDA NUMERO ")).strtoupper($rowjuridica[11])." DEL REGISTRO DE PERSONAS JURIDICAS DE LIMA ", 'nom_firma'=>strtoupper(utf8_decode($rowrepresentante[0])).chr(13).chr(10)." POR ".str_replace("*","&",str_replace("?","'",strtoupper($rowjuridica[3]))));
			//echo $rowrepresentante[0]." | ";
			    $i++;
			
			 $eval_mostrar_persona = strtoupper($rowjuridica[3]) . " REPRESENTADA POR " . strtoupper(utf8_decode($rowrepresentante[0]));
			}

		}
	### AQUI IBA PERSONAS NATURALES	
	
		
	}*/
#############################################################################################################################################################

## EVALUA AL REPRESENTANTE:
	

//Carga la plantilla;
	$TBS->LoadTemplate($template);
	
	// Creando el bloque para la impresion de contratanates:
	
	$TBS->MergeBlock('a', $dataContratantes);
	
	$TBS->MergeBlock('d,g', $dataRepresentantes);
	
	$TBS->MergeBlock('b,c', $dataContratantes2);
	
	//$TBS->MergeBlock('i', $todos_insertos);
	
	# $TBS->MergeBlock('c', $dataContratantes);
	
	
//Si existen comentios en la plantilla los oculta.
	$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

//Nombre para el archivo a descargar.
	//$file_name = 

    $file_name = 'K'.$num_kardex.'.doc';
	//$file_name = str_replace('.','_'.$suffix.'.',$file_name);
	
    //$TBS->Show(TBSZIP_FILE, $file_name);
	//$TBS->Show(OPENTBS_FILE+TBS_EXIT, $file_name);
	
	/*@header("Cache-Control: ");// leave blank to avoid IE errors
	@header("Pragma: ");// leave blank to avoid IE errors
	@header("Content-type: application/octet-stream");
	@header("Content-Disposition: attachment; filename=\"$file_name\"");
	*/
	
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
